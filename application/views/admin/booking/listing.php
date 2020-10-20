<!-- Begin Page Content -->
<div class="container-fluid">

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
                                <th>Service Date & Time</th>
                                <th>Booking Date & Time</th>
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
                                                $strInfo .= $value['serviceCategory'] . " - " . $value['serviceName'] . '<br/>';
                                            }
                                            echo $strInfo;
                                        ?></th>
                                        <th><?php echo $record['info']['service_date'] . " - " . $record['info']['service_time']; ?></th>
                                        <th><?php echo $record['info']['addDate']; ?></th>
                                        <th><?php echo $record['info']['address']; ?></th>
                                        <th>AED <?php echo $record['info']['total_price']; ?></th><?php
                                        if ($record['info']['status'] == 'PN') {
                                            ?><th class="text-warning">Pending</th><?php
                                        }
                                        else if ($record['info']['status'] == 'CN') {
                                            ?><th class="text-info">Confirmed</th><?php
                                        }
                                        else if ($record['info']['status'] == 'SBR') {
                                            ?><th class="text-info">Servicer Rejected</th><?php
                                        }
                                        else if ($record['info']['status'] == 'SBC') {
                                            ?><th class="text-info">Servicer Confirmed</th><?php
                                        }
                                        else{
                                            ?><th class="text-success">Completed</th><?php
                                        }
                                        
                                        ?><th class="text-right">
                                            <a href="<?php echo base_url().'securepanel/view-booking/'.$record['info']['cartMasterId']; ?>" class="btn btn-light">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url().'securepanel/edit-booking/'.$record['info']['cartMasterId']; ?>" class="btn btn-light">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </th>
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
<div class="modal fade" id="delete-service" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                Are you sure to delete this item?
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
                <input type="hidden" name="hdDeleteRecordId" id="hdDeleteRecordId">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-service-msg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                Are you sure to delete this item?
            </div>
        </div>
    </div>
</div>