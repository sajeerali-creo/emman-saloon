<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#8a2be2" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/serviceboy/stylesheets/screen.css"
        media="screen,projection" />
    <title><?php echo $pageTitle; ?></title>
</head>

<body class="d-flex align-items-center justify-content-center h-100vh bg-dark">
    <div style="width: 19rem">
        <div class="p-3 text-center mb-3">
            <img src="<?php echo base_url() ?>assets/serviceboy/img/logo.png">
        </div>
        <div class="row">
            <div class="card col-md-12 h-32vh">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div>
                        <?php
                                        
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
                                        ?>
                        <form action="<?php echo base_url(); ?>serviceboy/login-user" method="post" class="user"
                            id="login-form">
                            <form>
                                <div class="form-group w-100">
                                    <label for="txtUsername">Enter Your ID</label>
                                    <input type="password" class="form-control" id="txtUsername" name="txtUsername"
                                        placeholder="Team ID">
                                </div>
                                <button type="button" class="btn btn-primary w-100" id="btnServiceBoyLogin">
                                    <span class="text-white">
                                        Submit
                                    </span>
                                </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
    $("#btnServiceBoyLogin").click(function(e) {
        e.preventDefault();
        let txtUsername = $("#txtUsername").val();

        if (txtUsername == '') {
            alert("Please enter your ID");
        } else {
            $("#login-form").submit();
        }
    });
    </script>
</body>

</html>