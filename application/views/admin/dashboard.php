<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Overview</h1>
            <div class="d-none">
                <div class="form-group mr-1 d-none">
                    <button class="btn btn-light btn-sm line-height-normal p-3" id="reportrange">
                        <i class="mr-2 text-primary" data-feather="calendar"></i>
                        <span></span>
                        <i class="ml-1" data-feather="chevron-down"></i>
                    </button>
                    <form name="frmSearch" id="frmSearch" class="user" action="<?php echo base_url(); ?>securepanel/dashboard" method="get"  enctype="multipart/form-data" style="display: none;">
                        <input type="hidden" name="hdStartDate" id="hdStartDate">
                        <input type="hidden" name="hdEndDate" id="hdEndDate">
                        <button class="btn btn-dark" type="button" id="btnDashboardSearch"><i class="fas fa-search fa-sm"></i></button>
                    </form>
                    
                </div>
                <a href="#" class="d-sm-inline-block btn btn-md btn-primary shadow-sm h-40 d-none"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>
        </div>

        <!-- Content Row -->
        <div class="co-md-4">
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Sales</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">AED <?php echo $totalSales; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Bookings</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalBooking; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Confirm Bookings</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalConfirmBooking; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Pending Bookings</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalPendingBooking; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Completed Bookings</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalCompletedBooking; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Home Services</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalHomeServices; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Saloon Services</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalSaloonServices; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Product Sale</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalProductSale; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Product Use</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalProductUse; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Team</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalTeam; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Available Team</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalActiveTeam; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Off Team</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalOffTeam; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Customers</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalCustomers; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Suppliers</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalSuppliers; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>

        <div class="row">
            <!-- sales Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Sales Overview <span
                                class="text-gray-600">(Monthly)</span></h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Bookings Overview <span
                                class="text-gray-600">(Monthly)</span></h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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


        <div class="row">
            <!-- sales Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Best Performers <span
                                class="text-gray-600">(Monthly)</span></h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    <div
                        class="card-footer py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">More</h6>
                    </div>
                </div>
            </div>

        </div>
    </div>
    