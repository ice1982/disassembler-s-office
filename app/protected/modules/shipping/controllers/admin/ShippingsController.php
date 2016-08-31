<?php

class ShippingsController extends BackEndController
{
    private $_model_name = 'Shipping';
    private $_e_404_message = 'Запрашиваемая отгрузка не найдена.';

    public function actions()
    {
        return array(
            'delete' => array(
                'class' => 'DeleteAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Отгрузка удалена!',
                'error_message' => 'Отгрузка не удалена!',
                'e_404_message' => $this->_e_404_message,
            ),
            'create' => array(
                'class' => 'CreateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Отгрузка успешно создана!',
                'error_message' => 'Не удалось создать отгрузку!',
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Отгрузка успешно изменена!',
                'error_message' => 'Не удалось изменить отгрузку!',
                'e_404_message' => $this->_e_404_message,
            ),
            'index' => array(
                'class' => 'IndexAction',
                'model_name' => $this->_model_name,
            ),
            'turnOn' => array(
                'class' => 'TurnOnAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Отгрузка успешно включена!',
                'error_message' => 'Не удалось включить отгрузку!',
                'e_404_message' => $this->_e_404_message,
            ),
            'turnOff' => array(
                'class' => 'TurnOffAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Отгрузка успешно выключена!',
                'error_message' => 'Не удалось выключить отгрузку!',
                'e_404_message' => $this->_e_404_message,
            ),
        );
    }
}
