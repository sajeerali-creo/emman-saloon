            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span><?php echo PROJECT_COPYRIGHT; ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>securepanel/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <style>
        #dataTable_wrapper button{
            display: none !important;
        }
        #dataTable_wrapper .dataTables_length,
        #dataTable_wrapper .bottom #dataTable_info{
            display: inline-block; !important;
        }
        #dataTable_wrapper #dataTable_filter,
        #dataTable_wrapper .bottom #dataTable_paginate{
            display: inline-block; !important;
            float: right;
        }
    </style>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>assets/admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script><?php
        
    if(basename(base_url(uri_string())) != 'dashboard' && basename(base_url(uri_string())) != 'securepanel'){
        ?><!-- Page level plugins -->
        
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
        <!-- Page level custom scripts -->
        <!-- <script src="<?php echo base_url(); ?>assets/admin/js/demo/datatables-demo.js"></script> --><?php
    }
    else{
        ?><!-- Page level custom scripts -->
        <script src="<?php echo base_url(); ?>assets/admin/js/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/demo/chart-pie-demo.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/demo/chart-bar-demo.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /><?php
    }
    if(basename(base_url(uri_string())) == 'calender-team' || basename(base_url(uri_string())) == 'booking-calendar'){
        ?><script src='<?php echo base_url(); ?>assets/admin/js/main.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
              },
              initialDate: '<?php echo date("Y-m-d"); ?>',
              navLinks: true, // can click day/week names to navigate views
              selectable: true,
              selectMirror: true,
              select: function(arg) {
                var title = prompt('Event Title:');
                if (title) {
                  calendar.addEvent({
                    title: title,
                    start: arg.start,
                    end: arg.end,
                    allDay: arg.allDay
                  })
                }
                calendar.unselect()
              },
              eventClick: function(arg) {
                /*if (confirm('Are you sure you want to delete this event?')) {
                  arg.event.remove()
                }*/
              },
              editable: true,
              dayMaxEvents: true, // allow "more" link when too many events
              events: [
                <?php 
                $flFirst = true;
                foreach ($arrFinalCalendarData as $key => $value) {
                    if(!$flFirst){
                        ?>,<?php
                    }
                    ?>{
                      title: '<?php echo $value['title']; ?>',
                      start: '<?php echo $value['strDateTime']; ?>'
                    }<?php
                    $flFirst = false;
                }
                ?>
              ]
            });

            calendar.render();
          });
        </script><?php
    }
    ?><script src="<?php echo base_url(); ?>assets/admin/js/common.js"></script>
    <script>
        $("#available-time-list button").click(function(){
            $("#available-time-list button.btn-primary").addClass("btn-outline-primary");
            $("#available-time-list button").removeClass("btn-primary");

            $(this).removeClass("btn-outline-primary");
            $(this).addClass("btn-primary");
            
            $("#hdAvailableTime").val($(this).attr("data-val"));
        });

        $("#btnAddMoreService").click(function(){

            let nextCount = parseInt($("#hdServiceCount").val()) + 1;
            $("#hdServiceCount").val(nextCount);

            let objServiceInfo = JSON.parse($("#hdServiceJsonInfo").val());
            let strOptions = '';

            for(i in objServiceInfo){
                strOptions += '<optgroup label="' + objServiceInfo[i].categoryName + '">';
                for(j in objServiceInfo[i].services){
                    strOptions += '<option value="' + objServiceInfo[i].services[j].id + '" data-price="' + objServiceInfo[i].services[j].price + '">';
                    strOptions += objServiceInfo[i].services[j].title;
                    strOptions += '</option>';
                }
                strOptions += '</optgroup>';
            }


            let strHtml = $('<div id="div_service_count_' + nextCount + '" class="row mb-2"><div class="form-group col-md-12 col-sm-12 mb-2"><label class="text-primary">Select Service</label><span onclick="javascript: jsRemoveThis(\'div_service_count_' + nextCount + '\');" class="lnkRemoveService badge badge-danger ml-2" data-id="' + nextCount + '">remove this service</span><select class="custom-select" name="lstService[]" id="lstService' + nextCount + '" required><option value="">Select</option>' + strOptions + '</select></div><div class="form-group col-md-12 col-sm-12 mb-2"><input type="text" class="form-control" name="txtPersonCount[]" id="txtPersonCount' + nextCount + '" value="" required placeholder="Number of Person"></div><input type="hidden" name="hdCartIds[]" value=""/></div>');

            $("#div_service_count_main").append(strHtml);
        });


        function jsRemoveThis(id){
            console.log(id);
            $('#' + id).remove();
        }


        $("#btnAddMoreServicer").click(function(){

            let nextCount = parseInt($("#hdServicerProductCount").val()) + 1;
            $("#hdServicerProductCount").val(nextCount);

            let objServicerInfo = JSON.parse($("#hdServicerJsonInfo").val());
            let objProductInfo = JSON.parse($("#hdProductJsonInfo").val());
            let strServicerOptions = '';
            let strProductOptions = '';

            for(i in objServicerInfo){
                strServicerOptions += '<option value="' + objServicerInfo[i].id + '">';
                strServicerOptions += objServicerInfo[i].name;
                strServicerOptions += '</option>';
            }

            for(i in objProductInfo){
                strProductOptions += '<option value="' + objProductInfo[i].id + '">';
                strProductOptions += objProductInfo[i].title;
                strProductOptions += '</option>';
            }

            console.log(objProductInfo);

            let strHtml = $('<div id="div_servicer_product_' + nextCount + '" class="row mb-2"><div class="form-group col-md-12 col-sm-12 mb-2"><label class="text-primary">Beautician / Massager / Hairdresser</label><span onclick="javascript: jsRemoveThis(\'div_servicer_product_' + nextCount + '\');" class="badge badge-danger ml-2">remove this service</span><select class="custom-select" name="lstServicer[]" id="lstServicer' + nextCount + '" required><option selected>Select servicer</option>' + strServicerOptions + '</select></div><div class="form-group col-md-12 col-sm-12 mb-2"><select class="custom-select" name="lstProduct[]" id="lstProduct' + nextCount + '"><option selected>Select Product</option>' + strProductOptions + '</select></div><input type="hidden" name="hdCSPId[]" value=""/></div>');

            $("#div_servicer_product_main").append(strHtml);
        });

        $("#btnAddBooking").click(function(e) {
            e.preventDefault();

            let lstService = $("#lstService1").val();
            let txtPersonCount = $("#txtPersonCount1").val();
            let bookingDate = $("#txtBookingDate").val();
            let availableTime = $("#hdAvailableTime").val();
            let lstServicer1 = $("#lstServicer1").val();
            let txtCustomerName = $("#txtCustomerName").val();
            let txtCustomerEmail = $("#txtCustomerEmail").val();
            let txtCustomerPhone = $("#txtCustomerPhone").val();            

            if(lstService == ''){
                alert("Please select service");
                $("#lstService1").focus();
            }
            else if(txtPersonCount == ''){
                alert("Please enter number of person");
                $("#txtPersonCount1").focus();
            }
            else if(bookingDate == ''){
                alert("Please select Date");
                $("#txtBookingDate").focus();
            }
            else if(availableTime == ''){
                alert("Please Choose Available Time");
                $("html, body").animate({
                    scrollTop: $("#available-time-list").offset().top
                }, "10");
            }
            else if(lstServicer1 == ''){
                alert("Please select servicer");
                $("#lstServicer1").focus();
            }
            else if(txtCustomerName == ''){
                alert("Please enter Name");
                $("#txtCustomerName").focus();
            }
            else if(txtCustomerEmail == ''){
                alert("Please enter Email");
                $("#txtCustomerEmail").focus();
            }
            else if(txtCustomerPhone == ''){
                alert("Please enter Phone");
                $("#txtCustomerPhone").focus();
            }
            else{
                $("#frmAddForm").submit();
            }
        });
        <?php if(isset($pagePath) && $pagePath == 'supplier') {
            ?>const choices = new Choices($('#txtCatogory')[0], {
                removeItemButton: true,
                itemSelectText: ' ',
                placeholder: true,
                paste: false,
                duplicateItemsAllowed: false,
                editItems: true,
                delimiter: ',_,_,',
            });<?php
        } ?>

        $("#lstSupplier").on("change", function(){
            let categoryJson = JSON.parse($("#hdSupplierServiceJson").val());
            let selectedSuppliers = $("#lstSupplier").val();
            let categoryOptions;
            for (i in categoryJson) {
                if(i == selectedSuppliers){
                    categoryOptions = categoryJson[i];
                }
            }
            let strOptions = '<option value="">Select</option>';
            if(categoryOptions != ''){
                for(i in categoryOptions){
                    strOptions += '<option value="' + categoryOptions[i] + '">' + categoryOptions[i] + '</option>';
                }
            }

            $('#lstCategory').find('option').remove().end();
            $('#lstCategory').append(strOptions);
        });

        $("#pageSellProduct #lstProduct").on("change", function(){
            $('#txtPrice').val($('#pageSellProduct #lstProduct option:selected').attr("data-price"));
            $('#hdTaxRate').val($('#pageSellProduct #lstProduct option:selected').attr("data-tax"));
            jsUpdateSellProductInfo();
        });

        $("#pageSellProduct #txtQuantity, #pageSellProduct #txtPrice").on("change", function(){
            jsUpdateSellProductInfo();
        });

        $('#pageSellProduct #txtQuantity').bind('paste', function() {
            var txtPhone = this;
            setTimeout(function() {
                txtPhone.value = txtPhone.value.replace(/\D/g, '');
            }, 0);
        });

        $('#pageSellProduct #txtQuantity').keypress(function(evt) {
            var regex = new RegExp("^[0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

        function jsUpdateSellProductInfo(){
            let price = $('#txtPrice').val();
            let tax = $('#pageSellProduct #lstProduct option:selected').attr("data-tax");
            let text = $('#pageSellProduct #lstProduct option:selected').text();
            let quantity = $("#txtQuantity").val();
            let totalAmount = 0;

            price = (price == '') ? 0 : price; 
            quantity = (quantity == '') ? 0 : quantity;
            tax = (tax == '') ? 0 : tax;

            quantity = parseInt(quantity);
            price = parseFloat(price);
            tax = parseFloat(tax);

            $("#serviceCardName").text(text);
            $("#serviceCardPrice").text("AED " + price);
            $("#serviceCardVat").text(tax + "%");
            $("#serviceCardQuantity").text(quantity);

            if(quantity > 0 && price > 0){
                totalAmount = (quantity * price);
                totalAmount += totalAmount * (tax/100); 
            }
            $("#serviceCardTotal").text("AED " + totalAmount);
            $("#service-card-box").show();
        }

        $("#btnSellProductPrint").click(function(){
            if($("#hdSellProduct").val() == 'N'){
                $("#sell-product-popup .modal-body").text("Product Not selled. Please sell the product."); 
                $('#sell-product-popup').modal('show');
            }
            else{
                //Copy the element you want to print to the print-me div.
                $("#service-card-box > .sticky-top > .card").clone().appendTo("#print-me > .col-md-12");

                $("body").addClass("printing");
                //Print the window.
                window.print();
                //Restore the styles.
                $("body").removeClass("printing");

                //Clear up the div.
                $("#print-me > .col-md-12").empty();
            }
        });

        $("#btPrintReport").click(function(e){
            e.preventDefault();
            $("#dataTable_wrapper button.buttons-csv").click();
        });     


        // Date Range Picker Example
        $(function () {
            var start = moment().subtract(29, "days");
            var end = moment();

            function cb(start, end) {
                $("#reportrange span").html(
                    start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
                );
                /*$("#hdStartDate").val(start.format("MMMM D, YYYY"));
                $("#hdEndDate").val(end.format("MMMM D, YYYY"));
                $("#frmSearch").submit();*/
            }

            $("#reportrange").daterangepicker(
                {
                    startDate: start,
                    endDate: end,
                    ranges: {
                        Today: [moment(), moment()],
                        Yesterday: [
                            moment().subtract(1, "days"),
                            moment().subtract(1, "days"),
                        ],
                        "Last 7 Days": [moment().subtract(6, "days"), moment()],
                        "Last 30 Days": [moment().subtract(29, "days"), moment()],
                        "This Month": [
                            moment().startOf("month"),
                            moment().endOf("month"),
                        ],
                        "Last Month": [
                            moment().subtract(1, "month").startOf("month"),
                            moment().subtract(1, "month").endOf("month"),
                        ],
                    },
                },
                cb
            );

            cb(start, end); 
        }); 
    </script>
</body>

</html>