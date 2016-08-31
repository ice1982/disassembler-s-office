<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Список групп';

$this->breadcrumbs[] = array('route' => false, 'title' => 'Группы каталога');

$this->menu = array(
    array(
        'label' => 'Добавить группу',
        'icon' => 'plus',
        'url' => array('create')
    ),
);

?>

<h1>Группы товаров</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'catalog-group-grid',
    'dataProvider' => $model->search(),
    'itemsCssClass' => 'table',
    'filter' => $model,
    'rowCssClassExpression' => '($data->active == 1) ? "row-on" : "row-off"',
    'columns' => array(
        array(
            'class' => 'DataColumn',
            'evaluateHtmlOptions' => true,
            'type' => 'html',
            'header' => 'Вкл/Выкл',
            'htmlOptions' => array(
                'class' => '($data->active == 1) ? "td-active" : "td-inactive"',
                'title' => '($data->active == 1) ? "Выключить" : "Включить"',
            ),
            'value' => 'CHtml::link(($data->active == 1) ? "<span class=\'glyphicon glyphicon-off\'></span>" : "<span class=\'glyphicon glyphicon-play\'></span>", array(($data->active == 1) ? "turnOff" : "turnOn", "id" => $data->id))',
        ),
        'id',
        array(
            'name' => 'image',
            'type' => 'html',
            'value' => 'CHtml::image("/uploads/catalog/" . $data->image, $data->title, array("style" => "height: 30px"))'
        ),
        array(
            'name' => 'title',
            'type' => 'html',
            'value' => 'CHtml::link(CHtml::encode($data->title), Yii::app()->createUrl("catalog/admin/catalogItems/index", array("group_id" => $data->id)))'
        ),
        array(
            'name' => 'parent_id',
            'type' => 'html',
            'value' => '(isset($data->parent->title)) ? $data->parent->title : ""',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update} {delete}',
            'deleteConfirmation' => "js:'Вы действительно хотите удалить группу ' + $(this).parents('tr').children('.catalog-group-title').text() + '?'",
            'buttons' => array(
                'update' => array(
                    'label' => 'Редактировать группу',
                    'icon' => 'update',
                    'url' => 'Yii::app()->createUrl("catalog/admin/catalogGroups/update", array("id" => $data->id))',
                ),
                'delete' => array(
                    'label' => 'Удалить',
                    'icon' => 'remove',
                    'url' => 'Yii::app()->createUrl("catalog/admin/catalogGroups/delete", array("id" => $data->id))',
                ),
            ),
        ),
    ),
)); ?>
