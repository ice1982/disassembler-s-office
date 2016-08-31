<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Редактировать отгрузку: ' . $model->title;

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Отгрузки');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Редактировать отгрузку: ' . $model->title);

$this->menu = array(
    array(
        'label' => 'Список отгрузок',
        'icon' => 'list',
        'url' => array('index')
    ),
    array(
        'label' => 'Добавить отгрузку',
        'icon' => 'plus',
        'url' => array('create')
    ),
    array(
        'label' => 'Удалить отгрузку',
        'icon' => 'remove',
        'url' => array('delete', 'id' => $model->id),
        'htmlOptions' => array(
            'confirm' => 'Вы действительно хотите удалить эту отгрузку (' . $model->title . ')?'
        ),
    ),
);
?>

<h1>Редактировать отгрузку: <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>