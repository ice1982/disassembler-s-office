<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 07.03.2017
 * Time: 23:51
 */

namespace app\modules\calculation2\controllers;


use app\core\Controller;
use app\modules\calculation2\models\calculationModels;

class calculationController extends Controller
{
	function index()
	{
		if (isset($_SESSION['sellers_id']) && $_SESSION['sellers_id']) {
			$obj    = new calculationModels();
			$months = $obj->months();
			if ($_POST) {
				$f_pd_month = $_POST['f_pd_month'];
				$f_pd_year  = $_POST['f_pd_year'];
				$data       = $obj->get_data($f_pd_month, $f_pd_year, $_SESSION["sellers_id"]);

				$this->render('calculation.php', [
					'months'     => $months,
					'f_pd_month' => $f_pd_month,
					'f_pd_year'  => $f_pd_year,
					'data'       => $data
				]);
			} else {
				$this->render('calculation.php', [
					'months'     => $months,
					'f_pd_month' => 1
				]);
			}
		} else {
			header("Location: /web/login");
		}
	}

	public function get_points()
	{
		$person_id = $_POST["person"] ? intval($_POST["person"]) : false;
		$from      = $_POST["from"] ? strval($_POST["from"]) : false;
		$to        = $_POST["to"] ? strval($_POST["to"]) : false;

		if ($person_id) {
			$obj    = new calculationModels();
			$points = $obj->get_points_modal_info($person_id, $from, $to);
			echo $this->render('modal_points.php', [
				'points' => $points
			], true);
		}
	}
}