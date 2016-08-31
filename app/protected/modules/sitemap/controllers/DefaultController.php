<?php

class DefaultController extends FrontEndController
{
    public $models;

    public function init()
    {
        parent::init();

        $this->models = $this->_getModels();

        foreach ( Yii::app()->log->routes as $route ) {
            if ( $route instanceof CWebLogRoute ) {
                $route->enabled = false;
            }
        }
    }

    private function _getModels()
    {
        $models = array();

        $models['page'] = Page::model()->active()->findAll();
        $models['catalog_group'] = CatalogGroup::model()->active()->findAll();

        return $models;
    }

    public function actionXml()
    {
        try {
            $xml = Yii::app()->cache->get('sitemap');

            if (!$xml) {
                $xml = $this->_generateXMLSitemap();
                // Кешируем карту на 24 часа
                Yii::app()->cache->set('sitemap', $xml, 3600 * 24);
            }
        } catch (Exception $e) {
            $xml = $this->_generateXMLSitemap();
        }

        // $xml = $this->_generateXMLSitemap();

        header("Content-type: text/xml");
        echo $xml;
        Yii::app()->end();
    }

    public function actionIndex()
    {
        $items = array();

        $this->breadcrumbs[] = array('title' => 'Карта сайта www.bristol-msk.ru', 'route' => false);

        $this->render('index', array('models' => $this->models));
    }

    private function _generateXMLSitemap()
    {
        $sitemap = new DSitemap();

        $sitemap->addModels($this->models['page'], DSitemap::WEEKLY, 0.2);
        $sitemap->addModels($this->models['catalog_group'], DSitemap::WEEKLY, 0.5);

        $xml = $sitemap->render();

        return $xml;
    }

}