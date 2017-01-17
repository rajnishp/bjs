<?php

require_once 'controllers/BaseController.class.php';
require_once 'controllers/EmailController.class.php';

class AboutUsController extends BaseController {

	function __construct (  ){
		
		parent::__construct();

		/*$this -> logger -> debug("TestimonailController started");*/

	}

	function render (){
		$baseUrl = $this->baseUrl;
		$blueteamContactNumber = $this->blueteamContactNumber;
		// here its shower that user is not in session
		 
		try{

			require_once 'views/about/about-us.php';

		} catch (Exception $e) {

			//require_once 'views/error/pages-404.php';	
			/*$this->logger->error( "Error occur :500 ".json_encode($e) );*/
		}

	}
}
?>