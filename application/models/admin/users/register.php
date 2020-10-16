<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Emcsquared | Sign Up</title>
		<link rel=icon href="<?php echo base_url(); ?>favicon.png" sizes=32x32>
		<link rel=icon href="<?php echo base_url(); ?>favicon.png" sizes=192x192>
		<link rel=apple-touch-icon-precomposed href="<?php echo base_url(); ?>favicon.png">
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<script type="text/javascript">
			var baseURL = "<?php echo base_url(); ?>";
   		</script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>
	<body class="hold-transition login-page">
		<div class="row">
		<div class="col-sm-6">
			<div class="terms-of-use"><a href="">Terms of use</a> | <a href="">Privacy Policy</a></div>
		</div>
		<div class="col-sm-6">
			<div class="login-box register-box">
				<div class="login-box-body">
					<img src="<?php echo base_url(); ?>assets/images/logo-1.jpg" class="login-logo">
					<p class="login-box-msg">Sign Up to emcsquared</p>
					<p class="login-box-light-msg" >Create your Account</p>				
					<?php
						$this->load->helper('form');
						?><form action="<?php echo base_url(); ?>securepanel/registration" method="post"  role="form" id="userregistration" class="lined-form-fields">
						<div class="select-tab-user clearfix"><a href="javascript:;" id="selectusertype1" class="selectusertype selected">School</a><a href="javascript:;" id="selectusertype2" class="selectusertype">Others</a>
            </div>
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
								<div class="form-group has-feedback">
									<input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>"  name="fname" id="fname"   maxlength="50" autocomplete="off" placeholder="School Name"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<input type="text" class="form-control required" placeholder="Mobile Number" name="mobile" value="<?php echo set_value('mobile'); ?>"  maxlength="15" id="mobile" autocomplete="off" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<input type="text" class="form-control required" placeholder="Email address" value="<?php echo set_value('email'); ?>" name="email" id="email"  maxlength="50" autocomplete="off"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group has-feedback">
									<textarea  class="form-control required" placeholder="Address and Other Informations" name="notes"  maxlength="1500" id="notes" autocomplete="off" /><?php echo set_value('notes'); ?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group has-feedback">
									<input type="text" class="form-control required" placeholder="Username" name="username"  value="<?php echo set_value('username'); ?>" id="username"  maxlength="20" />
									<span class="glyphicon glyphicon-user form-control-feedback"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<input type="password" class="form-control required" maxlength="15" placeholder="Password" id="password" name="password"  />
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<input type="password" class="form-control required" maxlength="15" placeholder="Confirm Password" id="cpassword" name="cpassword"  />
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
              </div>
              </div>
              <div class="row">
							<div class="col-md-12">
							<div class="row login-btn-row">
								<div class="col-xs-8">    
									<input type="submit" class="btn btn-danger btn-block" value="Create Account" />
								</div>
								<!-- /.col -->
							</div>
							<div class="row sign-up-link-row">
								<div class="col-xs-12">    
									Already have an account? Click here to <a href="<?php echo base_url(); ?>securepanel/login">sign in</a>
								</div>
              </div>
            </div>
            </div>
					</form>
					</div><!-- /.login-box-body -->
				</div>
				<!-- /.login-box -->
			</div>
		</div>
		<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/userregistration.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js" type="text/javascript"></script>
		<!-- <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js" type="text/javascript"></script> -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
	
	</body>
</html>