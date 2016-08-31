<div class="container">

    <?=$this->decodeWidgets($model->body)?>

    <hr>

    <?php
        $output = $this->widget('LoadBlockWidget', array('alias' => 'serts_for_catalog_' . $model->group_id), true);
        if (!empty($output)) {
            echo $output;
        } else {
            $this->widget('LoadBlockWidget', array('alias' => 'serts_for_catalog'));
        }
    ?>

    <hr>

    <?php $this->widget('LoadBlockWidget', array('alias' => 'reviews_for_catalog')); ?>

    <hr>

    <?php $this->widget('LoadBlockWidget', array('alias' => 'partners_for_catalog')); ?>

    <br><br><br>

</div>
