<?php

class CatalogItemsController extends BackEndController
{
    private $_model_name = 'CatalogItem';
    private $_e_404_message = 'Запрашиваемый товар не найден.';

    public function actions()
    {
        return array(
            'delete' => array(
                'class' => 'DeleteAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Товар удален!',
                'error_message' => 'Товар не удален!',
                'e_404_message' => $this->_e_404_message,
            ),
            'create' => array(
                'class' => 'CreateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Товар успешно создан!',
                'error_message' => 'Не удалось создать товар!',
            ),
            'update' => array(
                'class' => 'UpdateAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Товар успешно изменен!',
                'error_message' => 'Не удалось изменить товар!',
                'e_404_message' => $this->_e_404_message,
            ),
//            'index' => array(
//                'class' => 'IndexAction',
//                'model_name' => $this->_model_name,
//            ),
            'turnOn' => array(
                'class' => 'TurnOnAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Товар успешно включен!',
                'error_message' => 'Не удалось включить товар!',
                'e_404_message' => $this->_e_404_message,
            ),
            'turnOff' => array(
                'class' => 'TurnOffAction',
                'model_name' => $this->_model_name,
                'success_message' => 'Товар успешно выключен!',
                'error_message' => 'Не удалось выключить товар!',
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
                'success_message' => 'Товары успешно отсортированы!',
                'e_404_message' => $this->_e_404_message,
            ),
        );
    }

    public function actionIndex($group_id = false)
    {
        $group_model = false;
        if ($group_id != false) {
            $group_model = CatalogGroup::model()->findByPk($group_id);
        }

        $groups = CatalogGroup::model()->findAll(array('order' => 'title'));
        $groups_list = CHtml::listData($groups, 'id', 'title');

        $model = new CatalogItem('search');
        $model->unsetAttributes();

        if (isset($_GET['CatalogItem'])) {
            $model->attributes = $_GET['CatalogItem'];
        }

        $data_provider = $model->backendSearch($group_id);

        // view
        $this->render('index',
            array(
                'data_provider' => $data_provider,
                'model' => $model,
                'group_model' => $group_model,
                'groups_list' => $groups_list,
            )
        );
    }


    public function actionAjaxupdate()
    {
        $act = $_GET['act'];
        $autoIdAll = $_POST['autoId'];

        if (count($autoIdAll) > 0) {
            foreach($autoIdAll as $autoId) {

                $model = CatalogItem::model()->findByPk($autoId);

                if ($act == 'doDelete') {
                    $model->delete();
                }
                if ($act == 'doActive') {
                    $model->active = 1;
                }
                if ($act == 'doInactive') {
                    $model->active = 0;
                }
                if ($act == 'doMove') {
                    $group_id = (int)$_POST['group_id'];
                    if (!empty($group_id)) {
                        $model->group_id = $group_id;
                    }
                }

                if ($model->save()) {
                    echo 'ok';
                } else {
                    throw new Exception("Sorry",500);
                }

            }

        }
    }

}
