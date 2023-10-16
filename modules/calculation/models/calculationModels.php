<?php
/**
 * Created by PhpStorm.
 * User: Programmist
 * Date: 04.05.2017
 * Time: 16:17
 */

namespace app\modules\calculation\models;

use app\core\Model;
use PDO;

class calculationModels extends Model
{
	function cat_by_day($id, $begin, $end)
	{
		$in         = $this->in_prepare($id);
		$id[]       = $begin;
		$id[]       = $end;
		$currencies = $this->currencies();
		$sql        = $this->db->prepare("              
              SELECT
                abd.sport,
                abd.user,
                abd.date_op,
                abd.part_of,
                abd.cat,
                abd.work_id,
                p.country,
                IFNULL(scc.currency, 1) currency,
                IFNULL(c.name_en, 'RUB') currency_name,
                ifnull(scc.country, 1) country,
              	(abd.part_of * scc.price) price
              FROM sellers_analists_by_day_sports abd
              LEFT JOIN sellers_analists_persons p ON p.id = abd.user
              LEFT JOIN sellers_analists_price scc ON scc.country = p.country AND scc.sport = IF(abd.sport = scc.sport, abd.sport, 1)
              LEFT JOIN sellers_currencies c ON c.id = scc.currency
              WHERE user IN ($in) AND (date_op BETWEEN ? AND ?) AND abd.sport <> 2
              ORDER BY sport
              ");
		$sql->execute($id);
		$data = [];
		foreach ($sql as $row) {
			$data[$row['user']]['summ'][] = $row['price'];
			$data[$row['user']]['currency_name'] = $row['currency_name'];
		}
		if (isset($data)) {
			foreach ($data as $key => $item) {
				$data[$key]['summ'] = array_sum($item['summ']);
			}
			return $data;
		} else {
			return false;
		}
	}

	function premiya($id, $month, $year, $cat_by_day = 0)
	{
		$user = $id;
		$in   = $this->in_prepare($id);

		$sql = $this->db->prepare(" 
            SELECT
            user,
            year,
            month,
            prem
            FROM sellers_analists_prize_sports
            WHERE user IN ($in) AND prem
        ");
		$sql->execute($id);
		foreach ($sql as $row) {
			$premiya[$row['user']][$row['year']][$row['month']] = $row['prem'];
		}


		if (is_array($month)) {
			list($m1, $m2) = $month;
			$id[] = $m1;
			$id[] = $m2;
			$id[] = $year;
			$sql  = $this->db->prepare("              
              SELECT
                ap.*,
                concat_ws(' ', p.last_name, p.first_name, p.patronymic) name,
                p.career,
                p.country
              FROM sellers_analists_prize_sports ap
              LEFT JOIN sellers_analists_persons p ON p.id = ap.user
              WHERE user in ($in) AND ap.month BETWEEN ? AND ? and ap.year = ? AND ap.sport <> 2
              ORDER BY sport
              ");
		} else {
			$id[] = $month;
			$id[] = $year;
			$sql  = $this->db->prepare("              
              SELECT
                ap.*,
                concat_ws(' ', p.last_name, p.first_name, p.patronymic) name,
                p.career,
                p.country
              FROM sellers_analists_prize_sports ap
              LEFT JOIN sellers_analists_persons p ON p.id = ap.user
              WHERE user in ($in) AND ap.month = ? and ap.year = ? AND ap.sport <> 2
              ORDER BY sport
              ");
		}
		$sql->execute($id);
		if ($sql->rowCount()) {
			foreach ($sql as $row) {
				$data[$row['user']]['user_id'] = $row['user'];
				if (isset($data[$row['user']]['part_of'])) {
					$data[$row['user']]['part_of'] += $row['part_of'];
				} else {
					$data[$row['user']]['part_of'] = $row['part_of'];
				}
				if (isset($data[$row['user']]['part_of_marks'])) {
					$data[$row['user']]['part_of_marks'] += $row['part_of_marks'];
				} else {
					$data[$row['user']]['part_of_marks'] = $row['part_of_marks'];
				}
				if (isset($data[$row['user']]['part_of_work'])) {
					$data[$row['user']]['part_of_work'] += $row['part_of_work'];
				} else {
					$data[$row['user']]['part_of_work'] = $row['part_of_work'];
				}
				$data[$row['user']]['name']    = $row['name'];
				$data[$row['user']]['prem']    = $row['prem'];
				$data[$row['user']]['career']  = $row['career'];
				$data[$row['user']]['year']    = $row['year'];
				$data[$row['user']]['month']   = $row['month'];
				$data[$row['user']]['sport']   = $row['sport'];
				$data[$row['user']]['country'] = $row['country'];
				$data[$row['user']]['summ']    = $cat_by_day[$row['user']]['summ'];
				if ($month == 3 || $month == 6 || $month == 9 || $month == 12) {
					$data[$row['user']]['prem_k'] = array_sum([
						isset($premiya[$row['user']][$year][$month]) ? $premiya[$row['user']][$year][$month] : 0,
						isset($premiya[$row['user']][$year][$month - 1]) ? $premiya[$row['user']][$year][$month - 1] : 0,
						isset($premiya[$row['user']][$year][$month - 2]) ? $premiya[$row['user']][$year][$month - 2] : 0
					]);
				} else {
					$data[$row['user']]['prem_k'] = 0.00;
				}
				if ($month == 12) {
					$data[$row['user']]['prem_y'] = array_sum([
						isset($premiya[$row['user']][$year][$month]) ? $premiya[$row['user']][$year][$month] : 0,
						isset($premiya[$row['user']][$year][$month - 1]) ? $premiya[$row['user']][$year][$month - 1] : 0,
						isset($premiya[$row['user']][$year][$month - 2]) ? $premiya[$row['user']][$year][$month - 2] : 0,
						isset($premiya[$row['user']][$year][$month - 3]) ? $premiya[$row['user']][$year][$month - 3] : 0,
						isset($premiya[$row['user']][$year][$month - 4]) ? $premiya[$row['user']][$year][$month - 4] : 0,
						isset($premiya[$row['user']][$year][$month - 5]) ? $premiya[$row['user']][$year][$month - 5] : 0,
						isset($premiya[$row['user']][$year][$month - 6]) ? $premiya[$row['user']][$year][$month - 6] : 0,
						isset($premiya[$row['user']][$year][$month - 7]) ? $premiya[$row['user']][$year][$month - 7] : 0,
						isset($premiya[$row['user']][$year][$month - 8]) ? $premiya[$row['user']][$year][$month - 8] : 0,
						isset($premiya[$row['user']][$year][$month - 9]) ? $premiya[$row['user']][$year][$month - 9] : 0,
						isset($premiya[$row['user']][$year][$month - 10]) ? $premiya[$row['user']][$year][$month - 10] : 0,
						isset($premiya[$row['user']][$year][$month - 11]) ? $premiya[$row['user']][$year][$month - 11] : 0
					]);
				} else {
					$data[$row['user']]['prem_y'] = 0.00;
				}
				// добавление валюты в зависимости от страны
				$data[$row['user']]['currency'] = $cat_by_day[$row['user']]['currency_name'];
			}
		} else {
			$sql = $this->db->prepare("              
              SELECT
                id,
                concat_ws(' ', last_name, first_name, patronymic) user,
                career,
                country
              FROM sellers_analists_persons
              WHERE id = :user
              ");
			$sql->execute($user);
			foreach ($sql as $row) {
				$data[$row['id']] = [
					'user_id'       => $row['id'],
					'name'          => $row['user'],
					'part_of'       => 0.00,
					'part_of_marks' => 0,
					'part_of_work'  => 0,
					'prem'          => 0,
					'career'        => $row['career'],
					'country'       => $row['country'],
					'summ'          => 0,
					'prem_k'        => 0,
					'prem_y'        => 0
				];
				$data[$row['id']]['currency'] = isset($cat_by_day[$row['user']]) ? $cat_by_day[$row['user']]['currency_name'] : '';
			}
		}


		if (isset($data)) {
			usort($data, function ($a, $b) {
				return ($a['name'] > $b['name']);
			});
			return $data;
		} else {

			return false;
		}
	}

	function price()
	{

		$sql = $this->db->prepare("SELECT * FROM sellers_analists_price");
		$sql->execute();
		foreach ($sql as $row) {
			$q[$row['country']][$row['currency']][$row['sport']] = $row['price'];
		}
		return $q;
	}

	function months()
	{

		$months = [
			1  => [
				'ru' => 'Январь',
				'en' => 'January',
				'es' => 'Enero',
				'vi' => 'Tháng môt'
			],
			2  => [
				'ru' => 'Февраль',
				'en' => 'February',
				'es' => 'Febrero',
				'vi' => 'Tháng hai'
			],
			3  => [
				'ru' => 'Март',
				'en' => 'March',
				'es' => 'Marzo',
				'vi' => 'Tháng ba'
			],
			4  => [
				'ru' => 'Апрель',
				'en' => 'April',
				'es' => 'Abril',
				'vi' => 'Tháng tư'
			],
			5  => [
				'ru' => 'Май',
				'en' => 'May',
				'es' => 'Mayo',
				'vi' => 'Tháng năm'
			],
			6  => [
				'ru' => 'Июнь',
				'en' => 'June',
				'es' => 'Junio',
				'vi' => 'Tháng sáu'
			],
			7  => [
				'ru' => 'Июль',
				'en' => 'July',
				'es' => 'Julio',
				'vi' => 'Tháng bảy'
			],
			8  => [
				'ru' => 'Август',
				'en' => 'August',
				'es' => 'Agosto',
				'vi' => 'Tháng tám'
			],
			9  => [
				'ru' => 'Сентябрь',
				'en' => 'September',
				'es' => 'Septiembre',
				'vi' => 'Tháng chín'
			],
			10 => [
				'ru' => 'Октябрь',
				'en' => 'October',
				'es' => 'Octubre',
				'vi' => 'Tháng mười'
			],
			11 => [
				'ru' => 'Ноябрь',
				'en' => 'November',
				'es' => 'Noviembre',
				'vi' => 'Tháng mười một'
			],
			12 => [
				'ru' => 'Декабрь',
				'en' => 'December',
				'es' => 'Diciembre',
				'vi' => 'Tháng mười hai'
			]
		];
		return $months;
	}

	function premiya_k($id, $f_pd_month, $f_pd_year)
	{
		if ($f_pd_month == 3 || $f_pd_month == 6 || $f_pd_month == 9 || $f_pd_month == 12) {
			$temp      = self::premiya($id, [$f_pd_month - 2, $f_pd_month], $f_pd_year);
			$premiya_k = array();
			if ($temp) {
				foreach ($temp as $item) {
					$premiya_k[$item['user']] = isset($premiya_k[$item['user']]) ? $premiya_k[$item['user']] + floatval($item['prem']) : floatval($item['prem']);
				}
			} else {
				$premiya_k = 0.00;
			}
		} else {
			$premiya_k = 0.00;
		}
		return $premiya_k;
	}

	function premiya_y($id, $f_pd_month, $f_pd_year)
	{
		if ($f_pd_month == 12) {
			$temp      = self::premiya($id, [$f_pd_month - 11, $f_pd_month], $f_pd_year);
			$premiya_y = array();
			foreach ($temp as $item) {
				$premiya_y[$item['user']] = isset($premiya_y[$item['user']]) ? $premiya_y[$item['user']] + floatval($item['prem']) : floatval($item['prem']);
			}
		} else {
			$premiya_y = 0.00;
		}
		return $premiya_y;
	}
}