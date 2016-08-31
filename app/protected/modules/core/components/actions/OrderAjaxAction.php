<?php

class OrderAjaxAction extends BaseAction
{
    public function run()
    {
        $object = CActiveRecord::model($this->model_name);

        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            if ($object->saveOrder($_POST['sortable'])) {
                $this->getController()->setSuccess($this->success_message);
                $this->getController()->redirect($this->redirect_to);
            }
        }

        $items = $object->findAll(array('order' => 'nn'));

        // Load view
        $this->getController()->renderPartial('order_ajax', array('items' => $items));
    }
} 