<style>
#accordionSidebar,
#content nav.navbar {
    display: none;
}
</style>
<div class="container mb-3">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3">
        <div class="text-primary f-24">Add New Service</div>
        <a href="<?php echo base_url() ?>securepanel/services" class="btn btn-dark">Back</a>
    </div>
    <div>
        <hr>
    </div>
    <!-- end header -->
    <div class="row">
        <div class="mt-2 col-md-8">
            <form name="frmAddForm" id="frmAddForm" class="user"
                action="<?php echo base_url(); ?>securepanel/add-service-info" method="post"
                enctype="multipart/form-data"><?php
                $txtTitle = isset($txtTitle) ? $txtTitle : '';
                $txtPrice = isset($txtPrice) ? $txtPrice : '';
                ?>

                <!-- Type of services -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Type</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusAC" name="rdStatus" class="custom-control-input" checked
                                value="AC">
                            <label class="custom-control-label" for="rdStatusAC">Home</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusIN" name="rdStatus" class="custom-control-input" value="IN">
                            <label class="custom-control-label" for="rdStatusIN">Saloon</label>
                        </div>
                    </div>
                </div>
                <!-- name of services -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Name Of Service</label>
                        <input type="text" class="form-control" value="<?php echo $txtTitle; ?>" id="txtTitle"
                            name="txtTitle" maxlength="300" placeholder="Name" required>
                    </div>
                </div>
                <!-- end name of services -->

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Select Category</label>
                        <select class="custom-select" name="lstCategory" id="lstCategory">
                            <option selected>Select</option>
                            <?php 
                            $lstCategory = isset($lstCategory) ? $lstCategory : '';
                            foreach ($serviceCatInfo as $key => $objCat) {
                                $strChk = ($objCat->id == $lstCategory ? ' selected="selected"' : "");

                                ?><option value="<?php echo $objCat->id; ?>" <?php echo $strChk; ?>>
                                <?php echo $objCat->category_name; ?></option><?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <!-- end category -->

                <!-- Time -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Time Duration</label>
                        <select class="custom-select" name="lstCategory" id="lstCategory">
                            <option selected>Select</option>
                            <option selected>15 Min</option>
                            <option selected>30 Min</option>
                            <option selected>45 Min</option>
                            <option selected>60 Min</option>
                            <option selected>1:15 Min</option>
                            <option selected>1:30 Min</option>
                            <option selected>1:45 Min</option>
                            <option selected>2 hr</option>

                        </select>
                    </div>
                </div>
                <!-- end persons -->
                <!-- persons -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Price (AED)</label>
                        <input type="text" class="form-control" value="<?php echo $txtPrice; ?>" id="txtPrice"
                            name="txtPrice" maxlength="50" placeholder="AED" required>
                    </div>
                </div>
                <!-- end persons -->

                <!-- persons -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Service Chnarge (AED)</label>
                        <input type="text" class="form-control mb-1" id="txtPrice" name="txtPrice" maxlength="50"
                            placeholder="Dubai" required>
                        <input type="text" class="form-control mb-1" id="txtPrice" name="txtPrice" maxlength="50"
                            placeholder="Abu Dhabi" required>
                        <input type="text" class="form-control mb-1" id="txtPrice" name="txtPrice" maxlength="50"
                            placeholder="Sharjah" required>
                        <input type="text" class="form-control mb-1" id="txtPrice" name="txtPrice" maxlength="50"
                            placeholder="Al Ain" required>
                        <input type="text" class="form-control mb-1" id="txtPrice" name="txtPrice" maxlength="50"
                            placeholder="Ajman" required>
                        <input type="text" class="form-control mb-1" id="txtPrice" name="txtPrice" maxlength="50"
                            placeholder="RAK City" required>
                        <input type="text" class="form-control mb-1" id="txtPrice" name="txtPrice" maxlength="50"
                            placeholder="Fujairah" required>
                        <input type="text" class="form-control" id="txtPrice" name="txtPrice" maxlength="50"
                            placeholder="Umm Al Quwain" required>
                    </div>
                </div>
                <!-- end persons -->


                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Status</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusAC" name="rdStatus" class="custom-control-input" checked
                                value="AC">
                            <label class="custom-control-label" for="rdStatusAC">Active</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusIN" name="rdStatus" class="custom-control-input" value="IN">
                            <label class="custom-control-label" for="rdStatusIN">Inactive</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <span class="text-white text-decoration-none">
                                Create
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
<!-- End of Page Wrapper -->