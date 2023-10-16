<?php
/**
 * Created by PhpStorm.
 * User: Programmist
 * Date: 04.05.2017
 * Time: 16:17
 */

namespace app\modules\calculation2\models;

use app\core\Model;
use PDO;

class calculationModels extends Model
{
	function months()
	{
		return [
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
	}

	public function get_data($month, $year, $emps_id)
	{
		$dates = $this->get_dates($month, $year);

		if ($dates) {
			$data       = new \stdClass();
			$arr_dates  = array_keys($dates);
			$arr_dates2 = array_keys($dates[end($arr_dates)]);
			$params     = [
				'_p_date_from' => $dates[0][0]->full,
				'_p_date_to'   => $dates[end($arr_dates)][end($arr_dates2)]->full
			];

			if ($emps_id != "") {
				$params = array_merge($params, [
					'_p_person_arr' => '{' . $emps_id . '}'
				]);
			}

			$response = json_decode($this->curl_proc_base('hockey', 'sellers_ask_analysis_plan', $params));

			if ($response and isset($response->status) and $response->status == 'Ok' and $response->data[0]->sellers_ask_analysis_plan) {

				$response = json_decode($response->data[0]->sellers_ask_analysis_plan);
			} else {
				//exit;
				$data = null;
				return $data;
			}

			$currencies = $this->currencies();

			$persons = $this->get_persons($emps_id);

			$checker_fr     = [];
			$fixed_rate     = [];
			$period_from_fr = [];

			$fix_rates = json_decode($this->curl_proc_base_pg_sellers('ask_sellers_data', ['_p_mode' => 'fix_rates']), true)['data'][0]['ask_sellers_data'];
			foreach ($fix_rates as $row) {
				$checker_fr[]     = $row['checker'];
				$fixed_rate[]     = $row['fixed_rate'];
				$period_from_fr[] = $row['period_from'];
			}

			$persons_id_ex_points = [];
			$persons_sum_quantity = [];
			$persons_date         = [];

			$ext_points = json_decode($this->curl_proc_base_pg_sellers('ask_sellers_data', ['_p_mode' => 'ext_points']), true)['data'][0]['ask_sellers_data'];

			foreach ($ext_points as $row) {
				$persons_id_ex_points[] = $row['person_id'];
				$persons_sum_quantity[] = $row['sum_quantity'];
				$persons_quantity[]     = $row['quantity'];
				$persons_date[]         = $row['period_from'];
				$persons_date_to[]      = $row['period_to'];
			}

			$main_sports = json_decode($this->curl_proc_base_pg_sellers('ask_sellers_data', ['_p_mode' => 'main_sports']), true)['data'][0]['ask_sellers_data'];

			$person_trainer = [];
			$trainer        = [];

			foreach ($main_sports as $row) {
				$person_trainer[] = $row['person_id'];
				$trainer[]        = $row['trainer'];
			}

			foreach ($response as $item) {
				$checker_fixed_rates = [];
				$fixed_rates         = [];
				$points              = [];
				$sdvig               = [];
				$sdvig1              = [];
				$analysis            = [];
				$s                   = [];

				foreach ($dates as $week => $dates_arr) {

					for ($k = 0; $k < count($fixed_rate); $k++) {
						if ($dates_arr[0]->full == $period_from_fr[$k]) {
							$checker_fixed_rates[$week] = $checker_fr[$k];
							$fixed_rates[$week]         = $fixed_rate[$k];
							break;
						}
					}

					$piep = array_filter($persons_id_ex_points, function ($d) use ($item){
						return $d == $item->person_id;
					});

					foreach ($piep as $i => $persons_id_ex_point) {
						if ($dates_arr[0]->full == $persons_date[$i]) {
							if (strlen($persons_sum_quantity[$i]) == 1 || strlen($persons_sum_quantity[$i]) == 2) {
								$sdvig[$week]  = -11;
								$sdvig1[$week] = 9;
							}
							if (strlen($persons_sum_quantity[$i]) == 3 || strlen($persons_sum_quantity[$i]) == 4) {
								$sdvig[$week]  = -10;
								$sdvig1[$week] = 8;
							}
							if (strlen($persons_sum_quantity[$i]) == 5 || strlen($persons_sum_quantity[$i]) == 6) {
								$sdvig[$week]  = -9;
								$sdvig1[$week] = 7;
							}
							if (strlen($persons_sum_quantity[$i]) == 7) {
								$sdvig[$week]  = -8;
								$sdvig1[$week] = 6;
							} else {
								$sdvig[$week]  = -6;
								$sdvig1[$week] = 4;
							}
							break;
						}
					}

					foreach ($piep as $key => $val) {
						if ($dates_arr[0]->full == $persons_date[$key]) {
							$points[$week][] = $persons_quantity[$key];
						}
					}

					$fact_real_sum = null;
					$fact_sum      = null;
					$plan_sum      = null;
					$norm          = 0;
					$countMiss     = 0;
					$countIfNorm   = 0;

					foreach ($dates_arr as $date) {
						$index = -1;

						foreach ($item->analysis as $key => $val) {
							if ($val->date == $date->full) {
								$index = $key;
								break;
							}
						}

						if ($index == -1) {
							foreach ($piep as $key => $val) {
								if ($persons_date[$key] == $date->full) {
									$begin_date = $persons_date[$key];
									while ($begin_date != date('Y-m-d', strtotime($persons_date_to[$key] . ' + 1 day'))) {
										$o            = new \stdClass();
										$o->plan      = 0;
										$o->fact      = 0;
										$o->date      = $begin_date;
										$o->fact_real = 0;

										$analysis[$week][] = $o;

										$begin_date = date('Y-m-d', strtotime($begin_date . ' + 1 day'));
									}
									$countMiss--;
									break;
								}
							}
						}

						if (!is_numeric($index)) {
							$index = -1;
						}

						if ($index == -1) {
							$countMiss++;
						}

						if ($index >= 0) {

							if ($item->analysis[$index]->plan >= 1 && $item->analysis[$index]->dow == 6) {
								$countIfNorm++;
							}

							if ($item->analysis[$index]->plan >= 1 && $item->analysis[$index]->dow == 7) {
								$countIfNorm++;
							}

							if ($item->analysis[$index]->plan >= 1 && $item->analysis[$index]->dow == 1) {
								$countIfNorm++;
							}

							if ($item->analysis[$index]->plan >= 1 && $item->analysis[$index]->dow == 2) {
								$countIfNorm++;
							}

							if ($item->analysis[$index]->plan <= $item->analysis[$index]->fact) {
								$countIfNorm++;
							}



							$analysis[$week][] = $item->analysis[$index];
							$fact_real_sum     += $item->analysis[$index]->fact_real;
							$fact_sum          += $item->analysis[$index]->fact;
							$plan_sum          += $item->analysis[$index]->plan;
						}
					}

					$stavka = $this->stavka($fact_sum);

					for ($i = 0; $i < count($person_trainer); $i++) {
						if ($person_trainer[$i] == $item->person_id) {
							if ($trainer[$i] == true) {
								if ($stavka == 1) {
									$stavka = 1;
								}
								if ($stavka > 1) {
									$stavka = 2;
								}
								break;
							}
						}
					}

					if (isset($fixed_rates[$week]) && isset($checker_fixed_rates[$week]) && $fixed_rates[$week] != null && $checker_fixed_rates[$week] == 1) {
						$stavka_value = $fixed_rates[$week];
					} else {
						$stavka_value = $this->stavka_value($stavka);
					}

					$base = round($stavka_value * $fact_real_sum / 3, 2) ?: null;

					// 11 действий = 7 дней план <= факта и 4 дня план >= 1 в СБ, ВС, ПН, ВТ)
					if ($countIfNorm == 11) {
						$norm = 1;
					}

					if (isset($fixed_rates[$week]) && isset($checker_fixed_rates[$week]) && $fixed_rates[$week] != null && $checker_fixed_rates[$week] == 1) {
						$bonus = null;
					} else {
						$bonus = $norm ? round(($plan_sum * $stavka_value) / 3 * 0.2, 2) : null;
					}

					$tc = 0;
					$sums[$week] = (object)[
						'fact_sum'   => $countMiss != 7 ? $fact_sum : null,
						'plan_sum'   => $countMiss != 7 ? $plan_sum : null,
						'stavka'     => $countMiss != 7 ? $stavka : null,
						'base'       => $countMiss != 7 ? $base : null,
						'total'      => $countMiss != 7 ? ($tc = round($base + $bonus + (isset($points[$week]) && $points[$week] ? floatval(array_sum($points[$week])) : 0), 2)) : null,
						'total_curr' => $countMiss != 7 ? round($tc * (in_array(2, $persons[$item->person_id]['sport']) ? $persons[$item->person_id]['price'][2] : $persons[$item->person_id]['price'][1]), 2) : null,
						'bonus'      => $countMiss != 7 ? $bonus : null
					];

					$iso = $currencies[$persons[$item->person_id]['currency']]->iso;
					$t[] = $sums[$week]->total_curr;
					$s[] = $sums[$week]->total;
				}

				$data->array_agg[] = (object)[
					'person_id'            => $item->person_id,
					'c_match_recalc_level' => $item->c_match_recalc_level,
					'person_name'          => $persons[$item->person_id]['full_name'] ?: '',
					'person_career'        => $persons[$item->person_id]['name'] ?: '',
					//					'person_country'       => $persons[$item->person_id]['person_country'] ?: '',
					'sums'                 => $sums,
					'total_per'            => array_sum($s),
					'total_curr_all'       => array_sum($t),
					'analysis'             => $analysis,
					'points'               => isset($points) ? $points : '',
					'sdvig'                => isset($sdvig) ? $sdvig : '',
					'sdvig1'               => isset($sdvig1) ? $sdvig1 : '',
					'iso'                  => $iso
				];


			}
			$data->dates = $dates;

			$data->fixed_rates         = $fixed_rates;
			$data->checker_fixed_rates = $checker_fixed_rates;

			$data->lang = $_SESSION['lang'];

			$data->cnt = count((array)$response);

			return $data ?: false;
		}
	}

	private function get_dates($month, $year)
	{

		$start           = date('Y-m-d', strtotime("$year-$month first friday of this month"));
		$end             = date('Y-m-d', strtotime("$year-$month last thursday of this month + 1 day"));
		$first_month_day = date('j', strtotime($start . 'first day of this month'));
		$difference      = intval(date('j', strtotime($start))) - intval($first_month_day);

		if ($difference < 7 && $difference > 0) {
			$start = date('Y-m-d', strtotime($start . ' - 1 week'));
		}


		$date_obj = new \DatePeriod(new \DateTime($start), new \DateInterval('P1D'), new \DateTime($end));
		$i        = 0;
		$periods  = [];

		foreach ($date_obj as $key => $item) {

			$periods[$i][] = (object)[
				'short' => $item->format('d.m'),
				'full'  => $item->format('Y-m-d')
			];
			if (count($periods[$i]) > 6) {
				$i++;
			}
		}
		return $periods;
	}

	private function stavka($fact)
	{
		if ($fact < 5) {
			$stavka = 5;
		} elseif ($fact < 10) {
			$stavka = 4;
		} elseif ($fact < 15) {
			$stavka = 3;
		} elseif ($fact < 20) {
			$stavka = 2;
		} else {
			$stavka = 1;
		}

		return isset($fact) ? $stavka : null;
	}

	private function stavka_value($stavka)
	{
		if ($stavka == 1) {
			$stavka_value = 1.7;
		}
		if ($stavka == 2) {
			$stavka_value = 1.6;
		}
		if ($stavka == 3) {
			$stavka_value = 1.5;
		}
		if ($stavka == 4) {
			$stavka_value = 1.4;
		}
		if ($stavka == 5) {
			$stavka_value = 1.248;
		}

		return isset($stavka) ? $stavka_value : null;
	}

	private function get_persons($person_id)
	{
		$sql = "
		SELECT p.id, concat_ws(' ', p.first_name, p.last_name, p.patronymic) full_name, if(find_in_set('" . $this->lang . "', 'en, ru, zh'), ca.name_$this->lang, ca.name_en) name, p.country, ap.currency, ap.sport, ap.price
		FROM sellers_analists_persons p
		INNER JOIN sellers_analists_careers ca ON ca.id = p.career
		INNER JOIN sellers_analists_price ap ON ap.country = if(p.country = ap.country, p.country, 1)
		WHERE p.id = :id
		";
		$q   = $this->db->prepare($sql);
		$q->execute(['id' => $person_id]);
		$result = [];
		while ($row = $q->fetchObject()) {
			$result[$row->id]['id']                 = $row->id;
			$result[$row->id]['full_name']          = $row->full_name;
			$result[$row->id]['name']               = $row->name;
			$result[$row->id]['country']            = $row->country;
			$result[$row->id]['currency']           = $row->currency;
			$result[$row->id]['sport'][]            = $row->sport;
			$result[$row->id]['price'][$row->sport] = $row->price;
		}
		return $result;
	}

	public function get_points_modal_info($person_id, $from, $to)
	{
		$points      = json_decode($this->curl_proc_base_pg_sellers('ask_sellers_data', ['_p_mode' => 'ext_points']), true)['data'][0]['ask_sellers_data'];
		$sum_points  = $result = [];
		$person_info = $this->get_persons($person_id);
		$sports      = $this->get_sports();

		foreach ($points as $index => $point) {
			if ($person_id == $point['person_id']) {
				if ($from == $point['period_from'] && $to == $point['period_to']) {
					$sum_points[$index]['point'] = $point['quantity'];
					$sum_points[$index]['sport'] = $sports[$point["sport"]]->{$this->lang};
					$sum_points[$index]['comment'] = $point["comment"];
				}
			}
		}

		$result['name']   = $person_info[$person_id]['full_name'];
		$result['period'] = date('d.m.Y', strtotime($from)) . ' - ' . date('d.m.Y', strtotime($to));
		$result['points'] = $sum_points;

		return $result;
	}

	private function get_sports()
	{
		$result = [];
		$q      = $this->db->query("SELECT * FROM sellers_sports");
		while ($row = $q->fetchObject()) {
			$obj = new \stdClass();
			$obj->ru = $row->name_ru;
			$obj->en = $row->name_en;
			$result[$row->id] = $obj;
		}
		return $result;
	}

	private function get_price(){
		$q      = $this->db->query("SELECT * FROM sellers_analists_price");

	}
}