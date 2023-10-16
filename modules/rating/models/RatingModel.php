<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 10.03.2017
 * Time: 10:20
 */

namespace app\modules\rating\models;


use app\core\Model;

class RatingModel extends Model
{
	public function get_exec_proc($id)
	{
		$request_data = array(
			'server' => 'instatfootball.com',
			'base'   => 'football',
			'login'  => 'instat_sellers',
			'pass'   => 'seLLers873X',
			'proc'   => 'iud_f_analyser_rating',
			'params' => [
				'@action'  => [4, 'in'],
				'@user_id' => [$id, 'in']
			]
		);
		$ch           = curl_init('https://service.instatfootball.com/ws.php');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		return $response;
	}
}