<!-- Begin Page Content -->
<div class="container-fluid" onload="javascript: AutoRefresh(5000);">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bookings</h1>
        <div class="d-flex d-sm-block">
            <div class="mr-2 w-sm-100 mr-sm-0 mt-sm-1">
                <button class="card p-2 w-sm-100 mr-2" id="reportrange">
                    <i class="text-primary" data-feather="calendar"></i>
                    <span></span>
                    <i class="ml-1" data-feather="chevron-down"></i>
                </button>
                <form name="frmSearch" id="frmSearch" class="user w-sm-100"
                    action="<?php echo base_url(); ?>securepanel/booking" method="get" enctype="multipart/form-data"
                    style="display: none;">
                    <input type="hidden" name="sDate" id="hdStartDate" value="<?php echo($sDate); ?>">
                    <input type="hidden" name="eDate" id="hdEndDate" value="<?php echo($eDate); ?>">
                    <button class="btn btn-dark" type="submit" id="btnDashboardSearch"><i
                            class="fas fa-search fa-sm"></i></button>
                </form>
            </div>
            <a href="javascript:;" id="lnkSearchDate" class="d-sm-inline-block btn btn-md btn-dark shadow-sm h-40 w-sm-100 mt-sm-1"><i class="fas fa-search fa-sm"></i></a>
        </div>

    </div>

    <!-- Begin Page Content -->
    <div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?php echo count($dataRecords); ?>&nbsp;
                    <span class="text-gray-600">Bookings</span>
                </h6>
                <div>
                    <a href="#" id="btPrintReport" class="d-none d-sm-inline-block btn btn-md btn-success shadow-sm"><i class="fas fa-file-download"></i>&nbsp;Export Report</a>
                    <a href="<?php echo base_url(); ?>securepanel/booking-calendar" class="d-none d-sm-inline-block btn btn-md btn-dark shadow-sm"> <i class="fas fa-calendar-alt"></i>&nbsp;Calender View</a>
                    <a href="<?php echo base_url(); ?>securepanel/add-booking" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-plus"></i>&nbsp;Add New Bookings</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Customer</th>
                                <th>Services</th>
                                <th>Team Members</th>
                                <th>Service Date & Time</th>
                                <th>Booking Date & Time</th>
                                <th>Service Type</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            if(!empty($dataRecords)){
                                $intCount = 1;
                                foreach($dataRecords as $record){
                                    ?><tr class="row_<?php echo $record['info']['cartMasterId']; ?>">
                                        <th><?php echo $intCount++; ?></th>
                                        <th>
                                            <div class="text-primary"><?php echo $record['info']['first_name'] . " " . $record['info']['last_name']; ?></div>
                                            <div class="text-gray font-weight-normal"><?php echo $record['info']['email']; ?></div>
                                            <div class="text-gray font-weight-normal"><?php echo $record['info']['phone']; ?></div>
                                        </th>
                                        <th><?php 
                                            $strInfo = '';
                                            foreach ($record['serviceAllInfo'] as $key => $value) {
                                                $strInfo .= $value['serviceCategory'] . " - " . $value['serviceName'] . " - " . $value['person'] . ' Person<br/>';
                                            }
                                            echo $strInfo;
                                        ?></th>
                                        <th><?php 
                                            $strInfo = '';
                                            foreach ($record['teamInfo'] as $key => $value) {
                                                $strInfo .= $value['first_name'] . " " . $value['last_name'] . '<br/>';
                                            }
                                            echo (empty($strInfo) ? "NA" : $strInfo);
                                        ?></th>
                                        <th><?php echo $record['info']['service_date'] . " - " . $record['info']['service_time']; ?></th>
                                        <th><?php echo $record['info']['addDate']; ?></th>
                                        <th><?php echo ucwords($record['info']['booking_type'] . " Service"); ?></th>
                                        <th><?php echo $record['info']['address']; ?></th>
                                        <th>AED <?php echo $record['info']['total_price']; ?></th><?php
                                        if($record['info']['flCancel'] == '1'){
                                            ?><th class="text-danger status-booking-<?php echo $record['info']['cartMasterId']; ?>">Cancelled</th><?php
                                        }
                                        else if ($record['info']['status'] == 'PN') {
                                            ?><th class="text-warning status-booking-<?php echo $record['info']['cartMasterId']; ?>">Pending</th><?php
                                        }
                                        else if ($record['info']['status'] == 'CN') {
                                            ?><th class="text-info status-booking-<?php echo $record['info']['cartMasterId']; ?>">Confirmed</th><?php
                                        }
                                        else if ($record['info']['status'] == 'SBR') {
                                            ?><th class="text-info status-booking-<?php echo $record['info']['cartMasterId']; ?>">Servicer Rejected</th><?php
                                        }
                                        else if ($record['info']['status'] == 'SBC') {
                                            ?><th class="text-info status-booking-<?php echo $record['info']['cartMasterId']; ?>">Servicer Confirmed</th><?php
                                        }
                                        else{
                                            ?><th class="text-success">
                                                Completed<br/>
                                                <?php 
                                                if($record['info']['payment_type'] == 'card'){
                                                    echo "Paid by Card(" . $record['info']['card_number'] . ")";
                                                } else if($record['info']['payment_type'] == 'cash'){
                                                    echo "Paid by cash";
                                                }
                                                ?>
                                            </th><?php
                                        }
                                        
                                        ?><th class="text-right"><?php 
                                            ?><a href="<?php echo base_url().'securepanel/view-booking/'.$record['info']['cartMasterId']; ?>" class="btn btn-light">
                                                <i class="fas fa-eye"></i>
                                            </a><?php
                                            if($record['info']['flCancel'] != '1' && $record['info']['status'] != 'CM'){
                                                ?><a href="<?php echo base_url().'securepanel/edit-booking/'.$record['info']['cartMasterId']; ?>" class="btn btn-light edit-booking-<?php echo $record['info']['cartMasterId']; ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a data-toggle="modal" data-target="#delete-order"
                                                    class="btn btn-light deleteOrder text-danger  delete-booking-<?php echo $record['info']['cartMasterId']; ?>"
                                                    data-recordid="<?php echo $record['info']['cartMasterId']; ?>" title="Cancel Booking">
                                                    <i class="fas fa-times"></i>
                                                </a><?php
                                            }
                                        ?></th>
                                    </tr><?php
                                }
                            }
                        ?></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.container-fluid -->

<!-- delet services -->
<div class="modal fade" id="delete-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                <h5 class="modal-title">Are you sure to cancel this booking?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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