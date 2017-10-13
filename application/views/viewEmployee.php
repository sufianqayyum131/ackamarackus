<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<title>View Employee</title>
<div class="main-content">
	<?php include 'template/topmenu.php' ?>
	<!-- PAGE CODE STARTS BELOW FROM HERE -->
	
	<!-- Breadcrumbs -->
	<div class="container-fluid">
		<div class="row">
			<ol class="breadcrumb">
				<li>
					<a href="javascript:;"> <i class="fa fa-user fa-fw"></i> Employee </a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>employee/viewEmployee">View Employee</a>
				</li>
			</ol>
		</div>
	</div>
	
	<!-- View Employee Table -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" data-collapsed="0">
			        <!-- panel head -->
			        <div class="panel-heading">
			            <div class="panel-title">View All Employee</div>
			            <div class="panel-options"> <a href="#" data-rel="collapse"><i class="fa fa-angle-down fa-fw"></i></a> </div>
			        </div>
			        <!-- panel body -->
			        <div class="panel-body">
			        	<table id="viewAllEmployeeTable" class="display responsive nowrap" cellspacing="0" width="100%">
						    <thead>
						        <tr>
						            <th>employeeID</th>
						            <th>name</th>
						            <th>userName</th>
						            <th>email</th>
						            <th>mobileNum</th>
						            <th>department</th>
						            <th>designation</th>
						            <th>employeeType</th>
						            <th>supervisorID</th>
						            
						         </tr>
						    </thead>
							
						</table>
			        </div>
			    </div>
			</div>
		</div>
	</div>
	
	<script src="<?php echo base_url(); ?>assets/js/pages/viewEmployee.js"></script>
	
</div>