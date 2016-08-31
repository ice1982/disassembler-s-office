<div class="white-block top-shadow catalog-section">
    <div class="container">
        <div class="catalog-block">
            <div class="font-h3 font-h-color margin-h3 block-center group-name"><?=CHtml::encode($group_model->title)?></div>
            <div class="font-h2 font-h-color margin-h2 block-center group-name">Таблица фигур: <?=$filter?></div>

            <hr>

            <div class="row">
                <div class="col-xs-6 group-notes">
                    <p>В списке ниже представлена продукция завода &laquo;Бристоль&raquo; из раздела &laquo;<?=CHtml::link(CHtml::encode($group_model->title), Yii::app()->createUrl('catalog/default/index', array('group' => $group_model->id)))?>&raquo;, соответствующая таблице фигур <strong>&laquo;<?=$filter?>&raquo;.</strong></p>
                    <p>Если у вас возникли вопросы по поводу конкретной продукции или если вы не нашли нужную вам единицу в списке, то, пожалуйста, оставьте свои контактные данные в форме справа, чтобы наши менеджеры смогли с вами связаться и проконсультировать вас.</p>
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
                            'form_item' => $group_model->title . '. Таблица фигур: ' . $filter,
                        )
                    );?>
                </div>
            </div>

            <hr>

            <div class="font-h3 font-h-color block-center group-name">Список наименований по таблице фигур <?=$filter?></div>

            <?php
            $this->widget('zii.widgets.grid.CGridView',
                array(
                    'id' => 'items-grid',
                    'dataProvider' => $model->frontendFilterSearch($group_model->id, $this->catalog_groups),
                    'filter' => $model,
                    'selectableRows' => 0,
                    'itemsCssClass' => 'catalog-table table table-striped',
                    'pagerCssClass' => 'pagination',
                    'columns' => array(
                        'title',
                        'code',
                        'diametr',
                        'pressure',
                        'material',
                        'environment',
                        array(
                            'header' => '',
                            'type' => 'raw',
                            'value' => '$data->getTableUrl("<span class=\'glyphicon glyphicon-question-sign\'></span> Узнать стоимость", "#modalItemRequest", "modal-item-request fancybox-modal")',
                        ),
                    ),
                    'htmlOptions' => array(
                        'data-group' => $group_model->title,
                    ),
                )
            );
            ?>

            <?php $this->widget(
                'FormWidget',
                array(
                    'template_name' => 'catalog_item_form',
                    'form_caption' => 'Узнать наличие, цену, технические характеристики',
                    'form_class' => 'form-horizontal',
                    'form_button_text' => 'Узнать о продукции',
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
                                'type' => 'text',
                                'name'=> 'quantity',
                                'label' => 'Количество',
                                'value' => '',
                                'validation' => array(

                                ),
                                'html' => array(
                                    'placeholder' => 'Введите количество'
                                ),
                            ),
                            array(
                                'type' => 'text',
                                'name'=> 'item',
                                'label' => 'Товар',
                                'value' => '',
                                'validation' => array(

                                ),
                                'html' => array(

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
                    'email_subject' => 'С сайта поступил запрос на стоимость',
                    // 'form_item' => $group_model->title,
                )
            );?>


        </div>
    </div>
</div>



