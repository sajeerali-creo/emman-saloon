<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Begin Page Content -->
    <div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?php echo count($dataRecords); ?>&nbsp;
                    <span class="text-gray-600">Team</span>
                </h6>
                <div>
                    <a href="#" id="btPrintReport" class="d-none d-sm-inline-block btn btn-md btn-success shadow-sm"><i class="fas fa-file-download"></i>&nbsp;Export Report</a>
                    <a href="<?php echo base_url(); ?>securepanel/calender-team"
                        class="d-none d-sm-inline-block btn btn-md btn-dark shadow-sm">
                        <i class="fas fa-calendar-alt"></i>&nbsp;Calender View</a>
                    <a href="<?php echo base_url(); ?>securepanel/add-team"
                        class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
                        <i class="fas fa-plus"></i>&nbsp;Add New Team</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Positioning</th>
                                <th>Capabilty</th>
                                <th>No.of Service Done</th>
                                <th>Joining Date</th>
                                <th>Gender</th>
                                <th>Experience</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            if(!empty($dataRecords)){
                                foreach($dataRecords as $record){
                                    ?><tr class="row_<?php echo $record->id; ?>">
                                        <th>
                                            <div class="text-primary">ES<?php echo $record->id; ?></div>
                                        </th>
                                        <th><?php echo $record->first_name . " " . $record->last_name; ?></th>
                                        <th><?php echo $arrPositioning[$record->positioning]; ?></th>
                                        <th><?php 
                                            $arrCap = json_decode($record->capabilities, 1);
                                            $strCap = '';
                                            foreach ($arrCap as $capVal) {
                                                $strCap .= $arrCapabilities[$capVal] . "<br>";
                                            }
                                            echo trim($strCap, "<br>"); 
                                        ?></th>
                                        <th>30</th>
                                        <th><?php echo $record->joining_date; ?></th>
                                        <th><?php echo $arrGender[$record->gender]; ?></th>
                                        <th><?php echo $record->experience; ?></th><?php

                                        if($record->status == 'AC'){
                                            ?><th class="text-success">Available</th><?php
                                        } else if($record->status == 'IN'){
                                            ?><th class="text-danger">Day-Off</th><?php
                                        } else if($record->status == 'SL'){
                                            ?><th class="text-danger">Sick Leave</th><?php
                                        } else if($record->status == 'ML'){
                                            ?><th class="text-danger">Medical</th><?php
                                        } else{
                                            ?><th class="text-danger">Off</th><?php
                                        }

                                        ?><th class="text-right">
                                            <a href="<?php echo base_url().'securepanel/detail-team/'.$record->id; ?>" class="btn btn-light">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url().'securepanel/edit-team/'.$record->id; ?>" class="btn btn-light">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a data-toggle="modal" data-target="#delete-team"
                                                class="btn btn-light deleteTeam" data-recordid="<?php echo $record->id; ?>">
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
<div class="modal fade" id="delete-team" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="delete-team-msg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                Are you sure to delete this item?
            </div>
        </div>
    </div>
</div>