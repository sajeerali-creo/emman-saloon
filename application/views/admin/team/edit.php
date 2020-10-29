<?php
$teamId = $teamInfo->id;
$team_id = $teamInfo->team_id;
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

?><style>
    #accordionSidebar,
    #content nav.navbar{
        display: none;
    }
</style><div class="container mb-3">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3">
        <div class="text-primary f-24">Edit Team Member</div>
        <a href="<?php echo base_url(); ?>securepanel/team" class="btn btn-dark">Back</a>
    </div>
    <div>
        <hr>
    </div>
    <!-- end header -->
    <div class="row">
        <div class="mt-2 col-md-12">
            <form class="user" action="<?php echo base_url() ?>securepanel/update-team" method="post" id="editDocument" role="form" enctype="multipart/form-data">
                <div class="p-2 bg-dark mb-2 text-white">Personal Details</div>

                <!-- name of services -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">ID</label>
                        <input type="text" class="form-control" id="disabledTextInput" placeholder="<?php echo $team_id; ?>" disabled>
                    </div>
                </div>
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
                        <input type="text" class="form-control" id="txtLName" name="txtLName" value="<?php echo $txtLName; ?>" placeholder="Last Name "
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
                $checkedAC = '';
                $checkedIN = '';
                $checkedSL = '';
                $checkedML = '';
                $checkedHD = '';

                if($rdStatus == 'AC'){
                    $checkedAC = 'checked';
                } else if($rdStatus == 'IN'){
                    $checkedIN = 'checked';
                } else if($rdStatus == 'SL'){
                    $checkedSL = 'checked';
                } else if($rdStatus == 'ML'){
                    $checkedML = 'checked';
                } else {
                    $checkedHD = 'checked';
                }

                ?><div class="row mb-2">
                    <div class="form-group col-md-12 col-sm-12">
                        <label class="text-primary">Status</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusAC" name="rdStatus"
                                class="custom-control-input" <?php echo $checkedAC; ?> value="AC">
                            <label class="custom-control-label" for="rdStatusAC">Avaialble</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusIN" name="rdStatus"
                                class="custom-control-input" <?php echo $checkedIN; ?> value="IN">
                            <label class="custom-control-label" for="rdStatusIN">Day-Off</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusSL" name="rdStatus"
                                class="custom-control-input"  <?php echo $checkedSL; ?> value="SL">
                            <label class="custom-control-label" for="rdStatusSL">Sick Leave</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusML" name="rdStatus"
                                class="custom-control-input"  <?php echo $checkedML; ?> value="ML">
                            <label class="custom-control-label" for="rdStatusML">Medical</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusHD" name="rdStatus"
                                class="custom-control-input"  <?php echo $checkedHD; ?> value="HD">
                            <label class="custom-control-label" for="rdStatusHD">Holiday</label>
                        </div>
                    </div>
                </div>

                <div>
                    <hr>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 col-sm-12">
                        <input type="hidden" name="teamId" id="teamId" value="<?php echo $teamId; ?>">
                        <button class="btn btn-primary btn-lg btn-block">
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