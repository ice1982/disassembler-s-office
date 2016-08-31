<?php
$str_pos = stripos(Yii::app()->request->url, Yii::app()->createUrl('catalog/default/index'));
?>

<ul class="nav navbar-nav">
    <li class="<?=(Yii::app()->request->url == '/') ? 'active' : ''?>">
        <a href="/" title="Главная">
            Главная
        </a>
    </li>
    <li class="dropdown <?=(Yii::app()->request->url == Yii::app()->createUrl('pages/default/view', array('alias' => 'news'))) ? 'active' : ''?>">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#" onclick="if($.inArray('open', $('li.dropdown')[0].classList) != -1){window.location.href='<?=Yii::app()->createUrl('pages/default/view', array('alias' => 'news'))?>'}">О КОМПАНИИ</a>
        <ul role="menu" class="dropdown-menu">
            <li>
                <a href="<?=Yii::app()->createUrl('pages/default/view', array('alias' => 'news'))?>">
                    Новости
                </a>
            </li>
        </ul>
    </li>
    <li class="dropdown <?=($str_pos === 0) ? 'active' : ''?>">
        <a data-toggle="dropdown" class="dropdown-toggle" href="<?=Yii::app()->createUrl('catalog/default/index')?>"
           onclick="if($.inArray('open', $('li.dropdown')[1].classList) != -1){window.location.href='<?=Yii::app()->createUrl('catalog/default/index')?>'}">КАТАЛОГ ТОВАРОВ</a>
        <ul role="menu" class="dropdown-menu">
            <li>
                <a href="<?=Yii::app()->createUrl('catalog/default/index')?>/group/2" title="Каталог товаров">
                    Задвижки
                </a>
            </li>
            <li>
                <a href="<?=Yii::app()->createUrl('catalog/default/index')?>/group/7" title="Каталог товаров">
                    Затворы дисковые
                </a>
            </li>
            <li>
                <a href="<?=Yii::app()->createUrl('catalog/default/index')?>/group/13" title="Каталог товаров">
                    Клапаны запорные
                </a>
            </li>
            <li>
                <a href="<?=Yii::app()->createUrl('catalog/default/index')?>/group/19" title="Каталог товаров">
                    Клапаны обратные
                </a>
            </li>
            <li>
                <a href="<?=Yii::app()->createUrl('catalog/default/index')?>/group/48" title="Каталог товаров">
                    Краны шаровые
                </a>
            </li>
            <li>
                <a href="<?=Yii::app()->createUrl('catalog/default/index')?>/group/70" title="Каталог товаров">
                    Клапаны сильфонные
                </a>
            </li>
        </ul>
    </li>

    <li class="dropdown <?=(Yii::app()->request->url == Yii::app()->createUrl('pages/default/view', array('alias' => 'sertifikaty'))) ? 'active' : ''?> <?=(Yii::app()->request->url == Yii::app()->createUrl('pages/default/view', array('alias' => 'proizvodstvo'))) ? 'active' : ''?>">
        <a href="<?=Yii::app()->createUrl('pages/default/view', array('alias' => 'sertifikaty'))?>" data-toggle="dropdown" class="dropdown-toggle" onclick="if($.inArray('open', $('li.dropdown')[2].classList) != -1){window.location.href='<?=Yii::app()->createUrl('pages/default/view', array('alias' => 'sertifikaty'))?>'}">
            КАЧЕСТВО
        </a>
        <ul role="menu" class="dropdown-menu">
            <li>
                <a href="<?=Yii::app()->createUrl('pages/default/view', array('alias' => 'proizvodstvo'))?>">
                    Производство
                </a>
            </li>
        </ul>
    </li>


    <li class="<?=(Yii::app()->request->url == Yii::app()->createUrl('pages/default/view', array('alias' => 'kontakty'))) ? 'active' : ''?>">
        <a href="<?=Yii::app()->createUrl('pages/default/view', array('alias' => 'kontakty'))?>">
            Контакты
        </a>
    </li>
</ul>
