jQuery(document).ready(function(){

	var objDataTable = $('#dataTable').DataTable({
		//dom: 'Bfrtip',
		dom: '<"top"Blf>rt<"bottom"ip>',
        buttons: [
	        { extend: 'csvHtml5', text: '<i class="fas fa-file-download"></i>Export Report', titleAttr: 'Export Report' }
	    ]
	});

	jQuery(document).on("click", ".deleteService", function(){
		let recordId = $(this).data("recordid");
		$("#hdDeleteRecordId").val(recordId);
		console.log(recordId);
	});

	jQuery(document).on("click", "#delete-service .btn-primary", function(){
		let recordId = $("#hdDeleteRecordId").val(),
		hitURL = baseURL + "securepanel/delete-service",
		currentRow = $('.row_' + recordId);

		jQuery.ajax({
				type : "POST",
				dataType : "json",
				url : hitURL,
				data : { serviceId : recordId } 
				}).done(function(data){
					if(data.status == true) { 
						objDataTable.row( currentRow ).remove().draw();
						//currentRow.remove();
						$("#delete-service-msg .modal-body").text("Record successfully deleted"); 
					}
					else if(data.status == false) {
						$("#delete-service-msg .modal-body").text("Record deletion failed"); 
					}
					else { 
						$("#delete-service-msg .modal-body").text("Access denied..!"); 
					}
					$('#delete-service').modal('hide');
					$('#delete-service-msg').modal('show');
				});
	});

	jQuery(document).on("click", ".deleteSupplier", function(){
		let recordId = $(this).data("recordid");
		$("#hdDeleteRecordId").val(recordId);
		console.log(recordId);
	});

	jQuery(document).on("click", "#delete-supplier .btn-primary", function(){
		let recordId = $("#hdDeleteRecordId").val(),
		hitURL = baseURL + "securepanel/delete-supplier",
		currentRow = $('.row_' + recordId);

		jQuery.ajax({
				type : "POST",
				dataType : "json",
				url : hitURL,
				data : { supplierId : recordId } 
				}).done(function(data){
					console.log(data);
					if(data.status == true) { 
						objDataTable.row( currentRow ).remove().draw();
						//currentRow.remove();
						$("#delete-supplier-msg .modal-body").text("Record successfully deleted"); 
					}
					else if(data.status == false) {
						$("#delete-supplier-msg .modal-body").text("Record deletion failed"); 
					}
					else { 
						$("#delete-supplier-msg .modal-body").text("Access denied..!"); 
					}
					$('#delete-supplier').modal('hide');
					$('#delete-supplier-msg').modal('show');
				});
	});

	jQuery(document).on("click", ".deleteTeam", function(){
		let recordId = $(this).data("recordid");
		$("#hdDeleteRecordId").val(recordId);
		console.log(recordId);
	});

	jQuery(document).on("click", "#delete-team .btn-primary", function(){
		let recordId = $("#hdDeleteRecordId").val(),
		hitURL = baseURL + "securepanel/delete-team",
		currentRow = $('.row_' + recordId);

		jQuery.ajax({
				type : "POST",
				dataType : "json",
				url : hitURL,
				data : { teamId : recordId } 
				}).done(function(data){
					console.log(data);
					if(data.status == true) { 
						objDataTable.row( currentRow ).remove().draw();
						//currentRow.remove();
						$("#delete-team-msg .modal-body").text("Record successfully deleted"); 
					}
					else if(data.status == false) {
						$("#delete-team-msg .modal-body").text("Record deletion failed"); 
					}
					else { 
						$("#delete-team-msg .modal-body").text("Access denied..!"); 
					}
					$('#delete-team').modal('hide');
					$('#delete-team-msg').modal('show');
				});
	});

	jQuery(document).on("click", ".deleteCustomer", function(){
		let recordId = $(this).data("recordid");
		$("#hdDeleteRecordId").val(recordId);
		console.log(recordId);
	});

	jQuery(document).on("click", "#delete-customer .btn-primary", function(){
		let recordId = $("#hdDeleteRecordId").val(),
		hitURL = baseURL + "securepanel/delete-customer",
		currentRow = $('.row_' + recordId);

		jQuery.ajax({
				type : "POST",
				dataType : "json",
				url : hitURL,
				data : { customerId : recordId } 
				}).done(function(data){
					console.log(data);
					if(data.status == true) { 
						objDataTable.row( currentRow ).remove().draw();
						//currentRow.remove();
						$("#delete-customer-msg .modal-body").text("Record successfully deleted"); 
					}
					else if(data.status == false) {
						$("#delete-customer-msg .modal-body").text("Record deletion failed"); 
					}
					else { 
						$("#delete-customer-msg .modal-body").text("Access denied..!"); 
					}
					$('#delete-customer').modal('hide');
					$('#delete-customer-msg').modal('show');
				});
	});

	jQuery(document).on("click", ".deleteProduct", function(){
		let recordId = $(this).data("recordid");
		$("#hdDeleteRecordId").val(recordId);
		console.log(recordId);
	});

	jQuery(document).on("click", "#delete-product .btn-primary", function(){
		let recordId = $("#hdDeleteRecordId").val(),
		hitURL = baseURL + "securepanel/delete-product",
		currentRow = $('.row_' + recordId);

		jQuery.ajax({
				type : "POST",
				dataType : "json",
				url : hitURL,
				data : { productId : recordId } 
				}).done(function(data){
					console.log(data);
					if(data.status == true) { 
						objDataTable.row( currentRow ).remove().draw();
						//currentRow.remove();
						$("#delete-product-msg .modal-body").text("Record successfully deleted"); 
					}
					else if(data.status == false) {
						$("#delete-product-msg .modal-body").text("Record deletion failed"); 
					}
					else { 
						$("#delete-product-msg .modal-body").text("Access denied..!"); 
					}
					$('#delete-product').modal('hide');
					$('#delete-product-msg').modal('show');
				});
	});

	$("#pageSellProduct #frmAddForm").submit(function(e) {
		e.preventDefault();
		let hitURL = baseURL + "securepanel/add-sell-product-info-ajax";
        let lstProduct = $("#lstProduct").val();
        let txtCustomerName = $("#txtCustomerName").val();
        let txtQuantity = $("#txtQuantity").val();
        let txtPrice = $("#txtPrice").val();

        let form = $(this);

        if(lstProduct == ''){
            alert("Please select Product");
            $("#lstProduct").focus();
        }
        else if(txtCustomerName == ''){
            alert("Please enter customer name");
            $("#txtCustomerName").focus();
        }
        else if(txtQuantity == ''){
            alert("Please enter quantity");
            $("#txtQuantity").focus();
        }
        else if(txtPrice == ''){
            alert("Please enter price");
            $("#txtPrice").focus();
        }
        else{
        	$.ajax({
    			type : "POST",
    			url : hitURL,
    			dataType : "json",
    			data: form.serialize(), // serializes the form's elements.
    		}).done(function(data){
    			console.log(data);
    			if(data.status == true) { 
    				$("#sell-product-popup .modal-body").text("Product selled successfully"); 
    				$("#hdSellProduct").val("Y");
    			}
    			else if(data.status == false) {
    				$("#sell-product-popup .modal-body").text("Product sell failed"); 
    			}
    			else { 
    				$("#sell-product-popup .modal-body").text("Access denied..!"); 
    			}
    			$('#sell-product-popup').modal('show');
    			$("#btnSellProduct").prop('disabled', true);
    			$("#btnSellProduct").hide();
    			$("#btnSellProductNew").removeClass("d-none");
    			$("#btnSellProductNew").addClass("d-block");
    		});
        }
	});
});

function jsValidateSettings(){
	let oldPass = $("#inputOldPassword").val();
	let newPass = $("#newPassword").val();
	let cNewPass = $("#cNewPassword").val();

	if(oldPass == ''){
		alert("Please enter Current Password.");
		return false;
	}
	else if(newPass == ''){
		alert("Please enter new Password.");
		return false;
	}
	else if(cNewPass == ''){
		alert("Please enter Confirm Password.");
		return false;
	}
	else if(cNewPass != newPass){
		alert("Please enter same password in Confirm Password.");
		return false;
	}
	else{
		return true;
	}
}