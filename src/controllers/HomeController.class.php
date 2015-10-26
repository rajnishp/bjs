<?php

require_once 'controllers/BaseController.class.php';
require_once 'controllers/EmailController.class.php';

class HomeController extends BaseController {

	function __construct (  ){
		
		parent::__construct();

		$this -> logger -> debug("HomeController started");

	}

	function render (){
		$baseUrl = $this->baseUrl;
		$blueteamContactNumber = $this->blueteamContactNumber;
		// here its shower that user is not in session
		 
		try{

			require_once 'views/landing/index.php';

		} catch (Exception $e) {

			//require_once 'views/error/pages-404.php';	
			$this->logger->error( "Error occur :500 ".json_encode($e) );
		}

	}


	function serviceRequest (){
		if (isset($_POST['name'], $_POST['mobile'], $_POST['address'], $_POST['type'])) {

			$serviceRequestObj = new ServiceRequests (
													$_POST['name'],
													$_POST['mobile'],
													$_POST['address'],
													$_POST['type'],
													1,
													date("Y-m-d H:i:s"),
													0
												);
			try {
				$this -> serviceRequestDAO -> insert($serviceRequestObj);
			}
			catch (Exception $e){
				$this->logger->error( "Error occur :500 ".json_encode($e) );
			}
			echo "Your request submitted successfuly";

			$adminMembers = explode(',', $this-> adminMembers);
			
			$subject = "Service Request for <b>". $_POST['type']. "</b> on Blueteam";
			$body = "<b>". $_POST['name']. "</b> have requested you a service for " .$_POST['type'] . "<br/><br/>
									Name: ". $_POST['name'] . ", <br/>
									Mobile Number: ". $_POST['mobile'] ."<br/>
									Address: ". $_POST['address'] . "<br/> Kindly process the request.";

			foreach ($adminMembers as $key => $member) {

				EmailController :: sendMail( $member, $subject, $body);

			}

		}
		else{
			header('HTTP/1.1 500 Internal Server Error');
			echo "Failed to submit request";
			die();
			//header('Location: '.$this-> baseUrl);
			//base url redirected for any error occurred
		}
	}

	function getInTouch (){
		if (isset($_POST['contactname'], $_POST['contactemail'], $_POST['contactsubject'], $_POST['contactmessage'])) {

			$getInTouchObj = new GetInTouch (
													$_POST['contactname'],
													$_POST['contactemail'],
													$_POST['contactsubject'],
													$_POST['contactmessage'],
													"not_checked",
													date("Y-m-d H:i:s")
												);
			try {
				$this -> getInTouchDAO -> insert($getInTouchObj);
			}
			catch (Exception $e){
				$this->logger->error( "Error occur :500 ".json_encode($e) );
			}
			echo "Your request submitted successfuly";
		}
		else{
			header('HTTP/1.1 500 Internal Server Error');
			echo "Failed to submit request";
			die();
			//header('Location: '.$this-> baseUrl);
			//base url redirected for any error occurred
		}
	}

}

?>