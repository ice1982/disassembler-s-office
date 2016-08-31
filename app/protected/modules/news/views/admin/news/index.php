<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Список новостей';

$this->breadcrumbs[] = array('route' => false, 'title' => 'Новости');

$this->menu = array(
    array(
        'label' => 'Добавить новость',
        'icon' => 'plus',
        'url' => array('create')
    ),
);

?>

<h1>список новостей</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'news-grid',
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
            'value' => 'CHtml::image("/uploads/" . $data->image, $data->title, array("style" => "height: 30px"))'
        ),
        array(
            'name' => 'title',
            'type' => 'html',
            'value' => 'CHtml::link(CHtml::encode($data->title), Yii::app()->createUrl("news/admin/news/update", array("id" => $data->id)))',
            'htmlOptions' => array(
                'class' => 'news-title',
            ),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update} {delete}',
            'deleteConfirmation' => "js:'Вы действительно хотите удалить новость ' + $(this).parents('tr').children('.shipping-title').text() + '?'",
            'buttons' => array(
                'update' => array(
                    'label' => 'Редактировать новость',
                    'icon' => 'update',
                    'url' => 'Yii::app()->createUrl("news/admin/news/update", array("id" => $data->id))',
                ),
                'delete' => array(
                    'label' => 'Удалить',
                    'icon' => 'remove',
                    'url' => 'Yii::app()->createUrl("news/admin/news/delete", array("id" => $data->id))',
                ),
            ),
        ),
    ),
)); ?>
