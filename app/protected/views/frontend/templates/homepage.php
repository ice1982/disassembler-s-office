<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

    <?php $this->widget('LoadBlockWidget', array('alias' => 'header')); ?>

    <div class="homepage-navbar">
        <?php $this->widget('LoadBlockWidget', array('alias' => 'main_menu')); ?>
    </div>

    <?php echo $content; ?>

    <?php $this->widget('CatalogWhatYouSeen'); ?>

    <?php $this->widget('LoadBlockWidget', array('alias' => 'footer')); ?>

<?php $this->endContent(); ?>