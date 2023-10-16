<?php
$c = time();
ini_set('max_execution_time', 7800);
ini_set('memory_limit', '-1');
require_once 'connectPDO.php';
//require_once __DIR__ . '/connectPDO.php';
date_default_timezone_set('Europe/Moscow');

error_reporting(E_ALL);
ini_set('display_errors', 1);


$tabs = [
    'sellers_analists_by_day',
    'sellers_analists_category',
    'sellers_analists_prize',
    'sellers_careers',
    'sellers_persons_main',
    'sellers_users_stats_nowork',
    'sellers_analists_by_day_sports',
    'sellers_analists_prize_sports',
    'sellers_workers_schedule',
    'sellers_workers_schedule_persons'
];

foreach ($tabs as $tab) {
    if ($tab != 'sellers_persons_main') {
        $postdata = http_build_query(
            array(
                'api'   => 'get-analists-table',
                'key'   => '5b252d3e81237e94f5ffa45d554c9327',
                'table' => $tab
            )
        );
    } else {
        $postdata = http_build_query(
            array(
                'api'     => 'get-analists-table',
                'key'     => '5b252d3e81237e94f5ffa45d554c9327',
                'table'   => $tab,
                'careers' => '443,464,445,320,323,356,325,370,321,322,327,326,396'
            )
        );
    }

    $opts = array(
        'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
    );

    $context = stream_context_create($opts);

    $query        = file_get_contents('http://sellers.instatfootball.tv/api/analists_download.php', false, $context);
    $itog         = json_decode($query);
    $context      = null;
    $query        = null;
    $fields       = count($itog->fields);
    $delete_array = [];
    $fp           = [];
    $str          = '';

    if ($tab == 'sellers_analists_by_day') {
        echo $tab . "\n";
        $sql = "
            SELECT
            *
            FROM $tab
        ";
        $q   = $pdo->query($sql);
        if ($q) {
            while ($row = $q->fetch()) {
                $fp[$row['user']][$row['sport']][$row['date_op']] = $row;
                $delete_array[$row['user']][]                     = $row;
            }
        } else {
            echo "error 69 string \n";
        }


        echo 'BD ' . $q->rowCount() . ' vs API ' . count($itog->rows) . "\n";

        foreach ($itog->rows as $item) {
            $row = array_combine($itog->fields, $item);
            if (isset($fp[$row['user']][$row['sport']][$row['date_op']])) {
                $diff = array_diff_assoc($fp[$row['user']][$row['sport']][$row['date_op']], $row);
                if (!empty($diff)) {
                    $str = mysql_implode_assoc([
                        'part_of' => $row['part_of'],
                        'cat'     => $row['cat'],
                        'work_id' => $row['work_id']
                    ]);
                    $sql = "
                        UPDATE $tab 
                        SET $str
                        WHERE user = $row[user] AND sport = $row[sport] AND date_op = '$row[date_op]'
				    ";
                    $q   = $pdo->query($sql);
                    if (!$q) {
                        echo "error 99 string \n";
                    }
                }
                unset($fp[$row['user']][$row['sport']][$row['date_op']]);
                if (empty($fp[$row['user']][$row['sport']])) {
                    unset($fp[$row['user']][$row['sport']]);
                    if (empty($fp[$row['user']])) {
                        unset($fp[$row['user']]);
                    }
                }
            } else {
                $str = mysql_implode_assoc($row);
                $sql = "
                        INSERT INTO $tab 
                        SET $str
				    ";
                $q   = $pdo->query($sql);
                if (!$q) {
                    echo "error 116 string \n";
                }
            }
        }
        if (!empty($fp)) {
            foreach ($fp as $key => $item) {
                foreach ($delete_array[$key] as $row) {
                    if (isset($fp[$row['user']][$row['sport']][$row['date_op']])) {
                        $sql = "
                            DELETE FROM $tab
                            WHERE user =  $row[user] AND sport = $row[sport] AND date_op = '$row[date_op]'
                        ";
                        $q   = $pdo->query($sql);
                        if (!$q) {
                            echo "error 130 string \n";
                        }
                    }
                }
            }
        }
    } elseif ($tab == 'sellers_analists_category') {
        echo $tab . "\n";
        $sql = "
            SELECT
            *
            FROM $tab
        ";
        $q   = $pdo->query($sql);
        while ($row = $q->fetch()) {
            $fp[$row['user']][$row['sport']][$row['date_b']][$row['date_e']] = $row;
            $delete_array[$row['user']][]                                    = $row;
        }


        echo 'BD ' . $q->rowCount() . ' vs API ' . count($itog->rows) . "\n";

        foreach ($itog->rows as $item) {
            $row = array_combine($itog->fields, $item);
            if (isset($fp[$row['user']][$row['sport']][$row['date_b']][$row['date_e']])) {
                $short_fp = $fp[$row['user']][$row['sport']][$row['date_b']][$row['date_e']];
                $diff     = array_diff_assoc($short_fp, $row);
                if (!empty($diff)) {
                    $str = mysql_implode_assoc([
                        'cat_bef' => $row['cat_bef'],
                        'cat'     => $row['cat']
                    ]);
                    $sql = "
                        UPDATE $tab 
                        SET $str
                        WHERE user = $row[user] AND sport = $row[sport] AND date_b = '$row[date_b]' AND date_e = '$row[date_e]'
				    ";
                    $q   = $pdo->query($sql);
                    if (!$q) {
                        echo "error 168 string \n";
                    }
                }
                unset($fp[$row['user']][$row['sport']][$row['date_b']][$row['date_e']]);
                if (empty($fp[$row['user']][$row['sport']][$row['date_b']])) {
                    unset($fp[$row['user']][$row['sport']][$row['date_b']]);
                    if (empty($fp[$row['user']][$row['sport']])) {
                        unset($fp[$row['user']][$row['sport']]);
                        if (empty($fp[$row['user']])) {
                            unset($fp[$row['user']]);
                        }
                    }
                }
            } else {
                $str = mysql_implode_assoc($row);
                $sql = "
                        INSERT INTO $tab 
                        SET $str
				    ";
                $q   = $pdo->query($sql);
                if (!$q) {
                    echo "error 189 string \n";
                }
            }
        }
        if (!empty($fp)) {
            foreach ($fp as $key => $item) {
                foreach ($delete_array[$key] as $row) {
                    if (isset($fp[$row['user']][$row['sport']][$row['date_b']][$row['date_e']])) {
                        $sql = "
                            DELETE FROM $tab
                            WHERE user = $row[user] AND sport = $row[sport] AND date_b = '$row[date_b]' AND date_e = '$row[date_e]'
                        ";
                        $q   = $pdo->query($sql);
                        if (!$q) {
                            echo "error 203 string \n";
                        }
                    }
                }
            }
        }
        // на завтра
    } elseif ($tab == 'sellers_analists_prize') {
        echo $tab . "\n";
        // Получение текущего списка из таблицы в BD
        $sql = "
            SELECT
            *
            FROM $tab
        ";
        $q   = $pdo->query($sql);
        if (!$q) {
            echo "error 220 string \n";
        }
        while ($row = $q->fetch()) {
            $fp[$row['user']][$row['sport']][$row['year']][$row['month']] = $row;
            $delete_array[$row['user']][]                                 = $row;
        }

        echo 'BD ' . $q->rowCount() . ' vs API ' . count($itog->rows) . "\n";
        // Добавление если нет или обновление текущих записей в BD
        foreach ($itog->rows as $item) {
            $row = array_combine($itog->fields, $item);
            if (isset($fp[$row['user']][$row['sport']][$row['year']][$row['month']])) {
                $diff = array_diff_assoc($fp[$row['user']][$row['sport']][$row['year']][$row['month']], $row);
                if (!empty($diff)) {
                    // изменяемые значения
                    $str = mysql_implode_assoc([
                        'part_of'       => $row['part_of'],
                        'prem'          => $row['prem'],
                        'part_of_marks' => $row['part_of_marks'],
                        'part_of_work'  => $row['part_of_work']
                    ]);
                    $sql = "
                        UPDATE $tab 
                        SET $str
                        WHERE user = $row[user] AND sport = $row[sport] AND year = $row[year] AND month = $row[month]
				    ";
                    $q   = $pdo->query($sql);
                    if (!$q) {
                        echo "error 248 string \n";
                    }
                }
                unset($fp[$row['user']][$row['sport']][$row['year']][$row['month']]);
                if (empty($fp[$row['user']][$row['sport']][$row['year']])) {
                    unset($fp[$row['user']][$row['sport']][$row['year']]);
                    if (empty($fp[$row['user']][$row['sport']])) {
                        unset($fp[$row['user']][$row['sport']]);
                        if (empty($fp[$row['user']])) {
                            unset($fp[$row['user']]);
                        }
                    }
                }
            } else {
                $str = mysql_implode_assoc($row);
                $sql = "
                        INSERT INTO $tab 
                        SET $str
				    ";
                $q   = $pdo->query($sql);
                if (!$q) {
                    echo "error 269 string \n";
                }
            }
        }
        // Удаление остатков после импорта
        if (!empty($fp)) {
            foreach ($fp as $key => $item) {
                foreach ($delete_array[$key] as $row) {
                    if (isset($fp[$row['user']][$row['sport']][$row['year']][$row['month']])) {
                        $sql = "
                            DELETE FROM $tab
                            WHERE user = $row[user] AND sport = $row[sport] AND year = $row[year] AND month = $row[month]
                        ";
                        $q   = $pdo->query($sql);
                        if (!$q) {
                            echo "error 284 string \n";
                        }
                    }
                }
            }
        }
        // 1
    } elseif ($tab == 'sellers_careers') {
        echo $tab . "\n";
        $sql = "
            SELECT
            *
            FROM sellers_analists_careers
        ";
        $q   = $pdo->query($sql);
        if (!$q) {
            echo "error 300 string \n";
        }
        while ($row = $q->fetch()) {
            $fp[$row['id']]             = $row;
            $delete_array[$row['id']][] = $row;
        }


        echo 'BD ' . $q->rowCount() . ' vs API ' . count($itog->rows) . "\n";

        foreach ($itog->rows as $item) {
            $row = array_combine($itog->fields, $item);
            if (isset($fp[$row['id']])) {
                $diff = array_diff_assoc($fp[$row['id']], $row);
                if (!empty($diff)) {
					$str = mysql_implode_assoc([
						'name_ru'     => $row['name_ru'],
						'name_en'     => $row['name_en'],
						'name_zh'     => $row['name_zh'],
						'team'        => $row['team'],
						'production'  => $row['production'],
						'old'         => $row['old'],
						'department_' => $row['department_'],
						'section_'    => $row['section_'],
						'short_ru'    => $row['short_ru'],
						'short_en'    => $row['short_en'],
						'timestamp'   => $row['timestamp'],
						'main'        => $row['main']
					]);
                    $sql = "
                        UPDATE sellers_analists_careers 
                        SET $str
                        WHERE id = $row[id]
				    ";
                    $q   = $pdo->query($sql);
                    if (!$q) {
                        echo "error 328 string \n";
                    }
                }
                unset($fp[$row['id']]);
            } else {
                $str = mysql_implode_assoc($row);
                $sql = "
                        INSERT INTO sellers_analists_careers 
                        SET $str
				    ";
                $q   = $pdo->query($sql);
            }
        }
        if (!empty($fp)) {
            foreach ($fp as $key => $item) {
                foreach ($delete_array[$key] as $row) {
                    if (isset($fp[$row['id']])) {
                        $sql = "
                            DELETE FROM sellers_analists_careers
                            WHERE id = $row[id]
                        ";
                        $q   = $pdo->query($sql);
                        if (!$q) {
                            echo "error 351 string \n";
                        }
                    }
                }
            }
        }
        //2
    } elseif ($tab == 'sellers_persons_main') {
        echo $tab . "\n";
        $q = $pdo->query("SELECT * FROM sellers_analists_persons");
        if (!$q) {
            echo "error 367 string \n";
        }

        echo 'BD ' . $q->rowCount() . ' vs API ' . count($itog->rows) . "\n";

        foreach ($itog->rows as $item) {
            $val[] = '('.$item[0].',"'.$item[1].'","'.$item[2].'","'.$item[3].'",'.$item[4].','.$item[5].')';
        }

        $fields_name = implode(',', $itog->fields);
        $values = implode(',', $val);
        $sql = "
            TRUNCATE TABLE sellers_analists_persons
        ";
        $q = $pdo->query($sql);
        if (!$q) {
            echo "error 386 string \n";
        }
        $sql = "
                    INSERT INTO sellers_analists_persons ($fields_name) VALUES $values
                ";
        $q   = $pdo->query($sql);
        if (!$q) {
            echo "error 394 string \n";
        }

    } elseif ($tab == 'sellers_users_stats_nowork') {
        echo $tab . "\n";
        $sql = "
            SELECT
            *
            FROM $tab
        ";
        $q   = $pdo->query($sql);
        if (!$q) {
            echo "error 438 string \n";
        }
        while ($row = $q->fetch()) {
            $fp[$row['user']][$row['cdate']] = $row;
            $delete_array[$row['user']][]    = $row;
        }


        echo 'BD ' . $q->rowCount() . ' vs API ' . count($itog->rows) . "\n";

        foreach ($itog->rows as $item) {
            $row = array_combine($itog->fields, $item);
            if (isset($fp[$row['user']][$row['cdate']])) {
                $diff = array_diff_assoc($fp[$row['user']][$row['cdate']], $row);
                if (!empty($diff)) {
                    $str = mysql_implode_assoc([
                        'reason' => $row['reason']
                    ]);
                    $sql = "
                        UPDATE $tab 
                        SET $str
                        WHERE user = $row[user] AND cdate = '$row[cdate]'
				    ";
                    $q   = $pdo->query($sql);
                    if (!$q) {
                        echo "error 463 string \n";
                    }
                }
                unset($fp[$row['user']][$row['cdate']]);
                if (empty($fp[$row['user']])) {
                    unset($fp[$row['user']]);
                }
            } else {
                $str = mysql_implode_assoc($row);
                $sql = "
                        INSERT INTO $tab 
                        SET $str
				    ";
                $q   = $pdo->query($sql);
                if (!$q) {
                    echo "error 478 string \n";
                }
            }
        }
        if (!empty($fp)) {
            foreach ($fp as $key => $item) {
                foreach ($delete_array[$key] as $row) {
                    if (isset($fp[$row['user']][$row['cdate']])) {
                        $sql = "
                            DELETE FROM $tab
                            WHERE user = $row[user] AND cdate = '$row[cdate]'
                        ";
                        $q   = $pdo->query($sql);
                        if (!$q) {
                            echo "error 492 string \n";
                        }
                    }
                }
            }
        }
        //3
    } elseif ($tab == 'sellers_analists_by_day_sports') {
        echo $tab . "\n";
        $sql = "
            SELECT
            *
            FROM $tab
        ";
        $q   = $pdo->query($sql);
        if (!$q) {
            echo "error 508 string \n";
        }
        while ($row = $q->fetch()) {
            $fp[$row['user']][$row['sport']][$row['date_op']] = $row;
            $delete_array[$row['user']][]                     = $row;
        }


        echo 'BD ' . $q->rowCount() . ' vs API ' . count($itog->rows) . "\n";

        foreach ($itog->rows as $item) {
            $row = array_combine($itog->fields, $item);
            if (isset($fp[$row['user']][$row['sport']][$row['date_op']])) {
                $diff = array_diff_assoc($fp[$row['user']][$row['sport']][$row['date_op']], $row);
                if (!empty($diff)) {
                    $str = mysql_implode_assoc([
                        'part_of' => $row['part_of'],
                        'cat'     => $row['cat'],
                        'work_id' => $row['work_id']
                    ]);
                    $sql = "
                        UPDATE $tab 
                        SET $str
                        WHERE user = $row[user] AND sport = $row[sport] AND date_op = '$row[date_op]'
				    ";
                    $q   = $pdo->query($sql);
                    if (!$q) {
                        echo "error 535 string \n";
                    }
                }
                unset($fp[$row['user']][$row['sport']][$row['date_op']]);
                if (empty($fp[$row['user']][$row['sport']])) {
                    unset($fp[$row['user']][$row['sport']]);
                    if (empty($fp[$row['user']])) {
                        unset($fp[$row['user']]);
                    }
                }
            } else {
                $str = mysql_implode_assoc($row);
                $sql = "
                        INSERT INTO $tab 
                        SET $str
				    ";
                $q   = $pdo->query($sql);
                if (!$q) {
                    echo "error 513 string \n";
                }
            }
        }
        if (!empty($fp)) {
            foreach ($fp as $key => $item) {
                foreach ($delete_array[$key] as $row) {
                    if (isset($fp[$row['user']][$row['sport']][$row['date_op']])) {
                        $sql = "
                            DELETE FROM $tab
                            WHERE user =  $row[user] AND sport = $row[sport] AND date_op = '$row[date_op]'
                        ";
                        $q   = $pdo->query($sql);
                        if (!$q) {
                            echo "error 567 string \n";
                        }
                    }
                }
            }
        }
    } elseif ($tab == 'sellers_analists_prize_sports') {
        echo $tab . "\n";
        // Получение текущего списка из таблицы в BD
        $sql = "
            SELECT
            *
            FROM $tab
        ";
        $q   = $pdo->query($sql);
        if (!$q) {
            echo "error 583 string \n";
        }
        while ($row = $q->fetch()) {
            $fp[$row['user']][$row['sport']][$row['year']][$row['month']] = $row;
            $delete_array[$row['user']][]                                 = $row;
        }

        echo 'BD ' . $q->rowCount() . ' vs API ' . count($itog->rows) . "\n";
        // Добавление если нет или обновление текущих записей в BD
        foreach ($itog->rows as $item) {
            $row = array_combine($itog->fields, $item);
            if (isset($fp[$row['user']][$row['sport']][$row['year']][$row['month']])) {
                $diff = array_diff_assoc($fp[$row['user']][$row['sport']][$row['year']][$row['month']], $row);
                if (!empty($diff)) {
                    // изменяемые значения
                    $str = mysql_implode_assoc([
                        'part_of'       => $row['part_of'],
                        'prem'          => $row['prem'],
                        'part_of_marks' => $row['part_of_marks'],
                        'part_of_work'  => $row['part_of_work']
                    ]);
                    $sql = "
                        UPDATE $tab 
                        SET $str
                        WHERE user = $row[user] AND sport = $row[sport] AND year = $row[year] AND month = $row[month]
				    ";
                    $q   = $pdo->query($sql);
                    if (!$q) {
                        echo "error 611 string \n";
                    }
                }
                unset($fp[$row['user']][$row['sport']][$row['year']][$row['month']]);
                if (empty($fp[$row['user']][$row['sport']][$row['year']])) {
                    unset($fp[$row['user']][$row['sport']][$row['year']]);
                    if (empty($fp[$row['user']][$row['sport']])) {
                        unset($fp[$row['user']][$row['sport']]);
                        if (empty($fp[$row['user']])) {
                            unset($fp[$row['user']]);
                        }
                    }
                }
            } else {
                $str = mysql_implode_assoc($row);
                $sql = "
                        INSERT INTO $tab 
                        SET $str
				    ";
                $q   = $pdo->query($sql);
                if (!$q) {
                    echo "error 632 string \n";
                }
            }
        }
        // Удаление остатков после импорта
        if (!empty($fp)) {
            foreach ($fp as $key => $item) {
                foreach ($delete_array[$key] as $row) {
                    if (isset($fp[$row['user']][$row['sport']][$row['year']][$row['month']])) {
                        $sql = "
                            DELETE FROM $tab
                            WHERE user = $row[user] AND sport = $row[sport] AND year = $row[year] AND month = $row[month]
                        ";
                        $q   = $pdo->query($sql);
                        if (!$q) {
                            echo "error 647 string \n";
                        }
                    }
                }
            }
        }
    } elseif ($tab == 'sellers_workers_schedule') {
        echo $tab . "\n";
        // Получение текущего списка из таблицы в BD
        $sql = "
            SELECT
            *
            FROM $tab
        ";
        $q   = $pdo->query($sql);
        if (!$q) {
            echo "error 583 string \n";
        }

        echo 'BD ' . $q->rowCount() . ' vs API ' . count($itog->rows) . "\n";

        $fields = implode(',', $itog->fields[0]);

        $rows  = '';
        $count = count($itog->rows);
        $i     = 0;
        foreach ($itog->rows as $row) {
            $i++;
            if ($i != $count) {
                $rows .= "('$row[0]','$row[1]'),";
            } else {
                $rows .= "('$row[0]','$row[1]')";
            }
        }
        if ($count) {
            $sql = "
            TRUNCATE TABLE sellers_workers_schedule
            ";
            $q   = $pdo->query($sql);
            $sql = "
            INSERT INTO sellers_workers_schedule ($fields) VALUES $rows
            ";
            $q   = $pdo->query($sql);
        }
    } elseif ($tab == 'sellers_workers_schedule_persons') {
        echo $tab . "\n";
        // Получение текущего списка из таблицы в BD
        $sql = "
            SELECT
            *
            FROM $tab
        ";
        $q   = $pdo->query($sql);
        if (!$q) {
            echo "error 583 string \n";
        }

        echo 'BD ' . $q->rowCount() . ' vs API ' . count($itog->rows) . "\n";

        $fields = implode(',', $itog->fields);

        $rows  = '';
        $count = count($itog->rows);
        $i     = 0;
        foreach ($itog->rows as $row) {
            $i++;
            if (!$row[4]) $row[4] = 0;
            if ($i != $count) {
                $rows .= str_replace($row[3], "'$row[3]'", "(".implode(',', $row)."),");
            } else {
                $rows .= str_replace($row[3], "'$row[3]'", "(".implode(',', $row).")");
            }
        }
        if ($count) {
            $sql = "
            TRUNCATE TABLE sellers_workers_schedule_persons
            ";
            $q   = $pdo->query($sql);
            $sql = "
            INSERT INTO sellers_workers_schedule_persons ($fields) VALUES $rows
            ";
            $q   = $pdo->query($sql);
        }
    }
}
echo "done \n";
$d = time();
echo $d - $c;
echo "sec \n";
function check_date($str)
{
    $t = explode('-', $str);
    if (isset($t[1]) && isset($t[0]) && isset($t[2])) {
        return checkdate($t[1], $t[2], $t[0]);
    } else {
        return false;
    }
}

function mysql_implode_assoc($array)
{
    $str = '';
    $i   = 0;
    foreach ($array as $key => $value) {

        if ($i == count($array) - 1) {
            $str .= $key . '=' . (($value == null) ? 'null' : (check_date($value) || (!is_numeric($value)) ? "'" . $value . "'" : $value));
        } else {
            $str .= $key . '=' . (($value == null) ? 'null' : (check_date($value) || (!is_numeric($value)) ? "'" . $value . "'" : $value)) . ',';
        }
        $i++;
    }
    return $str;
}