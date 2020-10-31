<section>
    <!-- navigation -->
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>assets/web/img/logo.png" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarText">
                <ul class="nav"><?php
                    if(isset($frontLogin) && $frontLogin == true){
                        ?><li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url() ?>order-history">Booking History</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-dark" href="<?php echo base_url() ?>logout">Logout</a>
                        </li><?php
                    }
                ?></ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="d-flex justify-content-between mt-4 mb-4 align-items-center">
            <div class="h3 text-gray-900 font-weight-bold">
                Previous Booking history
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-sm d-flex align-items-center ">
                    <a href="<?php echo base_url() ?>service" class="text-white text-decoration-none text-center-bt w-100">
                        Back
                    </a>
                </button>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12 mb-3"><?php
                if(!empty($orderhistory)){
                    foreach ($orderhistory as $key => $value) {
                        $cartmasterId = $value["cartMasterId"];
                        ?><!-- loop -->
                        <div class="card p-3 shadow mb-2">
                            <div class="text-gray-900 font-weight-bold"><?php echo ucwords(strtolower($value["serviceCatName"])) . " " . $value["serviceName"]; ?></div>
                            <small><?php echo $value["person"]; ?>person - <?php echo $value["service_time"] . "," . $value["service_date"]; ?></small><?php
                            if($value["flCancel"] == '1'){
                                $statusLabel = "cancelled";
                            } else {
                                $status = $value["status"];

                                if($status == 'PN'){
                                    $statusLabel = 'Pending';
                                } else if($status == 'CN'){
                                    $statusLabel = 'Confirmed';
                                } else if($status == 'SBR'){
                                    $statusLabel = 'Servicer Rejected';
                                } else if($status == 'SBC'){
                                    $statusLabel = 'Servicer Confirmed';
                                } else {
                                    $statusLabel = 'Completed';
                                }
                            }
                            echo "Status: " . $statusLabel;

                            if($value["flCancel"] != '1' && $status == 'PN'){
                                    ?><button type="button" class="btn btn-danger btn-sm mt-2 mr-1 deleteOrder delete-<?php echo $cartmasterId; ?>" data-toggle="modal" data-target="#delete-order" data-recordid="<?php echo $cartmasterId; ?>" title="Cancel Order" style="max-width: 120px;">Cancel Order</button><?php
                            }
                        ?></div><?php
                    }
                }
                else{
                    ?><!-- loop -->
                    <div class="card p-3 shadow mb-2">
                        <div class="text-gray-900 font-weight-bold">Empty</div>
                    </div><?php
                }
                
                ?>
            </div>
        </div>

        <div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="font-weight-bold f-20 text-center text-dark">We’re Always Here To Help</div>
                <div class="text-small text-gray text-center mb-3">Reach out to us through any of these support channels</div>
                <div class="h3 text-center font-weight-bold text-dark tel">
                    <a href="tel:971564849878">
                        <i class="fas fa-phone-square"></i>&nbsp;tel:971564849878
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="delete-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-center mb-2">Are you sure to cancel this booking?</h5>
                <div class="form-group">
                    <textarea class="form-control" id="taDeleteReason" name="taDeleteReason" rows="3" placeholder="Enter cancel notes"></textarea>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
                <input type="hidden" name="hdDeleteRecordId" id="hdDeleteRecordId">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-order-msg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                Are you sure to delete this item?
            </div>
        </div>
    </div>
</div>