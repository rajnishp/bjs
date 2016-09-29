<?php

/**
 * @author rajnish
 */
require_once 'resources/Resource.interface.php';
require_once 'dao/DAOFactory.class.php';
require_once 'models/ServiceRequest.class.php';
require_once 'exceptions/MissingParametersException.class.php';
require_once 'exceptions/UnsupportedResourceMethodException.class.php';

class ServiceRequestResource implements Resource {

    private $ServiceRequestDAO;
    private $ServiceRequest;

    public function __construct() {
        $DAOFactory = new DAOFactory();
        $this -> serviceRequestsDAO = $DAOFactory -> getServiceRequestsDAO();
    }

    public function checkIfRequestMethodValid($requestMethod) {
        return in_array($requestMethod, array('get', 'put', 'post', 'delete', 'options'));
    }

    public function options() {    }

    
    public function delete ($resourceVals, $data, $ServiceRequestId) {    }

    public function put ($resourceVals, $data, $ServiceRequestId) {    }

    public function post ($resourceVals, $data, $ServiceRequestId) {
        global $logger, $warnings_payload;

        $ServiceRequestInfoId = $resourceVals ['ServiceRequest'];
        if (isset($ServiceRequestInfoId)) {
            $warnings_payload [] = 'POST call to /ServiceRequest must not have ' . 
                                        '/ServiceRequest_ID appended i.e. POST /ServiceRequest';
            throw new UnsupportedResourceMethodException();
        }

        $ServiceRequestInfoObj = new ServiceRequest(
                                                    $data['name'], 
                                                    $data['mobile'], 
                                                    $data['address'], 
                                                    $data['service'], 
                                                    $data["type"], 
                                                    $data["salary_criteria"], 
                                                    $data["requirements"], 
                                                    $data["remarks"], 
                                                    $data["working_hour"], 
                                                    $data["status"], 
                                                    $data ['timestamp']
                                                    );
        //$logger -> debug ("POSTed ServiceRequest Detail: " . $ServiceRequestInfoObj -> toString());

        
            $this -> ServiceRequestDAO -> insert($ServiceRequestInfoObj);

            $ServiceRequestDetail = $ServiceRequestInfoObj -> toArray();
            
            $this -> ServiceRequestDetail[] = $ServiceRequestDetail;
            return array ('code' => '6001', 
                            'data' => array(
                                'ServiceRequestDetail' => $this -> ServiceRequestDetail
                            )
            );
        
    }
    public function get($resourceVals, $data, $ServiceRequestId) {

        //$userId = 1;

        $ServiceRequestInfoId = $resourceVals ['service_request'];
        if (isset($ServiceRequestInfoId))
            $result = $this -> getServiceRequest($ServiceRequestInfoId);
            
        else
            $result = $this -> getAllServiceRequest();
                                                                                                                                                                                                                                                                                
        if (!is_array($result)) {
            return array('code' => '6004');
        }

        return array('code' => '6000', 
                     'data' => $result
            );
    }

    private function getServiceRequest($ServiceRequestId) {
    
        global $logger;
        $logger->debug('Fetch User Detail...');
        $ServiceRequestInfoObj = $this -> serviceRequestsDAO -> load($ServiceRequestId);

              
             
        $this -> serviceRequestDetail [] = $ServiceRequestInfoObj-> toArray();
        $logger -> debug ('Fetched details: ' . json_encode($this -> serviceRequestDetail));

        return $this -> serviceRequestDetail;
    }

    private function getAllServiceRequest() {
    
        global $logger;
        $serviceRequestsArray = null;
        $logger->debug('Fetch User Detail...');
        $serviceRequestInfoObjs = $this -> serviceRequestsDAO -> loadAllServiceRequests();

              
        foreach ($serviceRequestInfoObjs as $key => $serviceRequestInfoObj) {
                  $serviceRequestsArray [] = $serviceRequestInfoObj-> toArray();
             }     
       
        $logger -> debug ('Fetched details: ' . json_encode($this -> serviceRequestsArray));

        return $serviceRequestsArray;
    }

    /*private function getServiceRequestDetail($ServiceRequestId) {
    
        global $logger;
        $logger->debug('Fetch ServiceRequest Detail...');
        $ServiceRequestInfoObj = $this -> mobacDAO -> load($ServiceRequestId);

        if(empty($ServiceRequestInfoObj)) 
                return array('code' => '6004');        
             
        $this -> ServiceRequestDetail [] = $ServiceRequestInfoObj-> toArray();
        $logger -> debug ('Fetched details: ' . json_encode($this -> ServiceRequestDetail));

        return array('code' => '6000', 
                     'data' => array(
                                'ServiceRequest' => $this -> ServiceRequestDetail
                            )
            );
    }*/

}