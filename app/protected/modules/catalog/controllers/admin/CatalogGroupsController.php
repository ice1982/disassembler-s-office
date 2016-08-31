<?php

class CatalogGroupsController extends BackEndController
{
    private $_model_name = 'CatalogGroup';
    private $_e_404_message = 'Запрашиваемая группа товаров не найдена.';

    public function actions()
    {
        return array(
            'delete' => array(
                'class' => 'DeleteAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Группа товаров удалена!',
                'error_message' => 'Группа товаров не удалена!',
                'e_404_message' => $this->_e_404_message,
            ),
            'create' => array(
                'class' => 'CreateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Группа товаров успешно создана!',
                'error_message' => 'Не удалось создать группу товаров!',
                // 'cache' => function() {
                //     // сменить состояние catalog_groups
                //     Yii::app()->cache->delete('catalog_groups');
                // },
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Группа товаров успешно изменена!',
                'error_message' => 'Не удалось изменить группу товаров!',
                'e_404_message' => $this->_e_404_message,
            ),
            'index' => array(
                'class' => 'IndexAction',
                'model_name' => $this->_model_name,
            ),
            'turnOn' => array(
                'class' => 'TurnOnAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Группа товаров успешно включена!',
                'error_message' => 'Не удалось включить группу товаров!',
                'e_404_message' => $this->_e_404_message,
            ),
            'turnOff' => array(
                'class' => 'TurnOffAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Группа товаров успешно выключена!',
                'error_message' => 'Не удалось выключить группу товаров!',
                'e_404_message' => $this->_e_404_message,
            ),
        );
    }
}
