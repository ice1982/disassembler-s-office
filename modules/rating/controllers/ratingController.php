<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 07.03.2017
 * Time: 23:51
 */

namespace app\modules\rating\controllers;


use app\core\Controller;
use app\modules\rating\models\RatingModel;

class RatingController extends Controller
{
	function index()
	{
		$obj = new RatingModel();
		$dat = json_decode($obj->get_exec_proc($this->userinfo->mainbase_user_id))->data;
		$this->render('rating.php',[
			'arr' => $dat ? $dat[0] : []
			]
		);
	}
}