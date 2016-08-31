<?php

class GalleryPhotosController extends BackEndController
{
    private $_model_name = 'GalleryPhoto';
    private $_e_404_message = 'Запрашиваемая фотография не найдена.';

    public function actions()
    {
        return array(
            'delete' => array(
                'class' => 'DeleteAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Фотография удалена!',
                'error_message' => 'Фотография не удалена!',
                'e_404_message' => $this->_e_404_message,
            ),
            'create' => array(
                'class' => 'CreateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Фотография успешно создана!',
                'error_message' => 'Не удалось создать фотографию!',
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Фотография успешно изменена!',
                'error_message' => 'Не удалось изменить фотографию!',
                'e_404_message' => $this->_e_404_message,
            ),
            'index' => array(
                'class' => 'IndexAction',
                'model_name' => $this->_model_name,
            ),
            'turnOn' => array(
                'class' => 'TurnOnAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Фотография успешно включена!',
                'error_message' => 'Не удалось включить фотографию!',
                'e_404_message' => $this->_e_404_message,
            ),
            'turnOff' => array(
                'class' => 'TurnOffAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Фотография успешно выключена!',
                'error_message' => 'Не удалось выключить фотографию!',
                'e_404_message' => $this->_e_404_message,
            ),
            'order' => array(
                'class' => 'OrderAction',
                'model_name' => $this->_model_name,
                'e_404_message' => $this->_e_404_message,
            ),
            'orderAjax' => array(
                'class' => 'OrderAjaxAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Фотографии успешно отсортированы!',
                'e_404_message' => $this->_e_404_message,
            ),
        );
    }
}
