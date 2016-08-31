
<h4 class="font-h4"><?=$form_caption?></h4>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => $form_widget_id,
    'action' => $form_model->setFormActionUrl(get_class($form_model), $email_subject),
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validationUrl' => $form_model->setFormValidationUrl($form_widget_id, get_class($form_model)),
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => false,
        'afterValidate' => $form_model->setFormAfterValidateScript($form_widget_id),
    ),
    'htmlOptions' => array(
        'class' => $form_class,
        'role' => 'form',
    ),
)); ?>

    <?php echo CHtml::hiddenField('email_subject' , $email_subject, array('id' => 'AjaxFormEmailSubjectHiddenInput' . $form_widget_id)); ?>
    <?php echo CHtml::hiddenField('form_item' , $form_item, array('id' => 'AjaxFormItemHiddenInput' . $form_widget_id)); ?>
    <?php echo CHtml::hiddenField('fields' , $fields, array('id' => 'AjaxFormFieldsHiddenInput' . $form_widget_id)); ?>

    <?php echo CHtml::hiddenField('antispam' , 1); ?>

    <div class="form-group">
        <?=$form->labelEx(
            $form_model,
            'name',
            array(
                'class' => 'col-xs-3 control-label',
            )
        );?>
        <div class="col-xs-9">
            <?=$form->textField(
                $form_model,
                'name',
                array(
                    'class' => 'form-control',
                    'placeholder' => (isset($html_options['name']['placeholder'])) ? $html_options['name']['placeholder'] : '',
                    'type' => 'text',
                )
            );?>
            <?=$form->error($form_model, 'name');?>
        </div>
    </div>

    <div class="form-group">
        <?=$form->labelEx(
            $form_model,
            'phone',
            array(
                'class' => 'col-xs-3 control-label',
            )
        );?>
        <div class="col-xs-9">
            <?=$form->textField(
                $form_model,
                'phone',
                array(
                    'class' => 'form-control',
                    'placeholder' => (isset($html_options['phone']['placeholder'])) ? $html_options['phone']['placeholder'] : '',
                    'type' => 'phone',
                )
            );?>
            <?=$form->error($form_model, 'phone');?>
        </div>
    </div>

    <div class="form-group">
        <?=$form->labelEx(
            $form_model,
            'email',
            array(
                'class' => 'col-xs-3 control-label',
            )
        );?>
        <div class="col-xs-9">
            <?=$form->textField(
                $form_model,
                'email',
                array(
                    'class' => 'form-control',
                    'placeholder' => (isset($html_options['email']['placeholder'])) ? $html_options['email']['placeholder'] : '',
                    'type' => 'email',
                )
            );?>
            <?=$form->error($form_model, 'email');?>
        </div>
    </div>

    <?=$form->hiddenField(
        $form_model,
        'item',
        array(
            'class' => 'hidden-input-field',
            'value' => $form_item,
        )
    );?>

    <div class="form-group">
        <div class="col-xs-3 control-label"></div>
        <div class="col-xs-9">
            <?=CHtml::submitButton(
                    $form_button_text,
                    array(
                        'id' => 'submit' . $form_widget_id,
                        'class' => $form_button_class,
                        // 'style' => 'width: 100%',
                        'data-item' => '',
                    )
                );?>
        </div>
    </div>

<?php $this->endWidget(); ?>

<?php $this->render('_modalStatusWindows', array('form_widget_id' => $form_widget_id)); ?>