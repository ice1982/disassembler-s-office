<?php

class DefaultController extends FrontEndController
{
    public $layout = '//templates/catalog';

    public $catalog_group;
    public $catalog_description;

    public $catalog_common_item;

    public function init()
    {
        parent::init();

        $this->page = $this->module->setPage();

        if (isset($this->page->id)) {
            $this->setPageMeta($this->page);
            $this->setPageTemplate($this->page);
        }

        // var_dump($_GET);

    }

    public function actionGroup($id)
    {
        $group_id = $id;

        // получаем класс модели
        $group_model_class = CatalogGroup::model();
        // получаем конкретную модель по алиасу
        $group_model = $group_model_class->findByPk($group_id);

        $this->catalog_group = $group_model;

        // Получаем описание группы для отображения сверху
        $this->catalog_description = $group_model->description;

        $parents = $group_model_class->findAllParentGroups($group_model->id, $this->catalog_groups);

        // Генерируем заголовок страницы
        $this->pageTitle = $group_model->setPageTitle();
        // Генерируем хлебные крошки
        $this->breadcrumbs = $group_model_class->setBreadcrumbs($parents, $group_id);

        if (isset($_SERVER['QUERY_STRING'])) {
            $utm = '?' . $_SERVER['QUERY_STRING'];
        } else {
            $utm = '';
        }
        $history_item = array(
            'link' => $group_model->getUrl() . $utm,
            'image' => $group_model->getImageUrl(),
            'title' => trim( $this->decodeWidgets($group_model->title) ),
            'hash' => md5($group_model->getUrl() . $utm . $group_model->title),
            'time' => time(),
        );
        $this->_addInHistory($history_item);

        // view
        $this->render('index_groups_2',
            array(
                'group_model' => $group_model,
            )
        );
    }


    private function _loadCatalogWithFilter($group, $filter)
    {
        // получаем модель группы
        // получаем класс модели
        $group_model_class = CatalogGroup::model();
        // получаем конкретную модель по алиасу
        $group_model = $group_model_class->findByPk($group);

        $model = new CatalogItem('search');
        $model->unsetAttributes();

        if (isset($_GET['CatalogItem'])) {
            $model->attributes = $_GET['CatalogItem'];
        } else {
            $model->code = $filter;
        }

        // view
        $this->render('index_filter_items',
            array(
                'model' => $model,
                'group_model' => $group_model,
                'filter' => $filter,
            )
        );

        // получаем провайдера для товаров группы и групп-потомков
        // генерим вид
    }

    private function _loadCatalogWithoutFilter($group)
    {
        if ($group == '') {
            // показываем общий каталог

            $group_model_class = CatalogGroup::model();

            $catalog_groups = $group_model_class->findAllMainGroups($this->catalog_groups);

            $this->catalog_description = $this->page->begin_body;

            $this->breadcrumbs[] = array('route' => false, 'title' => $this->page->title);

            // view
            $this->render('index_main',
                array(
                    'catalog_groups' => $catalog_groups,
                )
            );

        } else {

            $group_id = $group;

            // получаем класс модели
            $group_model_class = CatalogGroup::model();
            // получаем конкретную модель по алиасу
            $group_model = $group_model_class->findByPk($group_id);

            // Получаем описание группы для отображения сверху
            $this->catalog_description = $group_model->description;

            $parents = $group_model_class->findAllParentGroups($group_model->id, $this->catalog_groups);

            // Генерируем заголовок страницы
            $this->pageTitle = $group_model->setPageTitle();
            // Генерируем хлебные крошки
            $this->breadcrumbs = $group_model_class->setBreadcrumbs($parents, $group_id);

            if ($group_model_class->isGroupHaveChildren($group_id, $this->catalog_groups)) {
                // показываем список групп

                $children_groups = $group_model_class->findAllChildrenGroups($group_id, $this->catalog_groups);

                if (isset($_SERVER['QUERY_STRING'])) {
                    $utm = '?' . $_SERVER['QUERY_STRING'];
                } else {
                    $utm = '';
                }
                $history_item = array(
                    'link' => $group_model->getUrl() . $utm,
                    'image' => $group_model->getImageUrl(),
                    'title' => trim( $this->decodeWidgets($group_model->title) ),
                    'hash' => md5($group_model->getUrl() . $utm . $group_model->title),
                    'time' => time(),
                );
                $this->_addInHistory($history_item);

                // view
                $this->render('index_groups',
                    array(
                        'group_model' => $group_model,
                        'children_groups' => $children_groups,
                    )
                );

            } else {
                // показываем таблицу товара

                $model = new CatalogItem('search');
                $model->unsetAttributes();

                if (isset($_GET['CatalogItem'])) {
                    $model->attributes = $_GET['CatalogItem'];
                }

                if (isset($_SERVER['QUERY_STRING'])) {
                    $utm = '?' . $_SERVER['QUERY_STRING'];
                } else {
                    $utm = '';
                }
                $history_item = array(
                    'link' => $group_model->getUrl() . $utm,
                    'image' => $group_model->getImageUrl(),
                    'title' => trim( $this->decodeWidgets($group_model->title) ),
                    'hash' => md5($group_model->getUrl() . $utm . $group_model->title),
                    'time' => time(),
                );
                $this->_addInHistory($history_item);

                // view
                $this->render('index_items',
                    array(
                        'model' => $model,
                        'group_model' => $group_model,
                    )
                );
            }
        }
    }

