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
                ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="small mt-4">
            Step 1 of 4
        </div>
        <div class="h3 text-gray-900 font-weight-bold">
            Select Services<br>
            <h6>Home Services</h6>
        </div>
        <div class="small d-block mt-2">
            <i class="fas fa-map-marker-alt text-primary"></i>&nbsp;<?php echo $user_address; ?> <a
                href="<?php echo base_url() ?>map">Change</a>
        </div>
        <div class="row mt-5">
            <!-- service list -->
            <div class="col-md-3 mb-3 service-category">
                <div class="card sticky-top">
                    <ul class="list-group"><?php 

                        $flFirst = true;
                        foreach ($serviceRecords as $key => $arrSer) {
                            $key1 = strtolower($key);
                            $id = preg_replace("/[^a-zA-Z0-9]/i", '', $key1);

                            if($flFirst){
                                ?><li class="list-group-item active all_services">
                                    <a href="javascript:;" data-catid="" data-firstcat="cat_<?php echo $id; ?>">All</a>
                                </li><?php
                            }

                            ?><li class="list-group-item">
                                <a href="#<?php echo $id; ?>" data-catid="cat_<?php echo $id; ?>"><?php echo ucwords($key1); ?></a>
                            </li><?php

                            $flFirst = false;
                        }

                    ?></ul>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <!-- filter -->
                <div>
                    <?php 
                    /*echo "<pre>";
                    print_r($selectedService["serviceids"]);

                    
                    die();*/
                    foreach ($serviceRecords as $key => $arrSer) {
                        $key1 = strtolower($key);
                        $id = preg_replace("/[^a-zA-Z0-9]/i", '', $key1);

                        ?><div class="h6 font-weight-bold mb-3 chk-service-head bg-secondary p-2 text-white rounded cat_<?php echo $id; ?>"
                        id="<?php echo $id; ?>"><?php echo $key; ?></div><?php

                        foreach ($arrSer as $value) {

                            if(isset($selectedService["serviceids"][$value->id])){
                                $strCheck = ' checked="checked"';
                                $strPerson = $selectedService["serviceids"][$value->id]["persion"];
                                $strPersonBoxDisplay = "";
                            }
                            else{
                                $strCheck = "";
                                $strPerson = "0";
                                $strPersonBoxDisplay = "none";
                            }
                            ?>
                            <!-- loop -->
                            <div class="card mb-1 p-3 chk-service-card service-card-<?php echo $value->id; ?> cat_<?php echo $id; ?>">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="text-gray-600 font-weight-bold">
                                               <!-- offer -->
                                               <div class="sp-offer">Special Offer</div>
                                            <!-- end offer -->
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input chkService"
                                                    id="customCheck<?php echo $value->id; ?>" name="chkService"
                                                    value="<?php echo $value->id; ?>" data-label="<?php echo $value->title; ?>"
                                                    data-persion='<?php echo $strPerson; ?>'
                                                    data-price="<?php echo $value->price; ?>" <?php echo $strCheck; ?>>
                                                <label class="custom-control-label"
                                                    for="customCheck<?php echo $value->id; ?>"><?php echo $value->title; ?></label>
                                            </div>

                                         
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-right">From</div>
                                        <div class="text-gray-600 h6 font-weight-bold text-right">AED
                                            <?php echo $value->price; ?></div>
                                        <div class="persion-count badge badge-success"
                                            style="display: <?php echo $strPersonBoxDisplay; ?>; cursor: pointer;"><small
                                                class="fas fa-pen text-small"></small>&nbsp;<span><?php echo $strPerson; ?></span>person
                                        </div>
                                    </div>
                                </div>
                            </div><?php
                        }
                    }
                    ?>
                </div>
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

                        ?>
                        <!-- bill generated -->
                        <div class="card-body">
                            <div class="card-item-custom hide-on-empty-cart"
                                style="<?php echo $styleOfNonEmptyCartElement; ?>"><?php 
                                $totalPrice = 0;
                                foreach ($selectedService["serviceids"] as $key => $arrValue) {
                                    if(empty($arrValue) || is_null($arrValue)) continue;

                                    ?><div class="card-single-item"
                                    id="card-item-<?php echo $arrValue['serviceId']; ?>">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="font-weight-bold text-gray-900 card-persion-name">
                                                <?php echo $arrValue['name']; ?></div>
                                            <div class="small card-persion-count">
                                                <?php echo $arrValue['persion']; ?>person</div>
                                        </div>
                                        <div>
                                            <div class="small text-right">From</div>
                                            <div class="text-right font-weight-bold text-gray-900 card-persion-price">
                                                AED <?php echo $arrValue['price']; ?></div>
                                        </div>
                                    </div>
                                    <div>
                                        <hr>
                                    </div>
                                </div><?php

                                    $totalPrice += ($arrValue['persion'] * $arrValue['price']);
                                }

                                $totalPrice += $totalPrice * 0.05;
                            ?></div>
                            <div class="d-flex justify-content-between hide-on-empty-cart"
                                style="<?php echo $styleOfNonEmptyCartElement; ?>">
                                <div>
                                    <div class="text-gray-900">Vat</div>
                                </div>
                                <div>
                                    <div class="text-right text-gray-900">5%</div>
                                </div>
                            </div>

                            <!-- no bill generated -->
                            <div class="p-5 text-center show-on-empty-cart"
                                style="<?php echo $styleOfEmptyCartElement; ?>">
                                No services selected yet
                            </div>
                        </div>



                        <div class="card-footer text-muted d-flex justify-content-between hide-on-empty-cart"
                            style="<?php echo $styleOfNonEmptyCartElement; ?>">
                            <div class="font-weight-bold text-gray-900">
                                Total
                            </div>
                            <div class="text-gray-900 font-weight-bold" id="card-total-price">
                                AED <?php echo $totalPrice; ?>
                            </div>
                        </div>
                    </div>

                    <!-- button -->
                    <button class="btn btn-primary btn-lg btn-block mt-3 hide-on-empty-cart" id="service-booknow"
                        style="<?php echo $styleOfNonEmptyCartElement; ?>">
                        <a href="javascript:;" data-href="<?php echo base_url() ?>date-select"
                            class="text-white text-decoration-none">
                            Book Now
                        </a>
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body d-flex justify-content-center text-center">
                        <div class="small d-block mt-2">
                            <!-- No. of Persons -->
                            <div class="text-center h6 text-gray-900 mb-4 font-weight-bold">No. of Persons</div>
                            <div class="wrapper d-flex align-items-center mb-3">
                                <div class="control shadow" id="minus">-</div>
                                <div id="number">0</div>
                                <div class="control shadow" id="plus">+</div>
                            </div>
                            <!-- end No. of Persons -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnCloseService" class="btn btn-dark"
                            data-dismiss="modal">Close</button>
                        <button type="button" id="btnCancelService" class="btn btn-dark"
                            data-dismiss="modal">Cancel</button>
                        <button type="button" id="btnConfirmService" class="btn btn-primary"
                            data-dismiss="modal">Confirm</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- delet services -->
        <div class="modal fade" id="delete-service" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center f-24">
                        Are you sure?
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary">Yes</button>
                        <input type="hidden" name="hdDeleteRecordId" id="hdDeleteRecordId">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>