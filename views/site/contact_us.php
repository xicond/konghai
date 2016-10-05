<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
//use yii\captcha\Captcha;

$this->title = 'Contact Us';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="bg-light section-lg">
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
<!--        <li>Pages</li>-->
        <li class="active">Contact us</li>
    </ol>
</section>
<section class="section section-inset-1">
    <div class="container">
        <h2>Contact us</h2>
        <hr>
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <!-- RD Mailform-->
                <?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'contact-form', 'action' => ['POST site/contact_us'],
                    'options'=>['data-result-class'=>"rd-mailform-validate",'data-form-type'=>"contact"],
                    'fieldConfig' => ['template' => '<div class="mfInput">{input}{error}</div>',
                        'options' => [
                            'class' => 'col-xs-12 col-sm-6'
                        ],
                        'errorOptions'=>['tag'=>'div', 'class'=>'mfValidation'],]
                ]); ?>
                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                    <div class="alert alert-success">
                        Thank you for contacting us. We will respond to you as soon as possible.
                    </div>
                <?php endif ?>
<!--                <form data-result-class="rd-mailform-validate" data-form-type="contact" method="post" action="bat/rd-mailform.php" class="rd-mailform row">-->

                <div class="col-xs-12">
                    <div class="row rd-mailform">

                        <?= $form->field($model, 'firstname', ['errorOptions'=>['class'=>'mfValidation'.($model->getErrors('firstname')?' mfValidation--active':'')]])
                            ->textInput(['autofocus' => true,'data-constraints'=>"@NotEmpty", 'placeholder'=>"Your first name..."]) ?>
                        <?= $form->field($model, 'lastname', ['errorOptions'=>['class'=>'mfValidation'.($model->getErrors('lastname')?' mfValidation--active':'')]])
                            ->textInput(['data-constraints'=>"@NotEmpty", 'placeholder'=>"Your last name..."]) ?>
                        <?= $form->field($model, 'email', ['errorOptions'=>['class'=>'mfValidation'.($model->getErrors('email')?' mfValidation--active':'')]])
                            ->textInput(['data-constraints'=>"@NotEmpty @Email", 'placeholder'=>"Your e-mail..."]) ?>
                        <?= $form->field($model, 'phone', ['errorOptions'=>['class'=>'mfValidation'.($model->getErrors('phone')?' mfValidation--active':'')]])
                            ->textInput(['data-constraints'=>"@Phone", 'placeholder'=>"Your phone..."]) ?>
                        <?= $form->field($model, 'body',[
                            'errorOptions'=>['class'=>'mfValidation'.($model->getErrors('body')?' mfValidation--active':'')],
                            'options' => [
                            'class' => 'col-xs-12 col-sm-12'
                        ],])
                            ->textArea(['data-constraints'=>"@NotEmpty", 'placeholder'=>"Message:"]) ?>

                        <?= $form->field($model, 'verifyCode',[
                            'options' => [
                                'class' => 'col-xs-12 col-sm-12'
                            ],
                            'errorOptions'=>['class'=>'mfValidation'.($model->getErrors('body')?' mfValidation--active':'')],])
                            ->widget(\PetraBarus\Yii2\ReCaptcha\ReCaptcha::className()) ?>
                        <!-- RD SelectMenu-->
                        <button class="btn btn-primary btn-sm btn-min-width">send message</button>

                    </div>
                </div>
<!--                </form>-->
                <?php \yii\bootstrap\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
<section class="section bg-light">
    <div class="container">
        <div class="row text-sm-left clearleft-custom">
            <div class="col-xs-12 col-sm-6 col-lg-6 col-lg-push-2">
                <div class="row">
                    <div class="col-md-12">
                        <address>
                            <div class="media">
                                <div class="media-left"><span class="icon icon-primary icon-sm fa-envelope"></span></div>
                                <div class="media-body">
                                    <p class="h6">Email</p><a href="mailto:<?= Yii::$app->params['adminEmail']?>"><?= Yii::$app->params['adminEmail']?></a>
                                </div>
                            </div>
                        </address>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <address>
                            <div class="media">
                                <div class="media-left"><span class="icon icon-primary icon-sm fa-phone"></span></div>
                                <div class="media-body">
                                    <p class="h6">Phones</p>
                                    <dl class="dl-horizontal">
                                        <dt>Phone:</dt>
                                        <dd><a href="callto:<?= preg_replace('@[^0-9]@','',Yii::$app->params['callCenter'])?>"><?= Yii::$app->params['callCenter']?></a></dd>

                                        <?php if(isset(Yii::$app->params['adminPhones'])):$i=0;
                                            $adminPhones = (array)Yii::$app->params['adminPhones'];
                                            foreach($adminPhones as $admin=>$phone):$i++;?>
                                                ?>
                                                <dt>Phone <?=$i?>:</dt>
                                                <dd><a href="callto:<?= preg_replace('@[^0-9]@','',$phone)?>"><?=$phone?> (<?=$admin?>)</a></dd>
                                            <?php endforeach;endif?>
                                    </dl>
                                </div>
                            </div>
                        </address>

                    </div>
                </div>
            </div>

            <!--<div class="col-xs-12 col-sm-6 col-lg-3">
                <address>
                    <div class="media">
                        <div class="media-left"><span class="icon icon-primary icon-sm fa-clock-o"></span></div>
                        <div class="media-body">
                            <p class="h6">We Are Open</p><span>Open hours: 8.00-18.00 Mon-Sat</span>
                        </div>
                    </div>
                </address>
            </div>-->

            <div class="col-xs-12 col-sm-6 col-lg-4">
                <address>
                    <div class="media">
                        <div class="media-left"><span class="icon icon-primary icon-sm fa-map-marker"></span></div>
                        <div class="media-body">
                            <p class="h6">Alamat</p><span><!--<a href="#">-->
                                    Kompleks Ruko Taman Palem Lestari<br />Blok H 32<br />
                                    Jl. Kamal Raya Outer Ring Road, Cengkareng – Jakarta Barat
                                <!--</a>--></span>
                        </div>
                    </div>
                </address>

            </div>
        </div>
    </div>
</section>
<section>
    <!-- RD Google Map-->
    <div class="rd-google-map">
        <div id="map" data-zoom="14" data-x="-73.9874068" data-y="40.643180" class="rd-google-map__model"></div>
        <script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyAJ9Fa6Rb3mlqUCrbTeYI9Yrq4N-_zTLfg"></script>
        <script type="text/javascript">
            var locations = [
                ['Komplek Taman Palem Lestari , Ruko Galaxy Blok H No,32 Cengkareng - Jakarta Barat',-6.1380456,106.7256124,1] 	];

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: new google.maps.LatLng(-6.1380456,106.7256124),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        </script>
        <div class="clear50 clear"></div>
    </div>
</section>