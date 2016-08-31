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
        $shippings = Shipping::model()->active()->search();

        $this->breadcrumbs[] = array(
            'route' => false,
            'title' => 'Отгрузки завода Бристоль',
        );

        $this->render('index', array(
            'shippings' => $shippings,
        ));
    }

}