<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 09.03.2017
 * Time: 17:29
 */

namespace app\modules\main\models;

use app\core\Model;
use PDO;

class MainModel extends Model
{
	public function getMatches($id, $begin, $end, $career = 0){
        $result = [];
		$begin = date('Y-m-d', $begin);
		$end = date('Y-m-d', $end);

		$sql = $this->db->prepare("              
              SELECT
                a.cat,
                a.user,
                a.date_op,
                sum(a.part_of) part_of,
                a.sport,
                a.work_id,
                CONCAT_WS(' ', p.last_name, p.first_name, p.patronymic) fio,
                c.name_ru
              FROM sellers_analists_by_day_sports a
              LEFT JOIN sellers_analists_persons p ON p.id = a.user
              LEFT JOIN sellers_analists_careers c ON p.career = c.id
              WHERE a.user = :id AND (a.date_op BETWEEN :begin AND :end) AND a.sport <> 2
			  GROUP BY date_op
              ");
        $sql->execute([
            ':id' => $id,
//            ':career' => $career,
            ':begin' => strval($begin),
            ':end' => strval($end)
        ]);
        $result2 = $sql->fetchAll();
        foreach ($result2 as $item) {
            $result[$item['user']][$item['date_op']] = $item;
            if (isset($item['work_id']) && $item['work_id'] != null) {
                $result[$item['user']][$item['date_op']]['reason'] = explode(',', $item['work_id']);
            }
        }
        if ($result) {
            return $result;
        }else{
            return false;
        }
	}

	public function getPersons($person_id){
		$persons = $this->db->prepare('SELECT * FROM sellers_persons WHERE id = ?');
		$persons->execute([$person_id]);
		return $persons->fetch();
	}

	function getCategory($id,$begin,$end){
        $result = [];
		$begin = date('Y-m-d', $begin);
		$end = date('Y-m-d', $end);
		$sql = $this->db->prepare("              
              SELECT
                *
              FROM sellers_analists_category
              WHERE user = :id AND (date_b BETWEEN :begin AND :end) OR (date_e BETWEEN :begin2 AND :end2)
              ");
		$sql->execute([
		    ':id' => $id,
			':begin' => strval($begin),
			':end' => strval($end),
			':begin2' => strval($begin),
			':end2' => strval($end)
		]);
		$result2 = $sql->fetchAll();
        foreach ($result2 as $item) {
            $result[$item['user']][] = $item;
        }
        if ($result) {
            return $result;
        }else{
            return false;
        }
	}

	function getinner($id, $dat){
	    $date = explode(',', $dat);

        $sql = $this->db->prepare("
        SELECT
          * 
        FROM sellers_analists_manual
        ");
        $sql->execute();
        foreach ($sql->fetchAll() as $item)$manual[$item['id']] = $item;

        $sql = $this->db->prepare("
        SELECT
          * 
        FROM sellers_sports
        ");
        $sql->execute();
        $sports = $sql->fetchAll(PDO::FETCH_UNIQUE);


        $request_data = array(
            'server'   => 'instatfootball.com',
            'base'     => 'football',
            'login'    => 'views_football',
            'pass'     => 'RcGBBwVqMn7K9Fdz',
            'proc'     => 'prc_user_marks_stat_get_inner',
            'params'   => [
                '@sellers_user_id' => [$id, 'in'],
                '@date_b'          => [$date[0], 'in'],
                '@date_e'          => [isset($date[1])?$date[1]:$date[0], 'in'],
                '@additional'	   => ['varchar(2000)', 'out']
            ]
        );
        $ch = curl_init('https://service.instatfootball.com/ws.php');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $response = curl_exec($ch);
        $datarow = json_decode($response, $assoc = true);// Итоги работы
        $i = 0;
        $data = [];
        foreach ($datarow['data'] as $item){
        	if ($item['sport'] == 2) continue;
            $data['data'][$i] = $item;
            if ($this->lang == 'ru') {
                $data['data'][$i]['sports'] = $sports[$item['sport']]['name_ru'];
            }else{
                $data['data'][$i]['sports'] = $sports[$item['sport']]['name_en'];
            }
            $i++;
        }
        if ($datarow['variables']['@additional']){
            $r = explode('®', $datarow['variables']['@additional']);
            $i = 0;
            foreach ($r as $item){
                $m = explode('©', $item);
                $data['additional'][$i]['action']   = $manual[$m[0]]['name'];
                $data['additional'][$i]['quantity'] = $m[1]?$m[1]:'—';
                $data['additional'][$i]['size']     = $m[2]?$m[2]:'—';
                $data['additional'][$i]['comment']  = $m[3]?$m[3]:'—';
                $i++;
            }
        }
        return $data;
    }

}