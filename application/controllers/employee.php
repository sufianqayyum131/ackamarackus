<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this -> load -> model('employee_model');

	}

	public function addEmployee() {
		$data['header'] = 'template/header';
		$data['sidebar'] = 'template/sidebar';
		$data['main_content'] = 'addEmployee';
		$data['footer'] = 'template/footer';
		$this -> load -> view('template/template', $data);
	}

	public function viewEmployee() {
		$data['header'] = 'template/header';
		$data['sidebar'] = 'template/sidebar';
		$data['main_content'] = 'viewEmployee';
		$data['footer'] = 'template/footer';
		$this -> load -> view('template/template', $data);
	}

	public function viewEmployeeProfile($employeeID) {
		$employeeID = $this -> input -> post('employeeID');
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

	function functionToTestgetAndSaveEmployeeDetailsResult() {

		$result = $this -> getMaxIDFromEmployeeDetails();
		echo $result;
	}

	function getMaxIDFromEmployeeDetails() {
		$lastIdFromEmployeeTables = $this -> employee_model -> toGetMaximumIDFromEmployeeDetails();
		$dataFromUpdatedIdTable = $this -> employee_model -> toGetLastEmployeeID();
		$updatedIdinUpdatedIdTable = $dataFromUpdatedIdTable['employeeID'];
		if ($lastIdFromEmployeeTables == $updatedIdinUpdatedIdTable) {
			return $employee_id = $lastIdFromEmployeeTables + 1;
		} else {
			echo "There is some issue during previous entry";
			die();
		}
	}

	/*function getLastEmployeeID() {

	 $employeeData = $this -> employee_model -> toGetLastEmployeeID();
	 $employeeID = $employeeData['employeeID'];
	 $oldVersionBit = $employeeData['versionBit'];
	 $employeeID = $employeeID + 1;
	 $versionBit = 1;

	 $updateversionBitOfLastEmployeeAdded = $this -> employee_model -> updateIdOfLastEmployeeAddedAfterSucessfullEmployeeAddition($employeeID, $versionBit);
	 return $employeeID;

	 }*/

	public function do_upload($uploadedField, $employeeID) {

		//$uploadedField = $this -> input -> post('_hidden_field');
		if (empty($_FILES[$uploadedField]['name'])) {

			$error = "File is empty please choose a file";
			return $error;

		} else {
			//print_r($_FILES[$uploadedField]);
			//die();
			$name = '_' . $uploadedField;
			$config['file_name'] = $employeeID . $name;
			$config['upload_path'] = './uploads/' . $employeeID;
			$config['allowed_types'] = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp';
			$config['max_size'] = 2048;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$this -> upload -> initialize($config);
			//$this -> load -> library('upload', $config);

			if (!is_dir('uploads')) {
				mkdir('./uploads', 0777, true);
			}
			$dir_exist = true;
			// flag for checking the directory exist or not
			if (!is_dir('uploads/' . $employeeID)) {
				mkdir('./uploads/' . $employeeID, 0777, true);
				$dir_exist = false;
				// dir not exist
			} else {

			}

			if (!$this -> upload -> do_upload($uploadedField)) {

				if (!$dir_exist)
					rmdir('./uploads/' . $employeeID);

				$error = array('error' => $this -> upload -> display_errors());
				return $error;

				//$this -> load -> view('upload_form', $error);
			} else {
				$data = array('upload_data' => $this -> upload -> data());
				//print_r($data);
				return $path = $data['upload_data']['full_path'];

				//$this -> load -> view('upload_success', $data);
			}
		}
	}

	function delete_files($target) {
		if (is_dir($target)) {
			$files = glob($target . '*', GLOB_MARK);
			//GLOB_MARK adds a slash to directories returned

			foreach ($files as $file) {
				delete_files($file);
			}

			rmdir($target);
		} elseif (is_file($target)) {
			unlink($target);
		}
	}

	function getAndSaveEmployeeDetails() {

		$employeeID = $this -> getMaxIDFromEmployeeDetails();

		$profilePic = 'profilePic';
		$profilePic = $this -> do_upload($profilePic, $employeeID);

		$firstName = $this -> input -> post('firstName');

		$middleName = $this -> input -> post('middleName');

		$lastName = $this -> input -> post('lastName');

		$userName = $this -> input -> post('userName');

		$email = $this -> input -> post('email');

		$cnicNumber = $this -> input -> post('cnic');

		$mobileNum = $this -> input -> post('mobileNumber');

		$homePhone = $this -> input -> post('homePhone');

		$dob = $this -> input -> post('dob');

		$address = $this -> input -> post('address');

		$emergencyContactName = $this -> input -> post('emergencyCName');

		$emergencyContactNumber = $this -> input -> post('emergencyCNumber');

		$bloodGroup = $this -> input -> post('bloodGroup');

		$father_husbandName = $this -> input -> post('spouseName');

		$hireDate = $this -> input -> post('hireDate');

		$resume = 'resume';
		$resume = $this -> do_upload($resume, $employeeID);

		$saveEmployeeBasicDetails = $this -> employee_model -> createEmployee($employeeID, $firstName, $middleName, $lastName, $userName, $email, $mobileNum, $homePhone, $cnicNumber, $dob, $address, $emergencyContactNumber, $emergencyContactName, $bloodGroup, $father_husbandName, $hireDate, $profilePic, $resume);

		if ($saveEmployeeBasicDetails == 1) {

			$employeeType = $this -> input -> post('employeeType');

			$department = $this -> input -> post('department');

			$designation = $this -> input -> post('designation');

			$supervisorID = $this -> input -> post('superviserID');

			/*function call to save employe departmental details in departmen table*/

			$saveEmployeeDepartmentalDetails = $this -> employee_model -> createDepartment($employeeID, $department, $designation, $employeeType, $supervisorID);

			if ($saveEmployeeDepartmentalDetails == 1) {

				$salary = $this -> input -> post('salary');

				/*function call to save employe salary details in salary table*/
				$saveEmployeeSalaryDetails = $this -> employee_model -> createSalary($employeeID, $salary, $employeeType);

				/**/

				if ($saveEmployeeSalaryDetails == 1) {

					//I need this type of array	//$education = array(0 => array('employeeID' => $employeeID, 'instituteName' => 'FGCC Lahore', 'qualification' => 'SSC', 'admissionDate' => '01-03-2007', 'graduationDate' => '01-06-2009'), 1 => array('employeeID' => $employeeID, 'instituteName' => 'FGCC Lahore', 'qualification' => 'HSSC', 'admissionDate' => '01-07-2009', 'graduationDate' => '01-06-2011'));

					$educationInstitute = $this -> input -> post('educationInstitute');
					$educationQualification = $this -> input -> post('educationQualification');
					$educationAdmDate = $this -> input -> post('educationAdmDate');
					$educationGraDate = $this -> input -> post('educationGraDate');

					$sizeOfEducationArray = sizeof($educationInstitute);

					$education = array();
					$i = 0;
					foreach ($educationQualification as $id => $key) {
						if (--$sizeOfEducationArray <= 0) {
							break;
						}
						$education[$i] = array('employeeID' => $employeeID, 'instituteName' => $educationInstitute[$id], 'qualification' => $educationQualification[$id], 'admissionDate' => $educationAdmDate[$id], 'graduationDate' => $educationGraDate[$id]);
						$i++;

					}
					//print_r($education);
					//null;

					if (is_array($education) === true && count($education) > 0) {

						$saveEmployeeEducationHistory = $this -> employee_model -> createEducation($education);

					} else {
						// echo "no employee training data";
					}
					//I need this type of array //$jobHistory = array(0 => array('employeeID' => $employeeID, 'company' => 'Techaccess', 'designation' => 'SupportEngineer', 'employmentStartDate' => '01-02-2015', 'employmentEndDate' => '01-03-2016', 'JobDescription' => 'xyz'), 1 => array('employeeID' => $employeeID, 'company' => 'GlobizServ', 'designation' => 'SoftwareEngineer', 'employmentStartDate' => '01-02-2014', 'employmentEndDate' => '01-03-2015', 'JobDescription' => 'xyz'));

					$jobHistoryCompany = $this -> input -> post('jobHistoryCompany');
					$jobHistoryDesignation = $this -> input -> post('jobHistoryDesignation');
					$jobHistoryStartDate = $this -> input -> post('jobHistoryStartDate');
					$jobHistoryEndDate = $this -> input -> post('jobHistoryEndDate');
					$sizeOfJobArray = sizeof($jobHistoryCompany);

					$jobHistory = array();
					$i = 0;
					foreach ($jobHistoryCompany as $id => $key) {
						if (--$sizeOfJobArray <= 0) {
							break;
						}
						$jobHistory[$i] = array('employeeID' => $employeeID, 'company' => $jobHistoryCompany[$id], 'designation' => $jobHistoryDesignation[$id], 'employmentStartDate' => $jobHistoryStartDate[$id], 'employmentEndDate' => $jobHistoryEndDate[$id]);
						$i++;

					}
					//print_r($job);

					if (is_array($jobHistory) === true && count($jobHistory) > 0) {

						$saveEmployeejobHistory = $this -> employee_model -> createJobHistory($jobHistory);

					} else {
						//echo "no employee job data";
					}

					//I need this type of array //$training = array(0 => array('employeeID' => $employeeID, 'trainingInstituteName' => 'Technoed', 'trainingStartDate' => '10-03-2016', 'trainingEndDate' => '10-06-2016', 'ExamDate' => '11-11-2016', 'certificationName' => 'OCP'), 1 => array('employeeID' => $employeeID, 'trainingInstituteName' => 'Technoed', 'trainingStartDate' => '11-04-2016', 'trainingEndDate' => '01-01-2017', 'ExamDate' => '11-02-2017', 'certificationName' => 'RHCE'), );

					//$training = $this -> input -> post('training');
					//null;
					$trainingsInstitueName = $this -> input -> post('trainingsInstitueName');
					$trainingsCertficationName = $this -> input -> post('trainingsCertficationName');
					$trainingsStartDate = $this -> input -> post('trainingsStartDate');
					$trainingsEndDate = $this -> input -> post('trainingsEndDate');
					$trainingsExamDate = $this -> input -> post('trainingsExamDate');

					$sizeOfTrainingArray = sizeof($trainingsInstitueName);

					$training = array();
					$i = 0;
					foreach ($trainingsInstitueName as $id => $key) {
						if (--$sizeOfTrainingArray <= 0) {
							break;
						}
						$training[$i] = array('employeeID' => $employeeID, 'trainingInstituteName' => $trainingsInstitueName[$id], 'trainingStartDate' => $trainingsStartDate[$id], 'trainingEndDate' => $trainingsEndDate[$id], 'ExamDate' => $trainingsExamDate[$id], 'certificationName' => $trainingsCertficationName[$id]);
						$i++;

					}
					//print_r($training);
					if (is_array($training) === true && count($training) > 0) {

						$saveEmployeeTrainingHistory = $this -> employee_model -> createTraining($training);

					} else {

					}

				} else {
					$tableName = 'employee_basic_details';
					$this -> employee_model -> deleteUnsuccessfullData($employeeID, $tableName);
					$this -> delete_files('./uploads/' . $employeeID);
					$tableName = 'employee_department_details';
					$this -> employee_model -> deleteUnsuccessfullData($employeeID, $tableName);
					$errorResponse = array("status" => "false", "msg" => $saveEmployeeSalaryDetails);
					$errorResponse = json_encode($errorResponse);
					echo $errorResponse;
					//$data = array('some_data' => $errorResponse);
					//$this -> load -> view('upload_success', $data);
				}
			} else {
				$tableName = 'employee_basic_details';
				$this -> employee_model -> deleteUnsuccessfullData($employeeID, $tableName);
				$this -> delete_files('./uploads/' . $employeeID);
				$errorResponse = array("status" => "false", "msg" => $saveEmployeeDepartmentalDetails);
				$errorResponse = json_encode($errorResponse);
				echo $errorResponse;
				//$data = array('some_data' => $errorResponse);
				//$this -> load -> view('upload_success', $data);
			}
			/*updating of last id of employee added*/
			$versionBit = 0;
			$updateIDOfLastEmployeeAdded = $this -> employee_model -> updateIdOfLastEmployeeAddedAfterSucessfullEmployeeAddition($employeeID, $versionBit);
			if ($updateIDOfLastEmployeeAdded == 1) {
				$successResponse = array("status" => "true", "msg" => "Teacher Successfully Added !!!");
				$successResponse = json_encode($successResponse);
				echo $successResponse;
				//$data = array('some_data' => $successResponse);
				//$this -> load -> view('upload_success', $data);
			} else {
				$this -> delete_files('./uploads/' . $employeeID);
				$errorResponse = array("status" => "false", "msg" => $updateIDOfLastEmployeeAdded);
				$errorResponse = json_encode($errorResponse);
				echo $errorResponse;
				//$data = array('some_data' => $errorResponse);
				//$this -> load -> view('upload_success', $data);
			}
		} else {
			$this -> delete_files('./uploads/' . $employeeID);
			$errorResponse = array("status" => "false", "msg" => $saveEmployeeBasicDetails);
			$errorResponse = json_encode($errorResponse);
			echo $errorResponse;
			//$data = array('some_data' => $errorResponse);
			//$this -> load -> view('upload_success', $data);
		}

	}

	function getAllEmployeesFromDatabase() {

		$list = $this -> employee_model -> getAllEmployees();
		if (is_array($list) === true && count($list) > 0) {
			$data = array();
			foreach ($list as $customers) {
				$row = array();
				$row['employeeID'] = $customers -> employeeID;
				$row['name'] = $customers -> firstName . " " . $customers -> lastName;
				$row['userName'] = $customers -> userName;
				$row['email'] = $customers -> email;
				$row['mobileNum'] = $customers -> mobileNum;
				$row['department'] = $customers -> department;
				$row['designation'] = $customers -> designation;
				$row['employeeType'] = $customers -> employeeType;
				$row['supervisorID'] = $customers -> supervisorID;
				$data[] = $row;
			}
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