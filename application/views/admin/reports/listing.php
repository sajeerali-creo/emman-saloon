<!-- Begin Page Content -->
<div class="container-fluid" onload="javascript: AutoRefresh(5000);">

    <!-- Page Heading -->
    <div class="mb-3">
        <h1 class="h3 mb-0 text-gray-800">All Reports</h1>
    </div>



    <!-- Begin Page Content -->
    <div class="row report-box">
        <div class="col-md-3 col-sm-12  mb-4">
            <a class="font-weight-bold download-trading-summary" data-type="TRSUM" data-label="Trading Summary">
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url() ?>assets/admin/img/report.svg"
                        alt="Card image cap">
                    <div class="card-body report-body text-center">
                        <h5 class="card-title text-dark font-weight-bold">Trading Summary</h5>
                        <p class="card-text font-weight-light">Download the report from the belwo button</p>
                        <button class="btn btn-dark text-white">Download</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-12  mb-4">
            <a class="font-weight-bold download-trading-summary" data-type="PSU" data-label="Professional Stock Usage">
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url() ?>assets/admin/img/report.svg"
                        alt="Card image cap">
                    <div class="card-body report-body text-center">
                        <h5 class="card-title text-dark font-weight-bold">Professional Stock Usage</h5>
                        <p class="card-text font-weight-light">Download the report from the belwo button</p>
                        <button class="btn btn-dark text-white">Download</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-12  mb-4">
            <a class="font-weight-bold download-trading-summary" data-type="TBE" data-label="Transactions by Employee">
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url() ?>assets/admin/img/report.svg"
                        alt="Card image cap">
                    <div class="card-body report-body text-center">
                        <h5 class="card-title text-dark font-weight-bold">Transactions by Employee</h5>
                        <p class="card-text font-weight-light">Download the report from the belwo button</p>
                        <button class="btn btn-dark text-white">Download</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-12  mb-4">
            <a class="font-weight-bold download-trading-summary" data-type="SBDC"
                data-label="Service Breakdown by Category">
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url() ?>assets/admin/img/report.svg"
                        alt="Card image cap">
                    <div class="card-body report-body text-center">
                        <h5 class="card-title text-dark font-weight-bold">Services by Category</h5>
                        <p class="card-text font-weight-light">Download the report from the belwo button</p>
                        <button class="btn btn-dark text-white">Download</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-12  mb-4">
            <a class="font-weight-bold download-trading-summary" data-type="INSR" data-label="Stock Received">
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url() ?>assets/admin/img/report.svg"
                        alt="Card image cap">
                    <div class="card-body report-body text-center">
                        <h5 class="card-title text-dark font-weight-bold">Stock Received</h5>
                        <p class="card-text font-weight-light">Download the report from the belwo button</p>
                        <button class="btn btn-dark text-white">Download</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-12  mb-4">
            <a class="font-weight-bold download-trading-summary" data-type="PUBE" data-label="Product Use by Employees">
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url() ?>assets/admin/img/report.svg"
                        alt="Card image cap">
                    <div class="card-body report-body text-center">
                        <h5 class="card-title text-dark font-weight-bold">Product Use by Employees</h5>
                        <p class="card-text font-weight-light">Download the report from the belwo button</p>
                        <button class="btn btn-dark text-white">Download</button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-12  mb-4">
            <a class="font-weight-bold download-trading-summary" data-type="EMSB"
                data-label="Employee Breakdown Report">
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url() ?>assets/admin/img/report.svg"
                        alt="Card image cap">
                    <div class="card-body report-body text-center">
                        <h5 class="card-title text-dark font-weight-bold">Employee Breakdown</h5>
                        <p class="card-text font-weight-light">Download the report from the belwo button</p>
                        <button class="btn btn-dark text-white">Download</button>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.container-fluid -->

<!-- delet services -->
<div class="modal fade" id="download-report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <div class="modal-body text-center f-24 shadow card-counter bg-dark text-white">
                <h5 class="modal-title model-main-title"></h5>
                <h6 class="modal-title">Choose the date range</h6>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="form-group" style="text-align: center;">
                    <div class="mr-2 w-sm-100 mr-sm-0 mt-sm-1">
                        <button class="card p-2 w-sm-100 mr-2" id="reportrange"
                            style='margin-right: auto !important;margin-left: auto !important; margin-bottom: 9px;'>
                            <i class="text-primary" data-feather="calendar"></i>
                            <span></span>
                            <i class="ml-1" data-feather="chevron-down"></i>
                        </button>
                        <form name="frmSearch" id="frmSearch" class="user w-sm-100"
                            action="<?php echo base_url(); ?>securepanel/booking" method="get"
                            enctype="multipart/form-data" style="display: none;">
                            <input type="hidden" name="sDate" id="hdStartDate" value="<?php echo($sDate); ?>">
                            <input type="hidden" name="eDate" id="hdEndDate" value="<?php echo($eDate); ?>">
                            <input type="hidden" name="reportType" id="reportType" value="">
                            <button class="btn btn-dark" type="submit"><i class="fas fa-search fa-sm"></i></button>
                        </form>
                    </div>
                    <div class="row mb-4 mt-4" id="divUserSelection">
                        <div class="col-lg-2 col-md-12"></div>
                        <div class="col-lg-8 col-md-12">
                            <select name="lstIEmployee" id="lstIEmployee" class="custom-select">
                                <option value="all">All Employees</option>
                                <?php 
                                foreach ($teamInfo as $key => $value) {
                                    ?><option value="<?php echo $value->id; ?>">
                                    <?php echo $value->first_name . " " . $value->last_name; ?></option><?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-12"></div>
                    </div>
                    <a href="javascript:;" id="lnkDownloadReport"
                        class="d-sm-inline-block btn btn-md btn-success shadow-sm h-40 w-sm-100 mt-sm-1"
                        target="_blank"><i class="fas fa-file-download"></i>&nbsp;Download</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-order-msg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <div class="modal-body text-center f-24">
                Are you sure to delete this item?
            </div>
        </div>
    </div>
</div>