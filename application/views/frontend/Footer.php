		<!-- Bootstrap core JavaScript-->
	    <script src="<?php echo base_url() ?>assets/web/vendor/jquery/jquery.min.js"></script>
	    <script src="<?php echo base_url() ?>assets/web/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	    <!-- Core plugin JavaScript-->
	    <script src="<?php echo base_url() ?>assets/web/vendor/jquery-easing/jquery.easing.min.js"></script>

	    <!-- Custom scripts for all pages-->
	    <script src="<?php echo base_url() ?>assets/web/js/sb-admin-2.min.js"></script>

	    <!-- Page level plugins -->
	    <!-- <script src="<?php echo base_url() ?>assets/web/vendor/chart.js/Chart.min.js"></script> -->

	    <!-- Page level custom scripts -->
	    <!-- <script src="<?php echo base_url() ?>assets/web/js/demo/chart-area-demo.js"></script>
	    <script src="<?php echo base_url() ?>assets/web/js/demo/chart-pie-demo.js"></script> -->

	    <script>
            var number = 0;
            $("#minus").click(function () {
                number -= 1;
                if (number <= 0) number = 0;
                setNumber(number);
                $("#number").addClass('bounce');
                removeAnimation();
            });
    
            $("#plus").click(function () {
                //console.log(number)
                number += 1;
                setNumber(number);
                $("#number").addClass('bounce')
                removeAnimation();
            });
    
            function removeAnimation() {
                setTimeout(function () {
                    $("#number").removeClass('bounce');
                }, 100);
            }
    
            function setNumber(number) {
                // $("#number").attr('data-content', number);
                $("#number").text(number);
            }

            $(".servoce-catogory .list-group .list-group-item a").click(function(){
            	$(".servoce-catogory .list-group .list-group-item").removeClass("active");
            	$(this).parent().addClass("active");
            });
            $(".chkService").click(function(){
            	if ($(this).is(':checked')) {
            		$("#myModal .modal-title").text($(this).data('label'));
            		$("#myModal .modal-title").attr("data-serviceid", $(this).val());
            		number = parseInt($(this).attr('data-persion'));
            		if(number > 0){
            			$("#btnCancelService").show();
            			$("#btnCloseService").hide();
            		}
            		else{
            			$("#btnCancelService").hide();
            			$("#btnCloseService").show();
            		}
            		setNumber(number);
        	      	$("#myModal").modal({
					    backdrop: 'static',
					    keyboard: false
					});
        	    }
        	    else{
        	    	$(this).attr('data-persion', 0);
        	    	$(".service-card-" + $(this).val() + " .persion-count").hide();
        	    	jsRemoveFromCart($(this).val());
        	    }
            });

            $(".chk-service-card .persion-count").click(function(){
            	let chkObj = $(this).parents(".chk-service-card").find(".chkService");
            	let serviceid = chkObj.val();

            	$("#myModal .modal-title").text(chkObj.attr("data-label"));
        		$("#myModal .modal-title").attr("data-serviceid", serviceid);

        		number = parseInt(chkObj.attr("data-persion"));
        		setNumber(number);

        		if(number > 0){
        			$("#btnCancelService").show();
        			$("#btnCloseService").hide();
        		}
        		else{
        			$("#btnCancelService").hide();
        			$("#btnCloseService").show();
        		}

    	      	$("#myModal").modal({
				    backdrop: 'static',
				    keyboard: false
				});
            });

            $("#btnConfirmService").click(function(){
            	let serviceid = $("#myModal .modal-title").attr("data-serviceid");
            	$("#customCheck" + serviceid).attr("data-persion", $("#number").text());
            	$(".service-card-" + serviceid + " .persion-count span").text($("#number").text());

            	if(parseInt($("#number").text()) > 0){
	            	$(".service-card-" + serviceid + " .persion-count").show();
	            	jsAddIntoCart(serviceid);
	            }
	            else{
	            	$(".service-card-" + serviceid + " .persion-count").hide();
	            	$("#customCheck" + serviceid).click();
	            	jsRemoveFromCart(serviceid);
	            }     
            });

            $("#btnCloseService").click(function(){
            	$("#number").text("0");
            	let serviceid = $("#myModal .modal-title").attr("data-serviceid");
            	$("#customCheck" + serviceid).attr("data-persion", $("#number").text());
            	$(".service-card-" + serviceid + " .persion-count span").text($("#number").text());

            	if(parseInt($("#number").text()) > 0){
	            	$(".service-card-" + serviceid + " .persion-count").show();
	            	jsAddIntoCart(serviceid);
	            }
	            else{
	            	$(".service-card-" + serviceid + " .persion-count").hide();
	            	$("#customCheck" + serviceid).click();
	            	jsRemoveFromCart(serviceid);
	            }     
            });

			function setCookie(cname, cvalue, exdays) {
	            var d = new Date();
	            d.setTime(d.getTime() + (exdays*24*60*60*1000));
	            var expires = "expires="+ d.toUTCString();
	            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	        }

	        function getCookie(cname) {
				var name = cname + "=";
				var ca = document.cookie.split(';');
				for(var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') {
						c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
					}
				}
				return "";
			}

			function jsAddIntoCart(serviceId){
				let objSer = $("#customCheck" + serviceId);
				let strCookie = getCookie("serviceCartCookie");

				if(strCookie == ''){
					strCookie = {"serviceids":[]};
				}
				else{
					strCookie = JSON.parse(strCookie);
				}

				console.log(strCookie);

				$(".hide-on-empty-cart").show();
				$(".show-on-empty-cart").hide();

				if(typeof strCookie.serviceids[serviceId] !== "undefined" && strCookie.serviceids[serviceId] !== null){
					$("#card-item-" + serviceId).html('<div class="d-flex justify-content-between"><div><div class="font-weight-bold text-gray-900 card-persion-name">' + objSer.attr("data-label") + '</div><div class="small card-persion-count">' + objSer.attr("data-persion") + 'person</div></div><div><div class="small text-right">From</div><div class="text-right font-weight-bold text-gray-900 card-persion-price">AED ' + objSer.attr("data-price") + '</div></div></div><div><hr></div>');

					strCookie.serviceids[serviceId] = {
														"serviceId": serviceId, 
														"name":objSer.attr("data-label"),
														"persion":objSer.attr("data-persion"),
														"price":objSer.attr("data-price")
													};
				}
				else{
					$("#service-card-box .card-item-custom").append('<div class="card-single-item" id="card-item-' + serviceId + '"><div class="d-flex justify-content-between"><div><div class="font-weight-bold text-gray-900 card-persion-name">' + objSer.attr("data-label") + '</div><div class="small card-persion-count">' + objSer.attr("data-persion") + 'person</div></div><div><div class="small text-right">From</div><div class="text-right font-weight-bold text-gray-900 card-persion-price">AED ' + objSer.attr("data-price") + '</div></div></div><div><hr></div></div>');

					strCookie.serviceids[serviceId] = {
														"serviceId": serviceId, 
														"name":objSer.attr("data-label"),
														"persion":objSer.attr("data-persion"),
														"price":objSer.attr("data-price")
													};
				}

				jsCalculateTotal(strCookie);
				strCookie = JSON.stringify(strCookie);
				//console.log(strCookie);
				setCookie("serviceCartCookie", strCookie, 365);
			}

			function jsRemoveFromCart(serviceId){
				let strCookie = getCookie("serviceCartCookie");

				if(strCookie == ''){
					strCookie = {"serviceids":[]};
				}
				else{
					strCookie = JSON.parse(strCookie);
				}

				console.log(strCookie);

				if(typeof strCookie.serviceids[serviceId] !== "undefined" && strCookie.serviceids[serviceId] !== null){
					$("#card-item-" + serviceId).remove();

					strCookie.serviceids[serviceId] = null;
				}

				jsCalculateTotal(strCookie);
				strCookie = JSON.stringify(strCookie);

				setCookie("serviceCartCookie", strCookie, 365);
			}

			function jsCalculateTotal(objCart){
				let intTotal = 0;
				let flCartEMpty = true;
				for (i in objCart.serviceids) {
					if(objCart.serviceids[i] !== null){
						intTotal += objCart.serviceids[i].price * objCart.serviceids[i].persion;
						flCartEMpty = false;
					}
				}
				intTotal += intTotal * 0.05;
				$("#card-total-price").text("AED " + intTotal);

				if(flCartEMpty){
					$(".hide-on-empty-cart").css("display", "none !important");
					$(".show-on-empty-cart").show();
				}
			}

			function jsCheckCartIsEmpty(){
				let strCookie = getCookie("serviceCartCookie");
				let flCartEMpty = true;

				if(strCookie == ''){
					objCart = {"serviceids":[]};
				}
				else{
					objCart = JSON.parse(strCookie);
				}

				for (i in objCart.serviceids) {
					if(objCart.serviceids[i] !== null){
						flCartEMpty = false;
					}
				}

				if(flCartEMpty){
					return true;
				}
				else{
					return false;
				}
			}

			$("#service-booknow").click(function(e){
				e.preventDefault();
				if(jsCheckCartIsEmpty()){
					alert("Please select a service.");
				}
				else{
					window.location.href=$(this).find("a").attr("data-href");
				}
			});

			$("#available-time-list li").click(function(){
				$("#available-time-list li").removeClass("active");
				$(this).addClass("active");
				$("#hdAvailableTime").val($(this).attr("data-val"));
			});

			$("#dateselect-continue").click(function(e){
				e.preventDefault();
				let bookingDate = $("#txtBookingDate").val();
				let availableTime = $("#hdAvailableTime").val();

				if(bookingDate == ''){
					alert("Please select Date");
					$("#txtBookingDate").focus();
				}
				else if(availableTime == ''){
					alert("Please Choose Available Time");
				}
				else{
					let strcartDtlsCookie = getCookie("cartDetailsInfo");

					if(strcartDtlsCookie == ''){
						objCart = {"dateselect" : {"date" : "", "time" : ""}};
					}
					else{
						objCart = JSON.parse(strcartDtlsCookie);
					}

					objCart.dateselect["date"] = bookingDate;
					objCart.dateselect["time"] = availableTime;

					strCookie = JSON.stringify(objCart);
					setCookie("cartDetailsInfo", strCookie, 365);

					window.location.href = $(this).find("a").attr("data-href");
				}
			});


			$("#addpersoanalinfo-register").click(function() {
				let txtFName = $("#txtFName").val();
				let txtLName = $("#txtLName").val();
				let txtPhone = $("#txtPhone").val();
				let txtEmail = $("#txtEmail").val();
				let txtPassword = $("#txtPassword").val();
				let txtCPassword = $("#txtCPassword").val();
				let chkPrivacyPolicy = $("#chkPrivacyPolicy").val();

				if (txtFName == "") {
					alert("Please enter First Name");
					$("#txtFName").focus();
				}
				else if (txtLName == "") {
					alert("Please enter Last Name");
					$("#txtLName").focus();
				}
				else if (txtPhone == "") {
					alert("Please enter Phone");
					$("#txtPhone").focus();
				}
				else if (txtEmail == "") {
					alert("Please enter Email");
					$("#txtEmail").focus();
				}
				else if(!validateEmail(txtEmail)){
					alert("Invalid Email Address");
					$("#txtEmail").focus();
				}
				else if (txtPassword == "") {
					alert("Please enter Password");
					$("#txtPassword").focus();
				}
				else if(!validatePassword(txtPassword)){
					alert("Password must be at least 8 characters, no more than 15 characters, and must include at least one upper case letter, one lower case letter, and one numeric digit.");
					$("#txtPassword").focus();
				}
				else if (txtCPassword == "") {
					alert("Please enter Password");
					$("#txtCPassword").focus();
				}
				else if (txtCPassword != txtPassword) {
					alert("Please enter same password");
					$("#txtCPassword").focus();
				}
				else if(!$("#chkPrivacyPolicy").is(':checked')){
					alert("Please agree to the privacy policy, website terms and booking terms");
					$("#chkPrivacyPolicy").focus();
				}
				else{
					$("#frmAddForm").submit();
				}
			});

			$("#addpersoanalinfo-continue").click(function() {
				let txtFName = $("#txtFName").val();
				let txtLName = $("#txtLName").val();
				let txtPhone = $("#txtPhone").val();
				let txtEmail = $("#txtEmail").val();
				let chkPrivacyPolicy = $("#chkPrivacyPolicy").val();

				if (txtFName == "") {
					alert("Please enter First Name");
					$("#txtFName").focus();
				}
				else if (txtLName == "") {
					alert("Please enter Last Name");
					$("#txtLName").focus();
				}
				else if (txtPhone == "") {
					alert("Please enter Phone");
					$("#txtPhone").focus();
				}
				else if (txtEmail == "") {
					alert("Please enter Email");
					$("#txtEmail").focus();
				}
				else if(!validateEmail(txtEmail)){
					alert("Invalid Email Address");
					$("#txtEmail").focus();
				}
				else if(!$("#chkPrivacyPolicy").is(':checked')){
					alert("Please agree to the privacy policy, website terms and booking terms");
					$("#chkPrivacyPolicy").focus();
				}
				else{
					$("#frmAddForm").submit();
				}
			});

			$("#btnConfirmOrder").click(function(){
				let taOrderNotes = $("#taOrderNotes").val();

				if (taOrderNotes == "") {
					alert("Please enter Order Notes");
					$("#taOrderNotes").focus();
				}
				else{
					$("#frmAddForm").submit();
				}
			});

			$('#txtPhone').bind('paste', function() {
		        var txtPhone = this;
		        setTimeout(function() {
		            txtPhone.value = txtPhone.value.replace(/\D/g, '');
		        }, 0);
		    });

		    $('#txtPhone').keypress(function(evt) {
		        var regex = new RegExp("^[+0-9]+$");
		        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
		        if (!regex.test(key)) {
		            event.preventDefault();
		            return false;
		        }
		    });

			function validateEmail(sEmail) {
			  	let filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			  	if (filter.test(sEmail)) {
			    	return true;
			  	} else {
			    	return false;
			  	}
			}

			function validatePassword(value){
				return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}$/.test( value )
			}
        </script>
	</body>
</html>