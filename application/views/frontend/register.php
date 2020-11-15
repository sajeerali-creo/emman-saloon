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
    <body class="bg-gradient-primary h-100vh d-flex align-items-center h-sm-auto">
        <div class="container">
            <div class="d-flex justify-content-center mt-sm-6">
                <a class="navbar-brand" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>assets/web/img/logo.png">
                </a>
            </div>
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
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
                                ?><form class="user" name="frmAddForm" id="frmAddForm" action="<?php echo base_url(); ?>save-register-info" method="post"  enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="txtFName" name="txtFName" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" id="txtLName" name="txtLName" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="tel" class="form-control form-control-user" id="txtPhone" name="txtPhone" placeholder="+971">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control form-control-user" id="txtEmail" name="txtEmail" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" id="txtPassword" name="txtPassword" placeholder="Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user" id="txtCPassword" name="txtCPassword" placeholder="Repeat Password">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-user btn-block" id="btnRegister">Register Account</button>
                                    <!-- <hr>
                                    <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                    </a> -->
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?php echo base_url() ?>forgot-password">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <div class="small">Already have an account? <a href="<?php echo base_url() ?>login">Login Now</a>!</div>
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
            $('#txtPhone').bind('paste', function() {
                var txtPhone = this;
                setTimeout(function() {
                    txtPhone.value = txtPhone.value.replace(/\D/g, '');
                }, 0);
            });

            $('#txtPhone').keypress(function(evt) {
                var regex = new RegExp("^[+0-9]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
            
            $("#btnRegister").click(function() {
                let txtFName = $("#txtFName").val();
                let txtLName = $("#txtLName").val();
                let txtPhone = $("#txtPhone").val();
                let txtEmail = $("#txtEmail").val();
                let txtPassword = $("#txtPassword").val();
                let txtCPassword = $("#txtCPassword").val();

                if (txtFName == "") {
                    alert("Please enter First Name");
                    $("#txtFName").focus();
                }
                else if (txtLName == "") {
                    alert("Please enter Last Name");
                    $("#txtLName").focus();
                }
                else if (txtPhone == "") {
                    alert("Please enter Phone");
                    $("#txtPhone").focus();
                }
                else if (txtEmail == "") {
                    alert("Please enter Email");
                    $("#txtEmail").focus();
                }
                else if(!validateEmail(txtEmail)){
                    alert("Invalid Email Address");
                    $("#txtEmail").focus();
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
                    $("#frmAddForm").submit();
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