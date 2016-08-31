<?php


$this->pageTitle = Yii::app()->name . ' - ' . 'Список изображений';

$this->breadcrumbs[] = array('route' => false, 'title' => 'Список изображений');

$this->menu = array(
    array(
        'label' => 'Добавить изображение',
        'icon' => 'plus',
        'url' => array('create')
    ),
);

?>

<h1>Список изображений</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'gallery-photo-grid',
    'dataProvider' => $model->search(),
    'selectableRows' => 0,
    'itemsCssClass' => 'table',
    'columns' => array(
        'id',
        array(
            'name' => 'image',
            'type' => 'raw',
            'value' => 'CHtml::link("<img width=100 src=uploads/" . $data->image . ">", array("update", "id" => $data->id))'
        ),
        array(
            'name' => 'title',
            'type' => 'html',
            'value' => 'CHtml::link(CHtml::encode($data->title), array("update", "id" => $data->id))'
        ),
        array(
            'name' => 'album_id',
            'type' => 'html',
            'value' => '$data->album->title',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'deleteConfirmation' => "js:'Вы действительно хотите удалить это изображение?'",
            'buttons' => array(
                'delete' => array(
                    'label' => 'Удалить',
                    'icon' => 'remove',
                    'url' => 'Yii::app()->createUrl("gallery/admin/galleryPhotos/delete", array("id" => $data->id))',
                ),
            ),
        ),
    ),
)); ?>

