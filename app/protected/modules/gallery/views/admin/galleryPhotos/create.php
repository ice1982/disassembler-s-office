<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Добавить изображение';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Список изображений');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Добавить изображение');

$this->menu = array(
    array(
        'label' => 'Список изображений',
        'icon' => 'list',
        'url' => array('index')
    ),
);
?>

<h1>Добавить изображение</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>