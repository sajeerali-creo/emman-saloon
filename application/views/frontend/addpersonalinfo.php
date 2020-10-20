<section>
    <!-- navigation -->
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>assets/web/img/logo.png" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarText">
                <ul class="nav"><?php
                    if(isset($frontLogin) && $frontLogin == true){
                        ?><li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url() ?>order-history">Booking History</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-dark" href="<?php echo base_url() ?>logout">Logout</a>
                        </li><?php
                    }
                ?></ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="small mt-4">
            Step 3 of 4
        </div>
        <div class="h3 text-gray-900 font-weight-bold">
            Enter Your Personal Details
        </div>
        <div class="small d-block mt-2">
            <i class="fas fa-map-marker-alt text-primary"></i>&nbsp;<?php echo $user_address; ?> <a href="<?php echo base_url() ?>map">Change</a>
        </div>

        <div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-9 mb-3"><?php
                if(!isset($frontLogin) || $frontLogin != true){
                    ?><form name="frmAddForm" id="frmAddForm" action="<?php echo base_url(); ?>save-personal-info" method="post"  enctype="multipart/form-data">
                        <div class="row">
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
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="txtFName">First Name</label>
                                <input type="text" class="form-control" id="txtFName" name="txtFName">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="txtLName">Last Name</label>
                                <input type="text" class="form-control" id="txtLName" name="txtLName">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="txtPhone">Phone</label>
                                <input type="tel" class="form-control" id="txtPhone" name="txtPhone" placeholder="+971">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="txtEmail">Email</label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="txtPassword">Password</label>
                                <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="txtCPassword">Confirm Password</label>
                                <input type="password" class="form-control" id="txtCPassword" name="txtCPassword">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="chkPrivacyPolicy">
                                    <label class="form-check-label" for="chkPrivacyPolicy">I agree to the privacy policy,
                                        website terms and booking terms</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div>
                                    <button type="button" class="btn btn-primary d-flex align-items-center" id="addpersoanalinfo-register">
                                        <a href="javascript:;" class="text-white text-decoration-none">Register</a>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-3 col-md-12">Already have a booker account <a href="<?php echo base_url(); ?>login?flfrm=chkot">Login</a>
                                now</div>
                        </div>
                    </form><?php
                }
                else{
                    ?><form name="frmAddForm" id="frmAddForm" action="<?php echo base_url(); ?>save-personal-info-only" method="post"  enctype="multipart/form-data">
                        <div class="row">
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
                            </div>
                        </div><?php

                        $txtFName = '';
                        $txtLName = '';
                        $txtPhone = '';
                        $txtEmail = '';

                        if(isset($cartUserInfo) && !empty($cartUserInfo)){
                            
                            if(isset($cartUserInfo['txtFName'])){
                                $txtFName = $cartUserInfo['txtFName'];
                            }
                            if(isset($cartUserInfo['txtLName'])){
                                $txtLName = $cartUserInfo['txtLName'];
                            }
                            if(isset($cartUserInfo['txtPhone'])){
                                $txtPhone = $cartUserInfo['txtPhone'];
                            }
                            if(isset($cartUserInfo['txtEmail'])){
                                $txtEmail = $cartUserInfo['txtEmail'];
                            }
                        }
                        
                        ?><div class="row">
                            <div class="form-group col-md-6">
                                <label for="txtFName">First Name</label>
                                <input type="text" class="form-control" id="txtFName" name="txtFName" value="<?php echo $txtFName; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="txtLName">Last Name</label>
                                <input type="text" class="form-control" id="txtLName" name="txtLName" value="<?php echo $txtLName; ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="txtPhone">Phone</label>
                                <input type="tel" class="form-control" id="txtPhone" name="txtPhone" placeholder="+971" value="<?php echo $txtPhone; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="txtEmail">Email</label>
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" aria-describedby="emailHelp" value="<?php echo $txtEmail; ?>">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="chkPrivacyPolicy">
                                    <label class="form-check-label" for="chkPrivacyPolicy">I agree to the privacy policy,
                                        website terms and booking terms</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div>
                                    <button type="button" class="btn btn-lg btn-primary d-flex align-items-center" id="addpersoanalinfo-continue">
                                        <a href="javascript:;" class="text-white text-decoration-none">continue</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form><?php
                }
            ?></div>


            <!-- bill -->
            <div class="col-md-3 mb-3" id="service-card-box">
                <div class="sticky-top">
                    <div class="card shadow">
                        <div class="card-header d-flex align-items-center justify-content-center">
                        <img src="<?php echo base_url() ?>assets/web/img/logo-dark.png" style="width:51px;">
                        </div><?php


                        if(isset($selectedService["serviceids"]) && !empty($selectedService["serviceids"])){
                            $styleOfEmptyCartElement = ' display:none !important; ';
                            $styleOfNonEmptyCartElement = '';
                        }
                        else{
                            $styleOfEmptyCartElement = '';
                            $styleOfNonEmptyCartElement = ' display:none !important; ';
                        }

                        ?><!-- bill generated -->
                        <div class="card-body">
                            <div class="card-item-custom hide-on-empty-cart" style="<?php echo $styleOfNonEmptyCartElement; ?>"><?php 
                                $totalPrice = 0;
                                foreach ($selectedService["serviceids"] as $key => $arrValue) {
                                    if(empty($arrValue) || is_null($arrValue)) continue;

                                    ?><div class="card-single-item" id="card-item-<?php echo $arrValue['serviceId']; ?>"><div class="d-flex justify-content-between"><div><div class="font-weight-bold text-gray-900 card-persion-name"><?php echo $arrValue['name']; ?></div><div class="small card-persion-count"><?php echo $arrValue['persion']; ?>person</div></div><div><div class="small text-right">From</div><div class="text-right font-weight-bold text-gray-900 card-persion-price">AED <?php echo $arrValue['price']; ?></div></div></div><div><hr></div></div><?php

                                    $totalPrice += ($arrValue['persion'] * $arrValue['price']);
                                }
                                $totalPrice += $totalPrice * 0.05;
                            ?></div>
                            <div class="d-flex justify-content-between hide-on-empty-cart" style="<?php echo $styleOfNonEmptyCartElement; ?>">
                                <div>
                                    <div class="text-gray-900">Vat</div>
                                </div>
                                <div>
                                    <div class="text-right text-gray-900">5%</div>
                                </div>
                            </div>

                            <!-- no bill generated -->
                            <div class="p-5 text-center show-on-empty-cart" style="<?php echo $styleOfEmptyCartElement; ?>">
                                No services selected yet
                            </div>
                        </div>

                        

                        <div class="card-footer text-muted d-flex justify-content-between hide-on-empty-cart" style="<?php echo $styleOfNonEmptyCartElement; ?>">
                            <div class="font-weight-bold text-gray-900">
                                Total
                            </div>
                            <div class="font-weight-bold text-gray-900" id="card-total-price">
                                AED <?php echo $totalPrice; ?>
                            </div>
                        </div>
                    </div>

                    <!-- button -->
                    <!-- <button class="btn btn-primary btn-lg btn-block mt-3">
                    Book Now
                </button> -->
                </div>
            </div>
        </div>

    </div>



</section>