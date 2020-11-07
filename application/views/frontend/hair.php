<section class="bg-dark pb-5">
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__logo">
            <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/web/img/logo.svg" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__widget">
            <span>Call us for any questions</span>
            <h4>+971 564849878</h4>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header inner-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/web/img/logo.svg"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <nav class="header__menu mobile-menu text-right">
                        <ul>
                            <li><a href="<?php echo base_url() ?>about">About</a></li>
                            <li><a href="<?php echo base_url() ?>services" class="active-menu">Services</a></li>
                            <li><a href="<?php echo base_url() ?>gallery">Gallery</a></li>
                            <li><a href="<?php echo base_url() ?>contact">Contact Us</a></li>
                            <?php 
                        if(!isset($frontLogin) || $frontLogin != true){
                        ?> <li class="text-white btn btn-dark no-space w-sm-100 d-none"><a
                                    href="<?php echo base_url() ?>login">Login</a></li>
                            <li class="text-white btn btn-primary no-space w-sm-100 d-none"><a
                                    href="<?php echo base_url() ?>register">Register</a></li><?php
                        }
                        else{
                            ?><li><a href="<?php echo base_url() ?>order-history d-none">Booking History</a></li>
                            <li class="text-white btn btn-dark no-space w-sm-100 d-none"><a
                                    href="<?php echo base_url() ?>logout">Logout</a></li>
                            <?php
                        }
                        ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <div class="banner-about hair">
        <div class="container text-center">
            <div>Hair Care</div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-7 col-sm-6 colxs-12">
                We do not just do hair, “We Are HAIR.” We listen to your ideas and make them come alive. Any style, cut
                ,colour or even up style for a special occasion you want to achieve, we can make it happen. Whether by
                appointment or walk-in, our facility has highly-skilled specialists on-site to take care of you without
                a long wait.
                <div class="mt-5">
                        We do not just do hair, “We Are HAIR.” We listen to your ideas and make them come alive. Any
                        style, cut ,colour or even up style for a special occasion you want to achieve, we can make it
                        happen. Whether by appointment or walk-in, our facility has highly-skilled specialists on-site
                        to take care of you without a long wait.
                </div>
            </div>
            <div class="col-md-5 col-sm-6 colxs-12">
                <div class="sp-offer-v2">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100"
                                    src="<?php echo base_url() ?>assets/web/img/service/offer1.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100"
                                    src="<?php echo base_url() ?>assets/web/img/service/offer2.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100"
                                    src="<?php echo base_url() ?>assets/web/img/service/offer3.jpg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12 colxs-12">
                <div class="font-weight-bold text-white h5 mb-3 text-center">Hair Care Services</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 colxs-12">
                <hr>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    Blow Drying
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/woman-drying-hair-hairsalon.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                        Hair Cut
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/cut-hair.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    Hair Waves
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/hair-waves.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    Coloring
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/hair-coloring.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    Highlights/Foil
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/highlights.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    Conditioning Treatments
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/conditioning-treatments.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    Botox Treatment<br>( Depending on the length of the hair)
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/botox-treatment.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    Color Correction
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/color-correction.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    Updo for Special Occasions,<br> Weddings, Proms
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/weddings-proms.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="service-box-big">
                    <div class="overlay-1">
                    Wedding Parties welcome
                    </div>
                    <img src="<?php echo base_url() ?>assets/web/img/service/wedding-parties-welcome.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Footer Section Begin -->
<footer class="footer set-bg" data-setbg="<?php echo base_url() ?>assets/web/img/footer-bg.jpg">
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-lg-12 col-md-12 text-center">
                    <div class="copyright__text text-small">
                        <p class="text-small">Copyright © <script>
                            document.write(new Date().getFullYear());
                            </script>Copyright © 2015 Eman Salon. All rights reserved. | This design is made with <i
                                class="far fa-heart"></i> by <a href="https://timelino-12f7f.web.app/"
                                target="_blank">Timelino</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->