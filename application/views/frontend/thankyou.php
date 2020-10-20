<section>
    <!-- navigation -->
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark d-none">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>assets/web/img/logo.png" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarText">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="order-history.html" target="_blank">Booking History</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="h-80vh align-items-center">
            <div>
                <div class="d-flex align-items-center">
                    <div class="col text-center p-5">
                        <div class="text-gray-900 font-weight-bold h1 text-center">Thank you for choosing Us</div>
                        <small class="text-center">Your booking is successfully selected, our service team will
                            confirm and
                            call you back
                            soon.</small>
                    </div>
                </div>
                <!-- wizard -->
                <div class="d-flex justify-content-center">
                    <ul class="circle-wizard d-flex justify-content-center">
                        <li>
                            <div>
                                <i class="fas fa-check active"></i>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <small class="text-center mb-3">if you want book something more please click book again button
                        below.
                    </small>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-lg btn-primary d-flex align-items-center">
                        <a href="<?php echo base_url() ?>service" class="text-white text-decoration-none">
                            Book Again
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.cookie="serviceCartCookie=;expires=Thu 01 Jan 1970;path=/";
    document.cookie="cartDetailsInfo=;expires=Thu 01 Jan 1970;path=/";
    document.cookie="cartUserInfo=;expires=Thu 01 Jan 1970;path=/";
</script>