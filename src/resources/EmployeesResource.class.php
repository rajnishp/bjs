<?php

/**
 * @author anil
 */
require_once 'resources/Resource.interface.php';
require_once 'dao/DAOFactory.class.php';
require_once 'models/Employee.class.php';
require_once 'exceptions/MissingParametersException.class.php';
require_once 'exceptions/UnsupportedResourceMethodException.class.php';

class EmployeesResource implements Resource {

    private $employeesDAO;
    private $employee;

    public function __construct() {
		$DAOFactory = new DAOFactory();
		$this -> employeesDAO = $DAOFactory -> getEmployeesDAO();
    }

    public function checkIfRequestMethodValid($requestMethod) {
		return in_array($requestMethod, array('get', 'put', 'post', 'delete', 'options'));
    }

    public function options() {    }

    
    public function delete ($resourceVals, $data, $employeeId) {    }

    public function put ($resourceVals, $data, $employeeId) {    }

    public function post ($resourceVals, $data, $employeeId) {
        global $logger, $warnings_payload;

        $EmployeeInfoId = $resourceVals ['employees'];
        if (isset($EmployeeInfoId)) {
            $warnings_payload [] = 'POST call to /user must not have ' . 
                                        '/user_ID appended i.e. POST /user';
            throw new UnsupportedResourceMethodException();
        }

        
        $newEmployeeObj = new employee (
                                        $data['first_name'],
                                        $data['last_name'],
                                        $data['address_proof_name'],
                                        $data['address_proof_id'],
                                        $data['id_proof_name'],
                                        $data['id_proof_id'],
                                        $data['age'],
                                        $data['current_address'],
                                        $data['permanent_address'],
                                        $data['mobile'],
                                        $data['emergancy_mobile'],
                                        $data['education'],
                                        $data['languages'],
                                        $data['birth_date'],
                                        $data['gender'],
                                        $data['email'],
                                        $data['username'],
                                        $data['password'],
                                        $data['employee_type'],
                                        $data['remarks'],
                                        date("Y-m-d H:i:s")
                                    );

        
            $this -> employeesDAO -> insert($newEmployeeObj);

            $employeeDetail = $newEmployeeObj -> toArray();
            
            $this -> employeeDetail[] = $employeeDetail;
            return array ('code' => '6001', 
                            'data' => array(
                                'employee' => $this -> employeeDetail
                            )
            );
        
    }

    public function get($resourceVals, $data, $employeeId) {

        //$userId = 1;

        $EmployeeInfoId = $resourceVals ['employees'];
        if (isset($EmployeeInfoId))
            $result = $this -> getEmployee($EmployeeInfoId);
            
        else
            $result = $this -> getAllEmployees();
                                                                                                                                                                                                                                                                                
        if (!is_array($result)) {
            return array('code' => '6004');
        }

        return array('code' => '6000', 
                     'data' => $result
            );
    }

    private function getEmployee($employeeId) {
    
        global $logger;
        $logger->debug('Fetch User Detail...');
        $employeeInfoObj = $this -> employeesDAO -> load($employeeId);

              
             
        $this -> employeeDetail [] = $employeeInfoObj-> toArray();
        $logger -> debug ('Fetched details: ' . json_encode($this -> employeeDetail));

        return $this -> employeeDetail;
    }

    private function getAllEmployees() {
    
        global $logger;
        $workersArray = null;
        $logger->debug('Fetch User Detail...');
        $employeeInfoObjs = $this -> employeesDAO -> loadAllEmployees();

              
        foreach ($employeeInfoObjs as $key => $employeeInfoObj) {
                  $workersArray [] = $employeeInfoObj-> toArray();
             }     
       
        $logger -> debug ('Fetched details: ' . json_encode($this -> employeeDetail));

        return $employeesArray;
    }

}