<?php 
/*echo "<pre>";
print_r($productsInfo);
die();*/
?>
<style>
    @media print {
        /* Hide everything in the body when printing... */
        /*body.printing * { display: none; }*/
        body.printing #accordionSidebar,
        body.printing #content .nav,
        body.printing #content #pageSellProduct .hide-print{
            display: none;
        }
        /* ...except our special div. */
        body.printing #print-me { display: block; }
    }

    @media screen {
        /* Hide the special layer from the screen. */
        #print-me { display: none; }
    }
</style>
<style>
    #accordionSidebar,
    #content nav.navbar{
        display: none;
    }
</style><div class="container mb-3" id="pageSellProduct">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3 hide-print">
        <div class="text-primary f-24 hide-print">Add New Product</div>
        <a href="<?php echo base_url(); ?>securepanel/invetory" class="btn btn-dark hide-print">Back</a>
    </div>
    <div class="hide-print">
        <hr>
    </div>
    <!-- end header -->
    <div class="row hide-print">
        <div class="mt-2 col-md-8">
            <form name="frmAddForm" id="frmAddForm" class="user" action="<?php echo base_url(); ?>securepanel/add-sell-product-info" method="post"  enctype="multipart/form-data">
                <!-- name of product -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Select Of Product</label>
                        <select class="custom-select" id="lstProduct" name="lstProduct" required>
                            <option value="">Select</option><?php
                            foreach ($productsInfo as $key => $value) {
                                ?><option value="<?php echo $value->id; ?>" data-price="<?php echo $value->cost_of_sell; ?>" data-tax="<?php echo $value->sell_tax; ?>"><?php echo $value->title; ?></option><?php
                            }
                        ?></select>
                        <input type="hidden" name="hdTaxRate" id="hdTaxRate" value="0">
                    </div>
                </div>
                <!-- end name of product -->

                <!-- customers of product -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Name of Customers</label>
                        <input type="text" class="form-control" id="txtCustomerName" name="txtCustomerName" placeholder="Name" required>
                    </div>
                </div>
                <!-- end customers of product -->

                <!-- price of product -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Quantity</label>
                        <input type="tel" class="form-control" id="txtQuantity" name="txtQuantity" placeholder="Enter Quantity" required>
                    </div>
                </div>
                <!-- end name of product -->
                <!-- price of product -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Price (AED)</label>
                        <input type="text" class="form-control" id="txtPrice" name="txtPrice" placeholder="AED" required>
                    </div>
                </div>
                <!-- end name of product -->


                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <button id="btnSellProduct" class="btn btn-primary btn-lg btn-block">
                            <span class="text-white text-decoration-none">
                                Sell
                            </span>
                        </button>
                        <button id="btnSellProductNew" class="btn btn-primary btn-lg btn-block d-none">
                            <a href="<?php echo base_url(); ?>securepanel/sell-product" class="text-white text-decoration-none">
                                Sell new product
                            </a>
                        </button>
                    </div>
                </div>
            </form>
            <input type="hidden" name="hdSellProduct" id="hdSellProduct" value="N">
        </div>

        <!-- bill -->
        <div class="col-md-4 col-sm-12 mb-3 mt-3" id="service-card-box" style="display: none;">
            <div class="sticky-top">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center justify-content-center">
                        <img src="<?php echo base_url(); ?>assets/admin/img/logo-black.png">
                    </div>
                    <!-- bill generated -->
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="font-weight-bold text-gray-900" id="serviceCardName"></div>
                            </div>
                            <div>
                                <div class="text-right font-weight-bold text-gray-900" id="serviceCardPrice"></div>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <!-- vat -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="font-weight-bold text-gray-900">Quantity</div>
                            </div>
                            <div>
                                <div class="text-right font-weight-bold text-gray-900" id="serviceCardQuantity"></div>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <!-- vat -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <div class="font-weight-bold text-gray-900">Vat</div>
                            </div>
                            <div>
                                <div class="text-right font-weight-bold text-gray-900" id="serviceCardVat"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-between">
                        <div class="font-weight-bold text-gray-900">
                            Total
                        </div>
                        <div class="text-gray-900 font-weight-bold" id="serviceCardTotal"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12 col-sm-12 mt-2">
                        <button class="btn btn-success btn-lg btn-block" id="btnSellProductPrint">
                            <span class="text-white text-decoration-none">
                                <i class="fas fa-print"></i>&nbsp;Print Recipt
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div id="print-me" class="row">
        <div class="col-md-12">
        </div>
    </div>
</div>

<div class="modal fade" id="sell-product-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center f-24">
                
            </div>
        </div>
    </div>
</div>
