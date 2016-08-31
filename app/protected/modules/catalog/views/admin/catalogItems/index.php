<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->pageTitle = Yii::app()->name . ' - ' . 'Список товаров';

$this->breadcrumbs[] = array('route' => false, 'title' => 'Список товаров');

$this->menu = array(
    array(
        'label' => 'Добавить товар',
        'icon' => 'plus',
        'url' => array('create')
    ),
);

?>

<h1>Список товаров</h1>
<?php if (isset($group_model->id)) : ?>
<h2>Для группы: <?=$group_model->title?></h2>
<?php endif; ?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'catalog-grid',
    'dataProvider' => $data_provider,
    'filter' => $model,
    'selectableRows' => 0,
    'itemsCssClass' => 'table',
    'rowCssClassExpression' => '($data->active == 1) ? "row-on" : "row-off"',
    'columns' => array(
        array(
            'id'=>'autoId',
            'class'=>'CCheckBoxColumn',
            'selectableRows' => '50',
        ),
        array(
            'class' => 'DataColumn',
            'evaluateHtmlOptions' => true,
            'type' => 'html',
            'htmlOptions' => array(
                'class' => '($data->active == 1) ? "td-active" : "td-inactive"',
                'title' => '($data->active == 1) ? "Выключить" : "Включить"',
            ),
            'value' => 'CHtml::link(($data->active == 1) ? "<span class=\'glyphicon glyphicon-off\'></span>" : "<span class=\'glyphicon glyphicon-play\'></span>", array(($data->active == 1) ? "turnOff" : "turnOn", "id" => $data->id))',
        ),
        array(
            'name' => 'title',
            'type' => 'html',
            'value' => 'CHtml::link(CHtml::encode($data->title), array("update", "id" => $data->id))'
        ),
        'code',
        'diametr',
        'pressure',
        'material',
        'environment',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update} {delete}',
            'deleteConfirmation' => "js:'Вы действительно хотите удалить товар ' + $(this).parents('tr').children('.catalog-title').text() + '?'",
            'buttons' => array(
                'update' => array(
                    'label' => 'Редактировать группу',
                    'icon' => 'update',
                    'url' => 'Yii::app()->createUrl("catalog/admin/catalogItems/update", array("id" => $data->id))',
                ),
                'delete' => array(
                    'label' => 'Удалить',
                    'icon' => 'remove',
                    'url' => 'Yii::app()->createUrl("catalog/admin/catalogItems/delete", array("id" => $data->id))',
                ),
            ),
        ),
    ),
)); ?>

<script>
function reloadGrid(data) {
    $.fn.yiiGridView.update('catalog-grid');
}
</script>

<?php echo CHtml::ajaxSubmitButton(
    'Включить',
    Yii::app()->createUrl('catalog/admin/catalogItems/ajaxUpdate', array('act' => 'doActive')),
    array('success'=>'reloadGrid'),
    array('class' => 'btn btn-success')
); ?>
&nbsp;
<?php echo CHtml::ajaxSubmitButton(
    'Выключить',
    Yii::app()->createUrl('catalog/admin/catalogItems/ajaxUpdate', array('act' => 'doInactive')),
    array('success'=>'reloadGrid'),
    array('class' => 'btn btn-default')
); ?>
&nbsp;
<?php echo CHtml::ajaxSubmitButton(
    'Удалить',
    Yii::app()->createUrl('catalog/admin/catalogItems/ajaxUpdate', array('act' => 'doDelete')),
    array('success' => 'reloadGrid'),
    array('class' => 'btn btn-danger')
); ?>
&nbsp;
<?php echo CHtml::dropDownList(
    'group_id',
    false,
    $groups_list,
    array(
        'empty' => '-- Перенести в группу --',
        'class' => 'form-control',
        'style' => 'width: 200px; display: inline-block',
    )
); ?>
<?php echo CHtml::ajaxSubmitButton(
    'Перенести',
    Yii::app()->createUrl('catalog/admin/catalogItems/ajaxUpdate', array('act' => 'doMove')),
    array('success' => 'reloadGrid'),
    array('class' => 'btn btn-default')
); ?>

<?php $this->endWidget(); ?>