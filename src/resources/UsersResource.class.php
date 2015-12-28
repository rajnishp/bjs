<?php

/**
 * @author anil
 */
require_once 'resources/Resource.interface.php';
require_once 'dao/DAOFactory.class.php';
require_once 'models/User.class.php';
require_once 'exceptions/MissingParametersException.class.php';
require_once 'exceptions/UnsupportedResourceMethodException.class.php';

class UsersResource implements Resource {

    private $usersDAO;
    private $user;

    public function __construct() {
		$DAOFactory = new DAOFactory();
		$this -> usersDAO = $DAOFactory -> getUsersDAO();
    }

    public function checkIfRequestMethodValid($requestMethod) {
		return in_array($requestMethod, array('get', 'put', 'post', 'delete', 'options'));
    }

    public function options() {    }

    
    public function delete ($resourceVals, $data, $userId) {    }

    public function put ($resourceVals, $data, $userId) {    }

    public function post ($resourceVals, $data, $userId) {
        global $logger, $warnings_payload;

        $UserInfoId = $resourceVals ['users'];
        if (isset($UserInfoId)) {
            $warnings_payload [] = 'POST call to /user must not have ' . 
                                        '/user_ID appended i.e. POST /user';
            throw new UnsupportedResourceMethodException();
        }

        $userInfoObj = new User (
                                $data ['name'], 
                                $data ['mobile'], 
                                $data ['email'], 
                                $data ['address'], 
                                $data ['gpsLocation'],
                                date("Y-m-d H:i:s"),
                                date("Y-m-d H:i:s")
                                );
        //$logger -> debug ("POSTed User Detail: " . $userInfoObj -> toString());

        
            $this -> usersDAO -> insert($userInfoObj);

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

        $UserInfoId = $resourceVals ['users'];
        if (isset($UserInfoId))
            $result = $this -> getUserDetail($userId);
            //$result = $this->getUserDetail($userId);
            
        else
            $result = $this -> getAllUsers();
        
        if (!is_array($result)) {
            return array('code' => '6004');
        }

        return array('code' => '6000', 
                     'data' => $result
            );
    }

    private function getUserDetail($userId) {
    
        global $logger;
        $logger->debug('Fetch User Detail...');
        $userInfoObj = $this -> usersDAO -> load($userId);

        $this -> userDetail [] = $userInfoObj-> toArray();
        $logger -> debug ('Fetched details: ' . json_encode($this -> userDetail));

        return $this -> userDetail;
    }

    private function getAllUsers() {
    
        global $logger;
        $usersArray = null;
        $logger->debug('Fetch User Detail...');
        $userInfoObjs = $this -> usersDAO -> loadAll();

              
        foreach ($userInfoObjs as $key => $userInfoObj) {
                  $usersArray [] = $userInfoObj-> toArray();
             }     
       
        $logger -> debug ('Fetched details: ' . json_encode($this -> userDetail));

        return $usersArray;
    }

}