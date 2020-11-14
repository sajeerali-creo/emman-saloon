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
<header class="header">
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
                        <li><a data-toggle="modal" data-target="#appointment">Appointment</a></li>
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

<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="<?php echo base_url() ?>assets/web/img/bg.jpg">
            <div class="hero__text">
                <h2>Book your <br>Next services with Us</h2>
                <!-- <h4 class="text-white">Select where you want our Services</h4> -->
                <a href="<?php echo base_url() ?>map" class="primary-btn">Book Now</a>

                <div class="hero__social">
                    <a href="https://www.facebook.com/emansalondubai" target="_blank"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/emansalondubai" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/eman_salon/?ref=badge" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                </div>
                <a href="https://api.whatsapp.com/send?phone=971564849878&text=book%20your%20service%20though%20whatsap"
    class="watsap-icon">Chat with us for any appointments or enquiries</a>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- watsap -->
<!-- <a href="https://api.whatsapp.com/send?phone=971564849878&text=book%20your%20service%20though%20whatsapp"
    target="_blank" class="align-items-center d-flex text-decoration-none text-white watsap-button">
    <i class="fab fa-whatsapp h3"></i>
</a> -->
<!-- end watsap -->



<!-- Start of Async Drift Code -->
<script>
"use strict";

! function() {
    var t = window.driftt = window.drift = window.driftt || [];
    if (!t.init) {
        if (t.invoked) return void(window.console && console.error && console.error("Drift snippet included twice."));
        t.invoked = !0, t.methods = ["identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide",
                "off", "on"
            ],
            t.factory = function(e) {
                return function() {
                    var n = Array.prototype.slice.call(arguments);
                    return n.unshift(e), t.push(n), t;
                };
            }, t.methods.forEach(function(e) {
                t[e] = t.factory(e);
            }), t.load = function(t) {
                var e = 3e5,
                    n = Math.ceil(new Date() / e) * e,
                    o = document.createElement("script");
                o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src =
                    "https://js.driftt.com/include/" + n + "/" + t + ".js";
                var i = document.getElementsByTagName("script")[0];
                i.parentNode.insertBefore(o, i);
            };
    }
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('nz2h7vssyf3g');
</script>
<!-- End of Async Drift Code -->

<!-- appointment -->
<!-- Modal -->
<div class="modal fade" id="appointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="<?php echo base_url() ?>contactus" id="js-index-request-form-2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="txtName">Name</label>
                                <input type="text" class="form-control" id="txtName" name="txtName" required="required">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="txtEmail">E-mail</label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail"
                                    required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="txtName">Phone Number</label>
                                <input type="text" class="form-control" id="txtName" name="txtName" required="required">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="txtEmail">Select Service</label>
                                <select class="custom-select">
                                    <option selected>Face & Body care</option>
                                    <option value="1">Hair Care</option>
                                    <option value="2">Nail Care</option>
                                    <option value="3">Waxing</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="taMessage">Appointment Details</label>
                        <textarea class="form-control" id="taMessage" name="taMessage" rows="3"
                            required="required"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end appintment -->


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