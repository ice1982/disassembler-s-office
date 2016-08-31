<?php

class DefaultController extends FrontEndController
{
    public function init()
    {
        parent::init();

        $this->page = $this->module->setPage();

        if (isset($this->page->id)) {
            $this->setPageMeta($this->page);
            $this->setPageTemplate($this->page);
        }
    }

    
    public function actionIndex()
    {
        $news = News::model()->active()->search();

        $this->breadcrumbs[] = array(
            'route' => false,
            'title' => 'Новости завода Бристоль'
        );

        $this->render('index', array(
            'news' => $news
        ));
    }
    
    public function actionView($id)
    {
        $model = News::model()->findByPk($id);

        $this->render('view',
            array(
                'model' => $model,
            )
        );
    }

}