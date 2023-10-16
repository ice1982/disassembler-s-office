<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 09.03.2017
 * Time: 1:22
 */

namespace app\core;

use app\core\app;

class Model extends Config
{
	public $db;
	public $userinfo;
	public $lang;
	public $text;
	public $flags;

	/**
	 *
	 */
	public function __construct()
	{
		$host    = '';
		$db      = '';
		$user    = '';
		$pass    = '';
		$charset = '';
		$opt     = [
			\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
			\PDO::ATTR_EMULATE_PREPARES   => false,
		];
		extract(Config::db());
		$dsn      = "mysql:host=$host;dbname=$db;charset=$charset";
		$this->db = new \PDO($dsn, $user, $pass, $opt);
		if (isset($_COOKIE) && is_array($_COOKIE)) {
			$this->userinfo = (object)$_COOKIE;
			$_SESSION       = $_COOKIE;
		} else {
			$this->userinfo = (object)$_SESSION;
		}
		$result      = $this->translate();
		$this->text  = $result['text'];
		$this->lang  = $result['lang'];
		$this->flags = $this->get_flags();

		return $this->db;
	}

	public function translate()
	{
		$l = $this->get_user_settings('flags');
		if ($l) {
			$lang = $l->flag;
		} else {
			$lang = 'ru';
		}
		$sql = $this->db->query("
            SELECT * FROM sellers_translates
            ");
		foreach ($sql as $item) {
			$result[$item['id']] = $item[$lang];
		}

		return ['text' => $result, 'lang' => $lang];
	}

	public function in_prepare($arr)
	{
		$in = str_repeat('?,', count($arr) - 1) . '?';
		return $in;
	}

	public function fio($id)
	{
		$sql = $this->db->prepare("              
          SELECT
            CONCAT_WS(' ', last_name, first_name, patronymic) name
          FROM  sellers_analists_persons
          WHERE id = :id
        ");
		$sql->execute([
			':id' => $id
		]);
		return $sql->fetch();
	}

	/**
	 * @param $id
	 * @return array
	 */
	public function schedule($id)
	{
		$sql = $this->db->prepare("              
            SELECT
              sws.schedule_name name,
              swsp.start_date
            FROM sellers_workers_schedule sws
              LEFT JOIN sellers_workers_schedule_persons swsp ON swsp.schedule = sws.id
            WHERE swsp.person = :id
        ");

		$sql->execute([':id' => $id]);
		$result = $sql->fetchAll();

		$lastKey = null;
		$lastDif = null;
		foreach ($result as $k => $v) {
			if (strtotime($v['start_date']) == strtotime(date('Y-m-d'))) {
				return $k;
			}
			$dif = strtotime(date('Y-m-d')) - strtotime($v['start_date']);
			if (is_null($lastKey) && $dif >= 0 || $dif < $lastDif && $dif >= 0) {
				$lastKey = $k;
				$lastDif = $dif;
			}
		}
		if (!$lastKey) {
			$lastKey = 0;
		}

		if (isset($result[$lastKey])) {
			return $result[$lastKey];
		} else {
			return $result;
		}
	}

	function curl_proc_base($base, $proc, $params = null)
	{
		$request_data = array(
			'server' => 'instatfootball.com',
			'base'   => $base,
			'login'  => 'views_football',
			'pass'   => 'RcGBBwVqMn7K9Fdz',
			'proc'   => $proc,
			'params' => $params
		);
		$ch           = curl_init('https://service.instatfootball.com/ws.php');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 90);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		$response = curl_exec($ch);
		return $response;
	}

	function curl_proc_base_pg_sellers($proc, $params = null)
	{
		$request_data = array(
			'ssl' => false,
			'PHPSESSID' => '8bef99bf5d247a64873e216873329e40',
			'proc'   => $proc,
			'params' => $params
		);
		$ch           = curl_init('https://api-sellers.instatfootball.tv/data');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 90);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		$response = curl_exec($ch);
		return $response;
	}

	function curl_sellers_api($sellers_id)
	{
		$params['key'] = '8274983hfoih9cg679uplf345r9009oj';
		$params['id']  = $sellers_id;
		$params['api'] = 'get-person';


		$string = http_build_query($params);
		$ch     = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://sellers.instatfootball.tv/api/index.php');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		return json_decode($response);
	}

	public function get_flags()
	{
		$sql = $this->db->prepare("              
            SELECT *
			FROM sellers_flags
        ");
		$sql->execute();
		$result = new \stdClass();
		while ($row = $sql->fetchObject()) {
			$result->{$row->lang} = $row->img;
		}
		return $result;
	}

	public function set_user_settings($module, $settings)
	{
		$sql = $this->db->prepare("
    	INSERT INTO sellers_users_settings (user, module, settings)
		VALUES (?, ?, ?)
		ON DUPLICATE KEY UPDATE module = ?,
		                        settings = ?
    	");
		$sql->execute([$this->userinfo->sellers_id, $module, $settings, $module, $settings]);
		echo json_encode(['status' => 'ok']);
	}

	public function get_user_settings($modul)
	{
		$result = false;
		$sid    = isset($this->userinfo->sellers_id) ? $this->userinfo->sellers_id : 0;
		$sql    = $this->db->prepare("
		SELECT settings FROM sellers_users_settings
		WHERE user = ? AND module = ?
		");
		$sql->execute([$sid, $modul]);
		if ($sql->rowCount()) {
			$result = $sql->fetchObject()->settings;
		}
		return json_decode($result);
	}

	function currencies()
	{
		$d          = date('Y-m-d', strtotime('last day of previous month'));
		$currencies = [];
		$pg_query = json_decode($this->curl_proc_base_pg_sellers('ask_sellers_data', ['_p_mode' => 'currencies', '_p_date' => $d]));
		$pg_query = $pg_query ? $pg_query->data[0]->ask_sellers_data : [];

		foreach ($pg_query as $row) {
			$currencies[$row->currency] = $row;
		}
		return $currencies;
	}
}