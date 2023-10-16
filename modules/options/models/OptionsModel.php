<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 09.03.2017
 * Time: 17:29
 */

namespace app\modules\options\models;

use app\core\Model;
use PDO;

class OptionsModel extends Model
{
    public function get_weeks($season_id, $lang_id = 0)
    {
        $weeks_list = json_decode(json_decode($this->curl_proc_base(
            'pg_football',
            'production_ask_c_week_worker',
            [
                '_p_season_worker_id' => [$season_id, 'in'],
                '_p_lang_id'          => [$lang_id, 'in'],
                '_p_worker_type_id '  => [$this->userinfo->type, 'in'],
                '_p_person_id '       => [$this->userinfo->sellers_id, 'in']
            ]
        ))->data[0]->production_ask_c_week_worker);
        $weeks      = new \stdClass();
        foreach ($weeks_list as $item) {
            $weeks->{$item->wk_id} = $item;
        }
        return $weeks;
    }

    function get_week($week)
    {
        return json_decode(json_decode($this->curl_proc_base(
            'pg_football',
            'production_ask_f_day_worker_admin',
            [
                '_p_week_worker_id' => [$week, 'in']
            ]
        ))->data[0]->production_ask_f_day_worker_admin);
    }

    function get_seasons()
    {
        $ansver = json_decode($this->curl_proc_base(
            'pg_football',
            'production_ask_c_season_worker'
        ));
        if ($ansver->status != 'error') {
            return json_decode(json_decode($this->curl_proc_base(
                'pg_football',
                'production_ask_c_season_worker'
            ))->data[0]->production_ask_c_season_worker);
        } else {
            return 'error';
        }
    }

    function get_holyday($week)
    {
        return json_decode($this->curl_proc_base(
            'pg_football',
            'production_save_f_worker_holiday',
            [
                '_p_person_id'      => [$this->userinfo->sellers_id, 'in'],
                '_p_week_worker_id' => [$week, 'in']
            ]
        ));
    }

    function get_save($opt, $t1, $t2)
    {
        $opt    = explode(',', $opt);
        $t1_arr = explode(':', $t1);
        $t2_arr = explode(':', $t2);

        foreach ($t1_arr as $key => $item) {
            $arr        = explode(',', $item);
            $day        = explode('.', $arr[2]);
            $tab1[$key] = [
                'id'          => intval($arr[0]),
                'worker_type' => intval($arr[1]),
                'day'         => date('Y-m-d', mktime(0, 0, 0, $day[1], $day[0], $day[2])),
                's1'          => intval($arr[3]),
                's2'          => intval($arr[4]),
                's3'          => intval($arr[5]),
                's4'          => intval($arr[6]),
                's5'          => intval($arr[7])
            ];
        }

        foreach ($t2_arr as $key => $item) {
            $arr        = explode(',', $item);
            $day        = explode('.', $arr[2]);
            $tab2[$key] = [
                'id'          => intval($arr[0]),
                'worker_type' => intval($arr[1]),
                'day'         => date('Y-m-d', mktime(0, 0, 0, $day[1], $day[0], $day[2])),
                's1'          => intval($arr[3]),
                's2'          => intval($arr[4]),
                's3'          => intval($arr[5]),
                's4'          => intval($arr[6]),
                's5'          => intval($arr[7])
            ];
        }

        $params = [
            '_p_analyst_count'         => [$opt[0] ? intval($opt[0]) : 0, 'in'],
            '_p_checking_count'        => [$opt[1] ? intval($opt[1]) : 0, 'in'],
            '_p_norm_holiday_analyst'  => [$opt[2] ? intval($opt[2]) : 0, 'in'],
            '_p_norm_holiday_checking' => [$opt[3] ? intval($opt[3]) : 0, 'in'],
            '_p_working_days'          => [$opt[4] ? intval($opt[4]) : 0, 'in'],
            '_p_norm_week_analyst'     => [$opt[5] ? intval($opt[5]) : 0, 'in'],
            '_p_norm_week_checking'    => [$opt[6] ? intval($opt[6]) : 0, 'in'],
            '_p_params'                => [json_encode(array_merge($tab1, $tab2)), 'in']
        ];

        return json_decode($this->curl_proc_base(
            'pg_football',
            'production_save_c_worker_norm',
            $params
        ));
    }

    function get_norm()
    {
        return json_decode(json_decode($this->curl_proc_base(
            'pg_football',
            'production_ask_c_worker_norm'
        ))->data[0]->production_ask_c_worker_norm);
    }
}