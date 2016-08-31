<?php
/* @var $this PageController */
/* @var $model Page */

$this->pageTitle = Yii::app()->name . ' - ' . 'Список заявок';

$this->breadcrumbs[] = array('route' => false, 'title' => 'Список заявок с сайта');

?>

<h1>Список заявок</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'form-request-grid',
    'dataProvider' => $model->search(),
    'itemsCssClass' => 'table table-striped',
    'selectableRows' => 0,
    'columns' => array(
        'id',
        'created_datetime',
        'name',
        'phone',
        'email',
        array(
            'name' => 'custom',
            'type' => 'html',
            'value' => '$data->parseJson($data->custom)',
        ),
        array(
            'name' => 'utm',
            'type' => 'html',
            'value' => '$data->parseJson($data->utm)',
        ),
    ),
)); ?>
