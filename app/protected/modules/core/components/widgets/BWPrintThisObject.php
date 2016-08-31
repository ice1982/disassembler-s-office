<?php

class BWPrintThisObject extends CWidget
{
    /**
     * [$var_name description]
     * @var [type]
     */
    public $var_name;

    /**
     * [$var_property description]
     * @var [type]
     */
    public $var_property = false;

    /**
     * [$var_method description]
     * @var boolean
     */
    public $var_method = false;

    /**
     * [$has_widget description]
     * @var [type]
     */
    public $has_widget = false;

    public function run()
    {
        $result = '';

        $this_var = Yii::app()->getController();



        $var_name = $this->var_name;


        // Получаем переменную из $this контроллера;
        if (isset($this_var->$var_name)) {
            $result = $this_var->$var_name;
        }

        // Если это строка, то выводим ее
        if (is_string($result)) {
            $this->_echo($result);
            return true;
        }

        // Если указаны и метод и свойство, то ничего не выводим, так как мы выводим только 1 вещь
        if ( ($this->var_property != false) && ($this->var_method != false) ) {
            return false;
        }

        // Выводим значение свойства
        if ($this->var_property != false) {
            $property = $this->var_property;
            $result = $result->$property;

            $this->_echo($result);
            return true;
        }

        // Выводим значение метода
        if ($this->var_method != false) {
            $method = $this->var_method;
            $result = $result->$method();

            $this->_echo($result);
            return true;
        }

    }

    /**
     * [_echo description]
     * @param  [type] $result [description]
     * @return [type]         [description]
     */
    private function _echo($result)
    {
        if ($this->has_widget != false) {
            $result = Yii::app()->getController()->decodeWidgets($result);
        }

        if (is_string($result)) {
            echo $result;
        }
    }
}