<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Begin Page Content -->
    <div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?php echo count($dataRecords); ?>&nbsp;
                    <span class="text-gray-600">Customers</span>
                </h6>
                <div>
                    <a href="#" id="btPrintReport" class="d-none d-sm-inline-block btn btn-md btn-success shadow-sm"><i class="fas fa-file-download"></i>&nbsp;Export Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Service</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            if(!empty($dataRecords)){
                                foreach($dataRecords as $record){
                                    ?><tr class="row_<?php echo $record->id; ?>">
                                        <th>C<?php echo $record->id; ?></th>
                                        <th><?php echo $record->first_name . " " . $record->last_name; ?></th>
                                        <th><?php echo $record->email; ?></th>
                                        <th><?php echo $record->phone_number; ?></th>
                                        <th><?php echo $record->totalOrder; ?></th>
                                        <th><?php echo $record->totalPrice; ?></th><?php

                                        if ($record->status == 'PN') {
                                            ?><th class="text-warning">Inactive</th><?php
                                        }
                                        else{
                                            ?><th class="text-success">Active</th><?php
                                        }
                                        
                                        ?><th class="text-right">
                                            <a data-toggle="modal" data-target="#delete-customer"
                                                class="btn btn-light deleteCustomer" data-recordid="<?php echo $record->id; ?>">
                                                <i class="fas fa-trash-alt"></i>
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
<div class="modal fade" id="delete-customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                Are you sure to delete this customer?
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
                <input type="hidden" name="hdDeleteRecordId" id="hdDeleteRecordId">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-customer-msg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                Are you sure to delete this item?
            </div>
        </div>
    </div>
</div>