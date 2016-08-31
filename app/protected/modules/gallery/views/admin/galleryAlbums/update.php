<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Редактировать альбом :' . $model->title . '"';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Список альбомов');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Редактировать альбом :' . $model->title);

$this->menu = array(
    array(
        'label' => 'Список альбомов',
        'icon' => 'list',
        'url' => array('index')
    ),
    array(
        'label' => 'Добавить альбом',
        'icon' => 'plus',
        'url' => array('create')
    ),
    array(
        'label' => 'Удалить альбом',
        'icon' => 'remove',
        'url' => array('delete', 'id' => $model->id),
        'htmlOptions' => array(
            'confirm' => 'Вы действительно хотите удалить этот альбом (' . $model->title . ')?'
        ),
    ),
);
?>

<h1>'Редактировать альбом : <?=$model->title?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>