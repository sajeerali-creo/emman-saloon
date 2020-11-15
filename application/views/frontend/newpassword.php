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
            <!-- Outer Row -->
            <div class="d-flex justify-content-center">
                <a class="navbar-brand" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>assets/web/img/logo.png">
                </a>
            </div>
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
                                            <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                                            <p class="mb-4">Please enter the below details</p>
                                        </div>
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
                                                <?php echo $this->session->flashdata('error'); ?>                    
                                            </div>
                                        <?php } ?>
                                        <form action="<?php echo base_url(); ?>createnewpassword" method="post" class="lined-form-fields" id="fromAction">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" id="txtUsername" name="txtUsername" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="<?php echo $username; ?>"  readonly required >
                                                <input type="hidden" name="activation_code"  value="<?php echo $activation_code; ?>" maxlength="20" required />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="txtPassword" name="txtPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="txtCPassword" name="txtCPassword" placeholder="Repeat Password">
                                            </div>
                                            <input type="button" id="btnSubmitPassword" class="btn btn-primary btn-user btn-block" value="Submit">
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="<?php echo base_url() ?>register">Create an Account!</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="<?php echo base_url() ?>login">Already have an account? Login!</a>
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
            $("#btnSubmitPassword").click(function(e){
                e.preventDefault();
                let txtUsername = $("#txtUsername").val();
                let txtPassword = $("#txtPassword").val();
                let txtCPassword = $("#txtCPassword").val();

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
                else if (txtCPassword == "") {
                    alert("Please enter Password");
                    $("#txtCPassword").focus();
                }
                else if (txtCPassword != txtPassword) {
                    alert("Please enter same password");
                    $("#txtCPassword").focus();
                }
                else{
                    $("#fromAction").submit();
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