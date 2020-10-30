<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-lg-flex d-sm-block d-md-block align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Overview</h1>
        <div class="d-lg-flex d-sm-block d-md-block">
            <div class="mr-2 w-sm-100 mr-sm-0 mt-sm-1">
                <button class="card p-2 w-sm-100 mr-2" id="reportrange">
                    <i class="text-primary" data-feather="calendar"></i>
                    <span></span>
                    <i class="ml-1" data-feather="chevron-down"></i>
                </button>
                <form name="frmSearch" id="frmSearch" class="user w-sm-100"
                    action="<?php echo base_url(); ?>securepanel/dashboard" method="get" enctype="multipart/form-data"
                    style="display: none;">
                    <input type="hidden" name="sDate" id="hdStartDate" value="<?php echo($sDate); ?>">
                    <input type="hidden" name="eDate" id="hdEndDate" value="<?php echo($eDate); ?>">
                    <button class="btn btn-dark" type="submit" id="btnDashboardSearch"><i
                            class="fas fa-search fa-sm"></i></button>
                </form>
            </div>
            <a href="javascript:;" id="lnkSearchDate"
                class="d-sm-inline-block btn btn-md btn-dark shadow-sm h-40 w-sm-100 mt-sm-1"><i
                    class="fas fa-search fa-sm"></i></a>
        </div>

        <div class="">
            <a href="javascript:;" id="lnkGenerateDashboardReport" class="d-sm-inline-block btn btn-md btn-primary shadow-sm h-40 w-sm-100 mt-sm-1"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
    </div>



    <div class="row mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card-counter primary">
                <i class="fas fa-wallet"></i>
                <span class="count-numbers">AED <?php echo $totalSales; ?></span>
                <span class="count-name">Total Sales & Services</span>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-counter bg-warning">
                <i class="fas fa-cart-arrow-down"></i>
                <span class="count-numbers text-white"><?php echo $totalBooking; ?></span>
                <span class="count-name text-white">Total Bookings</span>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-counter success">
                <i class="fas fa-user-friends"></i>
                <span class="count-numbers"><?php echo $totalTeam; ?></span>
                <span class="count-name">Total Team</span>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-counter info">
                <i class="fa fa-users"></i>
                <span class="count-numbers"><?php echo $totalCustomers; ?></span>
                <span class="count-name">Total Customers</span>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12 col-lg-8">
            <div class="card-block bg-white mt-1 mb-1 card-counter2">
                <div class="h4 mb-2"><span class="font-weight-bold"><?php echo $totalBooking; ?></span>&nbsp;Bookings
                </div>

                <div class="d-lg-flex d-sm-block">
                    <div class="d-block w-100 mb-md-3">
                        <div class="mr-2 mb-1">
                            <button type="button" class="btn btn-primary">
                                Confirmed Bookings&nbsp;<span
                                    class="badge badge-light"><?php echo $totalConfirmBooking; ?></span>
                            </button>
                        </div>
                        <div class="mr-2 mb-1">
                            <button type="button" class="btn btn-dark">
                                Pending Bookings&nbsp;<span
                                    class="badge badge-light"><?php echo $totalPendingBooking; ?></span>
                            </button>
                        </div>
                        <div class="mb-sm-1">
                            <button type="button" class="btn btn-success">
                                Completed Bookings&nbsp;<span
                                    class="badge badge-light"><?php echo $totalCompletedBooking; ?></span>
                            </button>
                        </div>
                    </div>

                    <div class="d-lg-flex w-100 d-sm-block">
                        <div class="card border-left-info shadow h-100 py-2 mr-2 w-100 mb-sm-1">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="f-16 font-weight-bold text-info text-uppercase mb-1">
                                            Online Booking</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo $totalHomeServices; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-left-info shadow h-100 py-2 w-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="f-16 font-weight-bold text-info text-uppercase mb-1">
                                            Front desk</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo $totalSaloonServices; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card-block bg-white mt-1 mb-1 card-counter center  bg-gradient-info text-white">
                <div class="h4 mb-2"><span
                        class="font-weight-bold text-white"><?php echo $totalProductSale; ?></span><br>Total Product
                    Sale</div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card-block bg-white mt-1 mb-1">

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="f-16 font-weight-bold text-primary text-uppercase mb-1">
                            Available Team <span class="badge badge-secondary"><?php echo $totalActiveTeam; ?></span></div>
                        <div class=" mb-2 progress">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $totalActiveTeam; ?>%"
                                aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="f-16 font-weight-bold text-primary text-uppercase mb-1">
                            Day-Off <span class="badge badge-secondary"><?php echo $totalDayOffTeam; ?></span></div>
                        <div class=" mb-2 progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar"
                                style="width: <?php echo $totalDayOffTeam; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="f-16 font-weight-bold text-primary text-uppercase mb-1">
                            Sick Leave <span class="badge badge-secondary"><?php echo $totalSLOffTeam; ?></span></div>
                        <div class=" mb-2 progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?php echo $totalSLOffTeam; ?>%"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="f-16 font-weight-bold text-primary text-uppercase mb-1">
                            Medical <span class="badge badge-secondary"><?php echo $totalMLOffTeam; ?></span></div>
                        <div class=" mb-2 progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar"
                                style="width: <?php echo $totalMLOffTeam; ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="f-16 font-weight-bold text-primary text-uppercase mb-1">
                            Holiday <span class="badge badge-secondary"><?php echo $totalHDOffTeam; ?></span></div>
                        <div class=" mb-2 progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar"
                                style="width:  <?php echo $totalHDOffTeam; ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card  shadow h-100 py-2 mr-2 w-100">
                            <div class="card-body d-flex align-items-center justify-content-center d-sm-block">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2 text-center s-v mb-sm-1">
                                        <div>
                                            <h1 class="font-weight-bold text-success"><?php echo $totalTeam; ?></h1>
                                            <div>Total Team</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2 text-center s-v busy">
                                        <div>
                                            <h1 class="font-weight-bold text-danger">1</h1>
                                            <div>Busy Team</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card-block bg-white mt-1 mb-1 card-counter center  bg-gradient-info text-white">
                <div class="h4 mb-2">
                    <span class="font-weight-bold text-white"><?php echo $totalProductUse; ?></span><br>
                    Total Product Use
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-block bg-white mt-1 mb-1 card-counter center  bg-gradient-warning text-white">
                <div class="h4 mb-2"><span
                        class="font-weight-bold text-white"><?php echo $totalSuppliers; ?></span><br>Total Suppliers
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <!-- sales Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Overview <span
                            class="text-gray-600 d-none">(Monthly)</span></h6>
                    <div class="dropdown no-arrow d-none">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Filter:</div>
                            <a class="dropdown-item" href="#">Today</a>
                            <a class="dropdown-item" href="#">Weekly</a>
                            <a class="dropdown-item" href="#">Monthly</a>
                            <a class="dropdown-item" href="#">Anuualy</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- end sales Chart -->

        <!-- bookings Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Bookings Overview <span
                            class="text-gray-600 d-none">(Monthly)</span></h6>
                    <div class="dropdown no-arrow d-none">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Filter:</div>
                            <a class="dropdown-item" href="#">Today</a>
                            <a class="dropdown-item" href="#">Weekly</a>
                            <a class="dropdown-item" href="#">Monthly</a>
                            <a class="dropdown-item" href="#">Anuualy</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- end bookings Chart -->
    </div>


    <div class="row d-none">
        <!-- sales Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Best Performers <span
                            class="text-gray-600 d-none">(Monthly)</span></h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Filter:</div>
                            <a class="dropdown-item" href="#">Today</a>
                            <a class="dropdown-item" href="#">Weekly</a>
                            <a class="dropdown-item" href="#">Monthly</a>
                            <a class="dropdown-item" href="#">Anuualy</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="d-flex justify-contnet-between mb-1">
                        <div>Roshan James</div>
                        <div class="font-weight-bold text-primary">AED 12300</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-contnet-between mb-1">
                        <div>Roshan James</div>
                        <div class="font-weight-bold text-primary">AED 12300</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-contnet-between mb-1">
                        <div>Roshan James</div>
                        <div class="font-weight-bold text-primary">AED 12300</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-contnet-between mb-1">
                        <div>Roshan James</div>
                        <div class="font-weight-bold text-primary">AED 12300</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-contnet-between mb-1">
                        <div>Roshan James</div>
                        <div class="font-weight-bold text-primary">AED 12300</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-contnet-between mb-1">
                        <div>Roshan James</div>
                        <div class="font-weight-bold text-primary">AED 12300</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-contnet-between mb-1">
                        <div>Roshan James</div>
                        <div class="font-weight-bold text-primary">AED 12300</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="d-flex justify-contnet-between mb-1">
                        <div>Roshan James</div>
                        <div class="font-weight-bold text-primary">AED 12300</div>
                    </div>
                </div>
                <div class="card-footer py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">More</h6>
                </div>
            </div>
        </div>

    </div>
</div>