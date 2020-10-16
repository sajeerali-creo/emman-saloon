<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Emcsquared : Forgot Password</title> 
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
  <body class="login-page">
  <div class="row">
  <div class="col-sm-6"><div class="terms-of-use"><a href="">Terms of use</a> | <a href="">Privacy Policy</a></div></div>
  <div class="col-sm-6">
    <div class="login-box">
      <div class="login-box-body">
	   <img src="<?php echo base_url(); ?>assets/images/logo-1.jpg" class="login-logo">
        <p class="login-box-msg">Forgot Password</p>
        <p class="login-box-light-msg" >Please enter your username</p>

        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        $send = $this->session->flashdata('send');
        $notsend = $this->session->flashdata('notsend');
        $unable = $this->session->flashdata('unable');
        $invalid = $this->session->flashdata('invalid');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>                    
            </div>
        <?php }

        if($send)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $send; ?>                    
            </div>
        <?php }

        if($notsend)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $notsend; ?>                    
            </div>
        <?php }
        
        if($unable)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $unable; ?>                    
            </div>
        <?php }

        if($invalid)
        {
            ?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $invalid; ?>                    
            </div>
        <?php } ?>
        
        <form action="<?php echo base_url(); ?>securepanel/resetpassword" method="post" class="lined-form-fields">
          <div class="form-group has-feedback">
            <input type="text" class="form-control required" placeholder="Username" name="username" maxlength="20" required />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          
          <div class="row login-btn-row">
            <div class="col-xs-8 ">
			<input type="submit" class="btn btn-danger btn-block" value="Submit" />
            </div><!-- /.col -->
            
          </div>
		   <div class="row sign-up-link-row">
            <div class="col-xs-12">Already registered? Click here to <a href="<?php echo base_url(); ?>securepanel/login">login</a></div>
            
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