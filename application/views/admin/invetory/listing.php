<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if($error)
                {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>                    
            </div>
            <?php } ?>
            <?php  
                $success = $this->session->flashdata('success');
                if($success)
                {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
            
            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                    href="#list-inventory" role="tab" aria-controls="home">Inventory</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" href="<?php echo (base_url() . 'securepanel/invetory-employee'); ?>" >Employees Used</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list"
                    href="<?php echo (base_url() . 'securepanel/invetory-pooduct'); ?>">Sales</a>
            </div>
        </div>
        <div class="col-12">
            <div class="tab-content" id="nav-tabContent">
                
                <!-- inventory -->
                <div class="tab-pane fade show active" id="list-inventory" role="tabpanel" aria-labelledby="list-home-list">
                    <!-- Begin Page Content -->
                    <div>
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
                            <div class="d-flex d-sm-block">
                                <div class="mr-2 w-sm-100 mr-sm-0 mt-sm-1">
                                    <button class="card p-2 w-sm-100 mr-2" id="reportrange">
                                        <i class="text-primary" data-feather="calendar"></i>
                                        <span></span>
                                        <i class="ml-1" data-feather="chevron-down"></i>
                                    </button>
                                    <form name="frmSearch" id="frmSearch" class="user w-sm-100"
                                        action="<?php echo base_url(); ?>securepanel/invetory" method="get" enctype="multipart/form-data"
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
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <?php echo count($dataRecords); ?>&nbsp;
                                    <span class="text-gray-600">Products</span>
                                </h6>
                                <div>
                                    <a href="#" id="btPrintReport"
                                        class="d-none d-sm-inline-block btn btn-md btn-success shadow-sm"><i
                                            class="fas fa-file-download"></i>&nbsp;Export Report</a>
                                    <a href="<?php echo base_url(); ?>securepanel/use-product"
                                        class="d-none d-sm-inline-block btn btn-md btn-warning shadow-sm">
                                        <i class="fas fa-house-user"></i>&nbsp;Use Products</a>
                                    <a href="<?php echo base_url(); ?>securepanel/sell-product"
                                        class="d-none d-sm-inline-block btn btn-md btn-dark shadow-sm">
                                        <i class="fas fa-cart-arrow-down"></i>&nbsp;Sell Products</a>
                                    <a href="<?php echo base_url(); ?>securepanel/add-product"
                                        class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm">
                                        <i class="fas fa-plus"></i>&nbsp;Add New Products</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th>ID</th>
                                                <th>Supplier Name</th>
                                                <th>Category</th>
                                                <th>Product Name</th>
                                                <th>Total Qty</th>
                                                <th>Date fo add</th>
                                                <th>Cost fo Buy (AED)</th>
                                                <th>Buy Tax</th>
                                                <th>Cost Sales (AED)</th>
                                                <th>Sell Tax</th>
                                                <th>Profit</th>
                                                <th>Qty Instock</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody><?php
                            $intCount = 1;
                            foreach ($dataRecords as $key => $value) {
                                /*echo "<pre>";
                                print_r($supplierRecords);
                                die();*/
                                ?><tr class="row_<?php echo $value->id; ?>">
                                                <th><?php echo $intCount++; ?></th>
                                                <th><?php echo ($supplierRecords[$value->suppliers_id] ? $supplierRecords[$value->suppliers_id]['title'] : ''); ?></th>
                                                <th><?php echo $value->category_id; ?></th>
                                                <th><?php echo $value->title; ?></th>
                                                <th><?php echo $value->quantity; ?></th>
                                                <th><?php echo $value->date_of_add; ?></th>
                                                <th><?php echo $value->cost_of_buy; ?></th>
                                                <th><?php echo $value->buy_tax; ?></th>
                                                <th><?php echo $value->cost_of_sell; ?></th>
                                                <th><?php echo $value->sell_tax; ?></th>
                                                <th><?php echo $value->cost_of_sell - $value->cost_of_buy; ?></th>
                                                <th><?php echo $value->remaining_quantity; ?></th><?php
                                    if($value->status == 'AC'){
                                        ?><th class="text-success">In Stock</th><?php
                                    }
                                    else{
                                        ?><th class="text-danger">Out of Stock</th><?php
                                    }
                                    
                                    ?><th class="text-right">
                                                    <a href="<?php echo (base_url() . 'securepanel/edit-product/' . $value->id); ?>"
                                                        class="btn btn-light">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#delete-product"
                                                        class="btn btn-light deleteProduct"
                                                        data-recordid="<?php echo $value->id; ?>">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </th>
                                            </tr><?php
                            }
                        ?></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- end inventory -->

                <!-- Employee -->
                <div class="tab-pane fade" id="list-employee" role="tabpanel" aria-labelledby="list-profile-list">
                    add your table here
                </div>
                <!-- end employee -->

                <!-- Product -->
                <div class="tab-pane fade" id="list-product" role="tabpanel" aria-labelledby="list-messages-list">
                add your table here
                </div>
                <!-- end product -->

            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->
<!-- delet services -->
<div class="modal fade" id="delete-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                Are you sure to delete this product?
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary">Yes</button>
                <input type="hidden" name="hdDeleteRecordId" id="hdDeleteRecordId">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-product-msg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                Are you sure to delete this item?
            </div>
        </div>
    </div>
</div>