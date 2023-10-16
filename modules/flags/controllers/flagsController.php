<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 07.03.2017
 * Time: 23:51
 */

namespace app\modules\flags\controllers;


use app\core\Controller;
use app\core\Model;
use app\modules\login\models\LoginModel;

class FlagsController extends Controller
{
	function index()
	{

	}

	function get_flags_html()
	{
		$model = new Model();
		$flags = $model->get_flags();
		echo $this->render('flags.php', [
			'flags' => $flags
		], 'modal');
	}

	public function save_flag()
	{
		$model = new Model();
		$settings = [];
		if (isset($_POST['flag'])){
			$settings = ['flag' => $_POST['flag']];
		}
		$model->set_user_settings('flags',json_encode($settings));
	}

	public function load_flag(){
		$model = new Model();
		$result = $model->get_user_settings('flags');
		return $result->flag;
	}
}