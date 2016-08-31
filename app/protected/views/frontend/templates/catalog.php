<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

    <?php $this->widget('LoadBlockWidget', array('alias' => 'header')); ?>

    <div class="content">
    <?php $this->widget('LoadBlockWidget', array('alias' => 'main_menu')); ?>

        <div class="container">

            <?php if (isset($this->breadcrumbs)) : ?>
                <?php $this->widget('BWBreadcrumbs', array(
                    'homeLink' => CHtml::link('Главная', '/'),
                    'links' => $this->breadcrumbs,
                    'tagName' => 'ol',
                    'htmlOptions' => array(
                        'class' => 'breadcrumb',
                    ),
                    'activeLinkTemplate' => '<li><a href="{url}" title="{label}">{label}</a></li>',
                    'inactiveLinkTemplate' => '<li class="active">{label}</li>',
                    'separator' => false,
                    'encodeLabel' => false,
                )); ?>
            <?php endif; ?>

            <?php
                // echo $this->catalog_description;
            ?>
            <!-- navbar -->
            <?php $this->widget('CatalogMenu'); ?>
        </div>

        <?php echo $content; ?>

        <?php echo $this->page->end_body; ?>

        <?php $this->widget('CatalogWhatYouSeen'); ?>

    </div>

    <?php $this->widget('LoadBlockWidget', array('alias' => 'footer')); ?>

<?php $this->endContent(); ?>