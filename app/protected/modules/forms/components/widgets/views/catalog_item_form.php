<div style="display:none">
    <div id="modalItemRequest" class="modal-window">
        <h4><?=$form_caption?></h4>


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

            <div class="form-group">
                <?=$form->labelEx(
                    $form_model,
                    'item',
                    array(
                        'class' => 'col-xs-3 control-label',
                    )
                );?>
                <div class="col-xs-9">
                    <?=$form->hiddenField(
                        $form_model,
                        'item',
                        array(
                            'class' => 'hidden-input-field',
                        )
                    );?>
                    <p id="itemName"></p>
                    <?=$form->error($form_model, 'item');?>
                </div>
            </div>

            <div class="form-group">
                <?=$form->labelEx(
                    $form_model,
                    'quantity',
                    array(
                        'class' => 'col-xs-3 control-label',
                    )
                );?>
                <div class="col-xs-9">
                    <?=$form->textField(
                        $form_model,
                        'quantity',
                        array(
                            'class' => 'form-control',
                            'placeholder' => (isset($html_options['quantity']['placeholder'])) ? $html_options['quantity']['placeholder'] : '',
                            'type' => 'text',
                        )
                    );?>
                    <?=$form->error($form_model, 'quantity');?>
                </div>
            </div>

            <div class="form-group">
                <?=$form->labelEx(
                    $form_model,
                    'comment',
                    array(
                        'class' => 'col-xs-3 control-label',
                    )
                );?>
                <div class="col-xs-9">
                    <?=$form->textArea(
                        $form_model,
                        'comment',
                        array(
                            'class' => 'form-control',
                            'placeholder' => (isset($html_options['comment']['placeholder'])) ? $html_options['comment']['placeholder'] : '',
                        )
                    );?>
                    <?=$form->error($form_model, 'comment');?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-3 control-label"></div>
                <div class="col-xs-9">
                    <?=CHtml::submitButton(
                            $form_button_text,
                            array(
                                'id' => 'submit' . $form_widget_id,
                                'class' => $form_button_class,
                                'data-item' => '',
                            )
                        );?>
                </div>
            </div>

        <?php $this->endWidget(); ?>

    </div>
</div>

<?php

$script = "
    $( 'body' ).on( 'click', '.modal-item-request', function( e ) {
        e.preventDefault();

        var item = $( this ).data( 'item' );

        $( '#itemName' ).text( $( this ).data( 'item-text' ));
        $( '#" . $form_widget_id . " .hidden-input-field' ).val( JSON.stringify( $( this ).data( 'item' ) ) );
    } );
";
Yii::app()->clientScript->registerScript('modalItemRequestFormScript', $script, CClientScript::POS_END);

?>

<?php $this->render('_modalStatusWindows', array('form_widget_id' => $form_widget_id)); ?>
