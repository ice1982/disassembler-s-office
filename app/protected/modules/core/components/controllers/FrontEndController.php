<?php

class FrontEndController extends BaseController
{
    public $page;
    public $blocks = array();

    public $meta_title;
    public $pageIndex = 1;
    public $pageDescription;
    public $pageKeywords;
    public $pageTemplate;

    public $buffer = array();


    public $catalog_groups = array();


    public function init()
    {
        parent::init();

        $this->getAllBlocks();
        $this->getCatalogGroups();
    }

    /**
     * [behaviors description]
     * @return [type] [description]
     */
    public function behaviors()
    {
        return array(
            'InlineCommonWidgetsBehavior' => array(
                'class' => 'MInlineWidgetsBehavior',
                'location' => $this->_generateWidgetsLocations(),
                'widgets' => $this->_generateWidgetsList(),
            ),
        );
    }

    /**
     * [_generateWidgetsLocations description]
     * @return [type] [description]
     */
    private function _generateWidgetsLocations()
    {
        $modules = Yii::app()->getModulesNames();

        foreach ($modules as $module) {
            $locations[] = 'application.modules.' . $module . '.components.widgets';
        }

        return $locations;
    }

    /**
     * [_generateWidgetsList description]
     * @return [type] [description]
     */
    private function _generateWidgetsList()
    {
        $locations = $this->_generateWidgetsLocations();

        $list = array();

        foreach ($locations as $directory) {
            $path = Yii::getPathOfAlias($directory);

            if (is_dir($path)) {
                $files = CFileHelper::findFiles($path, array('fileTypes' => array('php'), 'level' => 0));

                if (count($files)) {
                    foreach ($files as $file) {
                        $list[] = basename($file, '.php');
                    }
                }
            }
        }

        return $list;
    }

    protected function getAllBlocks()
    {
        $blocks = Block::model()->findAll();
        if (count($blocks)) foreach ($blocks as $block) {
            $this->blocks[$block->alias] = $block->body;
        }
    }

    protected function getCatalogGroups()
    {
        $model = CatalogGroup::model();
        $this->catalog_groups = $model->getGroupsArray();
    }

    protected function setPageMeta()
    {
        $this->setPageTitle($this->page->meta_title);
        $this->pageDescription = $this->page->meta_description;
        $this->pageKeywords = $this->page->meta_keywords;
        $this->pageIndex = $this->page->meta_index;
    }

    protected function setPageTemplate()
    {
        if (!empty($this->page->template)) {
            $this->layout = '//templates/' . $this->page->template;
        }
    }

}