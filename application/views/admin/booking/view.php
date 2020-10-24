<?php
$bookingId = $bookingInfo['info']['cartMasterId'];
$name = $bookingInfo['info']['first_name'] . " " . $bookingInfo['info']['last_name'];
$email = $bookingInfo['info']['email'];
$phone = $bookingInfo['info']['phone'];

$rdServiceType = isset($rdServiceType) ? $rdServiceType : ($bookingInfo['info']['booking_type'] == 'home' ? 'HS' : 'SS');
$txtBookingDate = isset($txtBookingDate) ? $txtBookingDate : $bookingInfo['info']['service_date'];
$hdAvailableTime = isset($hdAvailableTime) ? $hdAvailableTime : $bookingInfo['info']['service_time'];
$txtServiceCharge = isset($txtServiceCharge) ? $txtServiceCharge : $bookingInfo['info']['service_charge'];
$txtDiscount = isset($txtDiscount) ? $txtDiscount : $bookingInfo['info']['discount_price'];
$txtVat = isset($txtVat) ? $txtVat : $bookingInfo['info']['vat'];

if(!isset($lstService)){
    $lstService = array();
    $txtPersonCount = array();
    $hdCartIds = array();
    foreach ($bookingInfo['serviceAllInfo'] as $key => $value) {
        $lstService[] = $value['service_id'];
        $txtPersonCount[] = $value['person'];
        $hdCartIds[] = $value['cartId'];
    }
}

if(!isset($lstServicer)){
    $lstServicer = array();
    $lstProduct = array();
    $hdCSPId = array();
    foreach ($bookingTeamProductInfo as $key => $value) {
        $lstServicer[] = $value->team_id;
        $lstProduct[] = $value->product_id;
        $hdCSPId[] = $value->cspId;
    }
}


?><style>
    @media print {
        /* Hide everything in the body when printing... */
        /*body.printing * { display: none; }*/
        body.printing #accordionSidebar,
        body.printing #content .nav,
        body.printing #content #pageSellProduct .hide-print{
            display: none;
        }
        /* ...except our special div. */
        body.printing #print-me { display: block; }
    }

    @media screen {
        /* Hide the special layer from the screen. */
        #print-me { display: none; }
    }
</style>
<style>
    #accordionSidebar,
    #content nav.navbar{
        display: none;
    }
