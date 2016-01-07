<?php

/**
 * @author anil
 */
require_once 'resources/Resource.interface.php';
require_once 'dao/DAOFactory.class.php';
require_once 'models/Followback.class.php';
require_once 'exceptions/MissingParametersException.class.php';
require_once 'exceptions/UnsupportedResourceMethodException.class.php';

class FollowbackResource implements Resource {

    private $FollowbackDAO;
    private $Followback;

    public function __construct() {
        $DAOFactory = new DAOFactory();
        $this -> FollowbackDAO = $DAOFactory -> getFollowbackWorkerDAO();
    }

    public function checkIfRequestMethodValid($requestMethod) {
        return in_array($requestMethod, array('get', 'put', 'post', 'delete', 'options'));
    }

    public function options() {    }

    
    public function delete ($resourceVals, $data, $FollowbackId) {    }

    public function put ($resourceVals, $data, $FollowbackId) {   
        lobal $logger, $warnings_payload;

        $FollowbackInfoObj = new Followback(
                                        $data["uid"], 
                                        $data["status"], 
                                        $data ['timestamp']
                                        );
        //$logger -> debug ("POSTed Followback Detail: " . $FollowbackInfoObj -> toString());

        
            $this -> FollowbackDAO -> insert($FollowbackInfoObj);

            $FollowbackDetail = $FollowbackInfoObj -> toArray();
            
            $this -> FollowbackDetail[] = $FollowbackDetail;
            return array ('code' => '6001', 
                            'data' => array(
                                'FollowbackDetail' => $this -> FollowbackDetail
                            )
            );
    }

    public function post ($resourceVals, $data, $FollowbackId) {
        global $logger, $warnings_payload;

        //$FollowbackInfoId = $resourceVals ['Followback'];
        //if (isset($FollowbackInfoId)) {
          //  $warnings_payload [] = 'POST call to /Followback must not have ' . 
            //                            '/Followback_ID appended i.e. POST /Followback';
           // throw new UnsupportedResourceMethodException();
        //}

        $FollowbackInfoObj = new Followback(
                                        $data["uid"], 
                                        $data["Followback"], 
                                        $data ['timestamp']
                                        );
        //$logger -> debug ("POSTed Followback Detail: " . $FollowbackInfoObj -> toString());

        
            $this -> FollowbackDAO -> insert($FollowbackInfoObj);

            $FollowbackDetail = $FollowbackInfoObj -> toArray();
            
            $this -> FollowbackDetail[] = $FollowbackDetail;
            return array ('code' => '6001', 
                            'data' => array(
                                'FollowbackDetail' => $this -> FollowbackDetail
                            )
            );
        
    }

    public function get($resourceVals, $data, $FollowbackId) {

        global $logger;
        $logger->debug('Fetch List of services Detail...');
        
        $serviceObjs = $this -> FollowbackDAO -> loadAll();
        $result = null;

        if(empty($serviceObjs)) 
                return array('code' => '6004');

         
        foreach ($serviceObjs as $key => $value) {

            $result [] = $value -> toArray();
        }

        $logger -> debug ('Fetched details: ' . json_encode($this -> result));


        return array('code' => '6000', 
                     'data' => array(
                                'services' => $result
                            )
            );

        return $result;
    }

    private function getFollowbackDetail($FollowbackId) {
    
        global $logger;
        $logger->debug('Fetch Followback Detail...');
        $FollowbackInfoObj = $this -> mobacDAO -> load($FollowbackId);

        if(empty($FollowbackInfoObj)) 
                return array('code' => '6004');        
             
        $this -> FollowbackDetail [] = $FollowbackInfoObj-> toArray();
        $logger -> debug ('Fetched details: ' . json_encode($this -> FollowbackDetail));

        return array('code' => '6000', 
                     'data' => array(
                                'Followback' => $this -> FollowbackDetail
                            )
            );
    }

}