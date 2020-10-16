<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Emcsquared | Log in</title>
    <link rel=icon href="<?php echo base_url(); ?>favicon.png" sizes=32x32>
		<link rel=icon href="<?php echo base_url(); ?>favicon.png" sizes=192x192>
		<link rel=apple-touch-icon-precomposed href="<?php echo base_url(); ?>favicon.png">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition login-page">
  <div class="row">
  <div class="col-sm-6"><div class="terms-of-use"><a href="">Terms of use</a> | <a href="">Privacy Policy</a></div></div>
  <div class="col-sm-6">
    <div class="login-box">
      
      <div class="login-box-body">
        <img src="<?php echo base_url(); ?>assets/images/logo-1.jpg" class="login-logo">
        <p class="login-box-msg">Login to emcsquared</p>
        <p class="login-box-light-msg" >Please login to your Account</p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
            </div>
        <?php }
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success; ?>                    
            </div>
        <?php } ?>
        <form action="<?php echo base_url(); ?>securepanel/loginadmin" method="post" class="lined-form-fields">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" maxlength="20" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password"  maxlength="20" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row remember-me-row">
            <div class="col-xs-6">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div> 
            </div>
            <div class="col-xs-6 forgot-password-right">
             <a href="<?php echo base_url(); ?>securepanel/forgotpassword">Forgot Password</a>
            </div><!-- /.col -->
        </div>
        <div class="row login-btn-row">
            <div class="col-xs-8">    
              <input type="submit" class="btn btn-danger btn-block" value="Login" />
            </div><!-- /.col -->
          </div>
          <div class="row sign-up-link-row">
            <div class="col-xs-12 sign-up-link-row-p">    
              Do not have an account yet? Click here to <a href="<?php echo base_url(); ?>securepanel/register">sign up</a>
            </div>
            
        </div>
        </form>
        

        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>