<hr>
<div class="row" style="padding-top:25px;">
<?php
$this->pageTitle = Yii::app()->name . ' - ' . $model->title;
    
$this->breadcrumbs[] = array('route' => array('index'), 'title' => 'Новости');
$this->breadcrumbs[] = array('route' => false, 'title' => $model->title);

    $this->menu = array(
    array(
        'url' => array('index')
    ),
); ?>

    <div class="col-xs-4">
        
            <img src="/uploads/<?=$model->image?>" class="img-responsive" alt="<?=$model->image_attr_alt?>" title="<?=$model->image_attr_title?>">
        
    </div>

    <div class="col-xs-8">
        <div class="font-h3 margin-h3"><?=$model->title?></div>

        <div>
            <?=$model->body?>
        </div>
    </div>

</div>
<hr>