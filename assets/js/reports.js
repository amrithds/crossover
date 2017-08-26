$("#newPatientDetails").css("display", "none");

$('.patientType').click(function() {
	if ($(this).val() == 2) {
		$("#newPatientDetails").css("display", "none");
		$("#existingPatientDetails").css("display", "block");
	} else {
		$("#newPatientDetails").css("display", "block");
		$("#existingPatientDetails").css("display", "none");
	}
});

$.ajax({
	url : "admin/reportComponents",
	success : function(result) {
		
	},
	error : function(){
		
	}
});