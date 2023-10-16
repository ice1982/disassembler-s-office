<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 07.03.2017
 * Time: 22:43
 */

namespace app\modules\main\controllers;


use app\core\Controller;
use app\modules\login\models\LoginModel;
use app\modules\main\models\MainModel;

class MainController extends Controller
{
	function Index(){
	    if (isset($_SESSION['sellers_id']) && $_SESSION['sellers_id']){
            $this->render('index.php');
        }else{
	        header("Location: /web/login");
        }
	}

	function getdata(){
        if (isset($_SESSION['sellers_id']) && $_SESSION['sellers_id']) {
            if ($_POST) {
                $obj = new MainModel();
                $get = $_POST['get'] ? $_POST['get'] : 0;
                if ($get == 'period') {
                    if ($_POST['begin'] && $_POST['end']) {
                        $datab = strtotime($_POST['begin']);
                        $datae = strtotime($_POST['end']);
	                    $databcat = strtotime($_POST['begin']) - 3 * 24 * 60 * 60;
	                    $dataecat = strtotime($_POST['end']) + 3 * 24 * 60 * 60;

                        $databeg = $datab;
                        $datas = $obj->getMatches($_SESSION['sellers_id'], $datab, $datae);
                        $category = $obj->getCategory($_SESSION['sellers_id'], $databcat, $dataecat);
                        while ($databeg <= $datae) {
                            $dates[] = ['d' => date('Y-m-d', $databeg)];
                            $databeg += 24 * 60 * 60;
                        }

                        $data['dates'] = $dates;
                        $data['datas'] = $datas;
                        $data['category'] = $category;
                        echo json_encode($data);

                    }
                } elseif ($get == 'by_day') {
                    $obj = new MainModel();
                    $id = $_POST['id'];
                    $date = $_POST['date'];
                    $data = $obj->getinner($id, $date);
                    echo json_encode($data);
                }
            } else {
                header('Location: /web/');
            }
        }else{
            echo json_encode("sel");
        }
	}
	
	public function get_text(){
	    $model = new MainModel();
	    $obj = $model->translate();
	    $text = $obj['text'];
	    $lang = $obj['lang'];
	    echo json_encode([
	        'text' => $text,
            'lang' => $lang
        ]);
    }
}