<div class="white-block top-shadow catalog-section">
    <div class="container">
        <div class="catalog-block catalog-groups-block">
            <div class="font-h2 font-h-color margin-h2 block-center group-name">
                <?=CHtml::encode($group_model->title)?>
            </div>

            <?php echo $this->catalog_description; ?>

            <hr>

            <div class="row">
                <div class="col-xs-4">
                    <br><br>
                    <img src="<?=$group_model->getImageUrl()?>" alt="" class="" style="min-width: 200px">
                    <br>
                    <br>
                    <br>

                    <?php $this->widget(
                        'FormWidget',
                        array(
                            'template_name' => 'modal_default_form',
                            'form_class' => 'form-horizontal',
                            'form_caption' => 'Запросить опросный лист',
                            'button_class' => 'modal-item-request fancybox-modal btn btn-primary width100',
                            'button_text' => 'Запросить опросный лист',
                            'form_button_text' => 'Запросить опросный лист',
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
                                )
                            ),
                            'email_subject' => 'Поступила заявка на опросный лист из раздела ' . CHtml::encode($group_model->title),
                        )
                    );?>

                    <br><br>

                    <?php $this->widget(
                        'FormWidget',
                        array(
                            'template_name' => 'modal_default_form',
                            'form_class' => 'form-horizontal',
                            'form_caption' => 'Сделать заказ',
                            'button_class' => 'modal-item-request fancybox-modal btn btn-danger width100',
                            'button_text' => 'СДЕЛАТЬ ЗАКАЗ',
                            'form_button_text' => 'Сделать заказ',
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
                                )
                            ),
                            'email_subject' => 'Поступила заявка на заказ продукции из раздела ' . CHtml::encode($group_model->title),
                        )
                    );?>
                    <br><br>
                    <?php $this->widget(
                        'FormWidget',
                        array(
                            'template_name' => 'modal_default_form',
                            'form_class' => 'form-horizontal',
                            'form_caption' => 'Запросить опытный образец',
                            'button_class' => 'modal-item-request fancybox-modal btn btn-primary width100',
                            'button_text' => 'Запросить опытный образец',
                            'form_button_text' => 'Запросить опытный образец',
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
                                )
                            ),
                            'email_subject' => 'Поступила заявка на опытный образец ' . CHtml::encode($group_model->title),
                        )
                    );?>

                </div>
                <div class="col-xs-8">

                    <?=$this->decodeWidgets($group_model->body)?>
                </div>

            </div>
        </div>

        <hr>

        <div class="row">

            <div class="col-xs-6  group-notes">
                <br><br>
                <p>Мы рады предложить вам продукцию Чебоксарского арматурного завода &laquo;Бристоль&raquo; из раздела &laquo;<?=CHtml::link(CHtml::encode($group_model->title), Yii::app()->createUrl('catalog/default/index', array('group' => $group_model->id)))?>&raquo;.</p>
                <p>Оставьте свои контактные данные в этой форме, чтобы наши менеджеры смогли с вами связаться и проконсультировать вас по поводу продукции завода.</p>
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

        <hr>

        <?php
            $output = $this->widget('LoadBlockWidget', array('alias' => 'serts_for_catalog_' . $group_model->id), true);
            if (!empty($output)) {
                echo $output;
            } else {
                $this->widget('LoadBlockWidget', array('alias' => 'serts_for_catalog'));
            }
        ?>

        <hr>

        <?php $this->widget('LoadBlockWidget', array('alias' => 'reviews_for_catalog')); ?>

        <hr>

        <?php $this->widget('LoadBlockWidget', array('alias' => 'partners_for_catalog')); ?>

        <br><br><br>

    </div>


</div>






