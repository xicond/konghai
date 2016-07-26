<?php

/* @var $this yii\web\View */

$this->title = 'Konghai';
?>
<section class="section">
    <div class="container">
        <h2>SERVICE  CALCULATOR</h2>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-md-5 col-lg-6 visible-md visible-lg">
                    <div class="img-thumbnail-mod-2"><img src="images/index-2.jpg" width="705" height="655" alt=""></div>
                </div>
                <div class="col-sm-10 col-md-7 col-lg-6 inset-3">
                    <p class="text-sm-left">Basic calculated fields sample.</p>
                    <div class="calculator">
                        <div data-price="1" class="form-group distance">
                            <label for="dist" class="h6">Distance (mi) *</label>
                            <input type="text" id="dist" class="numbers-only">
                        </div>
                        <div data-price="2" class="form-group weight">
                            <label for="weight" class="h6">Weight (lb)</label>
                            <input type="text" id="weight" class="numbers-only">
                        </div>
                        <div id="capacity" data-price="1" class="capacity clearfix">
                            <div class="form-group">
                                <label for="length" class="h6">Length (in)</label>
                                <input type="text" id="length" class="numbers-only">
                            </div>
                            <div class="form-group">
                                <label for="height" class="h6">Height (in)</label>
                                <input type="text" id="height" class="numbers-only">
                            </div>
                            <div class="form-group">
                                <label for="width" class="h6">Width (in)</label>
                                <input type="text" id="width" class="numbers-only">
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="h6">Fragile</p>
                            <div class="radio">
                                <label>
                                    <input data-price="25" type="radio" name="blankRadio" id="blankRadioYes" value="option1" class="numbers-only"><span class="radio-field"></span><span>Yes</span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="blankRadio" id="blankRadioNo" value="option2" class="numbers-only"><span class="radio-field"></span><span>No</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="h6">Extra services:</p>
                            <div class="checkbox-group">
                                <label class="checkbox-inline">
                                    <input data-price="15" type="checkbox" id="extra1" class="numbers-only"><span class="checkbox-field"></span><span>Insurance</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input data-price="20" type="checkbox" id="extra2" class="numbers-only"><span class="checkbox-field"></span><span>Express Delivery</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input data-price="25" type="checkbox" id="extra3" class="numbers-only"><span class="checkbox-field"></span><span>Packaging</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group border-top inset-4 h4">
                            <p>Total:<span id="total">0</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-inset-1 bg-primary">
    <div class="container">
        <h2 class="text-center">about konghai</h2>
        <hr>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 text-center text-md-left inset-1"><img src="images/index-1.jpg" alt=""></div>
            <div class="col-xs-12 col-sm-12 col-md-6 text-sm-left well1">
                <p>Perusahaan Kami Dipilih Untuk Melayani Anda! Kami Melayani dengan Hati. Perusahaan kami memiliki pengalaman di bidang ekspedisi IMPORT Lebih dari 8 tahun dan nomor urut ke-5 di Jakarta. Juga kami merupakan salah satu dari 25 Jasa Ekspedisi Import Terbesar di Indonesia. (Trading, Pengiriman Barang LCL & FCL Door To Door Rumah Customer).</p>
                <br/>
                <p>"We Serve Better Than Other"</p>
                <br/>
                <p>Kepuasan dan Kenyamanan anda adalah tujuan kami</p>
                <p>Pengalaman kami :</p>
                <p>Banyak perusahaan Besar Seperti Telkomsel, Flexi, Hua Wei, Nutrisi Depot Indonesia, Mesin" Balancing, Plastik PO, Spare Part, Electronic, Online Shop, Dll.</p>
<!--                <div class="progress-container text-left">-->
<!--                    <p class="font-secondary h6">Air Transportation</p>-->
                    <!-- Progress Bar-->
                    <!--<div data-value="50" data-stroke="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-horizontal progress-bar-default"></div>
                    <p class="font-secondary h6">Marine Transportation</p>-->
<!--                </div>-->
            </div>
        </div><a href="#" class="btn btn-white btn-sm btn-min-width">lebih lanjut</a>
    </div>
</section>
<!--<section class="section section-inset-2">
    <div class="container">
        <h2 class="text-center">Counters</h2>
        <hr>
        <div class="row">
            <div class="progress-container row offset-7 flow-offset-1">
                <!-- Progress Bar-/->
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail-mod-1">
                        <div class="progress-bar-wrapper">
                            <div data-value="50" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                        </div>
                        <p class="h5 fw-l inline-block">Air Transportation</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail-mod-1">
                        <div class="progress-bar-wrapper">
                            <div data-value="75" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                        </div>
                        <p class="h5 fw-l inline-block">Marine Transportation</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail-mod-1">
                        <div class="progress-bar-wrapper">
                            <div data-value="25" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                        </div>
                        <p class="h5 fw-l inline-block">Trucking Services</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail-mod-1">
                        <div class="progress-bar-wrapper">
                            <div data-value="100" data-stroke="10" data-trail="10" data-easing="linear" data-duration="1000" data-counter="true" class="progress-bar progress-bar-radial progress-bar-default"></div>
                        </div>
                        <p class="h5 fw-l inline-block">Safety Escort Services</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
