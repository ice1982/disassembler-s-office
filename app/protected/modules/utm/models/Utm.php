<?php

/**
 *
 */
class Utm extends CModel
{
    /**
     * [$utm_source description]
     * @var [type]
     */
    public $utm_source = false;

    /**
     * [$utm_medium description]
     * @var [type]
     */
    public $utm_medium = false;

    /**
     * [$utm_campaign description]
     * @var [type]
     */
    public $utm_campaign = false;

    /**
     * [$utm_content description]
     * @var [type]
     */
    public $utm_content = false;

    /**
     * [$utm_term description]
     * @var [type]
     */
    public $utm_term = false;

    /**
     * [$custom_params description]
     * @var array
     */
    public $custom_params = array();

    /**
     * [attributeNames description]
     * @return [type] [description]
     */
    public function attributeNames()
    {
        return array(
            'utm_source' => 'Источник перехода',
            'utm_medium' => 'Тип трафика',
            'utm_campaign' => 'Кампания',
            'utm_content' => 'Объявление',
            'utm_term' => 'Ключевое слово',
            'custom_params' => 'Пользовательские параметры',
        );
    }

    /**
     * [getUtm description]
     * @return [type] [description]
     */
    public function setUtm()
    {
        if (isset($_GET)) {
            $labels = $this->attributeNames();

            foreach ($_GET as $key => $value) {
                if ($key == 'r') {
                    continue;
                }

                if (isset($labels[$key])) {
                    $this->$key = $value;
                } else {
                    $this->custom_params[$key] = $value;
                }
            }
        }
    }

    /**
     * [getUtmForMail description]
     * @return [type] [description]
     */
    public function getUtmForMail()
    {
        $result = '';

        $labels = $this->attributeNames();
        foreach ($labels as $key => $name) {
            if ($key == 'custom_params') {
                continue;
            }
            if ($this->$key == false) {
                continue;
            }
            $result .= $name . ': ' . $this->$key . '<br>';
        }

        foreach ($this->custom_params as $key => $name) {
            $result .= $key . ': ' . $name . '<br>';
        }

        if (!empty($result)) {
            $message = 'UTM-метки:<br><br>' . $result;
        } else {
            $message = 'UTM-меток нет.';
        }

        return $message;
    }

    /**
     * [getUtmForDb description]
     * @return [type] [description]
     */
    public function getUtmForDb()
    {
        $result = array();
        $labels = $this->attributeNames();
        foreach ($labels as $key => $value) {
            if ($this->$key == false) {
                continue;
            }
            if ( ($key == 'custom_params') && ($value == array()) ) {
                continue;
            }
            $result[$key] = $value;
        }

        $json = json_encode($result);

        return $json;
    }
}