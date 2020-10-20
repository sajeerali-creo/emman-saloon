<style>
    #accordionSidebar,
    #content nav.navbar{
        display: none;
    }
</style><div class="container mb-3">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3">
        <div class="text-primary f-24">Add New Team Member</div>
        <a href="<?php echo base_url(); ?>securepanel/team" class="btn btn-dark">Back</a>
    </div>
    <div>
        <hr>
    </div>
    <!-- end header -->
    <div class="row">
        <div class="mt-2 col-md-12">
            <form name="frmAddForm" id="frmAddForm" class="user" action="<?php echo base_url(); ?>securepanel/add-team-info" method="post"  enctype="multipart/form-data"><?php
                
                $txtFName           = isset($txtFName) ? $txtFName : '';
                $txtLName          = isset($txtLName) ? $txtLName : '';
                $lstLevel           = isset($lstLevel) ? $lstLevel : '';
                $lstGender          = isset($lstGender) ? $lstGender : '';
                $txtJoiningDate     = isset($txtJoiningDate) ? $txtJoiningDate : '';
                $txtExperience      = isset($txtExperience) ? $txtExperience : '';
                $lstCommission      = isset($lstCommission) ? $lstCommission : '';
                $txtBasicSalary     = isset($txtBasicSalary) ? $txtBasicSalary : '';
                $txtHourlyRate      = isset($txtHourlyRate) ? $txtHourlyRate : '';
                $txtTaxation        = isset($txtTaxation) ? $txtTaxation : '';
                $txtPhone           = isset($txtPhone) ? $txtPhone : '';
                $txtEmail           = isset($txtEmail) ? $txtEmail : '';
                $txtAdress          = isset($txtAdress) ? $txtAdress : '';
                $txtPostCode        = isset($txtPostCode) ? $txtPostCode : '';
                $lstPositioning     = isset($lstPositioning) ? $lstPositioning : '';
                $chkCapabilities    = isset($chkCapabilities) ? $chkCapabilities : array();
                $rdStatus           = isset($rdStatus) ? $rdStatus : "AC";

                ?><div class="p-2 bg-dark mb-2 text-white">Personal Details</div>

                <!-- name of services -->
                <!-- <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">ID</label>
                        <input type="text" class="form-control" id="disabledTextInput" placeholder="D123456"
                            disabled>
                    </div>
                </div> -->
                <!-- end name of services -->

                <!-- name of services -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">First Name</label>
                        <input type="text" class="form-control" id="txtFName" name="txtFName" value="<?php echo $txtFName; ?>" placeholder="First Name"
                            required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Last Name</label>
                        <input type="text" class="form-control" id="txtLName" name="txtLName" value="<?php echo $txtLName; ?>" placeholder="Last Name"
                            required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Level</label>
                        <select class="custom-select" name="lstLevel" id="lstLevel">
                            <option value="">Select</option><?php
                            foreach ($arrLevel as $key => $value) {
                                $strSelected = ($lstLevel == $key ? ' selected="selected" ' : '');

                                ?><option value="<?php echo $key; ?>"<?php echo $strSelected; ?>><?php echo $value; ?></option><?php
                            }
                        ?></select>
                    </div>
                </div>
                <!-- end name of services -->

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Gender</label>
                        <select class="custom-select" name="lstGender" id="lstGender">
                            <option value="">Select</option><?php
                            foreach ($arrGender as $key => $value) {
                                $strSelected = ($lstGender == $key ? ' selected="selected" ' : '');

                                ?><option value="<?php echo $key; ?>"<?php echo $strSelected; ?>><?php echo $value; ?></option><?php
                            }
                        ?></select>
                    </div>
                </div>
                <!-- end category -->

                <div class="p-2 bg-dark mb-2 text-white">Pay Details</div>


                <!-- Joining Date -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Joining Date</label>
                        <div class="date-picker">
                            <input type="date" class="form-control form-control-lg text-left"
                                placeholder="mm/dd/yyyy" style="text-align:center;" id="txtJoiningDate" name="txtJoiningDate" value="<?php echo $txtJoiningDate; ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Experience</label>
                        <input type="text" class="form-control" id="txtExperience" name="txtExperience" value="<?php echo $txtExperience; ?>" placeholder="Experience" required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Commission</label>
                        <select class="custom-select" name="lstCommission" id="lstCommission">
                            <option value="">Select</option><?php
                            foreach ($arrCommission as $key => $value) {
                                $strSelected = ($lstCommission == $key ? ' selected="selected" ' : '');

                                ?><option value="<?php echo $key; ?>"<?php echo $strSelected; ?>><?php echo $value; ?></option><?php
                            }
                        ?></select>
                    </div>
                </div>
                <!-- end Joining Date -->

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Basic Salary (AED)</label>
                        <input type="text" class="form-control"  id="txtBasicSalary" name="txtBasicSalary" value="<?php echo $txtBasicSalary; ?>" placeholder="AED"
                            required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Hourly Rate (AED)</label>
                        <input type="text" class="form-control"  id="txtHourlyRate" name="txtHourlyRate" value="<?php echo $txtHourlyRate; ?>" placeholder="AED"
                            required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Taxation</label>
                        <input type="text" class="form-control"  id="txtTaxation" name="txtTaxation" value="<?php echo $txtTaxation; ?>" placeholder="Taxation"
                            required>
                    </div>

                </div>
                <!-- end category -->
                <div class="p-2 bg-dark mb-2 text-white">Address & Details</div>


                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Phone</label>
                        <input type="tel" class="form-control"  id="txtPhone" name="txtPhone" value="<?php echo $txtPhone; ?>" placeholder="Phone"
                            required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Email</label>
                        <input type="email" class="form-control"  id="txtEmail" name="txtEmail" value="<?php echo $txtEmail; ?>" placeholder="Email"
                            required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Adress/ Street</label>
                        <input type="text" class="form-control"  id="txtAdress" name="txtAdress" value="<?php echo $txtAdress; ?>" placeholder="Adress/ Street"
                            required>
                    </div>
                </div>
                <!-- end category -->

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Post Code</label>
                        <input type="text" class="form-control"  id="txtPostCode" name="txtPostCode" value="<?php echo $txtPostCode; ?>" placeholder="Post Code"
                            required>
                    </div>
                </div>
                <!-- end category -->


                <div class="p-2 bg-dark mb-2 text-white">Appointment Book</div>

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Positioning <small>(Room Number)</small></label>
                        <select class="custom-select" name="lstPositioning" id="lstPositioning">
                            <option value="">Select</option><?php
                            foreach ($arrPositioning as $key => $value) {
                                $strSelected = ($lstPositioning == $key ? ' selected="selected" ' : '');

                                ?><option value="<?php echo $key; ?>"<?php echo $strSelected; ?>><?php echo $value; ?></option><?php
                            }
                        ?></select>
                    </div>
                </div>
                <!-- end category -->

                <!-- capability -->
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label class="text-primary">Capabilities <small class="text-gray">(Select
                                Multtiple)</small></label>
                    </div><?php
                    $totCap = count($arrCapabilities);
                    $intCnt = 0;

                    ?><div class="form-group col-md-4 col-sm-12"><?php
                    foreach ($arrCapabilities as $key => $value) {
                        if(ceil($totCap / 2) == $intCnt){
                            ?></div>
                            <div class="form-group col-md-4 col-sm-12"><?php
                        }
                        $strChecked = (in_array($key, $chkCapabilities) ? ' checked="checked"' : '')
                        ?><div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="chkCap<?php echo $key; ?>" name="chkCapabilities[]" value="<?php echo $key; ?>"<?php echo $strChecked; ?>>
                            <label class="custom-control-label" for="chkCap<?php echo $key; ?>"><?php echo $value; ?></label>
                        </div><?php

                        $intCnt++; 
                    }

                    ?></div>
                </div>
                <!-- end capability --><?php

                if($rdStatus == 'AC'){
                    $checkedAC = 'checked';
                    $checkedIN = '';
                }
                else{
                    $checkedAC = '';
                    $checkedIN = 'checked';
                }
                ?><div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Status</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusAC" name="rdStatus"
                                class="custom-control-input" <?php echo $checkedAC; ?> value="AC">
                            <label class="custom-control-label" for="rdStatusAC">Avaialble</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusIN" name="rdStatus"
                                class="custom-control-input" <?php echo $checkedIN; ?> value="IN">
                            <label class="custom-control-label" for="rdStatusIN">Off</label>
                        </div>
                    </div>
                </div>

                <div>
                    <hr>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 col-sm-12">
                        <button class="btn btn-primary btn-lg btn-block">
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