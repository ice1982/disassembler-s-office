<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/login'); ?>

    <div class="content">

        <div class="container">
            <?php $this->widget('BWAlert', array(
                'block' => true,
                'fade' => true,
                'closeText' => '&times;',
            )); ?>

            <?php echo $content; ?>
        </div>

    </div>


<?php $this->endContent(); ?>