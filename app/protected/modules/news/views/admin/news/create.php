<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Добавить новость';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Новости');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Добавить новость');

$this->menu = array(
    array(
        'label' => 'Список новостей',
        'icon' => 'list',
        'url' => array('index')
    ),
);
?>

<h1>Добавить новость</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>