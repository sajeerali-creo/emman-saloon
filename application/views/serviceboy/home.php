<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#8a2be2" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/serviceboy/stylesheets/screen.css" media="screen,projection" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?php echo $pageTitle; ?></title>
</head>

<body>

    <!-- Just an image -->
    <nav class="navbar navbar-light bg-dark text-center d-flex justify-content-between fixed-top">
        <a class="navbar-brand m-0" href="<?php echo base_url() ?>serviceboy">
            <img src="<?php echo base_url() ?>assets/serviceboy/img/logo.png" height="55" alt="">
        </a>
        <a href="notification.html">
            <i class="material-icons text-white">notifications</i>
        </a>
        <a href="<?php echo base_url() ?>serviceboy/logout" style="display:none;">
            Logout
        </a>
    </nav>

    <!-- loop -->
    <div class="container mt-6"><?php
        if(count($servicesInfo) > 0){

            foreach ($servicesInfo as $cartmasterId => $arrSubInfo) {
                ?><div class="card mb-2" id="order-row-<?php echo $cartmasterId; ?>">
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
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex"><?php
                                if($arrSubInfo['info']['status'] == 'PN' || $arrSubInfo['info']['status'] == 'CN'){
                                    ?><button type="button" class="btn btn-danger d-flex align-items-center text-white w-100 mr-1 justify-content-center btnReject btnReject-<?php echo $cartmasterId; ?>" data-toggle="modal" data-target="#exampleModal" data-orderid="<?php echo $cartmasterId; ?>">Reject</button>
                                    <button type="button" class="btn btn-success d-flex align-items-center w-100 justify-content-center btnAccept btnAccept-<?php echo $cartmasterId; ?>" data-orderid="<?php echo $cartmasterId; ?>">Confirm</button><?php
                                }
                            ?></div>
                            <div class="d-flex"><?php
                                $lnkDirection = "https://www.google.com/maps/place/" . str_ireplace(" ", "+", trim($arrSubInfo['info']['address'])) . "/";
                                ?><a href="<?php echo $lnkDirection; ?>" class="btn btn-primary d-flex align-items-center w-100 mr-1 justify-content-center" target="_blank"><i class="material-icons">directions</i></a>
                                <a href="<?php echo base_url() ?>serviceboy/details/<?php echo $cartmasterId; ?>" class="btn btn-secondary d-flex align-items-center w-100 justify-content-center"><i class="material-icons">visibility</i></a>
                            </div>
                        </div>
                    </div>
                </div><?php
            }
            
        }
        else{
            ?>No booking found<?php
        }
    ?></div>
    <input type="hidden" name="selectedBookingId" id="selectedBookingId" value=""/>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reason</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control" id="taRejectReason" name="taRejectReason" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnSendReject">Send</button>
                </div>
            </div>
        </div>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    <script>
        $(".btnReject").click(function(){
            $("#selectedBookingId").val($(this).attr("data-orderid"));
        });
        $("#btnSendReject").click(function(){
            let hitURL = "<?php echo base_url() ?>serviceboy/reject-order"
            let orderId = $("#selectedBookingId").val();
            let taRejectReason = $("#taRejectReason").val();
            $.ajax({
                type : "POST",
                url : hitURL,
                dataType : "json",
                data: { orderId : orderId, rejectReason: taRejectReason } , // serializes the form's elements.
            }).done(function(data){
                console.log(data);
                $('#exampleModal').modal('hide');
                if(data.status == true) { 
                    alert("Order rejected successfully"); 
                    $("#order-row-" + orderId).fadeOut('1000');
                    $("#order-row-" + orderId).remove();
                }
                else if(data.status == false) {
                    alert("Order reject failed. Please try again."); 
                }
                else { 
                    alert("You don't permission to do this."); 
                }
            });
        });

        $(".btnAccept").click(function(){
            let hitURL = "<?php echo base_url() ?>serviceboy/confirm-order"
            let orderId = $(this).attr("data-orderid");
            $.ajax({
                type : "POST",
                url : hitURL,
                dataType : "json",
                data: { orderId : orderId} , // serializes the form's elements.
            }).done(function(data){
                console.log(data);
                if(data.status == true) { 
                    alert("Order confirmed successfully"); 
                    $(".btnAccept-" + orderId).fadeOut('1000');
                    $(".btnReject-" + orderId).fadeOut('1000');
                    $(".btnAccept-" + orderId).remove();
                    $(".btnReject-" + orderId).remove();
                }
                else if(data.status == false) {
                    alert("Something went wrong. Please try again."); 
                }
                else { 
                    alert("You don't permission to do this."); 
                }
            });
        });
    </script>
</body>

</html>