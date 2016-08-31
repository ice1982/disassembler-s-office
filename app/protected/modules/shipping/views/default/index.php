<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Список отгрузок завода Бристоль';

?>

<hr>

<?php
    $this->widget('zii.widgets.CListView', array(
        'id' => 'articlesList',
        'dataProvider' => $shippings,
        'emptyText' => 'Раздел &laquo;Отгрузки&raquo; в процессе наполнения',
        'itemView' => '_itemView',
    ));
?>


