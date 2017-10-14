<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this -> load -> model('employee_model');

	}

	public function index() {
		$this -> getEmployeeDetailsFromDatabase();
	}

	function getEmployeeDetailsFromDatabase() {

		$list = $this -> employee_model -> getEmployeesDetails(1014);
		if (is_array($list) === true && count($list) > 0) {
			$data = array();
			$data=$list;
			implode(',', array_map(function($key) {
				if (!is_numeric($key)) {
					return '"' . $key . '"';
					//adds double quotes, but if you prefer single quotes, use:
					//return "'" . $value . "'";
				} else {
					return $key;
				}
			}, $data[0]));

			$successResponse = array("status" => "true", "msg" => "Teacher's Data Received", "data" => $data, );
			echo json_encode($successResponse);

		} else {
			$errorResponse = array("status" => "false", "msg" => $list);
			echo json_encode($errorResponse);

		}
	}

}
?>