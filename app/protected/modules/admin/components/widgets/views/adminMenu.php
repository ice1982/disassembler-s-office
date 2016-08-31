<nav class="admin-navbar navbar navbar-default" role="navigation">
    <div class="container-fluid">

        <div class="navbar-header">
            <a class="navbar-brand" href="/"><?=Yii::app()->name;?></a>
        </div>

        <div class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li><a href="/admin/">Панель администрирования</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Контент <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="header-label">Страницы</li>
                        <li><a href="<?=Yii::app()->createUrl('pages/admin/pages/create')?>">Создать страницу</a></li>
                        <li><a href="<?=Yii::app()->createUrl('pages/admin/pages/index')?>">Список страниц</a></li>
                        <li class="divider"></li>
                        <li class="header-label">Блоки</li>
                        <li><a href="<?=Yii::app()->createUrl('blocks/admin/blocks/create')?>">Создать блок</a></li>
                        <li><a href="<?=Yii::app()->createUrl('blocks/admin/blocks/index')?>">Список блоков</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Каталог <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="header-label">Товары</li>
                        <li><a href="<?=Yii::app()->createUrl('catalog/admin/catalogItems/create')?>">Добавить товар</a></li>

                        <li><a href="<?=Yii::app()->createUrl('catalog/admin/catalogItems/index')?>">Список товаров</a></li>
                        <li class="divider"></li>
                        <li class="header-label">Группы товаров</li>
                        <li><a href="<?=Yii::app()->createUrl('catalog/admin/catalogGroups/create')?>">Добавить группу</a></li>
                        <li><a href="<?=Yii::app()->createUrl('catalog/admin/catalogGroups/index')?>">Список групп</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Новости <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=Yii::app()->createUrl('news/admin/news/create')?>">Добавить новость</a></li>
                        <li><a href="<?=Yii::app()->createUrl('news/admin/news/index')?>">Список новостей</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="<?=Yii::app()->createUrl('')?>" class="dropdown-toggle" data-toggle="dropdown">Мультимедиа <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="header-label">Фотографии</li>
                        <li><a href="<?=Yii::app()->createUrl('gallery/admin/galleryPhotos/create')?>">Добавить фото</a></li>
                        <li><a href="<?=Yii::app()->createUrl('gallery/admin/galleryPhotos/index')?>">Просмотр фотографий</a></li>
                        <li class="header-label">Альбомы фотографий</li>
                        <li><a href="<?=Yii::app()->createUrl('gallery/admin/galleryAlbums/create')?>">Добавить альбом</a></li>
                        <li><a href="<?=Yii::app()->createUrl('gallery/admin/galleryAlbums/index')?>">Список альбомов</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Заявки <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=Yii::app()->createUrl('forms/admin/reports/index')?>">Заявки с сайта</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Пользователи <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=Yii::app()->createUrl('user/admin/create')?>">Добавить пользователя</a></li>
                        <li><a href="<?=Yii::app()->createUrl('user/admin/admin')?>">Список пользователей</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=Yii::app()->user->name?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Профиль</a></li>
                        <li><a href="#">Сменить пароль</a></li>
                    </ul>
                </li>
                <li><a href="<?=Yii::app()->createUrl('user/logout/logout')?>">Выход</a></li>
            </ul>
        </div>
    </div>
</nav>