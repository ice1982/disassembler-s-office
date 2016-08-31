<?php $table_number = 0; ?>
<?php foreach ($catalog_groups as $key => $catalog_group) : ?>

    <?php if ($key % $cols == 0) : $table_size = count($catalog_groups) - $table_number * $cols; ?>
        <table class="inline-catalog-table table-<?=($table_size < $cols) ? $table_size : $cols ?>"><tr>
    <?php endif; ?>
    <td>
        <div class="image">
            <?php if (!empty($catalog_group['image'])) : ?>
                <a href="<?=Yii::app()->createUrl('catalog/default/index', array('group' => $catalog_group['id']))?>" title="<?=$catalog_group['title']?>">
                    <img src="/uploads/catalog/<?=$catalog_group['image']?>" alt="<?=$catalog_group['title']?>">
                </a>
            <?php endif; ?>
        </div>
        <div class="title">
            <?=CHtml::link(CHtml::encode($catalog_group['title']), Yii::app()->createUrl('catalog/default/index', array('group' => $catalog_group['id'])))?>
        </div>
    </td>
    <?php if ( ( ($key+1) % $cols == 0) || (count($catalog_groups) == $key+1) ) : $table_number++; ?>
        </tr></table>
    <?php endif; ?>

<?php endforeach; ?>