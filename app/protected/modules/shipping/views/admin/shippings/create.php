<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Добавить отгрузку';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Отгрузки');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Добавить отгрузку');

$this->menu = array(
    array(
        'label' => 'Список отгрузок',
        'icon' => 'list',
        'url' => array('index')
    ),
);
?>

<h1>Добавить отгрузку</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>