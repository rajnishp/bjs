<?php

/**
 * @author anil
 */
require_once 'resources/Resource.interface.php';
require_once 'dao/DAOFactory.class.php';
require_once 'models/Feedback.class.php';
require_once 'exceptions/MissingParametersException.class.php';
require_once 'exceptions/UnsupportedResourceMethodException.class.php';

class FeedbackResource implements Resource {

    private $FeedbackDAO;
    private $Feedback;

    public function __construct() {
        $DAOFactory = new DAOFactory();
        $this -> feedbackDAO = $DAOFactory -> getFeedbackUserDAO();
    }

    public function checkIfRequestMethodValid($requestMethod) {
        return in_array($requestMethod, array('get', 'put', 'post', 'delete', 'options'));
    }

    public function options() {    }

    
    public function delete ($resourceVals, $data, $FeedbackId) {    }

    public function put ($resourceVals, $data, $FeedbackId) {    }

    public function post ($resourceVals, $data, $FeedbackId) {
        global $logger, $warnings_payload;

        //$FeedbackInfoId = $resourceVals ['Feedback'];
        //if (isset($FeedbackInfoId)) {
          //  $warnings_payload [] = 'POST call to /Feedback must not have ' . 
            //                            '/Feedback_ID appended i.e. POST /Feedback';
           // throw new UnsupportedResourceMethodException();
        //}

        $FeedbackInfoObj = new Feedback(
                                        $data["uid"], 
                                        $data["feedback"], 
                                        $data ['timestamp']
                                        );
        //$logger -> debug ("POSTed Feedback Detail: " . $FeedbackInfoObj -> toString());

        
            $this -> FeedbackDAO -> insert($FeedbackInfoObj);

            $FeedbackDetail = $FeedbackInfoObj -> toArray();
            
            $this -> FeedbackDetail[] = $FeedbackDetail;
            return array ('code' => '6001', 
                            'data' => array(
                                'FeedbackDetail' => $this -> FeedbackDetail
                            )
            );
        
    }

    public function get($resourceVals, $data, $FeedbackId) {

        global $logger;
        $logger->debug('Fetch List of services Detail...');
        
        $serviceObjs = $this -> FeedbackDAO -> loadAll();
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

    private function getFeedbackDetail($FeedbackId) {
    
        global $logger;
        $logger->debug('Fetch Feedback Detail...');
        $FeedbackInfoObj = $this -> mobacDAO -> load($FeedbackId);

        if(empty($FeedbackInfoObj)) 
                return array('code' => '6004');        
             
        $this -> FeedbackDetail [] = $FeedbackInfoObj-> toArray();
        $logger -> debug ('Fetched details: ' . json_encode($this -> FeedbackDetail));

        return array('code' => '6000', 
                     'data' => array(
                                'Feedback' => $this -> FeedbackDetail
                            )
            );
    }

}