<?php

$this->pageTitle = Yii::app()->name . ' - ' . 'Список новостей завода Бристоль';

?>

<hr>

<?php
    $this->widget('zii.widgets.CListView', array(
        'id' => 'articlesList',
        'dataProvider' => $news,
        'emptyText' => 'Раздел &laquo;Новости&raquo; в процессе наполнения',
        'itemView' => '_itemView',
    ));
?>


