<?php if (count($items) > 0) : ?>
    <div class="container">
        <h4 class="font-h4">Ранее вы просматривали:</h4>
        <br>
        <div class="seen-items">
            <div class="row">
                <?php foreach ($items as $item) : ?>
                    <div class="col-xs-2">
                        <div class="image">
                            <a href="<?=$item['link']?>">
                                <img src="<?=$item['image']?>" alt="" class="img-responsive" style="height: 80px;">
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <?php foreach ($items as $item) : ?>
                    <div class="col-xs-2">
                        <div class="title">
                            <a href="<?=$item['link']?>">
                                <?=$item['title']?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
<?php else: ?>

<?php endif; ?>