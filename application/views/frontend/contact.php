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
                            <li><a href="<?php echo base_url() ?>services">Services</a></li>
                            <li><a href="https://emansalon.com/gallery-style/">Gallery</a></li>
                            <li><a href="<?php echo base_url() ?>contact" class="active-menu">Contact Us</a></li>
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

    <div class="banner-about contact">
        <div>Contact Us</div>
    </div>

    <div class="container mt-5">

        <div class="row mt-5">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <form action="">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Name</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                   >
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">E-mail</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                   >
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlInput1">Subject</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                          >
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Message</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 details-c">
                <div>
                    <a href="" class="d-flex">
                        <i class="fas fa-phone-square-alt"></i>
                        <span>+971 4 348 0009</span>
                    </a>
                </div>
                <div>
                    <a href="">
                        <i class="fas fa-mobile"></i>
                        <span>+971 4 348 0009</span>
                    </a>
                </div>
                <div>
                    <a href="" class="d-flex">
                        <i class="fas fa-envelope-square"></i>
                        <span>info@emansalon.com</span>
                    </a>
                </div>
                <div>
                    <a href="" class="d-flex">
                        <i class="fas fa-globe-africa"></i>
                        </span>www.emansalon.com</span>
                    </a>
                </div>
                <div class="d-flex">
                    <i class="fas fa-clock"></i>
                    <span>at - Thu 10:00am - 8:00 pm</span>
                </div>
                <div class="d-flex">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>
                        United Arab Emirates
                        Al Wasl Road - Umm Suquiem 2
                        Villa 1084
                    </span>
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