    /**
     *
     */
    public function actionIndex($group = '', $filter = false)
    {
        $this->_loadCatalogWithoutFilter('');

        // if ($filter == false) {
        //     $this->_loadCatalogWithoutFilter($group);
        // } else {
        //     $this->_loadCatalogWithFilter($group, $filter);
        // }
    }

    /**
     * [actionView description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionView($id)
    {
        $this->catalog_common_item = CatalogCommonItem::model()->findByPk($id);

        $group_model_class = CatalogGroup::model();
        // получаем конкретную модель по алиасу
        $this->catalog_group = $group_model_class->findByPk($this->catalog_common_item->group_id);

        // var_dump($this->catalog_group);

        if (isset($_SERVER['QUERY_STRING'])) {
            $utm = '?' . $_SERVER['QUERY_STRING'];
        } else {
            $utm = '';
        }
        $history_item = array(
            'link' => $this->catalog_common_item->getUrl() . $utm,
            'image' => $this->catalog_common_item->getImageUrl(),
            'title' => trim( $this->decodeWidgets($this->catalog_common_item->title) ),
            'hash' => md5($this->catalog_common_item->getUrl() . $utm . trim($this->decodeWidgets($this->catalog_common_item->title))),
            'time' => time(),
        );
        $this->_addInHistory($history_item);

        // $value = Yii::app()->request->cookies['catalog_history']->value;
        // var_dump(json_decode($value, true));

        $this->render('view',
            array(
                'model' => $this->catalog_common_item,
            )
        );
    }

    private function _actionSearch($group = false)
    {
        if (isset($_GET['CatalogItem'])) {
            $model = new CatalogItem('search');
            $model->unsetAttributes();

            $model->attributes = $_GET['CatalogItem'];

            $this->render('search_results',
                array(
                    'model' => $model,
                )
            );
        } else {
            $group_model = false;

            if (!empty($group)) {
                $group_model_class = CatalogGroup::model();
                // получаем конкретную модель по алиасу
                $group_model = $group_model_class->findByPk($group);
            }

            $this->render('search_form', array('group_model' => $group_model));
        }
    }

    public function _getParents($id, $parent_id, $dump)
    {
        if (empty($parent_id)) {
            $result[] = array('id' => $id, 'parent_id' => $parent_id);
        } else {

            if (count($dump) > 0) foreach ($dump as $key => $value) {
                if ($key == $parent_id) {
                    $result[] = array('id' => $id, 'parent_id' => $parent_id);
                    unset($dump[$key]);
                    $result[] = $this->_getParents($parent_id, $value->parent_id, $dump);
                }
            } else {
                $result[] = array('id' => $id, 'parent_id' => $parent_id);
            }
        }

        return $result;
    }


    private function _addInHistory($item)
    {
        // Yii::app()->request->cookies->clear();

        $catalog_history = null;

        if (isset(Yii::app()->request->cookies['catalog_history']->value)) {
            $catalog_history = Yii::app()->request->cookies['catalog_history']->value;
        }

        $history_items = array();
        if (!isset($catalog_history)) {
            $history_items = array( $item['hash'] => $item);
            Yii::app()->request->cookies['catalog_history'] = new CHttpCookie('catalog_history', json_encode($history_items));
        } else {
            $history_items = json_decode($catalog_history, true);
            $history_items[ $item['hash'] ] = $item;

            Yii::app()->request->cookies['catalog_history'] = new CHttpCookie('catalog_history', json_encode($history_items));
        }
    }

}