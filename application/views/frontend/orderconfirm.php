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
                <ul class="nav">
                    <li class="nav-item"><?php
                        if(isset($frontLogin) && $frontLogin == true){
                            ?><a class="nav-link text-white" href="<?php echo base_url() ?>order-history" target="_blank">Booking History</a><?php
                        }
                    ?></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="small mt-4">
            Step 4 of 4
        </div>
        <div class="h3 text-gray-900 font-weight-bold">
            Confirm the Booking
        </div>


        <div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-9 mb-3">
                <form name="frmAddForm" id="frmAddForm" action="<?php echo base_url(); ?>save-order-confirm-info" method="post"  enctype="multipart/form-data">
                    <div>
                        <div class="col-md-12 text-gray-900 font-weight-bold">Address</div>
                        <div class="small d-block mt-2 col-md-12">
                            <i class="fas fa-map-marker-alt text-primary"></i>&nbsp;<?php echo $user_address; ?> <a href="<?php echo base_url() ?>map">Change</a>
                        </div>

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

                        <div class="form-group mt-3 col-md-12">
                            <label for="taOrderNotes" class="text-gray-900 font-weight-bold">Booking
                                Notes</label>
                            <textarea class="form-control" id="taOrderNotes" name="taOrderNotes" rows="3"
                                placeholder="Ex: bring card machine"></textarea>
                        </div>

                        <div class="col-md-12">
                            <div>
                                <button type="button" class="btn btn-primary d-flex align-items-center" id="btnConfirmOrder">
                                    <span class="text-white text-decoration-none">
                                        Confirm
                                    </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>


            <!-- bill -->
            <div class="col-md-3 mb-3" id="service-card-box">
                <div class="sticky-top">
                    <div class="card shadow">
                        <div class="card-header d-flex align-items-center justify-content-center">
                            <img src="<?php echo base_url() ?>assets/web/img/logo-black.png">
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

                                    ?><div class="card-single-item" id="card-item-<?php echo $arrValue['serviceId']; ?>"><div class="d-flex justify-content-between"><div><div class="font-weight-bold text-gray-900 card-persion-name"><?php echo $arrValue['name']; ?></div><div class="small card-persion-count">1h - <?php echo $arrValue['persion']; ?>person</div></div><div><div class="small text-right">From</div><div class="text-right font-weight-bold text-gray-900 card-persion-price">AED <?php echo $arrValue['price']; ?></div></div></div><div><hr></div></div><?php

                                    $totalPrice += ($arrValue['persion'] * $arrValue['price']);
                                }
                                $totalPrice += $totalPrice * 0.05;
                            ?></div>
                            <div class="d-flex justify-content-between hide-on-empty-cart" style="<?php echo $styleOfNonEmptyCartElement; ?>">
                                <div>
                                    <div class="font-weight-bold text-gray-900">Vat</div>
                                </div>
                                <div>
                                    <div class="text-right font-weight-bold text-gray-900">5%</div>
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
                            <div class="text-gray-900" id="card-total-price">
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