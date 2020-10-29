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
            Step 2 of 4
        </div>
        <div class="h3 text-gray-900 font-weight-bold">
            Select Date & Time<br>
            <h6>Home Services</h6>
        </div>
        <div class="small d-block mt-2">
            <i class="fas fa-map-marker-alt text-primary"></i>&nbsp;<?php echo $user_address; ?> <a href="<?php echo base_url() ?>map">Change</a>
        </div>

        <div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-9 mb-3">
                <!-- select date -->
                <div class="wrapper">
                    <div class="inner">
                        <div class="mt-4 text-left h6 text-gray-900 mb-4 mt-5 font-weight-bold">Select Date
                        </div>
                        <div class="date-picker"><?php 
                            if(isset($cartDetailsInfo['dateselect']) && isset($cartDetailsInfo['dateselect']['date'])){
                                $defDate = $cartDetailsInfo['dateselect']['date'];
                            }
                            else{
                                $defDate = date("Y-m-d");
                            }
                            ?><input type="date" class="form-control form-control-lg text-left"
                                placeholder="mm/dd/yyyy" min='<?php echo date("Y-m-d"); ?>' style="text-align:center;" id="txtBookingDate" name="txtBookingDate" value="<?php echo $defDate; ?>">
                        </div>
                    </div>
                </div>
                <!-- end select date -->
                <div class="clearfix"></div>
                <div class="mt-7 text-left h6 text-gray-900 mb-4 font-weight-bold mt-5">Choose Available Time</div>
                <div class="d-flex"><?php 
                    if(isset($cartDetailsInfo['dateselect']) && isset($cartDetailsInfo['dateselect']['time'])){
                        $defTime = $cartDetailsInfo['dateselect']['time'];
                    }
                    else{
                        $defTime = '';
                    }
                    
                    ?><ul class="time-list" id="available-time-list">
                        <li class="not-avaialble">9:00 AM</li>
                        <li data-val="9:00 AM" <?php echo($defTime == "9:00 AM" ? ' class="active" ' : ''); ?>>9:00 AM</li>
                        <li data-val="9:30 AM"<?php echo($defTime == "9:30 AM" ? ' class="active" ' : ''); ?>>9:30 AM</li>
                        <li data-val="10:00 AM"<?php echo($defTime == "10:00 AM" ? ' class="active" ' : ''); ?>>10:00 AM</li>
                        <li data-val="10:30 AM"<?php echo($defTime == "10:30 AM" ? ' class="active" ' : ''); ?>>10:30 AM</li>
                        <li data-val="11:00 AM"<?php echo($defTime == "11:00 AM" ? ' class="active" ' : ''); ?>>11:00 AM</li>
                        <li data-val="11:30 AM"<?php echo($defTime == "11:30 AM" ? ' class="active" ' : ''); ?>>11:30 AM</li>
                        <li data-val="12:00 PM"<?php echo($defTime == "12:00 PM" ? ' class="active" ' : ''); ?>>12:00 PM</li>
                        <li data-val="12:30 PM"<?php echo($defTime == "12:30 PM" ? ' class="active" ' : ''); ?>>12:30 PM</li>
                        <li data-val="1:00 PM"<?php echo($defTime == "1:00 PM" ? ' class="active" ' : ''); ?>>1:00 PM</li>
                        <li data-val="1:30 PM"<?php echo($defTime == "1:30 PM" ? ' class="active" ' : ''); ?>>1:30 PM</li>
                        <li data-val="2:00 PM"<?php echo($defTime == "2:00 PM" ? ' class="active" ' : ''); ?>>2:00 PM</li>
                        <li data-val="2:30 PM"<?php echo($defTime == "2:30 PM" ? ' class="active" ' : ''); ?>>2:30 PM</li>
                        <li data-val="3:00 PM"<?php echo($defTime == "3:00 PM" ? ' class="active" ' : ''); ?>>3:00 PM</li>
                    </ul>
                    <input type="hidden" name="hdAvailableTime" id="hdAvailableTime" value="<?php echo $defTime; ?>">
                </div>
                <div>
                    <hr>
                </div>
                <button type="button" class="btn btn-lg btn-primary d-flex align-items-center" id="dateselect-continue">
                    <a href="javascript:;" data-href="<?php echo base_url() ?>add-personal-info" class="text-white text-decoration-none">Continue</a>
                </button>
            </div>


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