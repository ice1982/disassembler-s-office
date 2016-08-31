<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->pageTitle = Yii::app()->name . ' - ' . 'Добавить товар';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Список товаров');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Добавить товар');

$this->menu = array(
    array(
        'label' => 'Список товаров',
        'icon' => 'list',
        'url' => array('index')
    ),
);
?>

<h1>Добавить товар</h1>

<?php echo $this->renderPartial('_form',
    array(
        'model' => $model,
    )
); ?>