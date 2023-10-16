<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 07.03.2017
 * Time: 22:43
 */

namespace app\modules\schedule\controllers;


use app\core\Controller;
use app\modules\schedule\models\ScheduleModel;

class ScheduleController extends Controller
{
    function Index()
    {
        $model   = new ScheduleModel();
        $seasons = $model->get_seasons();

        if (isset($_SESSION['sellers_id']) && $_SESSION['sellers_id']) {
			
            $season_id = 1;
			$id        = $this->userinfo->sellers_id;
			
			$model   = new ScheduleModel();
			$weeks   = $model->get_weeks($season_id, false, $this->userinfo->lang, $id);
			$seasons = $model->get_seasons();
			$this->render('weeks.php', [
				'weeks'      => $weeks,
				'sellers_id' => $id,
				'season_id'  => $season_id,
				'seasons'    => $seasons
			]);
        } else {
            header("Location: /web/login");
        }
    }

    function get_weeks()
    {
        $url       = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $arr       = explode('/', $url);
		
        $season_id = isset($arr[6]) ? $arr[6] : false;
		$id        = isset($arr[7]) ? $arr[7] : $this->userinfo->sellers_id;
		
        $model   = new ScheduleModel();
        $weeks   = $model->get_weeks($season_id, false, $this->userinfo->lang, $id);
        $seasons = $model->get_seasons();
        $this->render('weeks.php', [
            'weeks'      => $weeks,
            'sellers_id' => $id,
            'season_id'  => $season_id,
            'seasons'    => $seasons
        ]);
    }

    function week()
    {
		$model   = new ScheduleModel();
        $url       = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $arr       = explode('/', $url);
		
        $season_id = isset($arr[6]) ? $arr[6] : false;
        $week      = isset($arr[7]) ? $arr[7] : false;
        $nweek     = isset($arr[8]) ? $arr[8] : false;
		$id        = isset($arr[10]) ? $arr[10] : $this->userinfo->sellers_id;
		$type      = isset($arr[9]) && $arr[9] != -1 ? $arr[9] : (isset($arr[9]) && $arr[9] == -1 ? $model->get_person_role($id) : $this->userinfo->type);
		
        $week_id = $week;
        $seasons = $model->get_seasons();
        $week    = $model->get_week($week, $type, $id);
        $weeks   = $model->get_weeks($season_id, $type, $this->userinfo->lang, $id);
		$fio     = $model->getPersons();

        $this->render('week.php', [
            'week'      => $week,
            'nweek'     => $nweek,
            'week_id'   => $week_id,
            'weeks'     => $weeks,
            'type'      => $type,
            'seasons'   => $seasons,
            'season_id' => $season_id,
            'fio'       => $fio,
			'user_id'   => $id
        ]);
    }

    function holyday()
    {
        $week  = isset($_POST['week']) ? intval($_POST['week']) : false;
		$type  = isset($_POST['type']) ? intval($_POST['type']) : false;
        $fio  = isset($_POST['fio']) ? intval($_POST['fio']) : false;
		
        $model = new ScheduleModel();
        $week  = $model->get_holyday($week, $type, $fio);
        if (isset($week->data[0]->_p_error_text)) {
            echo json_encode($week->data[0]->_p_error_text);
        } else {
            echo json_encode($week->status);
        }
    }
	
	function holyday_del()
    {
        $hol_id  = isset($_POST['hol_id']) ? intval($_POST['hol_id']) : false;
        $model = new ScheduleModel();
        $week  = $model->del_holyday($hol_id);
        if (isset($week->data[0]->_p_error_text)) {
            echo json_encode($week->data[0]->_p_error_text);
        } else {
            echo json_encode($week->status);
        }
    }

    function save()
    {
        $week = isset($_POST['week']) ? intval($_POST['week']) : false;
        $arr  = isset($_POST['arr']) ? $_POST['arr'] : false;
        $type = isset($_POST['type']) ? $_POST['type'] : false;
        $id = isset($_POST['id']) ? $_POST['id'] : $this->userinfo->sellers_id;

        $model = new ScheduleModel();
        $save  = $model->get_save($week, $arr, $type, $id);

        if (isset($save->data[0]->_p_error_text)) {
            echo json_encode($save->data[0]->_p_error_text);
        } else {
            echo json_encode($save->status);
        }
    }
	
	function modal(){
        $js  = isset($_POST['js']) ? $_POST['js'] : false;
        $arr = json_decode($js);

        echo $this->render('modal.php', [
            'arr' => $arr
        ], 'modal');
    }
}