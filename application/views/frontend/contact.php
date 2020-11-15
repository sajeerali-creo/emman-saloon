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
                            <li><a data-toggle="modal" data-target="#appointment">Appointment</a></li>
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
            <div class="col-md-7 col-sm-12 col-xs-12">
                <div class="row flash-message-box">
                    <div class="col-md-12">
                        <?php
                            $this->load->helper('form');
                            $error = $this->session->flashdata('error');
                            if($error)
                            {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error'); ?>                    
                        </div>
                        <?php } ?>
                        <?php  
                            $success = $this->session->flashdata('success');
                            if($success)
                            {
                        ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                        <?php } ?>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <form  method="POST" action="<?php echo base_url() ?>contactus" id="js-index-request-form-2">
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
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtSubject">Subject</label>
                        <input type="text" class="form-control" id="txtSubject" name="txtSubject" required="required">
                    </div>
                    <div class="form-group">
                        <label for="taMessage">Message</label>
                        <textarea class="form-control" id="taMessage" name="taMessage" rows="3" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12 details-c">
                <div>
                    <a href="tel:+97143480009" class="d-flex">
                        <i class="fas fa-phone-square-alt"></i>
                        <span>+971 4 348 0009</span>
                    </a>
                </div>
                <div>
                    <a href="tel:+97143480009">
                        <i class="fas fa-mobile"></i>
                        <span>+971 56 484 9879</span>
                    </a>
                </div>
                <div>
                    <a href="mailto:info@emansalon.com" class="d-flex">
                        <i class="fas fa-envelope-square"></i>
                        <span>info@emansalon.com</span>
                    </a>
                </div>
                <div>
                    <a href="www.emansalon.com" class="d-flex">
                        <i class="fas fa-globe-africa"></i>
                        </span>www.emansalon.com</span>
                    </a>
                </div>
<div>
    <span>Business Hours</span>

    <span class="d-flex">
        <span class="w-30">Sunday</span>
        <span>10:00AM - 8:00PM</span>
    </span>

    <span class="d-flex">
        <span class="w-30">Sunday</span>
        <span>10:00AM - 8:00PM</span>
    </span>

    <span class="d-flex">
        <span class="w-30">Monday</span>
        <span>10:00AM - 8:00PM</span>
    </span>

    <span class="d-flex">
        <span class="w-30">Tuesday</span>
        <span>10:00AM - 8:00PM</span>
    </span>

    <span class="d-flex">
        <span class="w-30">Wednesday</span>
        <span>10:00AM - 8:00PM</span>
    </span>

    <span class="d-flex">
        <span class="w-30">Thursday</span>
        <span>10:00AM - 8:00PM</span>
    </span>

    <span class="d-flex">
        <span class="w-30">Friday</span>
        <span>10:00AM - 8:00PM</span>
    </span>

    <span class="d-flex">
        <span class="w-30">Saturday</span>
        <span>10:00AM - 8:00PM</span>
    </span>

</div>
                <!-- <div class="d-flex"> -->
                    <!-- <i class="fas fa-map-marker-alt"></i> -->
                    <!-- <span>
                        United Arab Emirates
                        Al Wasl Road - Umm Suquiem 2
                        Villa 1084
                    </span> -->
                <!-- </div> -->
                <div class="d-flex">
                    <div class="hero__social">
                        <a href="https://www.facebook.com/emansalondubai" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/emansalondubai" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/eman_salon/?ref=badge" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>


        </div>

    </div>

</section>

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