<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this -> load -> model('employee_model');

	}

	public function viewEmployeeProfile($id) {
		$employeeID='1004';
		$data['employeeBasicDetails'] = $this -> getemployeeBasicDetailsFromDatabase($employeeID);
		$data['employeeDepartmentalDeails'] = $this -> getemployeeDepartmentalDeailsFromDatabase($employeeID);
		$data['employeeSalaryDetails'] = $this -> getemployeeDepartmentalDeailsFromDatabase($employeeID);
		$data['employeeEducationDetails'] = $this -> getemployeeEducationDetailsFromDatabase($employeeID);
		$data['employeeJobHistoryDetails'] = $this -> getemployeeJobHistoryDetailsFromDatabase($employeeID);
		$data['employeeTrainingDetails'] = $this -> getemployeeTrainingDetailsFromDatabase($employeeID);
		//$data['header'] = 'template/header';
		//$data['sidebar'] = 'template/sidebar';
		//$data['main_content'] = 'viewEmployee';
		//$data['footer'] = 'template/footer';
		//$this -> load -> view('template/template', $data);
		
		//print_r($data);
	}

	function getemployeeBasicDetailsFromDatabase($employeeID) {

		$employeeBasicDetailsArray = $this -> employee_model -> employeeBasicDetails($employeeID);
		if (is_array($employeeBasicDetailsArray) === true && count($employeeBasicDetailsArray) > 0) {
			return $employeeBasicDetailsArray;
		} else {
			$errorResponse = array("status" => "false", "msg" => $employeeBasicDetailsArray);
			echo json_encode($errorResponse);

		}
	}

	function getemployeeDepartmentalDeailsFromDatabase($employeeID) {
		$employeeDepartmentalDeailsArray = $this -> employee_model -> employeeDepartmentalDeails($employeeID);
		if (is_array($employeeDepartmentalDeailsArray) === true && count($employeeDepartmentalDeailsArray) > 0) {
			return $employeeDepartmentalDeailsArray;
		} else {
			$errorResponse = array("status" => "false", "msg" => $employeeDepartmentalDeailsArray);
			echo json_encode($errorResponse);

		}

	}

	function getemployeeSalaryDetailsFromDatabase($employeeID) {
		$employeeSalaryDetailsArray = $this -> employee_model -> employeeSalaryDetails($employeeID);
		if (is_array($employeeSalaryDetailsArray) === true && count($employeeSalaryDetailsArray) > 0) {
			return $employeeSalaryDetailsArray;
		} else {
			$errorResponse = array("status" => "false", "msg" => $employeeSalaryDetailsArray);
			echo json_encode($errorResponse);

		}
	}

	function getemployeeTrainingDetailsFromDatabase($employeeID) {
		$employeeTrainingDetailsArray = $this -> employee_model -> employeeTrainingDetails($employeeID);
		if (is_array($employeeTrainingDetailsArray) === true && count($employeeTrainingDetailsArray) > 0) {
			return $employeeTrainingDetailsArray;
		} else {
			return array();
			//$errorResponse = array("status" => "false", "msg" => $employeeTrainingDetailsArray);
			//echo json_encode($errorResponse);

		}
	}

	function getemployeeJobHistoryDetailsFromDatabase($employeeID) {
		$employeeJobHistoryDetailsArray = $this -> employee_model -> employeeJobHistoryDetails($employeeID);
		if (is_array($employeeJobHistoryDetailsArray) === true && count($employeeJobHistoryDetailsArray) > 0) {
			return $employeeJobHistoryDetailsArray;
		} else {
			return array();
			//$errorResponse = array("status" => "false", "msg" => $employeeJobHistoryDetailsArray);
			//echo json_encode($errorResponse);

		}
	}

	function getemployeeEducationDetailsFromDatabase($employeeID) {
		$employeeEducationDetailsArray = $this -> employee_model -> employeeEducationDetails($employeeID);
		if (is_array($employeeEducationDetailsArray) === true && count($employeeEducationDetailsArray) > 0) {
			return $employeeEducationDetailsArray;
		} else {
			return array();
			//$errorResponse = array("status" => "false", "msg" => $employeeEducationDetailsArray);
			//echo json_encode($errorResponse);

		}
	}

}
?>