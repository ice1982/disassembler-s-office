<?php
/* @var $this CatalogGroupController */
/* @var $model CatalogGroup */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'catalog-group-form',
	'enableAjaxValidation' => false,
	'clientOptions' => array(
    	'validateOnSubmit' => true,
    ),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span>, обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title', array('class' => 'form-control input-large')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'alias'); ?>
        <?php echo $form->textField($model,'alias', array('class' => 'form-control input-large')); ?>
        <?php echo $form->error($model,'alias'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'parent_id'); ?>
        <?php
        echo $form->dropDownList($model,'parent_id',
            CHtml::listData(CatalogGroup::model()->findAll(array('order' => 'title')),'id','title'),
            array('empty' => 'Выберите родительскую группу', 'class' => 'form-control input-large')
        );
        ?>
        <?php echo $form->error($model,'parent_id'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model, 'description',
            array(
                'class' => 'form-control input-large tinymce',
            )
        ); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <?php if (!empty($model->image)) : ?>
        <div class="form-group">
            <img width=100 src="/uploads/catalog/<?=$model->image?>" alt="">
        </div>
    <?php endif; ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'image'); ?>
        <?php echo $form->fileField($model,'image', array('class' => 'form-control input-large')); ?>
        <?php echo $form->error($model,'image'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'image_attr_title'); ?>
        <?php echo $form->textArea($model,'image_attr_title', array('class' => 'form-control input-large')); ?>
        <?php echo $form->error($model,'image_attr_title'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'image_attr_alt'); ?>
        <?php echo $form->textArea($model,'image_attr_alt', array('class' => 'form-control input-large')); ?>
        <?php echo $form->error($model,'image_attr_alt'); ?>
    </div>


	<div class="buttons">
		<?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->