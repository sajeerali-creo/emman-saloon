<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo PROJECT_NAME; ?> | Log In</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary h-100vh d-flex align-items-center">

  <div class="container">
    <div class="d-flex justify-content-center">
      <a class="navbar-brand" href="index.html">
        <img src="<?php echo base_url(); ?>assets/admin/img/logo.png">
      </a>
    </div>
    <!-- Outer Row -->
    <div class="justify-content-center d-flex">
        <div class="card o-hidden border-0 shadow-lg my-5 col-md-4 col-sm-12">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-md-12">
                <div class="p-3 pt-5 pb-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
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
                    <form action="<?php echo base_url(); ?>securepanel/loginadmin" method="post" class="user" id="login-form">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="username" id="txtusername" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="txtpassword" maxlength="50" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me">
                        <label class="custom-control-label" for="remember_me">Remember Me</label>
                      </div>
                    </div><input type="submit" class="btn btn-primary btn-user btn-block" value="Login" />
                    
                  </form>
                  <!-- <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo base_url(); ?>securepanel/forgotpassword">Forgot Password?</a>
                  </div> -->
                

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/admin/js/sb-admin-2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>
  <script>
    /*$( "#login-form" ).submit(function( event ) {
        event.preventDefault();
        var txtusername = $('#txtusername').val();
        var txtpassword = $('#txtpassword').val();
    });*/
    //$_COOKIE

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    function setRememberLoginInfo(){
      var nameVal = readCookie('user_name_session');
      var passVal = readCookie('user_pass_session');
      console.log(nameVal);

      if(nameVal != '' && nameVal != null){
        $('#txtusername').val(decodeURIComponent(nameVal));
        $('#txtpassword').val(decodeURIComponent(passVal));
        $("#remember_me").prop("checked", true);
      }
      else{
        $("#remember_me").prop("checked", false);
      }

      
    }
    setRememberLoginInfo();
  </script>
</body>

</html>