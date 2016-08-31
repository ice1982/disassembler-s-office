<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Создать группу';

$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Группы каталога');
$this->breadcrumbs[] = array('route' => false, 'title' => 'Создать группу');

$this->menu = array(
    array(
        'label' => 'Список групп',
        'icon' => 'list',
        'url' => array('index')
    ),
);
?>

<h1>Добавить группу</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>