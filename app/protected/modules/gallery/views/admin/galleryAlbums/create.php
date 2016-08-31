<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Добавить альбом с фотографиями';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Список альбомов с фотографиями');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Добавить альбом');

$this->menu = array(
	array(
        'label' => 'Список альбомов',
        'icon' => 'list',
        'url' => array('index')
    ),
);
?>

<h1>Добавить альбом</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>