--><section class="section section-inset-1 bg-light">
    <div class="container">
        <h2>Blog news</h2>
        <hr>
        <div class="row text-sm-left">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="blog-post thumbnail-1 thumbnail-mod-2"><img src="images/index-8.jpg" alt="">
                    <div class="caption">
                        <div class="blog-post-title">
                            <h4 class="text-primary text-transform-none"><a href="#blog_post.html">International Packing Import</a></h4>
                        </div>
                        <div class="blog-post-time">
                            <time datetime="2015-12-26">April 10, 2014</time>
                        </div>
                        <div class="blog-post-body">
                            <p>Bahan- bahan yang digunakan dalam packing export – IMPORT menggunakan bahan – bahan berkualitas INTERNATIONAL dengan standard operasional prosedur yang dijaga ketat.</p>
<!--                            <a href="blog_post.html" class="badge fa-comment font-secondary text-primary">10</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="blog-post thumbnail-1 thumbnail-mod-2"><img src="images/index-9.jpg" alt="">
                    <div class="caption">
                        <div class="blog-post-title">
                            <h4 class="text-primary text-transform-none"><a href="#blog_post.html">PILIHAN TEPAT IMPORT VIA UDARA</a></h4>
                        </div>
                        <div class="blog-post-time">
                            <time datetime="2015-12-26">April 8, 2014</time>
                        </div>
                        <div class="blog-post-body">
                            <p>Udara kargo pengiriman adalah pilihan yang cocok untuk bisnis yang perlu untuk mendapatkan dokumen yang dikirim dengan cepat atau yang ingin memastikan bahwa pelanggan mendapatkan produk mereka memesan segera. Udara kargo pengiriman ini juga pilihan yang luar biasa untuk individu yang memiliki sesuatu yang mereka butuhkan untuk mail dan yang berfokus terutama pada mendapatkan bahwa paket atau item dikirim cepat.</p>
<!--                            <a href="blog_post.html" class="badge fa-comment font-secondary text-primary">16</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="blog-post thumbnail-1 thumbnail-mod-2"><img src="images/index-10.jpg" alt="">
                    <div class="caption">
                        <div class="blog-post-title">
                            <h4 class="text-primary text-transform-none"><a href="#blog_post.html">Tips Cara Kirim Barang Import</a></h4>
                        </div>
                        <div class="blog-post-time">
                            <time datetime="2015-12-26">April 6, 2014</time>
                        </div>
                        <div class="blog-post-body">
                            <p>Sekarang ini barang import dari China sedang membanjiri pasar ekonomi Indonesia , bahkan hampir di seluruh dunia juga yang dikarenakan harga nya yang sangat murah dibanding dengan produk lainnya. Ini bisa menjadi peluang bisnis yang sangat bagus dan menjanjikan.</p>
<!--                            <a href="blog_post.html" class="badge fa-comment font-secondary text-primary">20</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--        <a href="blog_default.html" class="btn btn-primary-variant-1 btn-sm btn-min-width">view all blog posts</a>-->
    </div>
