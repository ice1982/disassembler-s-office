<div class="white-block top-shadow catalog-section">
    <div class="container">
        <div class="catalog-block">
            <div class="font-h3 font-h-color margin-h2 block-center group-name">
                <?=CHtml::encode($group_model->title)?>
            </div>

            <hr>

            <div class="font-h3 font-h-color margin-h2 block-center group-name">Список подразделов раздела &laquo;<?=CHtml::encode($group_model->title)?>&raquo;</div>

            <?php $this->renderPartial('_group_rows',
                array(
                    'catalog_groups' => $children_groups,
                    'cols' => 3,
                )
            ); ?>

            <hr>

            <div class="row margin-h2">
                <div class="col-xs-6 group-notes">
                   <p>В списке выше представлена продукция завода &laquo;Бристоль&raquo; из раздела &laquo;<?=CHtml::link(CHtml::encode($group_model->title), Yii::app()->createUrl('catalog/default/index', array('group' => $group_model->id)))?>&raquo;.</p>
                     <p>Вы можете выбрать интересующий вас подраздел выше, либо оставить свои контактные данные в форме справа, чтобы наши менеджеры смогли с вами связаться и проконсультировать вас по поводу продукции завода.</p>
                </div>
                <div class="col-xs-6">
                    <?php $this->widget(
                        'FormWidget',
                        array(
                            'template_name' => 'catalog_form',
                            'form_class' => 'form-horizontal',
                            'form_button_text' => 'Оставить контактные данные',
                            'form_button_class' => 'btn btn-primary',
                            'fields' => json_encode(
                                array(
                                    array(
                                        'type' => 'text',
                                        'name' => 'name',
                                        'label' => 'Ф.И.О.',
                                        'value' => '',
                                        'validation' => array(
                                            'required',
                                            'min:3',
                                            'max:300',
                                        ),
                                        'html' => array(
                                            'placeholder' => 'Введите Ф.И.О.',
                                        ),
                                    ),
                                    array(
                                        'type' => 'text',
                                        'name'=> 'phone',
                                        'label' => 'Телефон',
                                        'value' => '',
                                        'validation' => array(
                                            'required',
                                            'min:3',
                                            'max:20',
                                        ),
                                        'html' => array(
                                            'placeholder' => 'Введите телефон'
                                        ),
                                    ),
                                    array(
                                        'type' => 'text',
                                        'name'=> 'email',
                                        'label' => 'Email',
                                        'value' => '',
                                        'validation' => array(
                                            'required',
                                            'min:3',
                                            'max:20',
                                        ),
                                        'html' => array(
                                            'placeholder' => 'Введите почту'
                                        ),
                                    ),
                                    array(
                                        'type' => 'textarea',
                                        'name' => 'comment',
                                        'label' => 'Комментарий',
                                        'value' => '',
                                        'validation' => array(),
                                        'html' => array(
                                            'placeholder'=> 'Введите комментарий',
                                        ),
                                    ),
                                )
                            ),
                            'email_subject' => 'С сайта поступил запрос на информацию',
                            'form_item' => $group_model->title,
                        )
                    );?>

                </div>
            </div>

        </div>


    </div>

</div>
