<?php
/* @var $this CatalogGroupController */
/* @var $model CatalogGroup */

$this->pageTitle = Yii::app()->name . ' - ' . 'Редактировать группу: ' . $model->title;

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Группы каталога');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Редактировать группу: '. $model->title);

$this->menu = array(
    array(
        'label' => 'Список групп',
        'icon' => 'list',
        'url' => array('index')
    ),
    array(
        'label' => 'Создать группу',
        'icon' => 'plus',
        'url' => array('create')
    ),
    array(
        'label' => 'Удалить группу',
        'icon' => 'remove',
        'url' => array('delete', 'id' => $model->id),
        'htmlOptions' => array(
            'confirm' => 'Вы действительно хотите удалить эту группу (' . $model->title . ')?'
        ),
    ),
);
?>

<h1>Редактировать группу: <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>