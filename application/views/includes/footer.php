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
        if(isset($pagePath) && $pagePath == 'dashboard'){
            ?><script>
                // Set new default font family and font color to mimic Bootstrap's default styling
                Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = '#858796';

                function number_format(number, decimals, dec_point, thousands_sep) {
                  // *     example: number_format(1234.56, 2, ',', ' ');
                  // *     return: '1 234,56'
                  number = (number + '').replace(',', '').replace(' ', '');
                  var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                      var k = Math.pow(10, prec);
                      return '' + Math.round(n * k) / k;
                    };
                  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                  if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                  }
                  if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                  }
                  return s.join(dec);
                }

                // Area Chart Example
                var ctx = document.getElementById("myAreaChart");
                var myLineChart = new Chart(ctx, {
                  type: 'line',
                  data: {
                    labels: [<?php echo $lastSixMonthProductSales['label']; ?>],
                    datasets: [{
                      label: "Earnings",
                      lineTension: 0.3,
                      backgroundColor: "rgba(78, 115, 223, 0.05)",
                      borderColor: "rgba(78, 115, 223, 1)",
                      pointRadius: 3,
                      pointBackgroundColor: "rgba(78, 115, 223, 1)",
                      pointBorderColor: "rgba(78, 115, 223, 1)",
                      pointHoverRadius: 3,
                      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                      pointHitRadius: 10,
                      pointBorderWidth: 2,
                      data: [<?php echo $lastSixMonthProductSales['data']; ?>],
                    }],
                  },
                  options: {
                    maintainAspectRatio: false,
                    layout: {
                      padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                      }
                    },
                    scales: {
                      xAxes: [{
                        time: {
                          unit: 'date'
                        },
                        gridLines: {
                          display: false,
                          drawBorder: false
                        },
                        ticks: {
                          maxTicksLimit: 10
                        }
                      }],
                      yAxes: [{
                        ticks: {
                          maxTicksLimit: 10,
                          padding: 10,
                          // Include a AED sign in the ticks
                          callback: function(value, index, values) {
                            return number_format(value) + ' AED';
                          }
                        },
                        gridLines: {
                          color: "rgb(234, 236, 244)",
                          zeroLineColor: "rgb(234, 236, 244)",
                          drawBorder: false,
                          borderDash: [2],
                          zeroLineBorderDash: [2]
                        }
                      }],
                    },
                    legend: {
                      display: false
                    },
                    tooltips: {
                      backgroundColor: "rgb(255,255,255)",
                      bodyFontColor: "#858796",
                      titleMarginBottom: 10,
                      titleFontColor: '#6e707e',
                      titleFontSize: 14,
                      borderColor: '#dddfeb',
                      borderWidth: 1,
                      xPadding: 15,
                      yPadding: 15,
                      displayColors: false,
                      intersect: false,
                      mode: 'index',
                      caretPadding: 10,
                      callbacks: {
                        label: function(tooltipItem, chart) {
                          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                          return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' AED';
                        }
                      }
                    }
                  }
                });


                // Bar Chart Example
                var ctxB = document.getElementById("myBarChart");
                var myBarChart = new Chart(ctxB, {
                  type: 'bar',
                  data: {
                    labels: [<?php echo $lastSixMonthServicesSales['label']; ?>],
                    datasets: [{
                      label: "Bookings",
                      backgroundColor: "#4e73df",
                      hoverBackgroundColor: "#2e59d9",
                      borderColor: "#4e73df",
                      data: [<?php echo $lastSixMonthServicesSales['data']; ?>],
                    }],
                  },
                  options: {
                    maintainAspectRatio: false,
                    layout: {
                      padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                      }
                    },
                    scales: {
                      xAxes: [{
                        time: {
                          unit: 'month'
                        },
                        gridLines: {
                          display: false,
                          drawBorder: false
                        },
                        ticks: {
                          maxTicksLimit: 6
                        },
                        maxBarThickness: 25,
                      }],
                      yAxes: [{
                        ticks: {
                          min: 0,
                          maxTicksLimit: 10,
                          padding: 10,
                          // Include a dollar sign in the ticks
                          callback: function(value, index, values) {
                            return '' + number_format(value) + ' AED';
                          }
                        },
                        gridLines: {
                          color: "rgb(234, 236, 244)",
                          zeroLineColor: "rgb(234, 236, 244)",
                          drawBorder: false,
                          borderDash: [2],
                          zeroLineBorderDash: [2]
                        }
                      }],
                    },
                    legend: {
                      display: false
                    },
                    tooltips: {
                      titleMarginBottom: 10,
                      titleFontColor: '#6e707e',
                      titleFontSize: 14,
                      backgroundColor: "rgb(255,255,255)",
                      bodyFontColor: "#858796",
                      borderColor: '#dddfeb',
                      borderWidth: 1,
                      xPadding: 15,
                      yPadding: 15,
                      displayColors: false,
                      caretPadding: 10,
                      callbacks: {
                        label: function(tooltipItem, chart) {
                          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                          return datasetLabel + ':' + number_format(tooltipItem.yLabel) + ' AED';
                        }
                      }
                    },
                  }
                });

            </script><?php
        }
        else{
            ?><!-- Page level custom scripts -->
            <script src="<?php echo base_url(); ?>assets/admin/js/demo/chart-area-demo.js"></script>
            <script src="<?php echo base_url(); ?>assets/admin/js/demo/chart-bar-demo.js"></script><?php
        }
        
    }
    
    ?><link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <?php

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
                      start: '<?php echo $value['strDateTime']; ?>',
                      end: '<?php echo $value['endDateTime']; ?>'
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
        if(jQuery( window ).width() <= 1024){
            jQuery("#accordionSidebar").addClass('toggled');
            jQuery("#page-top").addClass('sidebar-toggled');
        }

        jQuery( window ).resize(function() { 
            if(jQuery( window ).width() <= 1024){
                jQuery("#accordionSidebar").addClass('toggled');
                jQuery("#page-top").addClass('sidebar-toggled');
            }
        });
        $('.number_only').bind('paste', function() {
            var number_only = this;
            setTimeout(function() {
                number_only.value = number_only.value.replace(/\D\./g, '');
            }, 0);
        });

        $('.number_only').keypress(function(evt) {
            var regex = new RegExp("^[0-9\.]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

        $("#available-time-list button").click(function(){
            if($(this).hasClass("not-avaialble")){
                alert("Sorry! Selected time of service is not available. Please choose another slot.");
                return false;
            }

            $("#available-time-list button.btn-primary").addClass("btn-outline-primary");
            $("#available-time-list button").removeClass("btn-primary");

            $(this).removeClass("btn-outline-primary");
            $(this).addClass("btn-primary");
            
            $("#hdAvailableTime").val($(this).attr("data-val"));
        });

        $("#btnAddMoreService").click(function(){

            let nextCount = parseInt($("#hdServiceCount").val()) + 1;
            $("#hdServiceCount").val(nextCount);
            $("#hdServicerProductCount").val(nextCount);

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

            //console.log(objProductInfo);

            let strHtml = $('<div id="div_service_count_' + nextCount + '" class="row mb-2"><div class="form-group col-md-12 col-sm-12 mb-2"><label class="text-primary">Select Service</label><span onclick="javascript: jsRemoveThis(\'div_service_count_' + nextCount + '\');" class="lnkRemoveService badge badge-danger ml-2" data-id="' + nextCount + '">remove this service</span><select class="custom-select" name="lstService[]" id="lstService' + nextCount + '" required><option value="">Select</option>' + strOptions + '</select></div><div class="form-group col-md-12 col-sm-12 mb-2"><input type="text" class="form-control number_only" name="txtPersonCount[]" id="txtPersonCount' + nextCount + '" value="" required placeholder="Number of Person"></div><div class="form-group col-md-12 col-sm-12 mb-2"><select class="custom-select" name="lstServicer[]" id="lstServicer' + nextCount + '" required><option value="">Select servicer</option>' + strServicerOptions + '</select></div><div class="form-group col-md-12 col-sm-12 mb-2"><select class="custom-select" name="lstProduct[' + (nextCount - 1) + '][]" id="lstProduct' + nextCount + '" multiple><option value="">Select Product</option>' + strProductOptions + '</select></div><input type="hidden" name="hdCSPId[]" value=""/><input type="hidden" name="hdCartIds[]" value=""/></div>');

            $("#div_service_count_main").append(strHtml);
            
            const choices = new Choices($('#lstProduct' + nextCount)[0], {
                removeItemButton: true,
                itemSelectText: ' ',
                placeholder: true,
                delimiter: ',_,_,',
            });

            $('.number_only').bind('paste', function() {
                var number_only = this;
                setTimeout(function() {
                    number_only.value = number_only.value.replace(/\D\./g, '');
                }, 0);
            });

            $('.number_only').keypress(function(evt) {
                var regex = new RegExp("^[0-9\.]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
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

            let strHtml = $('<div id="div_servicer_product_' + nextCount + '" class="row mb-2"><div class="form-group col-md-12 col-sm-12 mb-2"><label class="text-primary">Beautician / Massager / Hairdresser</label><span onclick="javascript: jsRemoveThis(\'div_servicer_product_' + nextCount + '\');" class="badge badge-danger ml-2">remove this service</span><select class="custom-select" name="lstServicer[]" id="lstServicer' + nextCount + '" required><option value="">Select servicer</option>' + strServicerOptions + '</select></div><div class="form-group col-md-12 col-sm-12 mb-2"><select class="custom-select" name="lstProduct[' + (nextCount - 1) + '][]" id="lstProduct' + nextCount + '" multiple><option value="">Select Product</option>' + strProductOptions + '</select></div><input type="hidden" name="hdCSPId[]" value=""/></div>');

            $("#div_servicer_product_main").append(strHtml);

             const choices = new Choices($('#lstProduct' + nextCount)[0], {
                removeItemButton: true,
                itemSelectText: ' ',
                placeholder: true,
                delimiter: ',_,_,',
            });
        });

        <?php 
        if(isset($pagePath) && ($pagePath == 'AddBooking' || $pagePath == 'EditBooking' || $pagePath == 'ViewBooking')) {
            ?>
            $(".rdServiceType").click(function(){
                if($(this).val() == 'HS'){
                    $("#divHomeServiceAddress").show();
                }
                else{
                    $("#divHomeServiceAddress").hide();
                }
            });

            $(".rdCustomer").click(function(){
                if($(this).val() == 'E'){
                    $("#divSearchEmail").show();
                    $("#divEnterEmail").hide();
                }
                else{
                    $("#divSearchEmail").hide();
                    $("#divEnterEmail").show();
                }
            });

            $(document).ready(function(){
                jsAjaxSlotChecking();
            });

            $("#txtBookingDate").on("change", function(){
                jsAjaxSlotChecking();
            });

            function jsAjaxSlotChecking(){
                let txtDate = $("#txtBookingDate").val();
                let bookingId = $("#bookingId").val();
                hitURL = baseURL + "securepanel/check-booking-slot-info-ajax",
                $.ajax({
                    type : "POST",
                    dataType : "json",
                    url : hitURL,
                    data : { bookingDate : txtDate, bookingId: bookingId } 
                }).done(function(data){
                    //console.log(data);
                    if(data.status == true) { 
                        $("#hdAvailableTime").val();
                        $("#available-time-list button.btn-primary").addClass("btn-outline-primary");
                        $("#available-time-list button").removeClass("btn-primary");
                        
                        let timeSlots = data.slots;
                        $("#available-time-list > button").addClass('not-avaialble');
                        for (i in timeSlots) {
                            $("#timeslot_" + i).removeClass('not-avaialble');
                        }

                        let selectedTime = $("#hdAvailableTime").val();
                        if(!$("#available-time-list button[data-val='" + selectedTime + "']").hasClass("not-avaialble")){
                            $("#available-time-list button[data-val='" + selectedTime + "']").addClass("btn-primary").removeClass("btn-outline-primary");
                        }
                        console.log();
                    }
                });
            }

            let totalServiceProduct = parseInt($("#hdServicerProductCount").val());

            for(let iCount = 1; iCount <= totalServiceProduct; iCount++){
                const choices = new Choices($('#lstProduct' + iCount)[0], {
                    removeItemButton: true,
                    itemSelectText: ' ',
                    placeholder: true,
                    delimiter: ',_,_,',
                });

            }
            const choicesCustomerEmail = new Choices($('#lstCustomerEmail')[0], {
                removeItemButton: false,
                itemSelectText: ' ',
                placeholder: true,
                delimiter: ',_,_,',
            });

            choicesCustomerEmail.passedElement.element.addEventListener(
              'change',
                function(event) {
                    let customerEmail = event.detail.value;
                    $("#txtCustomerEmail").val(customerEmail);
                    if(customerEmail != ''){
                        hitURL = baseURL + "securepanel/check-customer-info-ajax",
                        $.ajax({
                            type : "POST",
                            dataType : "json",
                            url : hitURL,
                            data : { customerEmail : customerEmail} 
                        }).done(function(data){
                            console.log(data);
                            if(data.status == true) { 
                               $("#txtCustomerName").val(data.custInfo.first_name + " " + data.custInfo.last_name);
                               $("#txtCustomerPhone").val(data.custInfo.phone_number);
                               $("#taCustomerLocation").val(data.custInfo.location_full_address);
                            }
                        });
                    }
                    else {

                    }
                    
                },
                false,
            );

            <?php
        } else if(isset($pagePath) && $pagePath == 'BookingList') {
            ?>
            $(window).on('load', function(){ 
                setTimeout("location.reload(true);", 60000);
            });
            <?php
        }
        ?>

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
            let lstCluster = $("#lstCluster").val();            

            if(lstService == ''){
                alert("Please select service");
                $("#lstService1").focus();
            }
            else if(txtPersonCount == ''){
                alert("Please enter number of person");
                $("#txtPersonCount1").focus();
            }
            else if(lstServicer1 == ''){
                alert("Please select servicer");
                $("#lstServicer1").focus();
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
            else if(lstCluster == ''){
                alert("Please select location - Cluster");
                $("#lstCluster").focus();
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
        } else if(isset($pagePath) && $pagePath == 'sellProduct'){
            ?>const choices = new Choices($('#lstEmployee')[0], {
                removeItemButton: false,
                itemSelectText: ' ',
                placeholder: true,
            });<?php
        } 
        else if(isset($pagePath) && $pagePath == 'useProduct'){
            ?>const choices = new Choices($('#lstEmployee')[0], {
                removeItemButton: false,
                itemSelectText: ' ',
                placeholder: true,
            });<?php
        } 
        ?>

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
            $('#product-stock-label').text("Stock Balance:" + $('#pageSellProduct #lstProduct option:selected').attr("data-remaining")).show();
            $("#hdMaxQuantity").val($('#pageSellProduct #lstProduct option:selected').attr("data-remaining"));
            jsUpdateSellProductInfo();
        });

        $("#pageSellProduct #txtQuantity, #pageSellProduct #txtPrice, #pageSellProduct #txtCustomerName").on("change", function(){
            jsUpdateSellProductInfo();
        });

        function jsUpdateSellProductInfo(){
            if($("#lstProduct").val() == '' || $("#txtQuantity").val() == '' || $("#txtPrice").val() == '' || $("#txtCustomerName").val() == ''){
                return;
            } else if(parseInt($("#hdMaxQuantity").val()) < parseInt($("#txtQuantity").val())){
                console.log($("#hdMaxQuantity").val());
                console.log($("#txtQuantity").val());
                alert("Maximum product available is " + $("#hdMaxQuantity").val());
                return;
            }

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
            $("#serviceCardPrice").text(price + " AED");
            $("#serviceCardVat").text(tax + "%");
            $("#serviceCardQuantity").text(quantity);

            if(quantity > 0 && price > 0){
                totalAmount = (quantity * price);
                totalAmount += totalAmount * (tax/100); 
            }
            $("#serviceCardTotal").text(totalAmount + " AED");
            $("#service-card-box").show();
        }

        $("#btnSellProductPrint").click(function(){
            if($("#hdSellProduct").val() == 'N'){
                $("#sell-product-popup .modal-body").text("Product Not selled. Please sell the product."); 
                $('#sell-product-popup').modal('show');
            }
            else{
                let bookingId = $("#productSaleId").val();
                hitURL = baseURL + "generate-product-recipt-ajax/" + bookingId,
                $.ajax({
                    type : "POST",
                    url : hitURL,
                    data : { bookingId: bookingId } 
                }).done(function(data){
                    console.log(data);
                    var myWindow=window.open('','','width=900,height=600');
                    myWindow.document.write(data);
                        
                    myWindow.document.close();
                    myWindow.focus();
                    setTimeout(function(){ myWindow.print(); }, 300);
                    //myWindow.close();
                });
            }
        });

        $("#btnBookingPrint").click(function(){
            let bookingId = $("#bookingId").val();
            hitURL = baseURL + "generate-booking-recipt-ajax/" + bookingId,
            $.ajax({
                type : "POST",
                url : hitURL,
                data : { bookingId: bookingId } 
            }).done(function(data){
                console.log(data);
                var myWindow=window.open('','','width=900,height=600');
                myWindow.document.write(data);
                    
                myWindow.document.close();
                myWindow.focus();
                setTimeout(function(){ myWindow.print(); }, 300);
            });
        });

        $("#btPrintReport").click(function(e){
            e.preventDefault();
            $("#dataTable_wrapper button.buttons-csv").click();
        });     


        // Date Range Picker Example
        $(function () {
            var start = moment($("#hdStartDate").val());//.subtract(29, "days");
            var end = moment($("#hdEndDate").val());

            function cb(start, end) {
                $("#reportrange span").html(
                    start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
                );
                $("#hdStartDate").val(start.format("MMMM D, YYYY"));
                $("#hdEndDate").val(end.format("MMMM D, YYYY"));
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

            $("#reportrange").on('apply.daterangepicker', function(ev, picker) {
              console.log(picker.startDate.format('YYYY-MM-DD'));
              console.log(picker.endDate.format('YYYY-MM-DD'));
            });

            cb(start, end); 
        }); 

        $("#lnkSearchDate").click(function(){
            $("#btnDashboardSearch").click();
        });

        $("#lnkGenerateDashboardReport").click(function(){
            let hdStartDate = $("#hdStartDate").val();
            let hdEndDate = $("#hdEndDate").val();
            let hitURL = baseURL + "securepanel/dashboardreportdownload?startDate=" + encodeURI(hdStartDate) + "&endDate=" + encodeURI(hdEndDate);
            window.open(hitURL, '_blank');
        });
    </script>
</body>

</html>