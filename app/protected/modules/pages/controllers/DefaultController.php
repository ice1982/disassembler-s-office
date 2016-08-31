<?php

class DefaultController extends BasePageController
{
    public function actionView($alias = '')
    {
        $this->page = Page::model()->active()->findByAlias($alias);

        if (!isset($this->page->id)) {
            throw new CHttpException(404, 'Запрашиваемая страница не найдена.');
        }

        $this->setPageMeta();
        $this->setPageTemplate();

        $this->render('view', array('model' => $this->page));
    }
}