<?php


$this->pageTitle = Yii::app()->name . ' - ' . 'Редактировать изображение:' . $model->title . '"';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Список изображений');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Редактировать изображение :' . $model->title);

$this->menu = array(
    array(
        'label' => 'Список изображений',
        'icon' => 'list',
        'url' => array('index')
    ),
    array(
        'label' => 'Добавить изображение',
        'icon' => 'plus',
        'url' => array('create')
    ),
    array(
        'label' => 'Удалить изображение',
        'icon' => 'remove',
        'url' => array('delete', 'id' => $model->id),
        'htmlOptions' => array(
            'confirm' => 'Вы действительно хотите удалить этот изображение (' . $model->title . ')?'
        ),
    ),
);
?>

<h1>Редактировать изображение: <?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>