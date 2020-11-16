<?php
$serviceId          = $serviceInfo->id;
$txtTitle           = isset($txtTitle) ? $txtTitle : $serviceInfo->title;
$txtTitleAr           = isset($txtTitleAr) ? $txtTitleAr : $serviceInfo->title_ar;
$lstCategory        = isset($lstCategory) ? $lstCategory : $serviceInfo->category_id;
$txtPrice           = isset($txtPrice) ? $txtPrice : $serviceInfo->price;
$rdStatus           = isset($rdStatus) ? $rdStatus : $serviceInfo->status;
$rdServiceType      = isset($rdServiceType) ? $rdServiceType : $serviceInfo->type;
$rdServiceSpecial   = isset($rdServiceSpecial) ? $rdServiceSpecial : $serviceInfo->fl_special;
$lstDuration        = isset($lstDuration) ? $lstDuration : $serviceInfo->time_duration;


?><style>
    #accordionSidebar,
    #content nav.navbar{
        display: none;
    }
</style><div class="container mb-3">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3">
        <div class="text-primary f-24">Edit Service</div>
        <a href="<?php echo base_url() ?>securepanel/services" class="btn btn-dark">Back</a>
    </div>
    <div>
        <hr>
    </div>
    <!-- end header -->
    <div class="row">
        <div class="mt-2 col-md-8">
            <form class="user" action="<?php echo base_url() ?>securepanel/update-service" method="post" id="editDocument" role="form" enctype="multipart/form-data"><?php

                if($rdServiceType == 'home'){
                    $checkedHome = 'checked';
                    $checkedSaloon = '';
                }
                else{
                    $checkedHome = '';
                    $checkedSaloon = 'checked';
                }
                ?><!-- Type of services -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Type</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdServiceTypeHome" <?php echo $checkedHome; ?> name="rdServiceType" class="custom-control-input" checked="checked" value="home">
                            <label class="custom-control-label" for="rdServiceTypeHome">Home</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdServiceTypeSaloon" <?php echo $checkedSaloon; ?> name="rdServiceType" class="custom-control-input" value="saloon">
                            <label class="custom-control-label" for="rdServiceTypeSaloon">Saloon</label>
                        </div>
                    </div>
                </div><?php

                if($rdServiceSpecial == 'N'){
                    $checkedNormal = 'checked';
                    $checkedSpecial = '';
                }
                else{
                    $checkedNormal = '';
                    $checkedSpecial = 'checked';
                }
                ?><!-- Type of services -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdServiceSpecialN" <?php echo $checkedNormal; ?> name="rdServiceSpecial" class="custom-control-input" checked="checked" value="N">
                            <label class="custom-control-label" for="rdServiceSpecialN">Normal Service</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdServiceSpecialY" <?php echo $checkedSpecial; ?> name="rdServiceSpecial" class="custom-control-input" value="Y">
                            <label class="custom-control-label" for="rdServiceSpecialY">Special Service</label>
                        </div>
                    </div>
                </div>
                <!-- name of services -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Name Of Service</label>
                        <input type="text" class="form-control" value="<?php echo $txtTitle; ?>" id="txtTitle" name="txtTitle" maxlength="250" placeholder="Name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Name Of Service in Arabic</label>
                        <input type="text" class="form-control" value="<?php echo $txtTitleAr; ?>" id="txtTitleAr" name="txtTitleAr" maxlength="250" placeholder="Name in Arabic">
                    </div>
                </div>
                <!-- end name of services -->

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Select Category</label>
                        <select class="custom-select" name="lstCategory" id="lstCategory">
                            <?php 
                            foreach ($serviceCatInfo as $key => $objCat) {
                                $strChk = ($objCat->id == $lstCategory ? ' selected="selected"' : "");

                                ?><option value="<?php echo $objCat->id; ?>"<?php echo $strChk; ?>><?php echo $objCat->category_name; ?></option><?php
                            }
                        ?></select>
                    </div>
                </div>
                <!-- end category -->
                <!-- Time -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Time Duration</label>
                        <select class="custom-select" name="lstDuration" id="lstDuration" required="required">
                            <option value="">Select</option>
                            <option value="1" <?php echo($lstDuration == 1 ? ' selected ' : ''); ?>>15 Min</option>
                            <option value="2" <?php echo($lstDuration == 2 ? ' selected ' : ''); ?>>30 Min</option>
                            <option value="3" <?php echo($lstDuration == 3 ? ' selected ' : ''); ?>>45 Min</option>
                            <option value="4" <?php echo($lstDuration == 4 ? ' selected ' : ''); ?>>60 Min</option>
                            <option value="5" <?php echo($lstDuration == 5 ? ' selected ' : ''); ?>>1 hr 15 Min</option>
                            <option value="6" <?php echo($lstDuration == 6 ? ' selected ' : ''); ?>>1 hr 30 Min</option>
                            <option value="7" <?php echo($lstDuration == 7 ? ' selected ' : ''); ?>>1 hr 45 Min</option>
                            <option value="8" <?php echo($lstDuration == 8 ? ' selected ' : ''); ?>>2 hr</option>

                        </select>
                    </div>
                </div>

                <!-- persons -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Price (AED)</label>
                        <input type="text" class="form-control" value="<?php echo $txtPrice; ?>" id="txtPrice" name="txtPrice" maxlength="50" placeholder="AED" required>
                    </div>
                </div>
                <!-- end persons -->
                <!-- persons -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Service Charges (AED)</label><?php
                        /*echo "<pre>";
                        print_r($serviceChargeInfo);
                        die();*/
                        foreach ($arrCluster as $key => $value) {
                            $serviceChargeInfo[$key] = (isset($serviceChargeInfo[$key]) ? $serviceChargeInfo[$key] : '');

                            $txtServicePrice   = $serviceChargeInfo[$key];
                            ?><input type="text" class="form-control mb-1 number_only" id="txtServicePrice_<?php echo $key; ?>" name="txtServicePrice[<?php echo $key; ?>]" maxlength="50" value="<?php echo $txtServicePrice; ?>" placeholder="<?php echo $value; ?>" title="<?php echo $value; ?>"><?php
                        }
                    ?></div>
                </div>
                <!-- end persons --><?php
                if($rdStatus == 'AC'){
                    $checkedAC = 'checked';
                    $checkedIN = '';
                }
                else{
                    $checkedAC = '';
                    $checkedIN = 'checked';
                }
                ?><div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusAC" name="rdStatus"
                                class="custom-control-input" <?php echo $checkedAC; ?> value="AC">
                            <label class="custom-control-label" for="rdStatusAC">Active</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusIN" name="rdStatus"
                                class="custom-control-input" <?php echo $checkedIN; ?> value="IN">
                            <label class="custom-control-label" for="rdStatusIN">Inactive</label>
                        </div>
                    </div>
                </div>


                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <input type="hidden" value="<?php echo $serviceId; ?>" id="serviceId"  name="serviceId" />   
                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            <span class="text-white text-decoration-none">
                                Update
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
<!-- End of Page Wrapper -->