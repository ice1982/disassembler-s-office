<?php

/**
 *
 * Пример URL с UTM-метками:
 * http://site.ru/?utm_source=yandex&utm_medium=cpc&utm_campaign=cid|14180330|search&utm_content=gid|878414738|aid|1174000813|4127388276_&utm_term=%D0%A8%D0%A3%D0%9E%D0%A2-2405-90-230-2-%D0%A3%D0%A5%D0%9B4&pm_source=none&pm_block=premium&pm_position=1&yclid=5903445630063760235&pm_replace=keyword
 *
 * Пример запуска виджета:
 * echo $this->decodeWidgets('[*UtmReplaceWidget|if_url_param_key=pm_replace;if_url_param_value=keyword;replace_url_param=utm_term;replace_template=Производим <b>*</b>;default_text_value=ШОТ*]');
 *
 * @author Pavel V. Danilov <pv.danilov.dev@gmail.com>
 */
class UtmReplaceWidget extends CWidget
{
    /**
     * [$if_url_param_key description]
     * @var [type]
     */
    public $if_url_param_key = false;

    /**
     * [$if_condition description]
     * @var [type]
     */
    public $if_condition = 'equal';

    /**
     * [$if_url_param_value description]
     * @var [type]
     */
    public $if_url_param_value = false;

    /**
     * [$replace_url_param description]
     * @var [type]
     */
    public $replace_url_param = 'utm_term';

    /**
     * [$replace_template_placeholder description]
     * @var string
     */
    public $replace_template_placeholder = '###';

    /**
     * [$replace_template description]
     * @var [type]
     */
    public $replace_template = '###';

    /**
     * [$default_text_value description]
     * @var [type]
     */
    public $default_text_value = '';

    /**
     * [run description]
     * @return [type] [description]
     */
    public function run()
    {
        // Если значение одной метки выполняет определенное условие, то виджет меняем на значение шаблона, куда подставляется значение метки, если метки нет, то показываем значение по умолчанию

        $result = $this->default_text_value;

        // Флаг: производим ли замену?
        $is_replace = false;

        // Если переменные для условий вообще не заданы, то замена произойдет в любом случае
        if (
            ($this->if_url_param_key === false)
            ) {
            $is_replace = true;
        } elseif (
            // Если указано специальное условие об отсутсвии конкретной UTM-метки
            ($this->if_condition == 'not_isset') &&
            ($this->if_url_param_key !== false)
            ) {
                if (!isset($_GET[$this->if_url_param_key])) {
                    $is_replace = true;
                }
        } elseif (
            // Если задано имя метки для условия, а остальные параметры для условия не заданы, то это значит, что замена будет выполняться при любом значении этой метки
            ($this->if_url_param_key !== false) &&
            ($this->if_url_param_value === false)
            ) {
                if (isset($_GET[$this->if_url_param_key])) {
                    $is_replace = true;
                }
        } elseif (
            // В остальных случаях проверяем условие
            ($this->if_url_param_key !== false) &&
            ($this->if_url_param_value !== false)
            ) {

            if (isset($_GET[$this->if_url_param_key])) {
                switch ($this->if_condition) {
                    case 'equal':
                        $is_replace = ($_GET[$this->if_url_param_key] == $this->if_url_param_value);
                        break;
                    case 'not_equal':
                        $is_replace = ($_GET[$this->if_url_param_key] != $this->if_url_param_value);
                        break;
                    case 'in_array': // Для этой операции можно указывать несколько значений через заяпятую
                        $values_array = explode(',', $this->if_url_param_value);
                        $is_replace = in_array($_GET[$this->if_url_param_key], $values_array);
                        break;
                    case 'not_in_array': // Для этой операции можно указывать несколько значений через заяпятую
                        $values_array = explode(',', $this->if_url_param_value);
                        $is_replace = !in_array($_GET[$this->if_url_param_key], $values_array);
                        break;
                    case 'greater':
                        $is_replace = ($_GET[$this->if_url_param_key] > $this->if_url_param_value);
                        break;
                    case 'less':
                        $is_replace = ($_GET[$this->if_url_param_key] < $this->if_url_param_value);
                        break;
                    case 'greater_or_equal':
                        $is_replace = ($_GET[$this->if_url_param_key] >= $this->if_url_param_value);
                        break;
                    case 'less_or_equal':
                        $is_replace = ($_GET[$this->if_url_param_key] <= $this->if_url_param_value);
                        break;
                }
            }
        }

        if ($is_replace === true) {
            if (isset($_GET[$this->replace_url_param])) {
                // Парсим шаблон
                $result = str_replace($this->replace_template_placeholder, $_GET[$this->replace_url_param], $this->replace_template);
            } else {
                $result = $this->replace_template;
            }
        }

        echo $result;
    }
}
