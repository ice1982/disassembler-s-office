<div class="row">

    <div class="col-xs-4">
        <a href="<?= Yii::app()->createUrl('news/default/view', array('id' => $data->id)) ?>" rel="shippings-photos" class="fancybox-image" title="<?=$data->title?>">
            <img src="/uploads/<?=$data->image?>" class="img-responsive" alt="<?=$data->image_attr_alt?>" title="<?=$data->image_attr_title?>">
        </a>
        
    </div>

    <div class="col-xs-8">
        <div class="font-h3 margin-h3"><?=CHtml::link(CHtml::encode($data->title), Yii::app()->createUrl('news/default/view', array('id' => $data->id)))?></div>

        <div>
            <?=$data->body?>
        </div>
    </div>

</div>
<hr>