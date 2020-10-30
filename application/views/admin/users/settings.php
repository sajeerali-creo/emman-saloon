<?php
$userId = $userInfo->userId;
$fl_notification = $userInfo->fl_notification;
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Settings</h6>
        </div>
        <div class="card-body">
            <form role="form" action="<?php echo base_url() ?>securepanel/settingsupdate" method="post" id="editProfilePassword" onsubmit="return jsValidateSettings();">
                <!-- Name Of Supplers -->
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12"><?php
                        $this->load->helper('form');
                        $error = $this->session->flashdata('error');
                        if($error)
                        {
                            ?><div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $this->session->flashdata('error'); ?>                    
                            </div><?php
                        } 

                        $success = $this->session->flashdata('success');
                        if($success)
                        {
                            ?><div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $this->session->flashdata('success'); ?>
                            </div><?php
                        }

                        $noMatch = $this->session->flashdata('nomatch');
                        if($noMatch)
                        {
                            ?><div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $this->session->flashdata('nomatch'); ?>
                            </div><?php
                        } 
                        
                        ?><div class="row">
                            <div class="col-md-12">
                                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12">
                        <label class="text-primary">Change Password</label>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Current Password</label>
                        <input type="password" class="form-control" id="inputOldPassword" placeholder="Current Password" name="oldPassword" maxlength="50">
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">New Password</label>
                        <input type="password" class="form-control" id="newPassword" placeholder="New Password" name="newPassword" maxlength="50">
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Confirm Password</label>
                        <input type="password" class="form-control"  id="cNewPassword" placeholder="Confirm Password" name="cNewPassword" maxlength="50">
                    </div>
                </div>
                <!-- end Name Of Supplers -->

                <!-- City -->
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12">
                        <label class="text-primary">Notification ON/OFF</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" <?php echo($fl_notification == '1' ? 'checked' : ''); ?> id="customSwitch1" name="chkNotification" value="1">
                            <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                    </div>

                </div>
                <!-- end City -->


                <div class="row mb-2">
                    <div class="col-md-12 col-sm-12">
                        <button class="btn btn-primary btn-lg" type="submit">
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
<!-- /.container-fluid -->