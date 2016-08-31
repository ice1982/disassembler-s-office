<?php

class TurnOffAction extends BaseAction
{
    public $success_message = 'Элемент успешно выключен!';
    public $error_message = 'Не удалось выключить элемент!';

    public function run($id)
    {
        $model = $this->_loadModel($id);

        if ($model->updateByPk($id, array('active' => 0))) {
            $this->getController()->setSuccess($this->success_message);
        } else {
            $this->getController()->setError($this->error_message);
        }
        if (!isset($_GET['ajax'])) {
            $this->getController()->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : $this->redirect_to);
        }
    }
} 