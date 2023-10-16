<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 09.03.2017
 * Time: 17:29
 */

namespace app\modules\schedule\models;

use app\core\Model;
use PDO;

class ScheduleModel extends Model
{
    public function get_weeks($season_id, $type = false, $lang_id = 0, $id = false)
    {
        if ($type) {
            $t = $type;
        } else {
            $t = $this->userinfo->type;
        }
        if ($id) {
            $i = $id;
        } else {
            $i = $this->userinfo->sellers_id;
        }
        $weeks_list = json_decode(json_decode($this->curl_proc_base(
            'pg_football',
            'production_ask_c_week_worker',
            [
                '_p_season_worker_id' => [$season_id, 'in'],
                '_p_lang_id'          => [$lang_id, 'in'],
                '_p_worker_type_id '  => [$t, 'in'],
                '_p_person_id '       => [$i, 'in']
            ]
        ))->data[0]->production_ask_c_week_worker);
        $weeks      = new \stdClass();
        if (isset($weeks_list)) {
            foreach ($weeks_list as $item) {
                $weeks->{$item->wk_id} = $item;
            }
        }
        return $weeks;
    }

    function get_week($week, $type, $id = false)
    {
		if ($id){
            $i = $id;
        }else{
            $i = $this->userinfo->sellers_id;
        }
        $data = json_decode(json_decode($this->curl_proc_base(
            'pg_football',
            'production_ask_f_day_worker',
            [
                '_p_person_id'      => [$i, 'in'],
                '_p_week_worker_id' => [$week, 'in'],
                '_p_worker_type_id' => [$type, 'in'],
                '_p_lang_id'        => [$this->userinfo->lang, 'in']
            ]
        ))->data[0]->production_ask_f_day_worker);
        return $data;
    }

    function get_seasons()
    {
        return json_decode(json_decode($this->curl_proc_base(
            'pg_football',
            'production_ask_c_season_worker'
        ))->data[0]->production_ask_c_season_worker);
    }

    function get_holyday($week, $type = false, $id = false)
    {
		if ($type){
            $t = $type;
        }else{
            $t = $this->userinfo->type;
        }
        if ($id){
            $i = $id;
        }else{
            $i = $this->userinfo->sellers_id;
        }
        $data  = json_decode($this->curl_proc_base(
            'pg_football',
            'production_save_f_worker_holiday',
            [
                '_p_person_id'      => [intval($i), 'in'],
                '_p_week_worker_id' => [$week, 'in'],
                '_p_worker_type_id' => [intval($t), 'in']
            ]
        ));
        return $data;
    }
	
	function del_holyday($hol_id)
    {
        $admin = $this->userinfo->role ? 1 : 0;
        $data  = json_decode($this->curl_proc_base(
            'pg_football',
            'production_save_f_worker_holiday',
            [
                '_p_id' => [intval($hol_id), 'in'],
                '_p_dl' => [1, 'in']
            ]
        ));
        return $data;
    }

    function get_save($week, $arr, $type, $id = false){
		if ($id){
            $i = $id;
        }else{
            $i = $this->userinfo->sellers_id;
        }
        $a1 = explode(':', $arr);
        foreach ($a1 as $key => $item){
            $a2 = explode(',', $item);
            if (count($a2) == 4) {
                $r[$key]['id']   = $a2[0];
                $reg             = explode('.', $a2[1]);
                $r[$key]['day']  = date('Y-m-d', mktime(0, 0, 0, $reg[1], $reg[0], $reg[2]));
                $r[$key][$a2[2]] = $a2[3];
            } elseif (count($a2) == 2){
                $r[$key]['id']   = $a2[0];
                $reg             = explode('.', $a2[1]);
                $r[$key]['day']  = date('Y-m-d', mktime(0, 0, 0, $reg[1], $reg[0], $reg[2]));
            } else {
                $reg             = explode('.', $a2[0]);
                $r[$key]['day']  = date('Y-m-d', mktime(0, 0, 0, $reg[1], $reg[0], $reg[2]));
                $r[$key][$a2[1]] = $a2[2];
            }
        }
        $res = json_encode($r);
		$admin = $this->userinfo->role ? 1 : 0;
		
        return json_decode($this->curl_proc_base(
            'pg_football',
            'production_save_f_worker_day',
            [
                '_p_person_id'      => [intval($i), 'in'],
                '_p_worker_type_id' => [intval($type), 'in'],
                '_p_week_worker_id' => [$week, 'in'],
                '_p_lang_id'        => [intval($this->userinfo->lang), 'in'],
                '_p_admin'          => [$admin, 'in'],
                '_p_params'         => [$res, 'in']
            ]
        ));
    }
	
	public function getPersons()
    {
        $persons = $this->db->prepare("SELECT id, CONCAT_WS(' ', last_name, first_name, patronymic) fio FROM sellers_analists_persons ORDER BY CONCAT_WS('', last_name, first_name, patronymic)");
        $persons->execute();
        $data = $persons->fetchAll(PDO::FETCH_CLASS);
        return $data;
    }
	
	function get_person_role($sellsrs_id)
    {

        $request_data = [
            'server' => 'main',
            'base'   => 'football',
            'login'  => 'dataeditor',
            'pass'   => 'IDDQD',
            'proc'   => 'get_person_role_ids',
            'params' => [
                '@person_id' => [intval($sellsrs_id), 'in']
            ]
        ];
        $ch           = curl_init('https://service.instatfootball.com/ws.php');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

        $response = curl_exec($ch);
        $data     = json_decode($response, true);
        if (isset($data['data'][0])) {
            $arr = explode(',', $data['data'][0]['role_ids']);


            if (in_array(8, $arr)) {
                $role = 1;
            } elseif (in_array(1, $arr)) {
                $role = 1;
            } else {
                $role = 0;
            }
            if (in_array(7, $arr) || $role) {
                $type = 2;
            } else {
                $type = 1;
            }
        }else{
            $type = 1;
        }

        return $type;
    }
}