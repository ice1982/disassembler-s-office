<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Редактировать новость: ' . $model->title;

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Новости');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Редактировать новость: ' . $model->title);

$this->menu = array(
    array(
        'label' => 'Список новостей',
        'icon' => 'list',
        'url' => array('index')
    ),
    array(
        'label' => 'Добавить новость',
        'icon' => 'plus',
        'url' => array('create')
    ),
    array(
        'label' => 'Удалить новость',
        'icon' => 'remove',
        'url' => array('delete', 'id' => $model->id),
        'htmlOptions' => array(
            'confirm' => 'Вы действительно хотите удалить эту новость (' . $model->title . ')?'
        ),
    ),
);
?>

<h1>Редактировать новость: <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>