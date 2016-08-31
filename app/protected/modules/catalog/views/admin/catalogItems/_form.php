<div class="form">


<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'catalog-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array(
//		'enctype' => 'multipart/form-data',
	),
	'clientOptions' => array(
    	'validateOnSubmit' => true,
    ),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span>, обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php
			echo $form->dropDownList($model,'group_id',
				CHtml::listData(CatalogGroup::model()->findAll(array('order' => 'title')),'id','title'),
				array('empty' => 'Выберите тип товара', 'class' => 'form-control input-large')
			);
		?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title', array('class' => 'form-control input-large')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'code'); ?>
        <?php echo $form->textField($model,'code', array('class' => 'form-control input-large')); ?>
        <?php echo $form->error($model,'code'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'diametr'); ?>
        <?php echo $form->textField($model,'diametr', array('class' => 'form-control input-large')); ?>
        <?php echo $form->error($model,'diametr'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'pressure'); ?>
        <?php echo $form->textField($model,'pressure', array('class' => 'form-control input-large')); ?>
        <?php echo $form->error($model,'pressure'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'material'); ?>
        <?php echo $form->textField($model,'material', array('class' => 'form-control input-large')); ?>
        <?php echo $form->error($model,'material'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'environment'); ?>
        <?php echo $form->textField($model,'environment', array('class' => 'form-control input-large')); ?>
        <?php echo $form->error($model,'environment'); ?>
    </div>


	<div class="buttons">
		<?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->