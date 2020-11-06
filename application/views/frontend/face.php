<section class="bg-dark">
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
                            <li><a href="https://emansalon.com/gallery-style/">Gallery</a></li>
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

    <div class="banner-about face">
        <div>Face & Body Care</div>
    </div>

    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12 colxs-12">
                <div class="font-weight-bold text-white h5 mb-3">Body Care</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 col-sm-6 colxs-12">
                PHYTOMER Body gives our spa what we want and that is benefit and solutions to our daily body
                challenges.<br><br>

                PHYTOMER range contains the greatest source of available natural ingredients and with the marine mask
                products and combine of body massage this help eliminate toxins, break down fat or re-invigorate skin
                tissues.<br><br>

                We have carefully chosen products that are suited for the different skin types and different sculpt of
                our bodies.
                <div class="row mt-5">
                    <div class="col-md-12 col-sm-12 colxs-12">
                        <div class="font-weight-bold text-white h5 mb-3">Facial Care</div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-7 col-sm-6 colxs-12">
                        PHYTO Facial Expert:<br><br>

                        The highly sensorial and relaxing context of PHYTOMER treatments Increases the
                        scientifically-proven
                        skincare benefits.
                    </div>
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
                <div class="font-weight-bold text-white h5 mb-3 text-center">PHYTOMER B0DY SERVICES</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 colxs-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 colxs-12 mb-3">
                <img class="d-block w-100" src="<?php echo base_url() ?>assets/web/img/service/cool-down-body.jpg">
                <div class="p-5 bg-dark1">
                    <div class="text-white h4 mt-2 mb-2">Cool-Down Treatment</div>
                    <div>
                        A relaxing massage of the back, scalp and feet, combined with
                        detoxifying marine products.
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 colxs-12 mb-3">
                <img class="d-block w-100" src="<?php echo base_url() ?>assets/web/img/service/salt-crystal.jpg">
                <div class="p-5 bg-dark1">
                    <div class="text-white h4 mt-2 mb-2">Salt Crystal Exfoliation
                    </div>
                    <div>
                        Exfoliation with salt crystals combined with a moisturizing
                        massage for an express beautifying treatment that leaves the
                        skin soft and silky.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12 colxs-12">
                <div class="font-weight-bold text-white h5 mb-3 text-center">3 KINDS OF BODY WRAPS</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 colxs-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 colxs-12 mb-3">
                <img class="d-block w-100" src="<?php echo base_url() ?>assets/web/img/service/body-wrap.jpg">
                <div class="p-5 bg-dark1 h-290px">
                    <div class="text-white h4 mt-2 mb-2">Body Wrap And Massage</div>
                    <div>
                        A choice of 3 high-performance marine body wraps combined
                        with a complete body massage to help eliminate toxins, break
                        down fat or re-invigorate skin tissues.
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 colxs-12 mb-3">
                <img class="d-block w-100" src="<?php echo base_url() ?>assets/web/img/service/firming-wrap-2-2.jpg">
                <div class="p-5 bg-dark1 h-290px">
                    <div class="text-white h4 mt-2 mb-2">Firming WRAP
                    </div>
                    <div>
                        A highly active gel wrap is applied and then massaged in order
                        to firm the skin, tighten tissues and combat skin slackening.
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 colxs-12 mb-3">
                <img class="d-block w-100" src="<?php echo base_url() ?>assets/web/img/service/Douceur-Marine.jpg">
                <div class="p-5 bg-dark1 h-290px">
                    <div class="text-white h4 mt-2 mb-2">Target Treatment for Abs-Buttocks-Thighs
                    </div>
                    <div>
                        An intensive localized treatment on the abdomen, buttocks and
                        thighs to beat excess fat and cellulite in record time.
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12 colxs-12">
                <div class="font-weight-bold text-white h5 mb-3 text-center bg-primary p-3">All body treatments our 60
                    minutes</div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12 colxs-12">
                <div class="font-weight-bold text-white h5 text-center">PHYTOMER FACIALSEXPERT TREATMENTS</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 colxs-12">
                <div class="h6 text-center text-gray">Face & Body Care</div>
                <div class=" h6 text-center text-gray">The highly sensorial and relaxing context of PHYTOMER treatments
                </div>
                <div class=" h6 text-center text-gray">Increases the scientifically-proven skincare benefits. </div>
                <div class=" h6 text-center text-gray">Below are the 5 Facial Care Services.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 colxs-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 colxs-12 mb-3">
                <img class="d-block w-100"
                    src="<?php echo base_url() ?>assets/web/img/service/marine-breeze-facial.jpg">
                <div class="p-5 bg-dark1 h-290px">
                    <div class="text-white h6 mt-2 mb-2">MARINE BREEZE</div>
                    <div class="text-white h5 mt-2 mb-2">Pollution Shield Treatment</div>
                    <div>
                        A real breath of oxygen to the skin: shine is reduced as the skin is cleansed and detoxified to
                        regain all of its luminosity.
                    </div>
                    <div class="text-white h6 mt-2 mb-2">75 minutes</div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 colxs-12 mb-3">
                <img class="d-block w-100"
                    src="<?php echo base_url() ?>assets/web/img/service/extened-youth-facial.jpg">
                <div class="p-5 bg-dark1 h-290px">
                    <div class="text-white h6 mt-2 mb-2">EXTENDED YOUTH</div>
                    <div class="text-white h5 mt-2 mb-2">Wrinkle Correction Firming Treatment</div>
                    <div>
                        Three key steps in a very high-performance treatment to resurface the skin, fill wrinkles and
                        restructure the face. After only 1 treatment, wrinkles are visibly reduced and the skin is
                        firmer.
                    </div>
                    <div class="text-white h6 mt-2 mb-2">75 minutes</div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4 col-sm-6 colxs-12 mb-3">
                <img class="d-block w-100" src="<?php echo base_url() ?>assets/web/img/service/Sea-water-facial.jpg">
                <div class="p-5 bg-dark1 h-290px">
                    <div class="text-white h6 mt-2 mb-2">SEA WATER </div>
                    <div class="text-white h5 mt-2 mb-2">Plumping Moisturizing Treatment</div>
                    <div>
                        It gives your skin an intense moisturizing soak.
                    </div>
                    <div class="text-white h6 mt-2 mb-2">60 minutes</div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 colxs-12 mb-3">
                <img class="d-block w-100" src="<?php echo base_url() ?>assets/web/img/service/Douceur-Marine.jpg">
                <div class="p-5 bg-dark1 h-290px">
                    <div class="text-white h6 mt-2 mb-2">DOUCEUR MARINE</div>
                    <div class="text-white h5 mt-2 mb-2">Comforting Soothing Treatment</div>
                    <div>
                        A halo of softness for skin that is sensitive or subject to redness.
                        This cocoon treatment soften the skin, improves its defense for a soothed and ideally hydrated
                        complexion.
                    </div>
                    <div class="text-white h6 mt-2 mb-2">60 minutes</div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 colxs-12 mb-3">
                <img class="d-block w-100" src="<?php echo base_url() ?>assets/web/img/service/White-Lumination.jpg">
                <div class="p-5 bg-dark1 h-290px">
                    <div class="text-white h6 mt-2 mb-2">WHITE LUMINATION</div>
                    <div class="text-white h5 mt-2 mb-2">Brightening Radiance Treatment

                    </div>
                    <div>
                        An immediate burst of radiance the reduction of dark spots and the brightening of the complexion
                        with total satisfaction.
                    </div>
                    <div class="text-white h6 mt-2 mb-2">60 minutes</div>
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