</section>
<section class="section section-inset-1">
    <div class="container">
        <h2 class="text-center">Our satisfied clients</h2>
        <hr>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="thumbnail thumbnail-mod-1"><img src="images/partner-8.png" alt="">
                    <div class="caption-mod-1">
                        <h6 class="text-gray">Tourner</h6><!--<a href="#" class="text-gray">www.tourner.com</a>-->
                        <p>We believe in the ability of all people to thrive, not just exist.</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="thumbnail thumbnail-mod-1"><img src="images/partner-9.png" alt="">
                    <div class="caption-mod-1">
                        <h6 class="text-gray">Frank`s Co.</h6><!--<a href="#" class="text-gray">www.franksco.com</a>-->
                        <p>We are open and transparent about the work we do and how we do it.</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="thumbnail thumbnail-mod-1"><img src="images/partner-10.png" alt="">
                    <div class="caption-mod-1">
                        <h6 class="text-gray">Retro Press</h6><!--<a href="#" class="text-gray">www.retropress.com</a>-->
                        <p>We are commited to achieving demonstrable impact for our stakeholders.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-light rd-parallax">
    <div data-speed="0" data-md-speed="0.2" data-type="media" data-url="images/index-11.jpg" class="rd-parallax-layer"></div>
    <div class="container section section-inset-1 z-index">
        <h2 class="text-center">Contact us</h2>
        <hr>
        <div class="row offset-3">
            <div class="col-xs-12 col-md-9 col-lg-6 col-md-offset-2 col-lg-offset-3">
                <!--p.fw-l.h5.text-transform-none Enter your email address to receive all company news, special offers and other discount information.-->
                <!-- RD Mailform-->
                <form data-result-class="rd-mailform-validate" data-form-type="contact" method="post" action="bat/rd-mailform.php" class="rd-mailform row">
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" name="name" data-constraints="@NotEmpty" placeholder="Your first name...">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" name="name" data-constraints="@NotEmpty" placeholder="Your last name...">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" name="email" data-constraints="@NotEmpty @Email" placeholder="Your e-mail...">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" data-constraints="@Phone" name="phone" placeholder="Your phone..." class="form-input">
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <textarea name="message" data-constraints="@NotEmpty" placeholder="Message:"></textarea>
                    </div>
                    <!-- RD SelectMenu-->
                    <button class="btn btn-primary btn-sm btn-min-width">send message</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!--<section class="section section-inset-1">
    <div class="container">
        <h2>testimonials</h2>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                <!-- Owl Carousel-/->
                <div data-items="1" data-sm-items="2" data-lg-items="3" data-loop="false" data-margin="30" data-dots="true" data-autoplay="true" class="owl-carousel owl-carousel-mod-2">
                    <div class="owl-item">
                        <blockquote class="quote"><img src="images/index-12.jpg" alt="" width="70" height="70" class="img-circle"/>
                            <p>
                                <cite>Sharon Willis</cite>
                            </p>
                            <p>
                                <q>Thanks a lot for the quick response. I was really impressed, your solution is excellent! Your competence is justified!</q>
                            </p>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <blockquote class="quote"><img src="images/index-14.jpg" alt="" width="70" height="70" class="img-circle"/>
                            <p>
                                <cite>Alan Smith</cite>
                            </p>
                            <p>
                                <q>Great organization!! Your prompt answer became a pleasant surprise for me. You've rendered an invaluable service!</q>
                            </p>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <blockquote class="quote"><img src="images/index-13.jpg" alt="" width="70" height="70" class="img-circle"/>
                            <p>
                                <cite>Jack Wilson</cite>
                            </p>
                            <p>
                                <q>I just don't know how to describe your services... They are extraordinary! I am quite happy with them! Just keep up going this way!</q>
                            </p>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <blockquote class="quote"><img src="images/index-12.jpg" alt="" width="70" height="70" class="img-circle"/>
                            <p>
                                <cite>Sharon Willis</cite>
                            </p>
                            <p>
                                <q>Thanks a lot for the quick response. I was really impressed, your solution is excellent! Your competence is justified!</q>
                            </p>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <blockquote class="quote"><img src="images/index-14.jpg" alt="" width="70" height="70" class="img-circle"/>
                            <p>
                                <cite>Alan Smith</cite>
                            </p>
                            <p>
                                <q>Great organization!! Your prompt answer became a pleasant surprise for me. You've rendered an invaluable service!s</q>
                            </p>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <blockquote class="quote"><img src="images/index-13.jpg" alt="" width="70" height="70" class="img-circle"/>
                            <p>
                                <cite>Jack Wilson</cite>
                            </p>
                            <p>
                                <q>I just don't know how to describe your services... They are extraordinary! I am quite happy with them! Just keep up going this way!</q>
                            </p>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <blockquote class="quote"><img src="images/index-12.jpg" alt="" width="70" height="70" class="img-circle"/>
                            <p>
                                <cite>Sharon Willis</cite>
                            </p>
                            <p>
                                <q>Thanks a lot for the quick response. I was really impressed, your solution is excellent! Your competence is justified!</q>
                            </p>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <blockquote class="quote"><img src="images/index-14.jpg" alt="" width="70" height="70" class="img-circle"/>
                            <p>
                                <cite>Alan Smith</cite>
                            </p>
                            <p>
                                <q>Great organization!! Your prompt answer became a pleasant surprise for me. You've rendered an invaluable service!</q>
                            </p>
                        </blockquote>
                    </div>
                    <div class="owl-item">
                        <blockquote class="quote"><img src="images/index-13.jpg" alt="" width="70" height="70" class="img-circle"/>
                            <p>
                                <cite>Jack Wilson</cite>
                            </p>
                            <p>
                                <q>I just don't know how to describe your services... They are extraordinary! I am quite happy with them! Just keep up going this way!</q>
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>-->