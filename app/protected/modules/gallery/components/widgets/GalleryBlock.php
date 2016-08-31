<?php

Yii::import('application.modules.clubs.gallery.*');

class GalleryBlock extends CWidget
{
    public $id = '';
    public $album = '';

    public $captions = 'off';
    public $row_span = 4;
    public $limit = false;
    public $order = 'id';

    public $height = false;
    public $width = false;
    public $margin = '0 5px 0 0';

    public $modal = true;

    public function run()
    {
        $widget_id = 'gallery' . md5(time() . rand(1, 9999999));

        $style = '';
        $style .= (!empty($this->height) ? 'height: ' . $this->height . 'px;' : '');
        $style .= (!empty($this->width) ? 'width: ' . $this->width . 'px' : '');
        $style .= (!empty($this->padding) ? 'padding: ' . $this->padding : '');

        if (!empty($this->id)) {

            $count = substr_count($this->id, ',');

            if (empty($count)) {
                // Показываем только одну фотку
                $photo = GalleryPhoto::model()->findByPk($this->id);

                $this->render('galleryOnePhoto', array(
                    'photo' => $photo,

                    'style' => $style,
                    'height' => $this->height,

                    'modal' => (bool) $this->modal,
                ));
            } else {
                $ids = str_replace(' ', '', $this->id);
                $ids_array = explode(',', $ids);

                $photos = GalleryPhoto::model()->findAllByPkArray($ids_array, $this->order, $this->limit);

                $this->render('galleryListPhotos', array(
//                    'height' => $this->height,
                    'photos' => $photos,
                    'row_span' => $this->row_span,
                    'captions' => $this->captions,
                    'widget_id' => $widget_id,

                    'style' => $style,
                    'height' => $this->height,

                    'modal' => (bool) $this->modal,
                ));
            }
        } elseif (!empty($this->album)) {

            $photos = GalleryPhoto::model()->findAllByAlbumTitle($this->album, $this->order, $this->limit);

//            var_dump($photos);

            $this->render('galleryListPhotos', array(
//                'height' => $this->height,
                'photos' => $photos,
                'row_span' => $this->row_span,
                'captions' => $this->captions,
                'widget_id' => $widget_id,

                'style' => $style,
                'height' => $this->height,

                'modal' => (bool) $this->modal,
            ));
        }
    }
}
?>
