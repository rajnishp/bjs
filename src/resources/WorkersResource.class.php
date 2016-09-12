<?php

/**
 * @author anil
 */
require_once 'resources/Resource.interface.php';
require_once 'dao/DAOFactory.class.php';
require_once 'models/Worker.class.php';
require_once 'exceptions/MissingParametersException.class.php';
require_once 'exceptions/UnsupportedResourceMethodException.class.php';

class WorkersResource implements Resource {

    private $workersDAO;
    private $worker;

    public function __construct() {
		$DAOFactory = new DAOFactory();
		$this -> workersDAO = $DAOFactory -> getWorkersDAO();
    }

    public function checkIfRequestMethodValid($requestMethod) {
		return in_array($requestMethod, array('get', 'put', 'post', 'delete', 'options'));
    }

    public function options() {    }

    
    public function delete ($resourceVals, $data, $workerId) {    }

    public function put ($resourceVals, $data, $workerId) {    }

    public function post ($resourceVals, $data, $workerId) {
        global $logger, $warnings_payload;

        $WorkerInfoId = $resourceVals ['workers'];
        if (isset($WorkerInfoId)) {
            $warnings_payload [] = 'POST call to /user must not have ' . 
                                        '/user_ID appended i.e. POST /user';
            throw new UnsupportedResourceMethodException();
        }

        
        $newWorkerObj = new Worker (
                                        $data['first_name'],
                                        $data['last_name'],
                                        $data['age'],
                                        $data['address_proof_name'],
                                        $data['address_proof_id'],
                                        $data['id_proof_name'],
                                        $data['id_proof_id'],
                                        $data['current_address'],
                                        $data['permanent_address'],
                                        $data['mobile'],
                                        $data['emergancy_mobile'],
                                        $data['education'],
                                        $data['languages'],
                                        $data['skills'],
                                        $data['experience'],
                                        $data['working_domain'],
                                        $data['current_working_city'],
                                        $data['current_working_area'],
                                        $data['preferred_working_city'],
                                        $data['preferred_working_area'],
                                        $data['working_slots'],
                                        $data['free_slots'],
                                        $data['birth_date'],
                                        $data['gender'],
                                        $data['salary_expected'],
                                        $data['remarks'],
                                        $data['police'],
                                        $employeeId,
                                        date("Y-m-d H:i:s")
                                    );

        
            $this -> workersDAO -> insert($newWorkerObj);

            $workerDetail = $newWorkerObj -> toArray();
            
            $this -> workerDetail[] = $workerDetail;
            return array ('code' => '6001', 
                            'data' => array(
                                'worker' => $this -> workerDetail
                            )
            );
        
    }

    public function get($resourceVals, $data, $workerId) {

        //$userId = 1;

        $WorkerInfoId = $resourceVals ['workers'];
        if (isset($WorkerInfoId))
            $result = $this -> getWorker($WorkerInfoId);
            
        else
            $result = $this -> getAllWorkers();
                                                                                                                                                                                                                                                                                
        if (!is_array($result)) {
            return array('code' => '6004');
        }

        return array('code' => '6000', 
                     'data' => $result
            );
    }

    private function getWorker($workerId) {
    
        global $logger;
        $logger->debug('Fetch User Detail...');
        $workerInfoObj = $this -> workersDAO -> load($workerId);

              
             
        $this -> workerDetail [] = $workerInfoObj-> toArray();
        $logger -> debug ('Fetched details: ' . json_encode($this -> workerDetail));

        return $this -> workerDetail;
    }

    private function getAllWorkers() {
    
        global $logger;
        $workersArray = null;
        $logger->debug('Fetch User Detail...');
        $workerInfoObjs = $this -> workersDAO -> loadAllWorkers();

              
        foreach ($workerInfoObjs as $key => $workerInfoObj) {
                  $workersArray [] = $workerInfoObj-> toArray();
             }     
       
        $logger -> debug ('Fetched details: ' . json_encode($this -> workerDetail));

        return $workersArray;
    }

}