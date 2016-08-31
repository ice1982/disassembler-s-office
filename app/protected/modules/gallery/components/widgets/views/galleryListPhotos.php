<div class="row gallery-line">

    <?php if (count($photos)) foreach ($photos as $photo) : ?>

        <div class="col-xs-<?=$row_span?>">

            <div class="thumbnail" style="<?=(!empty($height) ? 'height: ' . $height . 'px' : '')?>">

                <?php if ($modal === true) : ?>
                    <a href="/uploads/<?=$photo->image?>" rel="<?=$widget_id?>" class="fancybox-image" title="<?=$photo->title?>">
                <?php endif; ?>

                    <img
                        class="img-responsive review"
                        src="/uploads/<?=$photo->image?>"
                        alt="<?=$photo->title?>"
                        title="<?=$photo->title?>"
                    >

                <?php if ($captions == 'on') : ?>
                    <div class="thumbnail-caption">
                        <div><?=$photo->title?></div>
                    </div>
                <?php endif; ?>

                <?php if ($modal === true) : ?>
                    </a>
                <?php endif; ?>
            </div>

        </div>

    <?php endforeach; ?>

</div>