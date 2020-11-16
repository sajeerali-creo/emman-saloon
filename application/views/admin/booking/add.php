<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
/><style>
    #accordionSidebar,
    #content nav.navbar{
        display: none;
    }
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
</style><div class="container mb-3">
    <!-- header -->
    <div class="d-flex justify-content-between mt-3">
        <div class="text-primary f-24">Add New Booking</div>
        <a href="<?php echo base_url() ?>securepanel/booking" class="btn btn-dark">Back</a>
    </div>
    <div>
        <hr>
    </div>
    <!-- end header -->
    <div class="row">
        <div class="mt-2 col-md-8">
            <?php $this->load->helper("form"); ?>
            <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>                    
            </div>
            <?php
                } ?>
            <?php
                $success = $this->session->flashdata('success');
                if ($success) {
                ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php
                } ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
            <form name="frmAddForm" id="frmAddForm" class="user" action="<?php echo base_url(); ?>securepanel/add-booking-info" method="post"  enctype="multipart/form-data">
                <!-- type of services -->
                <div class="row">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Select Service Type</label>
                        <div class="clearfix"></div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdServiceTypeHS" name="rdServiceType" class="custom-control-input rdServiceType" checked value="HS">
                            <label class="custom-control-label" for="rdServiceTypeHS">Home Service</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdServiceTypeSS" name="rdServiceType" class="custom-control-input rdServiceType"  value="SS">
                            <label class="custom-control-label" for="rdServiceTypeSS">Saloon Service</label>
                        </div>
                    </div>
                </div>
                <!-- end type of services -->
                <?php //echo "<pre>"; print_r($productInfo); die(); ?>
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <div id="div_service_count_main">
                            <div id="div_service_count_1" class="row mb-2">
                                <div class="form-group col-md-12 col-sm-12 mb-2">
                                    <label class="text-primary">Select Service</label>
                                    <select class="custom-select" name="lstService[]" id="lstService1" required>
                                        <option value="">Select</option><?php
                                        foreach ($serviceInfo as $key => $value) {
                                            ?><optgroup label="<?php echo $value['categoryName']; ?>"><?php
                                                foreach ($value['services'] as $service) {
                                                    ?><option value="<?php echo $service['id']; ?>" data-price="<?php echo $service['price']; ?>"><?php echo $service['title']; ?></option><?php
                                                }
                                            ?></optgroup><?php
                                        }
                                    ?></select>
                                    <input type="hidden" name="hdServiceJsonInfo" id="hdServiceJsonInfo" value='<?php echo(json_encode($serviceInfo)); ?>'>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 mb-2">
                                    <input type="text" class="form-control number_only" name="txtPersonCount[]" id="txtPersonCount1" value="" required placeholder="Number of Person">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 mb-2">
                                    <select class="custom-select" name="lstServicer[]" id="lstServicer1" required>
                                        <option value="">Select servicer</option><?php
                                        foreach ($teamInfo as $key => $value) {
                                            ?><option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option><?php
                                        }
                                    ?></select>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 mb-2">
                                    <select class="custom-select lstProductChoice" name="lstProduct[0][]" id="lstProduct1" multiple>
                                        <option value="">Select Product</option><?php 
                                        foreach ($productInfo as $key => $value) {
                                            ?><option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option><?php
                                        }
                                    ?></select>
                                </div>
                                <input type="hidden" name="hdServicerJsonInfo" id="hdServicerJsonInfo" value='<?php echo(json_encode($teamInfo)); ?>'>
                                <input type="hidden" name="hdProductJsonInfo" id="hdProductJsonInfo" value='<?php echo(json_encode($productInfo)); ?>'>
                            </div>
                        </div>
                        <input type="hidden" name="hdServiceCount" id="hdServiceCount" value="1">
                        <input type="hidden" name="hdServicerProductCount" id="hdServicerProductCount" value="1">
                        <button type="button" class="btn btn-primary" id="btnAddMoreService">Add More Service</button>
                    </div>
                </div>                

                <!-- Select date of Service -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Select date of Service</label>
                        <div class="date-picker"><?php 
                            $defDate = date("Y-m-d");
                            ?><input type="date" class="form-control form-control-lg text-left" placeholder="mm/dd/yyyy"  min='<?php echo date("Y-m-d"); ?>' style="text-align:center;" id="txtBookingDate" name="txtBookingDate" value="<?php echo $defDate; ?>">
                        </div>
                    </div>
                </div>
                <!-- end Select date of Service -->

                <!-- Select time of Service -->
                <div class="row mb-2">
                    <div class="form-group col-md-12 col-sm-12"><?php
                        
                        $defTime = '';

                        ?><label class="text-primary">Select time of Service</label>
                        <div id="available-time-list"><?php
                            foreach ($arrTimeSlots as $key => $value) {
                                ?><button id="timeslot_<?php echo preg_replace('/[^0-9A-Za-z]/i', '', $value); ?>" data-val="<?php echo $value; ?>" type="button" class="btn <?php echo($defTime == $value ? ' btn-primary ' : ' btn-outline-primary '); ?> mr-1 mb-1"><?php echo $value; ?></button><?php    
                            }
                            ?><input type="hidden" name="hdAvailableTime" id="hdAvailableTime" value="">
                        </div>
                    </div>
                </div>
                <!-- end Select time of Service -->

                <!-- If any service charge extra? -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">If any service charge extra?(AED)</label>
                        <input type="text" class="form-control number_only" id="txtServiceCharge" name="txtServiceCharge" value="" placeholder="Service Charge" >
                    </div>
                </div>
                <!-- end If any service charge extra? -->
                <!-- If any discount? -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">If any Discount?(%)</label>
                        <input type="text" class="form-control number_only" id="txtDiscount" name="txtDiscount" value="" placeholder="Discount">
                    </div>
                </div>
                <!-- end If any service charge extra? -->
                <!-- If any discount? -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Vat(%)</label>
                        <input type="text" class="form-control number_only" id="txtVat" name="txtVat" value="5" placeholder="Vat Percentage">
                    </div>
                </div>
                <!-- end If any service charge extra? -->

                <div class="text-dark">
                    <label class="text-primary">Customer Details</label>
                </div>
                <div>
                    <hr>
                </div>
                <div class="row mb-2">
                    <div class="form-group col-md-12 col-sm-12">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdCustomerN" name="rdCustomer"
                                class="custom-control-input rdCustomer" checked value="N">
                            <label class="custom-control-label" for="rdCustomerN">New Customer</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="rdCustomerE" name="rdCustomer"
                                class="custom-control-input rdCustomer" value="E">
                            <label class="custom-control-label" for="rdCustomerE">Existing Customer</label>
                        </div>
                        
                    </div>
                </div>
                <div class="row mb-2" id="divSearchEmail" style="display: none;">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Phone Number</label>
                        <select name="lstCustomerPhone" class="form-control" id="lstCustomerPhone">
                            <option value="">Search Phone Number</option><?php
                            foreach ($arrCustomers as $key => $value) {
                                ?><option value="<?php echo $value->phone_number; ?>" data-name="<?php echo $value->first_name . " " . $value->last_name; ?>" data-phone="<?php echo $value->phone_number; ?>"><?php echo $value->phone_number; ?></option><?php
                            }
                        ?></select>
                    </div>
                </div>
                <!-- persons -->
                <div class="row mb-2" id="divEnterEmail">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Phone Number</label>
                        <input type="tel" class="form-control number_only" id="txtCustomerPhone" name="txtCustomerPhone" value="" placeholder="+971" required>
                    </div>
                </div>
                <!-- end persons -->
                <!-- persons -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Name of Customers</label>
                        <input type="text" class="form-control" id="txtCustomerName" name="txtCustomerName" value="" placeholder="Name" required>
                    </div>
                </div>
                <!-- end persons -->
                <!-- persons -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Email</label>
                        <input type="email" class="form-control" id="txtCustomerEmail" name="txtCustomerEmail" value="" placeholder="abc@example.com" required>
                    </div>
                </div>
                <!-- end persons -->
                <!-- persons -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Location - Cluster</label>
                        <div class="form-group">
                            <?php 
                            /*echo "<pre>";
                            print_r($arrCluster);
                            die();*/
                            ?>
                            <select class="custom-select" name="lstCluster" id="lstCluster" required>
                                <option value="">Select cluster</option><?php
                                foreach ($arrCluster as $key => $value) {
                                    ?><option value="<?php echo $key; ?>"><?php echo $value; ?></option><?php
                                }
                            ?></select>
                        </div>
                    </div>
                </div>
                <!-- persons -->
                <div class="row mb-2" id="divHomeServiceAddress">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">If Home Service - Location Details</label>
                        <div class="form-group">
                            <textarea class="form-control" id="taCustomerLocation" name="taCustomerLocation" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <!-- end persons -->
                <!-- Notes -->
                <div class="row mb-2">
                    <div class="form-group col-md-6 col-sm-12">
                        <label class="text-primary">Booking Notes</label>
                        <div class="form-group">
                            <textarea class="form-control" id="taBookingNotes" name="taBookingNotes" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <!-- end Notes -->

                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12">
                        <!-- type="button" -->
                        <button  id="btnAddBooking" class="btn btn-primary btn-lg btn-block">
                            <span class="text-white text-decoration-none">
                                Create
                            </span>
                        </button>
                        <input type="hidden" name="bookingId" id="bookingId" value="0">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Page Wrapper -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>