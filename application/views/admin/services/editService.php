<?php
$serviceId = $serviceInfo->id;
$txtTitle = isset($txtTitle) ? $txtTitle : $serviceInfo->title;
$lstCategory = isset($lstCategory) ? $lstCategory : $serviceInfo->category_id;
$txtPrice = isset($txtPrice) ? $txtPrice : $serviceInfo->price;
$rdStatus = isset($rdStatus) ? $rdStatus : $serviceInfo->status;


?><div class="container mb-3">
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
            <form class="user" action="<?php echo base_url() ?>securepanel/update-service" method="post" id="editDocument" role="form" enctype="multipart/form-data">
                <!-- name of services -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Name Of Service</label>
                        <input type="text" class="form-control" value="<?php echo $txtTitle; ?>" id="txtTitle" name="txtTitle" maxlength="300" placeholder="Name" required>
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

                <!-- persons -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Price (AED)</label>
                        <input type="text" class="form-control" value="<?php echo $txtPrice; ?>" id="txtPrice" name="txtPrice" maxlength="50" placeholder="AED" required>
                    </div>
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