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
                            <a class="nav-link text-white" href="<?php echo base_url() ?>logout">Logout</a>
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
                <button type="button" class="btn btn-primary btn-sm d-flex align-items-center">
                    <a href="<?php echo base_url() ?>service" class="text-white text-decoration-none">
                        Back
                    </a>
                </button>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12 mb-3"><?php
                if(!empty($orderhistory)){
                    foreach ($orderhistory as $key => $value) {
                        ?><!-- loop -->
                        <div class="card p-3 shadow mb-2">
                            <div class="text-gray-900 font-weight-bold"><?php echo ucwords(strtolower($value["serviceCatName"])) . " " . $value["serviceName"]; ?></div>
                            <small><?php echo $value["person"]; ?>person - <?php echo $value["service_time"] . "," . $value["service_date"]; ?></small>
                        </div><?php
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
    </div>
</section>