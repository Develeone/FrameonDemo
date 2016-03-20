<!DOCTYPE HTML>
<html lang="ru" dir="ltr">

<head>
    <meta charset="<?= Config::get()->encode ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="STUDIA" />
    <title><?=app::get()->config->sitename?></title>
    <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" href="/assets/css/widgetkit.css" type="text/css" />
    <script src="/assets/vendor/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/js/jquery-noconflict.js" type="text/javascript"></script>
    <script src="/assets/vendor/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <link rel="apple-touch-icon-precomposed" href="http://yootheme.com/demo/themes/joomla/2013/moustache/templates/yoo_moustache/apple_touch_icon.png">
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/custom.css">

    <script src="/assets/vendor/uikit/js/uikit.js"></script>
    <script src="/assets/vendor/uikit/js/components/autocomplete.js"></script>
    <script src="/assets/vendor/uikit/js/components/search.js"></script>
    <script src="/assets/vendor/uikit/js/components/tooltip.js"></script>
    <script src="/assets/js/theme.js"></script>
</head>

<body class="tm-isblog  tm-navbar-fixed tm-block-large">
<div id="tm-headerbar" class="tm-headerbar" style="padding: 0px;">


    <nav class="tm-navbar uk-navbar">
        <div class="uk-container uk-container-center">
            <div class="uk-clearfix">

                <a class="tm-logo uk-navbar-brand uk-hidden-small" href="/">
                    <img src="/assets/images/logo_black_small.png" style="height: 100%; padding: 5px;">
                </a>

                <!--div class="uk-navbar-flip uk-visible-large">
                    <div class="uk-navbar-content">
                        <form id="search-40-56dfb427d2e53" class="uk-search" action="http://yootheme.com/demo/themes/joomla/2013/moustache/index.php" method="post">
                            <input class="uk-search-field" type="text" name="searchword" placeholder="Поиск...">
                            <input type="hidden" name="task"   value="search">
                            <input type="hidden" name="option" value="com_search">
                            <input type="hidden" name="Itemid" value="107">
                        </form>
                    </div>
                </div-->

                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav uk-visible-large">
                        <li class="uk-parent<?= get_called_class() == "IndexController" ? " uk-active" : "" ?>" aria-haspopup="true" aria-expanded="false">
                            <a href="/">Главная</a>
                        </li>

                        <li class="uk-parent" data-uk-dropdown="{'preventflip':'y'}" aria-haspopup="true" aria-expanded="false">
                            <a href="#">Услуги</a>
                            <div class="uk-dropdown uk-dropdown-navbar uk-dropdown-width-1">
                                <div class="uk-grid uk-dropdown-grid">
                                    <div class="uk-width-1-1">
                                        <ul class="uk-nav uk-nav-navbar">
                                            <li>
                                                <a href="#">Аренда спецтехники</a>
                                            </li>
                                            <!--li>
                                                <a href="http://yootheme.com/demo/themes/joomla/2013/moustache/index.php/features/uikit">Продажа запчастей</a>
                                            </li-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="uk-parent<?= get_called_class() == "PartsCatalogueController" ? " uk-active" : "" ?>">
                            <a href="/parts">Запчасти</a>
                        </li>

                        <li class="uk-parent">
                            <a href="#">Контакты</a>
                        </li>

                        <?php if (!$this->user->check()) {?>
                            <li class="uk-parent<?= get_called_class() == "UserController" ? " uk-active" : "" ?>">
                                <a href="/login">Вход</a>
                            </li>
                        <?php } else { ?>
                            <li class="uk-parent<?= get_called_class() == "UserController" ? " uk-active" : "" ?>">
                                <a href="/personal"><?= $this->user->login ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

</div>

<?= $content ?>

</body>
</html>