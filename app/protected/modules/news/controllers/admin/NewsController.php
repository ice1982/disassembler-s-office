<?php

class NewsController extends BackEndController
{
    private $_model_name = 'News';
    private $_e_404_message = 'Запрашиваемая новость не найдена.';

    public function actions()
    {
        return array(
            'delete' => array(
                'class' => 'DeleteAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Новость удалена!',
                'error_message' => 'Новость не удалена!',
                'e_404_message' => $this->_e_404_message,
            ),
            'create' => array(
                'class' => 'CreateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Новость успешно создана!',
                'error_message' => 'Не удалось создать новость!',
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Новость успешно изменена!',
                'error_message' => 'Не удалось изменить новость!',
                'e_404_message' => $this->_e_404_message,
            ),
            'index' => array(
                'class' => 'IndexAction',
                'model_name' => $this->_model_name,
            ),
            'turnOn' => array(
                'class' => 'TurnOnAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Новость успешно включена!',
                'error_message' => 'Не удалось включить новость!',
                'e_404_message' => $this->_e_404_message,
            ),
            'turnOff' => array(
                'class' => 'TurnOffAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Новость успешно выключена!',
                'error_message' => 'Не удалось выключить новость!',
                'e_404_message' => $this->_e_404_message,
            ),
        );
    }
}
