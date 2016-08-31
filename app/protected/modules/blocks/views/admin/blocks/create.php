<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Создать блок';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Блоки');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Создать блок');

$this->menu = array(
    array(
        'label' => 'Список блоков',
        'icon' => 'list',
        'url' => array('index')
    ),
);
?>

<h1>Создать блок</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>