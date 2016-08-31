<div class="white-block top-shadow catalog-section">
    <div class="container">
        <div class="catalog-block">
            <div class="font-h3 font-h-color margin-h2 block-center group-name">Результаты поиска</div>

            <?php
            $this->widget('zii.widgets.grid.CGridView',
                array(
                    'id' => 'items-grid',
                    'dataProvider' => $model->frontendSearch($this->catalog_groups),
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
                            'value' => '$data->getTableUrl("Узнать стоимость", "#modalItemRequest", "modal-item-request fancybox-modal")',
                        ),
                    ),
                    'htmlOptions' => array(

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



