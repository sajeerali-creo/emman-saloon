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
										<input type="text" class="form-control required email" id="email" value="<?php echo set_value('email'); ?>" name="email" maxlength="50" autocomplete="off">
									</div>
								</div>
                            </div>
                            

                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="role">Role</label>
                                        
										<select class="form-control required" id="role" name="role" <?php   if($role == ROLE_SUPERADMIN){ ?> onchange="getParentList()" <?php } else { ?> onchange="getClassList()" <?php } ?>>
											<option value="0">Select Role</option>
											<?php
												if(!empty($roles))
												{
												    foreach ($roles as $rl)
												    {
												        ?>
											<option value="<?php echo $rl->roleId ?>" <?php if($rl->roleId == set_value('role')) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
											<?php
												}
												}
												?>
										</select>
									</div>
								</div>
							
							<?php   if($role == ROLE_SUPERADMIN){ ?>
							
								<div class="col-md-6">
									<div class="form-group">
										<label for="role">Select Parent Role</label>
										<select class="form-control" id="parentRoles" name="parentRoles" onchange="getClassList()">
											<option value="">-----</option>
											<?php
												/* if(!empty($allsubcat))
												 {
												     foreach ($allsubcat as $rl)
												     {
												         ?>
											<option value="<?php echo $rl->subcategoryId ?>" <?php if(($rl->subcategoryId == set_value('subCat')) ) {echo "selected=selected";} ?>><?php echo $rl->title ?></option>
											<?php
												}
												}*/
												?>
										</select>
									</div>
								</div>
							
							<?php 
								}
								else{
                                    if($role == ROLE_ADMIN){ 
                                        ?> <input type="hidden" id="parentRoles1" name="parentRoles" value="<?php echo $vendorId; ?>"><?php
                                    }
                                    else{
								    ?> <input type="hidden" id="parentRoles1" name="parentRoles" value="<?php echo $parentUserId; ?>"><?php
                                    }
								}
								
								?>
								<div class="col-md-6">
									<div class="form-group">
										<label for="role">Select Class</label>
										<select class="form-control" id="studentClass" name="studentClass">
											<option value="">-----</option>
											<?php
												/* if(!empty($allsubcat))
												 {
												     foreach ($allsubcat as $rl)
												     {
												         ?>
											<option value="<?php echo $rl->subcategoryId ?>" <?php if(($rl->subcategoryId == set_value('subCat')) ) {echo "selected=selected";} ?>><?php echo $rl->title ?></option>
											<?php
												}
												}*/
												?>
										</select>
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="email">Profile Picture</label>
										<input type="file" name="userfile" size="20" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="notes">Notes</label>
										<textarea rows=5 class="form-control" id="notes" name="notes" maxlength="1500" autocomplete="off"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control required" id="username" value="<?php echo set_value('username'); ?>" name="username" maxlength="20" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" class="form-control required" id="password" name="password" maxlength="15" autocomplete="off">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="cpassword">Confirm Password</label>
										<input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="15" autocomplete="off">
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