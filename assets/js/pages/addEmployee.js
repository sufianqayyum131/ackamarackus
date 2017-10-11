$(document).ready(function() {
	//INIT Image and File Upload UI Plugin
	initImageFileUploadUI();

});

function getValues() {
	textToIconButton();
	var formData = new FormData($('form#newTeacherForm')[0]);
	$.ajax({
		url: "/ackamarackus/employee/getAndSaveEmployeeDetails",
		type: "POST",
		data: formData,
		dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
		//async : false,
		success: function(data) {
			console.log(data);
			console.log(data.status);
			if (data.status == "true") {
				showResponseMessage('Success!',data.msg,'success','OK');
			}
			if (data.status == "false") {
				showResponseMessage('Error!',data.msg,'error','OK');
			}
			textToIconButton();
			
		},
		error: function(error) {
			//console.log(error);
		}
	});
	
}
