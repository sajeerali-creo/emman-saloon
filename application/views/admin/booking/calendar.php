<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Begin Page Content -->
    <div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?php echo count($arrFinalCalendarData); ?>&nbsp;
                    <span class="text-gray-600">Bookings</span>
                </h6>
                <div>
                    <a href="<?php echo base_url(); ?>securepanel/booking" class="d-none d-sm-inline-block btn btn-md btn-dark shadow-sm"> <i class="fas fa-table"></i>&nbsp;Table View</a>
                    <a href="<?php echo base_url(); ?>securepanel/add-booking" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-plus"></i>&nbsp;Add New Bookings</a>
                </div>
            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.container-fluid -->