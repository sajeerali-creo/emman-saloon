<?php
$teamId = $teamInfo->id;
$txtFName = isset($txtFName) ? $txtFName : $teamInfo->first_name;
$txtLName = isset($txtLName) ? $txtLName : $teamInfo->last_name;
$lstLevel = isset($lstLevel) ? $lstLevel : $teamInfo->level;
$lstGender = isset($lstGender) ? $lstGender : $teamInfo->gender;
$txtJoiningDate = isset($txtJoiningDate) ? $txtJoiningDate : $teamInfo->joining_date;
$txtExperience = isset($txtExperience) ? $txtExperience : $teamInfo->experience;
$lstCommission = isset($lstCommission) ? $lstCommission : $teamInfo->commission;
$txtBasicSalary = isset($txtBasicSalary) ? $txtBasicSalary : $teamInfo->basic_salary;
$txtHourlyRate = isset($txtHourlyRate) ? $txtHourlyRate : $teamInfo->hourly_rate;
$txtTaxation = isset($txtTaxation) ? $txtTaxation : $teamInfo->taxation;
$txtPhone = isset($txtPhone) ? $txtPhone : $teamInfo->phone;
$txtEmail = isset($txtEmail) ? $txtEmail : $teamInfo->email;
$txtAdress = isset($txtAdress) ? $txtAdress : $teamInfo->address;
$txtPostCode = isset($txtPostCode) ? $txtPostCode : $teamInfo->post_code;
$lstPositioning = isset($lstPositioning) ? $lstPositioning : $teamInfo->positioning;
$chkCapabilities = isset($chkCapabilities) ? $chkCapabilities : json_decode($teamInfo->capabilities, 1);
$rdStatus = isset($rdStatus) ? $rdStatus : $teamInfo->status;

?><div class="container mb-3">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3">
        <div class="text-primary f-24">Detail: <?php echo $txtFName . " " . $txtLName; ?></div>
        <a href="<?php echo base_url(); ?>securepanel/team" class="btn btn-dark">Back</a>
    </div>
    <div>
        <hr>
    </div>
    <!-- end header -->
    <div class="row">
        <div class="mt-2 col-md-12">
            <form class="user">
                <div class="p-2 bg-dark mb-2 text-white">Personal Details</div>

                <!-- name of services -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">ID</label>
                        <input type="text" class="form-control" id="disabledTextInput" placeholder="ES<?php echo $teamId; ?>"
                            disabled>
                    </div>
                </div>
                <!-- end name of services -->

                <!-- name of services -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">First Name</label>
                        <input type="text" class="form-control" id="txtFName" name="txtFName" value="<?php echo $txtFName; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Last Name</label>
                        <input type="text" class="form-control" id="txtLName" name="txtLName" value="<?php echo $txtLName; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Level</label>
                        <input type="text" class="form-control" id="lstLevel" name="lstLevel" value="<?php echo $arrLevel[$lstLevel]; ?>" disabled>
                    </div>
                </div>
                <!-- end name of services -->

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Gender</label>
                        <input type="text" class="form-control" id="lstGender" name="lstGender" value="<?php echo $arrGender[$lstGender]; ?>" disabled>
                    </div>
                </div>
                <!-- end category -->

                <div class="p-2 bg-dark mb-2 text-white">Pay Details</div>


                <!-- Joining Date -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Joining Date</label>
                        <input type="text" class="form-control" id="txtJoiningDate" name="txtJoiningDate" value="<?php echo $txtJoiningDate; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Experience</label>
                        <input type="text" class="form-control" id="txtExperience" name="txtExperience" value="<?php echo $txtExperience; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Commission</label>
                        <input type="text" class="form-control" id="lstCommission" name="lstCommission" value="<?php echo $arrCommission[$lstCommission]; ?>" disabled>
                    </div>
                </div>
                <!-- end Joining Date -->

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Basic Salary (AED)</label>
                        <input type="text" class="form-control" id="txtBasicSalary" name="txtBasicSalary" value="<?php echo $txtBasicSalary; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Hourly Rate (AED)</label>
                        <input type="text" class="form-control" id="txtHourlyRate" name="txtHourlyRate" value="<?php echo $txtHourlyRate; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Taxation</label>
                        <input type="text" class="form-control" id="txtTaxation" name="txtTaxation" value="<?php echo $txtTaxation; ?>" disabled>
                    </div>

                </div>
                <!-- end category -->

                <div class="p-2 bg-dark mb-2 text-white">Address & Details</div>

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Phone</label>
                        <input type="text" class="form-control" id="txtPhone" name="txtPhone" value="<?php echo $txtPhone; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Email</label>
                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $txtEmail; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Adress/ Street</label>
                        <input type="text" class="form-control" id="txtAdress" name="txtAdress" value="<?php echo $txtAdress; ?>" disabled>
                    </div>
                </div>
                <!-- end category -->

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Post Code</label>
                        <input type="text" class="form-control" id="txtPostCode" name="txtPostCode" value="<?php echo $txtPostCode; ?>" disabled>
                    </div>
                </div>
                <!-- end category -->


                <div class="p-2 bg-dark mb-2 text-white">Appointment Book</div>

                <!-- category -->
                <div class="row mb-2">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Positioning <small>(Room Number)</small></label>
                        <input type="text" class="form-control" id="lstPositioning" name="lstPositioning" value="<?php echo $arrPositioning[$lstPositioning]; ?>" disabled>
                    </div>
                </div>
                <!-- end category -->

                <!-- capability -->
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label class="text-primary">Capabilities <small class="text-gray">(Select
                                Multtiple)</small></label>
                    </div>
                    <div class="form-group col-md-4 col-sm-12"><?php
                        foreach ($chkCapabilities as $key => $value) {
                            ?><div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck<?php echo $value; ?>" value="<?php echo $value; ?>" checked disabled>
                                <label class="custom-control-label" for="customCheck<?php echo $value; ?>" ><?php echo $arrCapabilities[$value]; ?></label>
                            </div><?php
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
                                class="custom-control-input" <?php echo $checkedAC; ?> value="AC" disabled>
                            <label class="custom-control-label" for="rdStatusAC">Avaialble</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusIN" name="rdStatus"
                                class="custom-control-input" <?php echo $checkedIN; ?> value="IN" disabled>
                            <label class="custom-control-label" for="rdStatusIN">Off</label>
                        </div>
                    </div>
                </div>

                <div>
                    <hr>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 col-sm-12">
                        <a href="<?php echo base_url().'securepanel/edit-team/' . $teamId; ?>" class="text-white text-decoration-none">
                            <div class="btn btn-primary btn-lg btn-block">
                                Edit
                            </div>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Page Wrapper -->