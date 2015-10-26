<?php

require_once 'dao/DAOFactory.class.php';
//require_once 'components/xxx.class.php';
//require_once '.class.php';

// this will be a single page app

abstract class BaseController {

	protected $baseUrl;
	protected $serviceRequestDAO;
	protected $getInTouchDAO;
	protected $blueteamContactNumber;


	function __construct (  ){
		
		global $configs;
		$this->baseUrl = $configs["BLUETEAM_BASE_URL"];
		
		$this->adminMembers = $configs["BLUETEAM_ADMIN_MEMBERS"];

		$this->blueteamContactNumber = $configs["BLUETEAM_CONTACT_NUMBER"];

		$this->url = rtrim($this->baseUrl,"/").$_SERVER[REQUEST_URI];

		global $logger;
		$this -> logger = $logger;

		$this -> logger -> debug("BaseController started");
		

		$DAOFactory = new DAOFactory();
		
		$this -> serviceRequestDAO = $DAOFactory->getServiceRequestDAO();
		$this -> getInTouchDAO = $DAOFactory->getGetInTouchDAO();
		
		$this->process();

	}

	function process (){

	}

}

?>