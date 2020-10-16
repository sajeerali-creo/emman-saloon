jQuery(document).ready(function(){

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
					currentRow.remove();
					if(data.status == true) { 
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
					currentRow.remove();
					if(data.status == true) { 
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
					currentRow.remove();
					if(data.status == true) { 
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