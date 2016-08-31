<?php

class BackEndController extends BaseController
{
    public $layout = '//templates/admin';

    /*
        Фильтры
    */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            // 'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('deny',
                'users' => array('?'),
            ),
        );
    }

    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            $this->render('/site/error', $error);
        }
    }
}