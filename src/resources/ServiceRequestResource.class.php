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
        $this -> ServiceRequestDAO = $DAOFactory -> getServiceRequestsDAO();
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

        $ServiceRequestInfoObj = new ServiceRequest($data['name'], $data['mobile'], $data['address'], $data ['service'], $data["type"], $data ['timestamp']);
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

        //$ServiceRequestId = 1;

        $ServiceRequestInfoId = $resourceVals ['ServiceRequest'];
        if (isset($ServiceRequestInfoId))
            return array('code' => '6004');
            //$result = $this->getServiceRequestDetail($ServiceRequestId);
            
        else
            $result = $this -> getServiceRequestDetail($ServiceRequestId);
        
        if (!is_array($result)) {
            return array('code' => '6004');
        }

        return $result;
    }

    private function getServiceRequestDetail($ServiceRequestId) {
    
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
    }

}