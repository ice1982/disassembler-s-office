<?php

/**
 *
 */

/**
 *
 */
class BWGetModelProperty extends CWidget
{
    /**
     * [$model description]
     * @var [type]
     */
    public $model;

    /**
     * [$pk description]
     * @var string
     */
    public $pk = 'id';

    /**
     * [$value description]
     * @var [type]
     */
    public $pk_value;

    /**
     * [$property description]
     * @var [type]
     */
    public $property;

    public function run()
    {
        $model = CActiveRecord::model($this->model)->findByPk($this->pk_value);

        $property = $this->property;

        if (isset($model->$property)) {
            echo Yii::app()->getController()->decodeWidgets( $model->$property );
        }
    }
}