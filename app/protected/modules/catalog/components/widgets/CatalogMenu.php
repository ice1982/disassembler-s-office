<?php

class CatalogMenu extends CWidget
{
    public function run()
    {
        $level_1 = array();

        $groups = Yii::app()->getController()->catalog_groups;
        $active_group = Yii::app()->getController()->catalog_group;

        $active_group_id =  isset($active_group->id) ? $active_group->id : null;

        foreach ($groups as $group) {
            if (empty($group['parent_id'])) {

                $level_1[] = $group['id'];
                $ar_level_1[$group['id']] = $group['title'];
            }
        }

        // foreach ($groups as $group) {
        //     if (in_array($group['parent_id'], $level_1)) {
        //         $ar_level_2[$group['parent_id']][$group['id']] = $group['title'];
        //     }
        // }


        asort($ar_level_1);

        $this->render('catalogMenu', array(
            'level_1' => $ar_level_1,
            'active_group_id' => $active_group_id,
            // 'level_2' => $ar_level_2,
        ));
    }

}