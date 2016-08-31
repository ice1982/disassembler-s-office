<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'shippings-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
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
        <?php echo $form->labelEx($model,'body'); ?>
        <?php echo $form->textArea($model, 'body',
            array(
                'class' => 'form-control input-large tinymce',
            )
        ); ?>
        <?php echo $form->error($model, 'body'); ?>
    </div>

    <?php if (!empty($model->image)) : ?>
        <div class="form-group">
            <img width=100 src="/uploads/<?=$model->image?>" alt="">
        </div>
    <?php endif; ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php echo $form->fileField($model, 'image', array('class' => 'form-control input-large')); ?>
        <?php echo $form->error($model, 'image'); ?>

        <small class="hint">Изображение должно быть 500px в ширину</small>
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