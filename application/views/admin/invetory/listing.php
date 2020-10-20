<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Begin Page Content -->
    <div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?php echo count($dataRecords); ?>&nbsp;
                    <span class="text-gray-600">Products</span>
                </h6>
                <div>
                    <a href="#" id="btPrintReport" class="d-none d-sm-inline-block btn btn-md btn-success shadow-sm"><i class="fas fa-file-download"></i>&nbsp;Export Report</a>
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
                                <th>Invoice No</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Date fo add</th>
                                <th>Cost fo Buy (AED)</th>
                                <th>Buy Tax</th>
                                <th>Cost Sales (AED)</th>
                                <th>Sell Tax</th>
                                <th>Profit</th>
                                <th>Balance Product</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody><?php
                            $intCount = 1;
                            foreach ($dataRecords as $key => $value) {
                                /*echo "<pre>";
                                print_r($value);
                                die();*/
                                ?><tr class="row_<?php echo $value->id; ?>">
                                    <th><?php echo $intCount++; ?></th>
                                    <th><?php echo $value->invoice_number; ?></th>
                                    <th><?php echo $value->title; ?></th>
                                    <th><?php echo $value->quantity; ?></th>
                                    <th><?php echo $value->date_of_add; ?></th>
                                    <th><?php echo $value->cost_of_buy; ?></th>
                                    <th><?php echo $value->buy_tax; ?></th>
                                    <th><?php echo $value->cost_of_sell; ?></th>
                                    <th><?php echo $value->sell_tax; ?></th>
                                    <th>0</th>
                                    <th><?php echo $value->cost_of_buy; ?></th><?php
                                    if($value->status == 'AC'){
                                        ?><th class="text-success">In Stock</th><?php
                                    }
                                    else{
                                        ?><th class="text-danger">Out of Stock</th><?php
                                    }
                                    
                                    ?><th class="text-right">
                                        <a href="<?php echo (base_url() . 'securepanel/edit-product/' . $value->id); ?>" class="btn btn-light">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#delete-product"
                                            class="btn btn-light deleteProduct" data-recordid="<?php echo $value->id; ?>">
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