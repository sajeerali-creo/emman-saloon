<?php
$supplierId     = $supplierInfo->id;
$txtTitle       = isset($txtTitle) ? $txtTitle : $supplierInfo->title;
$txtCountry     = isset($txtCountry) ? $txtCountry : $supplierInfo->country;
$txtCity        = isset($txtCity) ? $txtCity : $supplierInfo->city;
$txtPostCode    = isset($txtPostCode) ? $txtPostCode : $supplierInfo->postcode;
$txtPhone       = isset($txtPhone) ? $txtPhone : $supplierInfo->phone;
$txtFax         = isset($txtFax) ? $txtFax : $supplierInfo->fax;
$txtWeb         = isset($txtWeb) ? $txtWeb : $supplierInfo->web;
$txtEmail       = isset($txtEmail) ? $txtEmail : $supplierInfo->email;
$txtCatogory    = isset($txtCatogory) ? $txtCatogory : $supplierInfo->category;
$rdStatus       = isset($rdStatus) ? $rdStatus : $supplierInfo->status;

?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
/>
<style>
    #accordionSidebar,
    #content nav.navbar{
        display: none;
    }
</style><div class="container mb-3">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3">
        <div class="text-primary f-24">Edit Suppliers</div>
        <a href="<?php echo base_url(); ?>securepanel/suppliers" class="btn btn-dark">Back</a>
    </div>
    <div>
        <hr>
    </div>
    <!-- end header -->
    <div class="row">
        <div class="mt-2 col-md-12">
            <form class="user" action="<?php echo base_url() ?>securepanel/update-supplier" method="post" id="editDocument" role="form" enctype="multipart/form-data">
                <!-- Name Of Supplers -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Name Of Supplers</label>
                        <input type="text" class="form-control" id="txtTitle" name="txtTitle" value="<?php echo $txtTitle; ?>" placeholder="- - -" required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Country</label>
                        <input type="text" class="form-control" id="txtCountry" name="txtCountry" value="<?php echo $txtCountry; ?>" placeholder="- - -" required>
                    </div>
                </div>
                <!-- end Name Of Supplers -->

                <!-- City -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">City</label>
                        <input type="text" class="form-control" id="txtCity" name="txtCity" value="<?php echo $txtCity; ?>" placeholder="- - -" required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Post Code</label>
                        <input type="text" class="form-control" id="txtPostCode" name="txtPostCode" value="<?php echo $txtPostCode; ?>" placeholder="- - -" required>
                    </div>
                </div>
                <!-- end City -->

                <!-- Phone -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Phone</label>
                        <input type="tel" class="form-control" id="txtPhone" name="txtPhone" value="<?php echo $txtPhone; ?>" placeholder="- - -" required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Fax</label>
                        <input type="tel" class="form-control" id="txtFax" name="txtFax" value="<?php echo $txtFax; ?>" placeholder="- - -" required>
                    </div>
                </div>

                <!-- Web -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Web</label>
                        <input type="text" class="form-control" id="txtWeb" name="txtWeb" value="<?php echo $txtWeb; ?>" placeholder="- - -" required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Email</label>
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $txtEmail; ?>" placeholder="- - -" required>
                    </div>
                </div>
                <!-- end Web -->

                <!-- Catogory -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Catogory</label>
                        <input type="text" class="form-control" id="txtCatogory" name="txtCatogory" value="<?php echo $txtCatogory; ?>" placeholder="- - -" required>
                    </div>
                </div>
                <!-- end Web --><?php

                if($rdStatus == 'AC'){
                    $checkedAC = 'checked';
                    $checkedIN = '';
                }
                else{
                    $checkedAC = '';
                    $checkedIN = 'checked';
                }
                ?><div class="row mb-2">
                    <div class="form-group col-md-12 col-sm-12">
                        <label class="text-primary">Status</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusAC" name="rdStatus"
                                class="custom-control-input" <?php echo $checkedAC; ?> value="AC">
                            <label class="custom-control-label" for="rdStatusAC">In Stock</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusIN" name="rdStatus"
                                class="custom-control-input" <?php echo $checkedIN; ?> value="IN">
                            <label class="custom-control-label" for="rdStatusIN">Out of Stock</label>
                        </div>
                    </div>
                </div>


                <div class="row mb-2">
                    <div class="col-md-4 col-sm-12">
                        <input type="hidden" value="<?php echo $supplierId; ?>" id="supplierId"  name="supplierId" />  
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
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>