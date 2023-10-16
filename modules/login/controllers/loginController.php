<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 07.03.2017
 * Time: 23:51
 */

namespace app\modules\login\controllers;


use app\core\Controller;
use app\modules\login\models\LoginModel;

class LoginController extends Controller
{
	function index(){
	    if (isset($_POST['get'])){
            if ($_POST['get'] == 'del_session'){
                session_unset();
                session_destroy();
				setcookie('sellers_id','');
                setcookie('role','');
                setcookie('type','');
                setcookie('lang','');
				setcookie('lang_main', '');
                echo json_encode("ok");
            }else {
                $login = htmlspecialchars($_POST['login']);
                $password = htmlspecialchars($_POST['password']);
                $obj = new LoginModel();
                $data = $obj->getUsers($login, $password);
                if (isset($data['data'])) {
                    $week = $obj->get_sellers($data['data']);
                }
                if (isset($data['role']) && $data['role']) {
                    $arr = explode(',', $data['role']);
                    if (in_array(8, $arr)){
                        $role = 1;
                    }elseif (in_array(1, $arr)){
                        $role = 1;
                    }else{
                        $role = 0;
                    }
                    if (in_array(7, $arr) || $role){
                        $type = 2;
                    }else{
                        $type = 1;
                    }
                    $authorization = $data['variables'];
                }

                if (isset($authorization) && $authorization){
                    $_SESSION['sellers_id']       = isset($data['data']) ? $data['data'] : 0;
					$_SESSION['mainbase_user_id'] = isset($data['mainbase_user_id']) ? $data['mainbase_user_id'] : 0;
					$_SESSION['scout_user_id']    = isset($data['scout_user_id']) ? $data['scout_user_id'] : 0;
					$_SESSION['role']             = $role ? $role : 0;
					$_SESSION['type']             = $type ? $type : 1;
					$_SESSION['lang']             = $week['lang'] ? $week['lang'] : 0;
					$_SESSION['lang_main']        = $week['lang_main'] ? $week['lang_main'] : 0;
					setcookie('sellers_id', $data['data'] ? $data['data'] : 0, time() + 86400);
					setcookie('mainbase_user_id', $data['mainbase_user_id'] ? $data['mainbase_user_id'] : 0, time() + 86400);
					setcookie('scout_user_id', $data['scout_user_id'] ? $data['scout_user_id'] : 0, time() + 86400);
					setcookie('role', $role ? $role : 0, time() + 86400);
					setcookie('type', $type ? $type : 1, time() + 86400);
					setcookie('lang', $week['lang'] ? $week['lang'] : 0, time() + 86400);
					setcookie('lang_main', $week['lang_main'] ? $week['lang_main'] : 0, time() + 86400);
					header("Location: /web/");
                }else{
                    header("Location: /web/login");
                }
            }
        }else {
            $this->render('login.php');
        }
	}
}