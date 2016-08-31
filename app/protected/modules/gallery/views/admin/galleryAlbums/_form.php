<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'gallery-album-form',
	'enableAjaxValidation' => false,
	'clientOptions' => array(
    	'validateOnSubmit' => true,
    ),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span>, обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('class' => 'form-control input-large')); ?>
		<?php echo $form->error($model, 'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model, 'description',
			array(
				'class' => 'form-control input-large',
			)
		); ?>
		<p class="help-block">Короткий текст.</p>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->