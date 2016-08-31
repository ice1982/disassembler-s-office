<div class="white-block top-shadow catalog-section">
    <div class="container">
        <div class="catalog-block">
            <div class="font-h3 font-h-color margin-h2 block-center group-name">Трубопроводная арматура</div>

            <hr>

            <?php $this->renderPartial('_group_rows',
                array(
                    'catalog_groups' => $catalog_groups,
                    'cols' => 3,
                )
            ); ?>

            <hr>

            <div class="row margin-h2">
                <div class="col-xs-6 group-notes">
                    <p>В списке выше представлена продукция завода &laquo;Бристоль&raquo; по всему ассортименту трубопроводной арматуры.</p>
                    <p>Вы можете выбрать интересующий вас раздел выше, либо оставить свои контактные данные в форме справа, чтобы наши менеджеры смогли с вами связаться и проконсультировать вас по поводу продукции завода.</p>
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
                            'form_item' => 'Трубопроводная арматура',
                        )
                    );?>
                </div>
            </div>



        </div>
    </div>


</div>

