<style>
    #accordionSidebar,
    #content nav.navbar{
        display: none;
    }
</style><div class="container mb-3">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3">
        <div class="text-primary f-24">Add New Product</div>
        <a href="<?php echo base_url(); ?>securepanel/invetory" class="btn btn-dark">Back</a>
    </div>
    <div>
        <hr>
    </div>
    <!-- end header -->
    <div class="row">
        <div class="mt-2 col-md-12">
            <form name="frmAddForm" id="frmAddForm" class="user" action="<?php echo base_url(); ?>securepanel/add-product-info" method="post"  enctype="multipart/form-data">
                <!-- ID of Team -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Invoice Number </label>
                        <input type="text" class="form-control" id="txtInvoiceNumber" name="txtInvoiceNumber" placeholder="INV123456" value="" required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Select Suppliers</label>
                        <select class="custom-select" name="lstSupplier" id="lstSupplier" required>
                            <option value="">Select</option><?php
                            $arrCategory = array();
                            foreach ($supplierRecords as $key => $value) {
                                ?><option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option><?php
                                $arrCategory[$value['id']] = $value['category'];
                            }
                        ?></select>
                        <input type="hidden" name="hdSupplierServiceJson" id="hdSupplierServiceJson" value='<?php echo json_encode($arrCategory); ?>'>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Select Catogory</label>
                        <select class="custom-select" name="lstCategory" id="lstCategory" required>
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>
                <!-- end ID of Team -->



                <!-- name of product -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Name Of Product</label>
                        <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Name Of Product in Arabic</label>
                        <input type="text" class="form-control" id="txtNameAr" name="txtNameAr" placeholder="Name in Arabic">
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Quantity</label>
                        <input type="text" class="form-control" id="txtQuantity" name="txtQuantity" placeholder="30" required>
                    </div>
                </div>
                <!-- end name of product -->


                <!-- Cost of BUy -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Date Of added</label>
                        <div class="date-picker">
                            <input type="date" class="form-control form-control-lg text-left" placeholder="mm/dd/yyyy" style="text-align:center;" name="txtDate" id="txtDate" required>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Cost of Buy(Single Product)</label>
                        <input type="text" class="form-control" id="txtCostOfBuy" name="txtCostOfBuy" placeholder="30" required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Buy Tax(%)</label>
                        <input type="text" class="form-control" id="txtBuyTax" name="txtBuyTax" placeholder="VAT 5%" required>
                    </div>
                </div>
                <!-- end Cost of BUy -->
              
                <!-- Sell Tax -->
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Cost of Sell(Single Product)</label>
                        <input type="text" class="form-control" id="txtCostOfSell" name="txtCostOfSell" placeholder="30" required>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="text-primary">Sell Tax(%)</label>
                        <input type="text" class="form-control" id="txtSellTax" name="txtSellTax" placeholder="VAT 5%" required>
                    </div>
                </div>
                <!-- end Cost of Sell -->

                <div class="row mb-2">
                    <div class="form-group col-md-12 col-sm-12">
                        <label class="text-primary">Status</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusAC" name="rdStatus"
                                class="custom-control-input" checked value="AC">
                            <label class="custom-control-label" for="rdStatusAC">In Stock</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdStatusIN" name="rdStatus"
                                class="custom-control-input" value="IN">
                            <label class="custom-control-label" for="rdStatusIN">Out of Stock</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 col-sm-12">
                        <button id="btnAddProduct" class="btn btn-primary btn-lg btn-block">
                            <span class="text-white text-decoration-none">
                                Create
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>