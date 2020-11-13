<?php 
/*echo "<pre>";
print_r($productsInfo);
die();*/
?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
/>
<style>
    .choices__list--dropdown{
        text-align:left;
    }
    .choices[data-type*=select-multiple] .choices__inner, 
    .choices[data-type*=text] .choices__inner{
        text-align: left;
    }
    .choices__placeholder {
        opacity: 1;
        color: #6e707e;
    }
    .choices__inner {
        background-color: #ffffff;
    }
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
        <div class="text-primary f-24 hide-print">Use a Product(Professional Use)</div>
        <a href="<?php echo base_url(); ?>securepanel/invetory" class="btn btn-dark hide-print">Back</a>
    </div>
    <div class="hide-print">
        <hr>
    </div>
    <!-- end header -->
    <div class="row hide-print">
        <div class="mt-2 col-md-8">
            <form name="frmAddForm" id="frmAddUseForm" class="user" action="<?php echo base_url(); ?>securepanel/add-use-product-info" method="post"  enctype="multipart/form-data">
                <!-- customers of product -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Name of Employee</label>
                        <select class="custom-select" id="lstEmployee" name="lstEmployee" required="required">
                            <option value="">Select</option>
                            <?php foreach ($teamInfo as $key => $value) {
                                ?><option value="<?php echo $value->id; ?>"><?php echo $value->first_name . " " . $value->last_name; ?></option><?php
                            } ?>
                        </select>
                    </div>
                </div>
                <!-- end customers of product -->

                <!-- name of product -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Select a Product</label>
                        <select class="custom-select" id="lstProduct" name="lstProduct" required>
                            <option value="" data-remaining="0">Select</option><?php
                            foreach ($productsInfo as $key => $value) {
                                ?><option value="<?php echo $value->id; ?>" data-price="<?php echo $value->cost_of_sell; ?>" data-tax="<?php echo $value->sell_tax; ?>" data-remaining="<?php echo $value->remaining_quantity; ?>"><?php echo $value->title; ?></option><?php
                            }
                        ?></select>
                        <input type="hidden" name="hdTaxRate" id="hdTaxRate" value="0">
                        <input type="hidden" name="hdMaxQuantity" id="hdMaxQuantity" value="0">
                    </div>
                </div>
                <!-- end name of product -->

                <!-- price of product -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Quantity</label>
                        <input type="tel" class="form-control number_only" id="txtQuantity" name="txtQuantity" placeholder="Enter Quantity" required>
                        <label class="text-primary mt-1 text-success" id="product-stock-label" style="display: none;"></label>
                    </div>
                </div>
                <!-- end name of product -->

                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <button type="button" id="btnUseProduct" class="btn btn-primary btn-lg btn-block">
                            <span class="text-white text-decoration-none">
                                Use
                            </span>
                        </button>
                    </div>
                </div>
            </form>
            <input type="hidden" name="hdSellProduct" id="hdSellProduct" value="N">
            <input type="hidden" name="productSaleId" id="productSaleId" value="">
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>