<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/admin'); ?>

    <header>
        <?php
            $this->widget('AdminMenu');
        ?>
    </header>

    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xs-9" id="contentArea">
                    <div class="admin-content" >

                        <?php if (isset($this->breadcrumbs)) : ?>
                            <?php $this->widget('BWBreadcrumbs', array(
                                'homeLink' => CHtml::link('Администрирование', '/admin/'),
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

                        <?php $this->widget('BWAlert', array(
                            'block' => true,
                            'fade' => true,
                            'closeText' => '&times;',
                        )); ?>

                        <?php echo $content; ?>
                    </div>
                </div>
                <div class="col-xs-3 admin-sidebar" id="adminSidebar">
                    <?php
                        if (count($this->menu)) {
                            array_unshift($this->menu, array('itemOptions' => array('class' => 'header-label')));
                            $this->widget('BWMenu', array(
                                'items'=> $this->menu,
                            ));
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <footer>

    </footer>

<?php $this->endContent(); ?>