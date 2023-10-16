<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 07.03.2017
 * Time: 22:43
 */

namespace app\modules\options\controllers;


use app\core\Controller;
use app\modules\options\models\OptionsModel;

class OptionsController extends Controller
{
    function Index()
    {
        $model   = new OptionsModel();
        $seasons = $model->get_seasons();

        if (isset($_SESSION['sellers_id']) && $_SESSION['sellers_id']) {
            $this->render('index.php', [
                'seasons' => $seasons
            ]);
        } else {
            header("Location: /web/login");
        }
    }

    function get_weeks()
    {
        $season_id = isset($_POST['season_id']) ? $_POST['season_id'] : false;

        $model = new OptionsModel();
        $weeks = $model->get_weeks($season_id);
        echo $this->render('weeks.php', [
            'weeks' => $weeks
        ], 'modal');
    }

    function week()
    {
        $week_id = isset($_POST['week']) ? $_POST['week'] : false;
        $nweek   = isset($_POST['nweek']) ? $_POST['nweek'] : false;

        $model = new OptionsModel();
        $week  = $model->get_week($week_id);


        echo $this->render('content.php', [
            'week' => $week
        ], 'modal');
    }

    function holyday()
    {
        $week  = isset($_POST['week']) ? intval($_POST['week']) : false;
        $model = new OptionsModel();
        $week  = $model->get_holyday($week);
        if (isset($week->data[0]->_p_error_text)) {
            echo json_encode($week->data[0]->_p_error_text);
        } else {
            echo json_encode($week->status);
        }
    }

    function save()
    {
        $opt = isset($_POST['opt']) ? $_POST['opt'] : false;
        $t1  = isset($_POST['t1']) ? $_POST['t1'] : false;
        $t2  = isset($_POST['t2']) ? $_POST['t2'] : false;


        $model = new OptionsModel();
        $save  = $model->get_save($opt, $t1, $t2);

        if (isset($save->data[0]->_p_error_text)) {
            echo json_encode($save->data[0]->_p_error_text);
        } else {
            echo json_encode($save->status);
        }
    }
}