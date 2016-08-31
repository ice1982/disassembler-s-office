<div class="font-h3 font-h-color margin-h3 block-center group-name">
    <?php if (isset($group_model->id)) : ?>
        Поиск по группе &laquo;<?=$group_model->title?>&raquo;
    <?php else: ?>
        Поиск по каталогу
    <?php endif;?>

</div>

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('catalog/default/search'),
    'method' => 'get',
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    ),
)); ?>

<div class="row">
    <div class="col-xs-4">
        <div class="">
            <?php echo $form->label($model,'group_id', array('class' => 'control-label')); ?>
            <?php echo $form->dropDownList(
                $model,
                'group_id',
                CHtml::listData(
                    $groups,
                    'id',
                    'title'
                ),
                array(
                    'empty' => '--- Выберите группу товаров ---',
                    'class' => 'form-control',
                )
            ); ?>
        </div>
    </div>

    <div class="col-xs-8">
        <div class="">
            <?php echo $form->label($model, 'name', array('class' => 'control-label')); ?>
            <?php echo $form->textField(
                $model,
                'name',
                array(
                    'class' => 'form-control',
                )
            ); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <div class="">
            <?php echo $form->label($model,'diametr', array('class' => 'control-label')); ?>
            <?php echo $form->textField(
                $model,
                'diametr',
                array(
                    'class' => 'form-control',
                )
            ); ?>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="">
            <?php echo $form->label($model,'pressure', array('class' => 'control-label')); ?>
            <?php echo $form->textField(
                $model,
                'pressure',
                array(
                    'class' => 'form-control',
                )
            ); ?>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="">
            <?php echo $form->label($model,'material', array('class' => 'control-label')); ?>
            <?php echo $form->textField(
                $model,
                'material',
                array(
                    'class' => 'form-control',
                )
            ); ?>
        </div>
    </div>


</div>

<hr/>



<div class="">
    <label class="control-label" for=""></label>
    <?php echo CHtml::submitButton('Искать', array('class' => 'btn btn-lg btn-primary')); ?>
</div>


<?php $this->endWidget(); ?>

<hr/>

<p class="">Заполните хотя бы одно из полей</p>