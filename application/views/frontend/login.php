<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $title; ?></title>
        <meta property="og:title" content="Eman"/>
        <meta property="og:image" content=""/>
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta property="og:image:type" content="image/png" />
        <link rel=icon href="<?php echo base_url() ?>favicon.png" sizes=32x32>
        <link rel=icon href="<?php echo base_url() ?>favicon.png" sizes=192x192>
        <link rel=apple-touch-icon-precomposed href="<?php echo base_url() ?>favicon.png">
        <!-- Custom fonts for this template-->
        <link href="<?php echo base_url() ?>assets/web/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?php echo base_url() ?>assets/web/css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    <body class="bg-gradient-primary h-100vh d-flex align-items-center">
        <div class="container">
            <div class="d-flex justify-content-center">
                <a class="navbar-brand" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>assets/web/img/logo.png">
                </a>
            </div>
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div><?php
                                        
                                        $this->load->helper('form');
                                        $error = $this->session->flashdata('error');
                                        if($error)
                                        {
                                            ?><div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <?php echo $error; ?>                    
                                            </div><?php
                                        }

                                        $success = $this->session->flashdata('success');
                                        if($success)
                                        {
                                            ?><div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <?php echo $success; ?>                    
                                            </div><?php
                                        } 
                                        ?><form action="<?php echo base_url(); ?>login-user" method="post" class="user" id="login-form">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" id="txtUsername" name="txtUsername" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="txtPassword" name="txtPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me">
                                                    <label class="custom-control-label" for="remember_me">Remember Me</label>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Login" id="btnLogin">
                                            <!-- <hr>
                                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                            </a>
                                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                            </a> -->
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?php echo base_url() ?>forgot-password">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <div class="small">If you don't have account <a href="<?php echo base_url() ?>register">register</a> now.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo base_url() ?>assets/web/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>assets/web/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url() ?>assets/web/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="<?php echo base_url() ?>assets/web/js/sb-admin-2.min.js"></script>
        <script>
            $("#btnLogin").click(function(e){
                e.preventDefault();

                let txtUsername = $("#txtUsername").val();
                let txtPassword = $("#txtPassword").val();

                if (txtUsername == "") {
                    alert("Please enter Email");
                    $("#txtUsername").focus();
                }
                else if(!validateEmail(txtUsername)){
                    alert("Invalid Email Address");
                    $("#txtUsername").focus();
                }
                else if (txtPassword == "") {
                    alert("Please enter Password");
                    $("#txtPassword").focus();
                }
                else if(!validatePassword(txtPassword)){
                    alert("Password must be at least 8 characters, no more than 15 characters, and must include at least one upper case letter, one lower case letter, and one numeric digit.");
                    $("#txtPassword").focus();
                }
                else{
                    $("#login-form").submit();
                }
            });

            function validateEmail(sEmail) {
                let filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                if (filter.test(sEmail)) {
                    return true;
                } else {
                    return false;
                }
            }

            function validatePassword(value){
                return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}$/.test( value )
            }
        </script>
    </body>
</html>