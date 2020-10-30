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
        $lstServicer[$value->team_id] = $value->team_id;
        $lstProduct[$value->team_id][] = $value->product_id;
        $hdCSPId[$value->team_id] = $value->cspId;
    }
}

//echo "<pre>"; print_r($lstProduct); die();  


?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<style>
#accordionSidebar,
#content nav.navbar {
    display: none;
}

.choices__list--dropdown {
    text-align: left;
}

.choices[data-type*=select-multiple] .choices__inner,
.choices[data-type*=text] .choices__inner {
    text-align: left;
}

.choices__placeholder {
    opacity: 1;
    color: #6e707e;
}

.choices__inner {
    background-color: #ffffff;
}
</style>
<div class="container mb-3">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3">
        <div class="text-primary f-24">Edit Booking</div>
        <a href="<?php echo base_url() ?>securepanel/booking" class="btn btn-dark">Back</a>
    </div>
    <div>
        <hr>
    </div>

    <div class="card text-white bg-dark mb-3 col-md-12">
        <div class="card-body">
            <h5 class="card-title">Customer Details</h5>
            <h6 class="card-subtitle mb-2 ">Name: <?php echo $name; ?></h6>
            <h6 class="card-subtitle mb-2 ">Email: <?php echo $email; ?></h6>
            <h6 class="card-subtitle mb-2 ">Phone: <?php echo $phone; ?></h6>
        </div>
    </div>
    <!-- end header -->
    <div class="row">
        <div class="mt-2 col-md-8">
            <form name="frmAddForm" id="frmAddForm" class="user"
                action="<?php echo base_url(); ?>securepanel/update-booking" method="post"
                enctype="multipart/form-data">
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
                            <input type="radio" id="rdServiceTypeHS" name="rdServiceType"
                                class="custom-control-input rdServiceType" <?php echo $checkedHS; ?> value="HS">
                            <label class="custom-control-label" for="rdServiceTypeHS">Home Service</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdServiceTypeSS" name="rdServiceType"
                                class="custom-control-input rdServiceType" <?php echo $checkedSS; ?> value="SS">
                            <label class="custom-control-label" for="rdServiceTypeSS">Saloon Service</label>
                        </div>
                    </div>
                </div>
                <!-- end type of services -->

                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <div id="div_service_count_main"><?php
                            $intCount = 1;
                            foreach ($lstService as $index => $serviceVal) {
                                ?><div id="div_service_count_<?php echo $intCount; ?>" class="row mb-2">
                                <div class="form-group col-md-12 col-sm-12 mb-2">
                                        <label class="text-primary">Select Service</label>
                                        <?php
                                        if($intCount > 1){
                                            ?>
                                        <span
                                            onclick="javascript: jsRemoveThis('div_service_count_<?php echo $intCount; ?>');"
                                            class="badge badge-danger ml-2"><i class="fas fa-trash-alt"></i> remove this service</span>
                                        <?php
                                        }
                                        ?>

                                    <select class="custom-select" name="lstService[]" id="lstService1" required>
                                        <option value="">Select</option><?php
                                            foreach ($serviceInfo as $key => $value) {
                                                ?><optgroup label="<?php echo $value['categoryName']; ?>"><?php
                                                    foreach ($value['services'] as $service) {
                                                        $strChecked = '';
                                                        if($serviceVal == $service['id']){
                                                            $strChecked = ' selected="selected" ';
                                                        }
                                                        ?><option value="<?php echo $service['id']; ?>"
                                                data-price="<?php echo $service['price']; ?>"
                                                <?php echo $strChecked; ?>><?php echo $service['title']; ?></option><?php
                                                    }
                                                ?></optgroup><?php
                                            }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group col-md-12 col-sm-12 mb-2">
                                    <input type="text" class="form-control number_only" name="txtPersonCount[]"
                                        id="txtPersonCount<?php echo $intCount; ?>"
                                        value="<?php echo $txtPersonCount[$index]; ?>" required
                                        placeholder="Number of Person">
                                    <input type="hidden" name="hdCartIds[]" value="<?php echo ($hdCartIds[$index]); ?>">
                                </div>
                            </div><?php
                                $intCount++;
                            }
                            ?>
                        </div>
                        <input type="hidden" name="hdServiceJsonInfo" id="hdServiceJsonInfo"
                            value='<?php echo(json_encode($serviceInfo)); ?>'>
                        <input type="hidden" name="hdServiceCount" id="hdServiceCount"
                            value="<?php echo ($intCount - 1); ?>">
                        <button type="button" class="btn btn-primary" id="btnAddMoreService">Add More Service</button>
                    </div>
                </div>


                <!-- Select date of Service -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Select date of Service</label>
                        <div class="date-picker">
                            <input type="date" class="form-control form-control-lg text-left" placeholder="mm/dd/yyyy"
                                style="text-align:center;" id="txtBookingDate" name="txtBookingDate"
                                value="<?php echo $txtBookingDate; ?>">
                        </div>
                    </div>
                </div>
                <!-- end Select date of Service -->

                <!-- Select time of Service -->
                <div class="row mb-2">
                    <div class="form-group col-md-12 col-sm-12">
                        <label class="text-primary">Select time of Service</label>
                        <div id="available-time-list"><?php 
                            
                            foreach ($arrTimeSlots as $key => $value) {
                                ?><button id="timeslot_<?php echo preg_replace('/[^0-9A-Za-z]/i', '', $value); ?>"
                                data-val="<?php echo $value; ?>" type="button"
                                class="btn <?php echo($hdAvailableTime == $value ? ' btn-primary ' : ' btn-outline-primary '); ?> mr-1 mb-1"><?php echo $value; ?></button><?php    
                            }

                            ?><input type="hidden" name="hdAvailableTime" id="hdAvailableTime"
                                value="<?php echo $hdAvailableTime; ?>">
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

                            if(count($lstServicer) > 0){
                                foreach ($lstServicer as $index => $teamId) {
                                ?><div id="div_servicer_product_<?php echo $intCount; ?>" class="row mb-2">
                                <div class="form-group col-md-12 col-sm-12 mb-2"><?php
                                        if($intCount > 1){
                                            ?><label class="text-primary">Beautician / Massager / Hairdresser</label>
                                                <span
                                                onclick="javascript: jsRemoveThis('div_servicer_product_<?php echo $intCount; ?>');"
                                                class="badge badge-danger"><i class="fas fa-trash-alt"></i> remove this service</span><?php
                                                }
                                                ?>
                                                
                                                <select class="custom-select" name="lstServicer[]"
                                                id="lstServicer<?php echo $intCount; ?>" required>
                                                <option value="">Select servicer</option><?php
                                                    foreach ($teamInfo as $key => $value) {
                                                        $strChecked = '';
                                                        if($teamId == $value['id']){
                                                            $strChecked = ' selected="selected" ';
                                                        }
                                                        ?><option value="<?php echo $value['id']; ?>"
                                                    <?php echo $strChecked; ?>><?php echo $value['name']; ?></option><?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 mb-2">
                                            <select class="custom-select lstProductChoice"
                                                name="lstProduct[<?php echo ($intCount - 1); ?>][]"
                                                id="lstProduct<?php echo $intCount; ?>" multiple>
                                                <option value="">Select Product</option><?php 
                                                    foreach ($productInfo as $key => $value) {
                                                        $strChecked = '';
                                                        foreach ($lstProduct[$index] as $valueProduct) {
                                                            if($valueProduct == $value['id']){
                                                                $strChecked = ' selected="selected" ';
                                                            }
                                                        }
                                                        ?><option value="<?php echo $value['id']; ?>"
                                                    <?php echo $strChecked; ?>><?php echo $value['title']; ?></option><?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="hdCSPId[]" value="<?php echo ($hdCSPId[$index]); ?>">
                                    </div><?php
                                    $intCount++;
                                }
                            }
                            else{
                                ?><div id="div_servicer_product_1" class="row mb-2">
                                    <div class="form-group col-md-12 col-sm-12 mb-2">
                                        <select class="custom-select" name="lstServicer[]" id="lstServicer1" required>
                                            <option value="">Select servicer</option><?php
                                            foreach ($teamInfo as $key => $value) {
                                                ?><option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option><?php
                                            }
                                        ?></select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 mb-2">
                                        <select class="custom-select lstProductChoice" name="lstProduct[0][]" id="lstProduct1" multiple>
                                            <option value="">Select Product</option><?php 
                                            foreach ($productInfo as $key => $value) {
                                                ?><option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option><?php
                                            }
                                        ?></select>
                                    </div>
                                    <input type="hidden" name="hdServicerJsonInfo" id="hdServicerJsonInfo" value='<?php echo(json_encode($teamInfo)); ?>'>
                                    <input type="hidden" name="hdProductJsonInfo" id="hdProductJsonInfo" value='<?php echo(json_encode($productInfo)); ?>'>
                                </div><?php
                                $intCount++;
                            }
                            
                        ?></div>
                        <input type="hidden" name="hdServicerJsonInfo" id="hdServicerJsonInfo"
                            value='<?php echo(json_encode($teamInfo)); ?>'>
                        <input type="hidden" name="hdProductJsonInfo" id="hdProductJsonInfo"
                            value='<?php echo(json_encode($productInfo)); ?>'>
                        <input type="hidden" name="hdServicerProductCount" id="hdServicerProductCount"
                            value="<?php echo ($intCount - 1); ?>">
                        <button type="button" class="btn btn-primary" id="btnAddMoreServicer">Add More Servicer</button>
                    </div>
                </div>
                <!-- end Beautician / Massager / Hairdresser -->

                <!-- If any service charge extra? -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">If any service charge extra?</label>
                        <input type="text" class="form-control number_only" id="txtServiceCharge"
                            name="txtServiceCharge" value="<?php echo $txtServiceCharge; ?>"
                            placeholder="Service Charge">
                    </div>
                </div>
                <!-- end If any service charge extra? -->
                <!-- If any discount? -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">If any Discount?(%)</label>
                        <input type="text" class="form-control number_only" id="txtDiscount" name="txtDiscount"
                            value="<?php echo $txtDiscount; ?>" placeholder="Discount">
                    </div>
                </div>
                <!-- end If any service charge extra? -->
                <!-- If any discount? -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Vat</label>
                        <input type="text" class="form-control number_only" id="txtVat" name="txtVat"
                            value="<?php echo $txtVat; ?>" placeholder="Vat Percentage">
                    </div>
                </div>
                <!-- end If any service charge extra? -->

                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <button id="btnUpdateBooking" class="btn btn-primary btn-lg btn-block">
                            <span class="text-white text-decoration-none">
                                Update & Confirm
                            </span>
                        </button>
                        <input type="hidden" value="<?php echo $bookingId; ?>" id="bookingId" name="bookingId" />
                    </div>
                </div>
            </form>
        </div>

        <!-- bill -->
        <!-- bill -->
        <div class="col-md-4 mb-3 mt-3 d-none">
            <div class="sticky-top">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center justify-content-center">
                        <img src="<?php echo base_url(); ?>assets/admin/img/logo-dark.png">
                    </div>
                    <!-- bill generated -->
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
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
                                <div class="text-right font-weight-bold text-gray-900">5%</div>
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
                                <div class="text-right font-weight-bold text-gray-900">AED 100</div>
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
                        <div class="text-gray-900 font-weight-bold">
                            AED 400.00
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12 col-sm-12 mt-2">
                        <button class="btn btn-success btn-lg btn-block">
                            <a href="date-select.html" class="text-white text-decoration-none">
                                <i class="fas fa-print"></i>&nbsp;Print Recipt
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>