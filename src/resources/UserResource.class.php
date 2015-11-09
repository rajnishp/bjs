<?php

/**
 * @author rajnish
 */
require_once 'resources/Resource.interface.php';
require_once 'dao/DAOFactory.class.php';
require_once 'models/User.class.php';
require_once 'exceptions/MissingParametersException.class.php';
require_once 'exceptions/UnsupportedResourceMethodException.class.php';

class UserResource implements Resource {

    private $userDAO;
    private $user;

    public function __construct() {
		$DAOFactory = new DAOFactory();
		$this -> userDAO = $DAOFactory -> getUsersDAO();
    }

    public function checkIfRequestMethodValid($requestMethod) {
		return in_array($requestMethod, array('get', 'put', 'post', 'delete', 'options'));
    }

    public function options() {    }

    
    public function delete ($resourceVals, $data, $userId) {    }

    public function put ($resourceVals, $data, $userId) {    }

    public function post ($resourceVals, $data, $userId) {
        global $logger, $warnings_payload;

        $UserInfoId = $resourceVals ['user'];
        if (isset($UserInfoId)) {
            $warnings_payload [] = 'POST call to /user must not have ' . 
                                        '/user_ID appended i.e. POST /user';
            throw new UnsupportedResourceMethodException();
        }

        $userInfoObj = new User($data ['name'], $data ['mobile'], $data ['email'], $data ['gpslocation']);
        //$logger -> debug ("POSTed User Detail: " . $userInfoObj -> toString());

        
            $this -> userDAO -> insert($userInfoObj);

            $userDetail = $userInfoObj -> toArray();
            
            $this -> userDetail[] = $userDetail;
            return array ('code' => '6001', 
                            'data' => array(
                                'userDetail' => $this -> userDetail
                            )
            );
        
    }

    public function get($resourceVals, $data, $userId) {

        //$userId = 1;

        $UserInfoId = $resourceVals ['user'];
        if (isset($UserInfoId))
            return array('code' => '6004');
            //$result = $this->getUserDetail($userId);
            
        else
            $result = $this -> getUserDetail($userId);
        
        if (!is_array($result)) {
            return array('code' => '6004');
        }

        return $result;
    }

    private function getUserDetail($userId) {
    
        global $logger;
        $logger->debug('Fetch User Detail...');
        $userInfoObj = $this -> mobacDAO -> load($userId);

        if(empty($userInfoObj)) 
                return array('code' => '6004');        
             
        $this -> userDetail [] = $userInfoObj-> toArray();
        $logger -> debug ('Fetched details: ' . json_encode($this -> userDetail));

        return array('code' => '6000', 
                     'data' => array(
                                'user' => $this -> userDetail
                            )
            );
    }

}