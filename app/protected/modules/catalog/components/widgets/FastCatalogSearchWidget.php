<?php

class FastCatalogSearchWidget extends CWidget
{
    public $group_model = false;

    public function run()
    {
        $item_model = new CatalogItem;

        if (isset($_GET['CatalogItem'])) {
            $item_model->attributes = $_GET['CatalogItem'];
        } else {
            if (isset($this->group_model->id)) {
                $item_model->group_id = $this->group_model->id;
            }
        }

        // $groups = CatalogGroup::model()->buildGroupTree();
        // $model->buildGroupTree($this->catalog_groups);

        $groups = CatalogGroup::model()->buildGroupTree(Yii::app()->getController()->catalog_groups);

        $this->render('fastCatalogSearchWidget',
            array(
                'model' => $item_model,
                'groups' => $groups,

                'group_model' => $this->group_model,
            )
        );
    }
}