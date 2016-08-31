<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Создать страницу';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Страницы');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Создать страницу');

$this->menu = array(
    array(
        'label' => 'Список страниц',
        'icon' => 'list',
        'url' => array('index')
    ),
);
?>

<h1>Создать страницу</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>