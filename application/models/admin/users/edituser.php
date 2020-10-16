<?php
$userId = $userInfo->userId;
$name = $userInfo->name;
$lname = $userInfo->lname;
$email = $userInfo->email;
$mobile = $userInfo->mobile;
$roleId = $userInfo->roleId;
$parentUserId = $userInfo->parentUserId;
$studentClass = $userInfo->schoolgradeId;
$profilepic = $userInfo->profilepic;
$notes = $userInfo->notes;
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
                            <div class="col-md-12">
                                    <div class="form-group" style="    background-color: #f4f4f4;padding: 10px;>
                                        <label for="role">Role: </label>
                                        
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                  
                                                  if($rl->roleId == $roleId) {
													  echo "<b>" . $rl->role . "</b>";
												  }
                                                }
                                            }
                                            ?><input type="hidden" name="roleId" value="<?php echo $roleId; ?>">
                                       
                                    </div>
                                </div>    
                                </div>    

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Full Name" name="fname" value="<?php echo $name; ?>" maxlength="50">
                                        <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" value="<?php echo $lname; ?>" maxlength="50">
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Mobile Number" name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>
                           
                            
                                
                                
                            <?php 
                            if($roleId == ROLE_STUDENT){
                                    ?>
                                
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">Select Class</label>
                                            <select class="form-control" id="studentClass" name="studentClass">
                                                <option value="">-----</option>
                                                <?php
                                                 if(!empty($allclasses))
                                                {
                                                    foreach ($allclasses as $rl)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $rl->schoolgradeId ?>" <?php if(($rl->schoolgradeId == $studentClass) ) {echo "selected=selected";} ?>><?php echo $rl->name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div> </div>   
                                <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea rows=5 class="form-control" id="notes" name="notes" maxlength="1200" autocomplete="off"><?php echo $notes; ?></textarea>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                    
									
                                    <div class="form-group">
                                        <label for="email">Change Profile Picture</label>
										<input type="file" name="userfile" size="20" /><br/>
										<?php 
										if(!empty($profilepic)){
											?><img src="<?php echo base_url() . 'uploads/' . $profilepic; ?>" width="150px"><?php
										}
										?>
                                       
                                    </div>
                                </div>	
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Username: <span style="color: #736faa;"><?php echo $username; ?></span></label>
                                        
                                    </div>
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