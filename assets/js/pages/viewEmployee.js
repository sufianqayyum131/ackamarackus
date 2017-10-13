$(document).ready(function() {
	//INIT Table
	getAllEmployee();
	
});

function getAllEmployee() {
	var formData;
	$.ajax({
		url: "/ackamarackus/employee/getAllEmployeesFromDatabase",
		type: "POST",
		data: formData,
		dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
		success: function(data) {
			if (data.status == "true") {
				tableData = data.data;
				showAllEmployeeTable(tableData);
			}
			if (data.status == "false") {
				showResponseMessage('Error!',data.msg,'error','OK');
			}
		},
		error: function(error) {
			//console.log(error);
		}
	});
}

function showAllEmployeeTable(tableData) {
	console.log(tableData);
	$('#viewAllEmployeeTable').DataTable({
		"processing": true,
		"serverSide": false,
		"dom": 'Bfrtip',
		"buttons": ['colvis', 'print', 'csv', 'excel', 'pdf'],
		"language": {
			"buttons": {
				"colvis": 'Show/Hide Columns'
			}
		},
		"aaData": tableData,
        "columns": [
            { "data": "employeeID" },
            { "data": "name" },
            { "data": "userName" },
            { "data": "email" },
            { "data": "mobileNum" },
            { "data": "department" },
            { "data": "designation" },
            { "data": "employeeType" },
            { "data": "supervisorID" }
        ]
	});

}
