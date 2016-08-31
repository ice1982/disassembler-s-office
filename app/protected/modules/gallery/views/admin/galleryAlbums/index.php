<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Список альбомов с фотографиями';

$this->breadcrumbs[] = array('route' => false, 'title' => 'Список альбомов с фотографиями');

$this->menu = array(
    array(
        'label' => 'Добавить альбом',
        'icon' => 'plus',
        'url' => array('create')
    ),
);

?>

<h1>Список альбомов с фотографиями</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'gallery-album-grid',
    'dataProvider' => $model->search(),
    'selectableRows' => 0,
    'itemsCssClass' => 'table',
    'columns' => array(
        array(
            'name' => 'title',
            'htmlOptions' => array('class' => 'gallery-album-title'),
            'type' => 'html',
            'value' => 'CHtml::link(CHtml::encode($data->title), array("update", "id" => $data->id))'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'deleteConfirmation' => "js:'Вы действительно хотите удалить альбом ' + $(this).parents('tr').children('.gallery-album-title').text() + '?'",
            'buttons' => array(
                'delete' => array(
                    'label' => 'Удалить',
                    'icon' => 'remove',
                    'url' => 'Yii::app()->createUrl("gallery/admin/galleryAlbums/delete", array("id" => $data->id))',
                ),
            ),
        ),
    ),
)); ?>

