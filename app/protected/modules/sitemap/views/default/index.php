
<div class="font-h2 margin-h3">Карта сайта</div>


<div class="font-h4 margin-h4">Страницы</div>
<ul>
    <?php foreach ($models['page'] as $id => $page) : ?>

        <li><a title="<?=$page->title?>" href="<?=Yii::app()->createUrl('pages/default/view', array('alias' => $page->alias))?>"><?=$page->title?></a></li>

    <?php endforeach; ?>
</ul>

<div class="font-h4 margin-h4">Каталог продукции</div>

<ul>
<?php foreach ($models['catalog_group'] as $id => $group) : ?>
    <li><a href="<?=Yii::app()->createUrl('catalog/default/index', array('group' => $group->id))?>"><?=$group->title?></a>
    </li>
<?php endforeach; ?>
</ul>
