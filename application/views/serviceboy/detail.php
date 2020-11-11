<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php echo base_url() ?>assets/serviceboy/img/fav-icon.png" type="image/gif" sizes="16x16">
    <meta name="theme-color" content="#8a2be2" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/serviceboy/stylesheets/screen.css" media="screen,projection" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>eman</title>
</head>

<body>

    <!-- Just an image -->
    <nav class="navbar navbar-light bg-dark text-center d-flex justify-content-between fixed-top">
        <a href="<?php echo base_url() ?>serviceboy"><i class="material-icons text-white">arrow_back_ios</i></a>
        <a class="navbar-brand m-0" href="<?php echo base_url() ?>">
            <img src="<?php echo base_url() ?>assets/serviceboy/img/logo.png" height="55" alt="">
        </a>
    </nav>
    <?php 

    /*echo "<pre>";
    print_r($servicesInfo);
    die();*/

    ?><!-- details -->
    <div class="container mt-6">
        <div class="card text-white bg-dark mb-3 col-md-12 hide-print">
            <div class="card-body">
                <h5 class="card-title">Customer Details</h5>
                <h6 class="card-subtitle mb-2 ">Name: <?php echo $servicesInfo[$orderId]['info']['first_name'] . " " . $servicesInfo[$orderId]['info']['last_name']; ?></h6>
                <h6 class="card-subtitle mb-2 ">Email: <?php echo $servicesInfo[$orderId]['info']['email']; ?></h6>
                <h6 class="card-subtitle mb-2 ">Phone: <?php echo $servicesInfo[$orderId]['info']['phone']; ?></h6>
                <h6 class="card-subtitle mb-2 ">Date and Time: <?php echo $servicesInfo[$orderId]['info']['service_date'] . " " . $servicesInfo[$orderId]['info']['service_time']; ?></h6>
                <h6 class="card-subtitle mb-2 ">Location: <?php echo $servicesInfo[$orderId]['info']['address']; ?></h6>
            </div>
        </div>
        <!-- details of booking --><?php
        if(count($servicesInfo) > 0){
            foreach ($servicesInfo as $cartmasterId => $arrSubInfo) {
                ?><div class="card mb-2">
                    <div class="card-body"><?php
                        foreach ($arrSubInfo['serviceAllInfo'] as $key => $value) {
                            ?><h5 class="card-title"><?php echo(ucwords(strtolower($value['serviceCategory'])) ." " . $value['serviceName']); ?></h5>
                            <p class="card-text text-gray">
                                <div class="text-gray"><?php 
                                echo $value['person'];
                                if($value['person'] > 1){
                                    echo " persons";
                                }
                                else{
                                    echo " person only";
                                }
                                ?></div>
                            </p><?php
                        }
                        ?><p class="card-text text-gray">
                            <small class="text-gray"><?php echo $arrSubInfo['info']['address']; ?></small>
                        </p>
                        <div>
                            <hr>
                        </div><?php
                        foreach ($arrSubInfo['serviceAllInfo'] as $key => $value) {
                            ?><div class="d-flex justify-content-between">
                                <div class="text-gray">
                                    <?php echo(ucwords(strtolower($value['serviceCategory'])) ." " . $value['serviceName']); ?><br>Service Charge<br/>
                                    <?php 
                                    echo $value['person'];
                                    if($value['person'] > 1){
                                        echo " persons";
                                    }
                                    else{
                                        echo " person only";
                                    }
                                    ?>
                                </div>
                                <div style="text-align: right;">
                                    <strong><?php echo $value['price']; ?> AED</strong><br/>
                                    <strong><?php echo $value['service_charge']; ?> AED</strong>
                                </div>
                            </div>
                            <div>
                                <hr>
                            </div><?php
                        }
                        ?><div class="d-flex justify-content-between mb-3">
                            <div class="text-gray">
                                Vat
                            </div>
                            <div>
                                <strong><?php echo $arrSubInfo['info']['vat']; ?>%</strong>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <div class="text-gray">
                                Total
                            </div>
                            <div>
                                <strong><?php echo $arrSubInfo['info']['total_price']; ?> AED</strong>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <div class="text-gray">
                                Payment Type
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="rdPaymentType" id="rdPaymentTypeCash" value="cash" class="custom-control-input rdPaymentType" checked><label class="custom-control-label" for="rdPaymentTypeCash">Cash</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="rdPaymentType" id="rdPaymentTypeCard" value="card" class="custom-control-input rdPaymentType"><label class="custom-control-label" for="rdPaymentTypeCard">Card</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none justify-content-between mb-3" id="divCardNumber">
                            <div class="text-gray">
                                Card Number (Last 4 digit)
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <input type="text" class="form-control number_only" id="txtCardNumber" name="txtCardNumber" placeholder="XXXX" maxlength="4">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary d-flex align-items-center w-100 justify-content-center mb-2 btnCompleteService" data-orderid="<?php echo $cartmasterId; ?>"><i class="material-icons">check_circle</i>&nbsp;Complete Service & Share Bill</button><?php

                            $lnkDirection = "https://www.google.com/maps/place/" . str_ireplace(" ", "+", trim($arrSubInfo['info']['address'])) . "/";
                            ?><a href="<?php echo $lnkDirection; ?>" class="btn btn-secondary d-flex align-items-center w-100 justify-content-center" target="_blank"><i class="material-icons">directions</i>Directions</a>
                        </div>
                    </div>
                </div>

                <!-- further edit call admin -->
                <div class="mt-2">
                    <small class="p-1 text-center d-flex justify-content-center mb-2 mt-2">If any edit your bill just call to
                        Admin of eman</small>
                    <button class="btn btn-success w-100 d-flex align-items-center justify-content-center">
                        <a href="tel:971564849878" class="text-white d-flex align-items-center justify-content-center text-decoration-none">
                            <span class="material-icons">local_phone</span>&nbsp;Call
                        </a>
                    </button>
                </div><?php
            }
        }
        ?>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    <script src="<?php echo base_url() ?>assets/web/vendor/jquery/jquery.min.js"></script>
    <!--JavaScript at end of body for optimized loading-->
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/serviceboy/js/materialize.min.js"></script> -->
    <script>
        $(".btnCompleteService").click(function(){
            let hitURL = "<?php echo base_url() ?>serviceboy/complete-order"
            let orderId = $(this).attr("data-orderid");
            let cardNumber = $("#txtCardNumber").val();
            let paymentType = $(".rdPaymentType:checked").val();
            $.ajax({
                type : "POST",
                url : hitURL,
                dataType : "json",
                data: { orderId : orderId, paymentType: paymentType, cardNumber: cardNumber} , // serializes the form's elements.
            }).done(function(data){
                console.log(data);
                if(data.status == true) { 
                    window.location.href="<?php echo base_url() ?>serviceboy/thankyou";
                }
                else if(data.status == false) {
                    alert("Something went wrong. Please try again."); 
                }
                else { 
                    alert("You don't permission to do this."); 
                }
            });
        });

        $('.rdPaymentType').click(function(){
            if($(this).val() == 'card'){
                $("#divCardNumber").addClass("d-flex");
                $("#divCardNumber").removeClass("d-none");
            }
            else{
                $("#divCardNumber").addClass("d-none");
                $("#divCardNumber").removeClass("d-flex");
            }
        });

        $('.number_only').bind('paste', function() {
            var number_only = this;
            setTimeout(function() {
                number_only.value = number_only.value.replace(/\D\./g, '');
            }, 0);
        });

        $('.number_only').keypress(function(evt) {
            var regex = new RegExp("^[0-9\.]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
    </script>
</body>

</html>