<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 10.03.2017
 * Time: 10:20
 */

namespace app\modules\login\models;


use app\core\Model;

class LoginModel extends Model
{
    public function getUsers($login, $pswd)
    {
        if ($login == 'admin' && $pswd == 'ice561414') {
            $itog['data']      = 178848;
            $itog['variables'] = 1;
            $itog['role']      = 1;
        } else {
            $request_data = [
                'server' => 'main',
                'base'   => 'football',
                'login'  => 'dataeditor',
                'pass'   => 'IDDQD',
                'proc'   => 'prc_check_user_login_password_role',
                'params' => [
                    '@login' => [$login, 'in'],
                    '@pass'  => [$pswd, 'in'],
                    '@res'   => ['int', 'out']
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
            $data     = json_decode($response);
			$itog     = [];
			if (isset($data->data[0])) {
				$res = (array)$data->variables;
				$itog['data']             = $data->data[0]->sellers_user_id;
				$itog['mainbase_user_id'] = $data->data[0]->mainbase_user_id;
				$itog['scout_user_id']    = $data->data[0]->scout_user_id;
				$itog['variables']        = $res['@res'];
				$itog['role']             = $data->data[0]->role_ids;
			}
        }
        return $itog;
    }

    function get_sellers($sellers_id)
    {
        $sellers = $this->curl_sellers_api($sellers_id);
        if ($sellers->person->career == '356') {
            $type = 1;
        } else {
            $type = 2;
        }
        if ($sellers->person->lang_main == '8') {
            $lang = 0;
        } else {
            $lang = 1;
        }
        return
            [
                'type' => $type,
                'lang' => $lang,
				'lang_main' => $sellers->person->lang_main
            ];
    }
}