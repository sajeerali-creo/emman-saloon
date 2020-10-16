<?php
$userId = $userInfo->userId;
$first_name = $userInfo->first_name;
$last_name = $userInfo->last_name;
$email = $userInfo->email;
$phone_number = $userInfo->phone_number;
$gender = $userInfo->gender;
$religion = $userInfo->religion;
$address1 = $userInfo->address1;
$address2 = $userInfo->address2;
$city = $userInfo->city;
$state = $userInfo->state;
$country = $userInfo->country;
$username = $userInfo->username;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header clearfix">
    <div class="row">
    <div class="col-sm-6">
      <h1>
        User Management
        <small>Edit User</small>
      </h1>
      </div>
      
<div class="col-sm-6">
		<a href="<?php echo base_url(); ?>securepanel/users" class="lnk-warning link-right-pos"><i class="fa fa-arrow-left"></i>Back</a>
		</div>
		</div>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->     
                
                <div class="box box-primary">       
                    
                    <form role="form" action="<?php echo base_url() ?>securepanel/updateuser" method="post" id="updateuser" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                        <?php
                            $this->load->helper('form');
                            $error = $this->session->flashdata('error');
                            if($error)
                            {
                                ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('error'); ?>                    
                                </div>
                            <?php } ?>
                            <?php  
                            $success = $this->session->flashdata('success');
                            if($success)
                            {
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php } ?>
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" placeholder="Full Name" name="first_name" value="<?php echo $first_name; ?>" maxlength="50">
                                        <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="<?php echo $last_name; ?>" maxlength="50">
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">Mobile Number</label>
                                        <input type="text" class="form-control" id="phone_number" placeholder="Mobile Number" name="phone_number" value="<?php echo $phone_number; ?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lstGender">Gender</label>
                                        <select class="form-control required" id="lstGender" name="lstGender" required><?php
                                            if (!empty($allGender)) {
                                                foreach ($allGender as $key => $val) {
                                                    ?><option value="<?php echo $key ?>" <?php if ($key == $gender) { echo "selected=selected"; } ?>><?php echo $val; ?></option><?php
                                                }
                                            }

                                        ?></select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion">Religion</label>
                                        <input type="text" class="form-control" id="religion" value="<?php echo $religion; ?>" name="religion" maxlength="50" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address1">Address 1</label>
                                        <input type="text" class="form-control required" id="address1" value="<?php echo $address1; ?>" name="address1" maxlength="50" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address2">Address 2</label>
                                        <input type="text" class="form-control" id="address2" value="<?php echo $address2; ?>" name="address2" maxlength="50" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control required" id="city" value="<?php echo $city; ?>" name="city" maxlength="50" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control required" id="state" value="<?php echo $state; ?>" name="state" maxlength="50" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select class="form-control required" id="lstCountry" name="lstCountry" required><?php
                                            $defCountry = (set_value('lstCountry') ? set_value('lstCountry') : $country);
                                            if (!empty($allCountry)) {
                                                foreach ($allCountry as $key => $arrVal) {
                                                    ?><option value="<?php echo $key ?>" <?php if ($key == $defCountry) { echo "selected=selected"; } ?>><?php echo $arrVal["name"]; ?></option><?php
                                                }
                                            }

                                        ?></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="box-title">User Login Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><?php
                                        if(!empty($username)){
                                            ?><label for="password">Username: <span style="color: #736faa;"><?php echo $username; ?></span></label><?php
                                        }
                                        else{
                                            ?><label for="password">Username</label>
                                            <input type="text" class="form-control required" id="username" value="<?php echo $username; ?>" name="username" maxlength="50" autocomplete="off"><?php
                                        }
                                        
                                    ?></div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" maxlength="15">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword" maxlength="15">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                          
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
               
            </div>
        </div>    
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>