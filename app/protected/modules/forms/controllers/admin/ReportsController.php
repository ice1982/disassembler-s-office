<?php

class ReportsController extends BackEndController
{
    private $_model_name = 'FormRequest';
    private $_e_404_message = 'Запрашиваемая страница не найдена.';

    public function actions()
    {
        return array(
            'index' => array(
                'class' => 'IndexAction',
                'model_name' => $this->_model_name,
            ),
        );
    }
}