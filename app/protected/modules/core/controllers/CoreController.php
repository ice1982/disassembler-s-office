<?php

class CoreController extends FrontEndController
{
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            $this->render('/site/error', $error);
        }
    }

    public function actionUnderConstruction()
    {
        $this->layout = '/layouts/under_construction';

        $this->render('under_construction');
    }

    public function actionIndex()
    {
        $this->render('index');
    }
}