<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 07.03.2017
 * Time: 23:51
 */

namespace app\modules\calculation\controllers;


use app\core\Controller;
use app\modules\calculation\models\calculationModels;

class CalculationController extends Controller
{
	function index(){
        if (isset($_SESSION['sellers_id']) && $_SESSION['sellers_id']){
            $obj = new calculationModels();
            $months = $obj->months();
            if ($_POST) {
                $f_pd_month = $_POST['f_pd_month'];
                $f_pd_year = $_POST['f_pd_year'];
                $begin = date('Y-m-d', strtotime("first day of " . $months[$f_pd_month]['en'] . " $f_pd_year"));
                $end = date('Y-m-d', strtotime("last day of " . $months[$f_pd_month]['en'] . " $f_pd_year"));
                $cat_by_day = $obj->cat_by_day([$_SESSION['sellers_id']], $begin, $end);
                $premiya = $obj->premiya([$_SESSION['sellers_id']], $f_pd_month, $f_pd_year, $cat_by_day);
				foreach ($months as $key => $month) {
                    if (isset($month[$this->lang])) {
                        $months[$key] = $month[$this->lang];
                    } else {
                        $months[$key] = $month['ru'];
                    }
                }
                
                
                $this->render('calculation.php', [
                    'cat_by_day' => $cat_by_day,
                    'premiya' => $premiya,
                    'months' => $months,
                    'f_pd_month' => $f_pd_month,
                    'f_pd_year' => $f_pd_year
                ]);
            }else{
				foreach ($months as $key => $month) {
                    if (isset($month[$this->lang])) {
                        $months[$key] = $month[$this->lang];
                    } else {
                        $months[$key] = $month['ru'];
                    }
                }
                $this->render('calculation.php',[
                    'months' => $months,
                    'f_pd_month' => 1
                ]);
            }
        }else{
            header("Location: /web/login");
        }
	}
}