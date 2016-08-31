<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'gallery-photo-form',
	'enableAjaxValidation' => false,
	'htmlOptions'=> array(
		'enctype' => 'multipart/form-data',
	),
	'clientOptions'=> array(
    	'validateOnSubmit' => true,
    ),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span>, обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'album_id'); ?>
		<?php
			echo $form->dropDownList($model, 'album_id',
				CHtml::listData(GalleryAlbum::model()->findAll(array('order' => 'title')), 'id','title'),
				array('empty' => 'Выберите альбом', 'class' => 'form-control input-large')
			);
		?>
		<?php echo $form->error($model,'album_id'); ?>
	</div>

	<?php if (!empty($model->image)) : ?>
	<div class="form-group">
		<img width=100 src="uploads/<?=$model->image?>" alt="">
	</div>
	<?php endif; ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image', array('class' => 'form-control input-xlarge')); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title', array('class' => 'form-control input-xlarge')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description', array('class' => 'form-control input-xlarge')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'image_attr_title'); ?>
		<?php echo $form->textField($model,'image_attr_title', array('class' => 'form-control input-xlarge')); ?>
		<?php echo $form->error($model,'image_attr_title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'image_attr_alt'); ?>
		<?php echo $form->textField($model,'image_attr_alt', array('class' => 'form-control input-xlarge')); ?>
		<?php echo $form->error($model,'image_attr_alt'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'tags'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->