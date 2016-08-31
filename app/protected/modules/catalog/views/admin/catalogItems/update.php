<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->pageTitle = Yii::app()->name . ' - ' . 'Редактировать товар :' . $model->title . '"';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Список товаров');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Редактировать товар :' . $model->title);

$this->menu = array(
    array(
        'label' => 'Список товаров',
        'icon' => 'list',
        'url' => array('index')
    ),
    array(
        'label' => 'Добавить товар',
        'icon' => 'plus',
        'url' => array('create')
    ),
    array(
        'label' => ($model->active == 1) ? 'Выключить товар' : 'Включить товар',
        'icon' => ($model->active == 1) ? 'icon-off' : 'icon-ok',
        'url' => ($model->active == 1) ? array('turnOff', 'id' => $model->id) : array('turnOn', 'id' => $model->id)
    ),
    array(
        'label' => 'Удалить товар',
        'icon' => 'remove',
        'url' => array('delete', 'id' => $model->id),
        'htmlOptions' => array(
            'confirm' => 'Вы действительно хотите удалить этот товар (' . $model->title . ')?'
        ),
    ),
);
?>

<h1>Редактировать товар: <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form',
    array(
        'model'   => $model,
    )
); ?>