</style><div class="container mb-3" id="pageViewBooking">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3 hide-print">
        <div class="text-primary f-24 hide-print">Edit Booking</div>
        <a href="<?php echo base_url() ?>securepanel/booking" class="btn btn-dark hide-print">Back</a>
    </div>
    <div class=" hide-print">
        <hr>
    </div>

    <div class="card text-white bg-dark mb-3 col-md-12 hide-print">
        <div class="card-body">
            <h5 class="card-title">Customer Details</h5>
            <h6 class="card-subtitle mb-2 ">Name: <?php echo $name; ?></h6>
            <h6 class="card-subtitle mb-2 ">Email: <?php echo $email; ?></h6>
            <h6 class="card-subtitle mb-2 ">Phone: <?php echo $phone; ?></h6>
        </div>
    </div>
    <!-- end header -->
    <div class="row">
        <div class="mt-2 col-md-8 hide-print">
            <form name="frmAddForm" id="frmAddForm" class="user" action="<?php echo base_url(); ?>securepanel/confirm-booking" method="post"  enctype="multipart/form-data">
                <!-- type of services -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Select Service Type</label>
                        <div class="clearfix"></div><?php

                        if($rdServiceType == 'HS'){
                            $checkedHS = 'checked';
                            $checkedSS = '';
                        }
                        else{
                            $checkedHS = '';
                            $checkedSS = 'checked';
                        }

                        ?><div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdServiceTypeHS" name="rdServiceType" class="custom-control-input" <?php echo $checkedHS; ?> value="HS">
                            <label class="custom-control-label" for="rdServiceTypeHS">Home Service</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdServiceTypeSS" name="rdServiceType" class="custom-control-input" <?php echo $checkedSS; ?> value="SS">
                            <label class="custom-control-label" for="rdServiceTypeSS">Saloon Service</label>
                        </div>
                    </div>
                </div>
                <!-- end type of services -->

                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <div id="div_service_count_main"><?php
                            $intCount = 1;
                            $arrSelectedServiceInfo = array();
                            foreach ($lstService as $index => $serviceVal) {
                                ?><div id="div_service_count_<?php echo $intCount; ?>" class="row mb-2">
                                    <div class="form-group col-md-12 col-sm-12 mb-2">
                                        <label class="text-primary">Select Service</label>
                                        <select class="custom-select" name="lstService[]" id="lstService1" required>
                                            <option value="">Select</option><?php
                                            foreach ($serviceInfo as $key => $value) {
                                                ?><optgroup label="<?php echo $value['categoryName']; ?>"><?php
                                                    foreach ($value['services'] as $service) {
                                                        $strChecked = '';
                                                        if($serviceVal == $service['id']){
                                                            $strChecked = ' selected="selected" ';
                                                            $arrSelectedServiceInfo[$index]['service'] = $service;
                                                        }
                                                        ?><option value="<?php echo $service['id']; ?>" data-price="<?php echo $service['price']; ?>" <?php echo $strChecked; ?>><?php echo $service['title']; ?></option><?php
                                                    }
                                                ?></optgroup><?php
                                            }
                                        ?></select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 mb-2">
                                        <input type="text" class="form-control" name="txtPersonCount[]" id="txtPersonCount<?php echo $intCount; ?>" value="<?php echo $txtPersonCount[$index]; ?>" required placeholder="Number of Person">
                                        <input type="hidden" name="hdCartIds[]" value="<?php echo ($hdCartIds[$index]); ?>">
                                    </div>
                                </div><?php
                                $arrSelectedServiceInfo[$index]['person'] = $txtPersonCount[$index];
                                $intCount++;
                            }
                            ?>
                        </div>
                        <input type="hidden" name="hdServiceJsonInfo" id="hdServiceJsonInfo" value='<?php echo(json_encode($serviceInfo)); ?>'>
                        <input type="hidden" name="hdServiceCount" id="hdServiceCount" value="<?php echo ($intCount - 1); ?>">
                    </div>
                </div>  


                <!-- Select date of Service -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Select date of Service</label>
                        <div class="date-picker">
                            <input type="date" class="form-control form-control-lg text-left" placeholder="mm/dd/yyyy" style="text-align:center;" id="txtBookingDate" name="txtBookingDate" value="<?php echo $txtBookingDate; ?>">
                        </div>
                    </div>
                </div>
                <!-- end Select date of Service -->

                <!-- Select time of Service -->
                <div class="row mb-2">
                    <div class="form-group col-md-12 col-sm-12">
                        <label class="text-primary">Select time of Service</label>
                        <div id="available-time-list">
                            <button data-val="<?php echo $hdAvailableTime; ?>" type="button" class="btn btn-primary mr-1 mb-1"><?php echo $hdAvailableTime; ?></button>
                            <input type="hidden" name="hdAvailableTime" id="hdAvailableTime" value="<?php echo $hdAvailableTime; ?>">
                        </div>
                    </div>
                </div>
                <!-- end Select time of Service -->


                <!-- Beautician / Massager / Hairdresser -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Beautician / Massager / Hairdresser<br>
                            <small class="text-gray-600">you can select multiple servicer</small>
                        </label>
                        <div id="div_servicer_product_main"><?php
                            $intCount = 1;
                            foreach ($lstServicer as $index => $teamId) {
                                ?><div id="div_servicer_product_<?php echo $intCount; ?>" class="row mb-2">
                                    <div class="form-group col-md-12 col-sm-12 mb-2"><?php
                                        if($intCount > 1){
                                            ?><label class="text-primary">Beautician / Massager / Hairdresser</label><?php
                                        }
                                        ?><select class="custom-select" name="lstServicer[]" id="lstServicer<?php echo $intCount; ?>" required>
                                            <option value="">Select servicer</option><?php
                                            foreach ($teamInfo as $key => $value) {
                                                $strChecked = '';
                                                if($teamId == $value['id']){
                                                    $strChecked = ' selected="selected" ';
                                                }
                                                ?><option value="<?php echo $value['id']; ?>" <?php echo $strChecked; ?>><?php echo $value['name']; ?></option><?php
                                            }
                                        ?></select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 mb-2">
                                        <select class="custom-select" name="lstProduct[]" id="lstProduct<?php echo $intCount; ?>">
                                            <option value="">Select Product</option><?php 
                                            foreach ($productInfo as $key => $value) {
                                                $strChecked = '';
                                                if($lstProduct[$index] == $value['id']){
                                                    $strChecked = ' selected="selected" ';
                                                }

                                                ?><option value="<?php echo $value['id']; ?>" <?php echo $strChecked; ?>><?php echo $value['title']; ?></option><?php
                                            }
                                        ?></select>
                                    </div>
                                    <input type="hidden" name="hdCSPId[]" value="<?php echo ($hdCSPId[$index]); ?>">
                                </div><?php
                                $intCount++;
                            }
                        ?></div>
                        <input type="hidden" name="hdServicerJsonInfo" id="hdServicerJsonInfo" value='<?php echo(json_encode($teamInfo)); ?>'>
                        <input type="hidden" name="hdProductJsonInfo" id="hdProductJsonInfo" value='<?php echo(json_encode($productInfo)); ?>'>
                        <input type="hidden" name="hdServicerProductCount" id="hdServicerProductCount" value="<?php echo ($intCount - 1); ?>">
                    </div>
                </div>
                <!-- end Beautician / Massager / Hairdresser -->

                <!-- If any service charge extra? -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">If any service charge extra?</label>
                        <input type="text" class="form-control" id="txtServiceCharge" name="txtServiceCharge" value="<?php echo $txtServiceCharge; ?>" placeholder="Service Charge" >
                    </div>
                </div>
                <!-- end If any service charge extra? -->
                <!-- If any discount? -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">If any Discount?</label>
                        <input type="text" class="form-control" id="txtDiscount" name="txtDiscount" value="<?php echo $txtDiscount; ?>" placeholder="Discount">
                    </div>
                </div>
                <!-- end If any service charge extra? -->
                <!-- If any discount? -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Vat</label>
                        <input type="text" class="form-control" id="txtVat" name="txtVat" value="<?php echo $txtVat; ?>" placeholder="Vat Percentage">
                    </div>
                </div>
                <!-- end If any service charge extra? -->

                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <button  id="btnConfirmBooking" class="btn btn-primary btn-lg btn-block">
                            <span class="text-white text-decoration-none">
                                Confirm
                            </span>
                        </button>
                        <input type="hidden" value="<?php echo $bookingId; ?>" id="bookingId"  name="bookingId" /> 
                    </div>
                </div>
            </form>
        </div>

        <!-- bill -->
        <!-- bill -->
        <div class="col-md-4 mb-3 mt-3">
            <div class="sticky-top">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center justify-content-center">
                        <img src="<?php echo base_url(); ?>assets/admin/img/logo-dark.png">
                    </div>
                    <!-- bill generated -->
                    <div class="card-body"><?php
                        /*echo "<pre>";
                        print_r($arrSelectedServiceInfo);
                        die();*/
                        $intTotal = 0;
                        foreach ($arrSelectedServiceInfo as $key => $arrValue) {
                            ?><div class="d-flex justify-content-between">
                                <div>
                                    <div class="font-weight-bold text-gray-900"><?php echo $arrValue['service']['title']; ?></div>
                                    <div class="small"><?php echo $arrValue['person']; ?>person</div>
                                </div>
                                <div>
                                    <div class="text-right font-weight-bold text-gray-900">AED <?php echo $arrValue['service']['price']; ?></div>
                                </div>
                            </div>
                            <div>
                                <hr>
                            </div><?php

                            $intTotal += $arrValue['person'] * $arrValue['service']['price'];
                        }
                        ?><div class="d-flex justify-content-between">
                            <div>
                                <div class="font-weight-bold text-gray-900"> Hair Cut Full</div>
                                <div class="small">1person</div>
                            </div>
                            <div>
                                <div class="text-right font-weight-bold text-gray-900">AED 300</div>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <!-- vat -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="font-weight-bold text-gray-900">Vat</div>
                            </div>
                            <div>
                                <div class="text-right font-weight-bold text-gray-900"><?php echo $txtVat; ?>%</div>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <!-- service charge -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="font-weight-bold text-gray-900">Service Charge</div>
                            </div>
                            <div>
                                <div class="text-right font-weight-bold text-gray-900">AED <?php echo $txtServiceCharge; ?></div>
                            </div>
                        </div>
                    </div>
                    <!-- no bill generated -->
                    <!-- <div class="card-body">
                            <div class="p-5 text-center">
                                No services selected yet
                            </div>
                        </div> -->
                    <div class="card-footer text-muted d-flex justify-content-between">
                        <div class="font-weight-bold text-gray-900">
                            Total
                        </div>
                        <div class="text-gray-900 font-weight-bold"><?php
                            $intTotal += $txtServiceCharge;
                            $intTotal += ($intTotal * ($txtVat / 100));
                            ?>AED <?php echo $intTotal; ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12 col-sm-12 mt-2">
                        <button class="btn btn-success btn-lg btn-block" id="btnSellProductPrint">
                            <span class="text-white text-decoration-none">
                                <i class="fas fa-print"></i>&nbsp;Print Recipt
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="print-me" class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</div>