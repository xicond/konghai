<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu:400,500,700%7COpen+Sans:400,300);">
    <link rel="stylesheet" href="css/style.css">
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;">
        <a href="http://windows.microsoft.com/en-US/internet-explorer/">
            <img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.">
        </a>
    </div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="page text-center">
    <!-- Page Header-->
    <header class="page-head">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap header-corporate">
            <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fullwidth" data-md-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-static">
                <!--(data-layout='rd-navbar-fixed',data-sm-layout='rd-navbar-fullwidth', data-lg-layout='#{rd_navbar_data_ajuster}' )-->
                <div class="rd-navbar-top-panel">
                    <div class="rd-navbar-inner">
                        <button data-rd-navbar-toggle=".list-inline" type="submit" class="rd-navbar-collapse-toggle"><span></span></button>
                        <a href="mailto:#" class="fa-envelope-o text-slim">info@konghai.com</a>
                        <a href="callto:#" class="fa-mobile-phone preffix-2 text-slim">1-800-1234-567</a>
                        <ul class="list-inline pull-right social">
                            <li><a href="#" class="fa-facebook"></a></li>
                            <li><a href="#" class="fa-twitter"></a></li>
                            <li><a href="#" class="fa-pinterest-p"></a></li>
                            <li><a href="#" class="fa-vimeo"></a></li>
                            <li><a href="#" class="fa-google-plus"></a></li>
                            <li><a href="#" class="fa-rss"></a></li>
                            <li class="text-left"><a href="mailto:#" class="fa-envelope-o text-slim">info@konghai.com</a></li>
                            <li class="text-left"><a href="callto:#" class="fa-mobile-phone text-slim">1-800-1234-567</a></li>
                        </ul>
                    </div>
                </div>
                <div class="rd-navbar-inner">
                    <!-- RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <!-- RD Navbar Toggle-->
                        <button data-rd-navbar-toggle=".rd-navbar-nav-wrap" type="submit" class="rd-navbar-toggle"><span></span></button>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand">
                            <a href="<?= Yii::$app->homeUrl?>" class="brand-name">
                                <img src="/images/konghai-logo.png" alt="konghai logo">
                            </a></div>
                    </div>
                    <div class="rd-navbar-nav-wrap">
                        <!-- RD Navbar Search-->
                        <!--<div class="rd-navbar-search">
                            <form action="search.php" method="GET" class="rd-navbar-search-form">
                                <label class="rd-navbar-search-form-input">
                                    <input type="text" name="s" placeholder="Search.." autocomplete="off">
                                </label>
                                <button type="submit" class="rd-navbar-search-form-submit fa-shopping-cart"></button>
                            </form><span class="rd-navbar-live-search-results"></span>
                            <button data-rd-navbar-toggle=".rd-navbar-search, .rd-navbar-live-search-results" type="submit" class="rd-navbar-search-toggle"></button>
                        </div><a href="shop-cart.html" class="fa-shopping-cart"><span>10</span></a>-->
                        <!-- RD Navbar Nav-->
                        <ul class="rd-navbar-nav">
                            <li<?= \yii\helpers\Url::current()==\yii\helpers\Url::to(['site/index'])?' class="active"':''?>><a href="<?= Yii::$app->homeUrl?>">Home</a></li>
                            <li<?= \yii\helpers\Url::current()==\yii\helpers\Url::to(['site/track'])?' class="active"':''?>><a href="<?= \yii\helpers\Url::to(['site/track'])?>">Tracking</a></li>
                            <li><a href="#about.html">About Us</a></li>
                            <li><a href="#contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <section>

            <!--jumbotron-->
            <div class="swiper-container swiper-slider swiper-slider-height-1">
                <div class="jumbotron-mod-1 text-center">
                    <div>
                        <h1><small>We Serve Better Than Other</small><span class='text-bold'>Konghai</span></h1>
                        <div class="slogan">
                            <p>Ekspedisi barang import door to door terbesar ke 5 di Indonesia berdiri sejak 2006</p>
                        </div>
<!--                        <div class='btn-group-variant'> <div><a class='btn btn-primary btn-sm' href='#'>Our advantages</a> <a class='btn btn-white btn-sm' href='#'>Virtual tour</a></div></div>-->
                    </div>
                </div>
                <div class="swiper-wrapper">
                    <div data-slide-bg="images/slider-1.jpg" class="swiper-slide">
                        <div class="swiper-slide-caption"></div>
                    </div>
                    <div data-slide-bg="images/slider-2.jpg" class="swiper-slide">
                        <div class="swiper-slide-caption"></div>
                    </div>
                    <div data-slide-bg="images/slider-3.jpg" class="swiper-slide">
                        <div class="swiper-slide-caption"></div>
                    </div>
                </div>
                <!-- Swiper Pagination-->
                <div class="swiper-pagination"></div>
            </div>

        </section>
    </header>
    <!-- Page Content-->
    <main class="page-content">

        <!--< section breadcrumb -->
        <?= $content ?>

    </main>
    <footer class="page-foot section-inset-4">
        <section class="footer-content">
            <div class="container">
                <!--footer-->
            </div>
        </section>
        <!-- {%FOOTER_LINK}-->
    </footer>
    <!-- Rd Mailform result field-->
    <div class="rd-mailform-validate"></div>
</div>


<!-- Java script-->
<script src="js/core.min.js"></script>
<script src="js/script.js"></script>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
</body>
</html>

