<?php


/**
 *
 */
class CatalogWhatYouSeen extends CWidget
{
    public function run()
    {
        $items = array();

        $history_items = array();
        if (isset(Yii::app()->request->cookies['catalog_history']->value)) {
            $catalog_history = Yii::app()->request->cookies['catalog_history']->value;
            $history_items = json_decode($catalog_history, true);
        }

        $arr = array();
        foreach ($history_items as $item) {
            $arr[$item['time']] = array(
                'title' => $item['title'],
                'link' => $item['link'],
                'image' => $item['image'],
            );
        }

        krsort($arr);

        $count = 1;
        foreach ($arr as $key => $value) {
            $items[$key] = $value;
            if ($count == 6) {
                break;
            }
            $count++;
        }

        $this->render('catalogWhatYouSeen', array('items' => $items));
    }
}