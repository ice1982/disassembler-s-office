
<div class="catalog-navbar navbar navbar-default" role="navigation">
    <div class="font-h4 block-center block-title">Быстрая навигация по каталогу</div>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav" style="width: 100%">
            <?php foreach ($level_1 as $id => $value) : ?>

                    <li class="<?=($active_group_id == $id) ? 'active' : '';?>" style="text-align: center; min-width: 33%">
                        <a href="<?=Yii::app()->createUrl('catalog/default/index', array('group' => $id))?>"><?=$value?></a>
                    </li>

            <?php endforeach; ?>
        </ul>
    </div>
</div>