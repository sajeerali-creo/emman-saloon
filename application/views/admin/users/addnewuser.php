<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header clearfix">
	<div class="row">
    <div class="col-sm-6">
		<h1>
			User Management
			<small>Add new user</small>
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
					<div class="box-header">
						<h3 class="box-title">Enter User Details</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<?php $this->load->helper("form"); ?>
					<form role="form" id="addUser" action="<?php echo base_url() ?>securepanel/addnewuserdetails" method="post" role="form" autocomplete="off" enctype="multipart/form-data" class="form-smaller">
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="fname">First Name</label>
										<input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="fname" name="fname" maxlength="50" autocomplete="off">
									</div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
										<label for="lname">Last Name</label>
										<input type="text" class="form-control required" value="<?php echo set_value('lname'); ?>" id="lname" name="lname" maxlength="50" autocomplete="off">
									</div>
								</div>
                                
								
							</div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="mobile">Mobile Number</label>
										<input type="text" class="form-control required" id="mobile" value="<?php echo set_value('mobile'); ?>" name="mobile" maxlength="15" autocomplete="off">
									</div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
										<label for="email">Email address</label>
										<input type="email" class="form-control required email" id="email" value="<?php echo set_value('email'); ?>" name="email" maxlength="50" autocomplete="off">
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
                                                    ?><option value="<?php echo $key ?>" <?php if ($key == set_value('lstGender')) { echo "selected=selected"; } ?>><?php echo $val; ?></option><?php
                                                }
                                            }

                                        ?></select>
									</div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
										<label for="religion">Religion</label>
										<input type="text" class="form-control" id="religion" value="<?php echo set_value('religion'); ?>" name="religion" maxlength="50" autocomplete="off">
									</div>
								</div>
                            </div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="address1">Address 1</label>
										<input type="text" class="form-control required" id="address1" value="<?php echo set_value('address1'); ?>" name="address1" maxlength="50" autocomplete="off">
									</div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
										<label for="address2">Address 2</label>
										<input type="text" class="form-control" id="address2" value="<?php echo set_value('address2'); ?>" name="address2" maxlength="50" autocomplete="off">
									</div>
								</div>
                            </div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="city">City</label>
										<input type="text" class="form-control required" id="city" value="<?php echo set_value('city'); ?>" name="city" maxlength="50" autocomplete="off">
									</div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
										<label for="state">State</label>
										<input type="text" class="form-control required" id="state" value="<?php echo set_value('state'); ?>" name="state" maxlength="50" autocomplete="off">
									</div>
								</div>
                            </div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="country">Country</label>
										<select class="form-control required" id="lstCountry" name="lstCountry" required><?php
											$defCountry = (set_value('lstCountry') ? set_value('lstCountry') : "AE");
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
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control required" id="username" value="<?php echo set_value('username'); ?>" name="username" maxlength="50" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" class="form-control required" id="password" name="password" maxlength="50" autocomplete="off">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="cpassword">Confirm Password</label>
										<input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="50" autocomplete="off">
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<input type="submit" class="btn btn-primary" value="Submit" />
							
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4">
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
			</div>
		</div>
	</section>
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>