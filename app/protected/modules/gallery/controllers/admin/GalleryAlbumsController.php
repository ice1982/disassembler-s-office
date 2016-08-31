<?php

class GalleryAlbumsController extends BackEndController
{
    private $_model_name = 'GalleryAlbum';
    private $_e_404_message = 'Запрашиваемый альбом не найден.';

    public function actions()
    {
        return array(
            'delete' => array(
                'class' => 'DeleteAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Альбом удален!',
                'error_message' => 'Альбом не удален!',
                'e_404_message' => $this->_e_404_message,
            ),
            'create' => array(
                'class' => 'CreateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Альбом успешно создан!',
                'error_message' => 'Не удалось создать альбом!',
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Альбом успешно изменен!',
                'error_message' => 'Не удалось изменить альбом!',
                'e_404_message' => $this->_e_404_message,
            ),
            'index' => array(
                'class' => 'IndexAction',
                'model_name' => $this->_model_name,
            ),
            'turnOn' => array(
                'class' => 'TurnOnAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Альбом успешно включен!',
                'error_message' => 'Не удалось включить альбом!',
                'e_404_message' => $this->_e_404_message,
            ),
            'turnOff' => array(
                'class' => 'TurnOffAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Альбом успешно выключен!',
                'error_message' => 'Не удалось выключить альбом!',
                'e_404_message' => $this->_e_404_message,
            ),
        );
    }
}
