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
		//async : false,
		success: function(data) {
			console.log(data);
			if (data.status == "true") {
				tableData = data;
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
	alert("omg");
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
		"ajax": tableData,
        "columns": [
            { "data": "department" },
            { "data": "designation" },
            { "data": "email" },
            { "data": "employeeID" },
            { "data": "employeeType" },
            { "data": "mobileNum" },
            { "data": "name" },
            { "data": "supervisorID" },
            { "data": "userName" }
        ]
	});

}

function initviewAllEmployeeTable() {
	/*
	var tableData='';
		$('#viewAllEmployeeTable').DataTable({
			"processing": true,
			"serverSide": false,
			"bFilter": false,
			dom: 'Bfrtip',
			buttons: ['colvis', 'print', 'csv', 'excel', 'pdf'],
			searching: false,
			language: {
				buttons: {
					colvis: 'Show/Hide Columns'
				}
			},
			"aaData": tableData,
			"aoColumns": [
				{"mData": "subscriberId", "visible": false}, 
				{"mData": "phone"}, 
				{"mData": "name"}, 
				{"mData": "countryName", "visible": false}, 
				{"mData": "city"}, 
				{"mData": "address"}, 
				{"mData": "cnic"}, 
				{"mData": "ntn", "visible": false}, 
				{"mData": "operatorId", "visible": false}, 
				{"mData": "activationDate"}
			]
		});*/
	
}
