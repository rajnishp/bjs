<?php

require_once 'controllers/BaseController.class.php';
require_once 'controllers/EmailController.class.php';

class HomeController extends BaseController {

	function __construct (  ){
		
		parent::__construct();

		/*$this -> logger -> debug("HomeController started");*/

	}

	function render (){
		$baseUrl = $this->baseUrl;
		$blueteamContactNumber = $this->blueteamContactNumber;
		// here its shower that user is not in session
		 
		try{

			require_once 'views/landing/index.php';

		} catch (Exception $e) {

			//require_once 'views/error/pages-404.php';	
			/*$this->logger->error( "Error occur :500 ".json_encode($e) );*/
		}

	}


	function serviceRequest (){
/*		if (isset($_POST['name'],$_POST['email'],$_POST['mobile'],$_POST['needed'],$_POST['timing'], $_POST['timing2'],$_POST['address'],
					 $_POST['salary'], $_POST['salary2'],$_POST['remarks'], $_POST['type'])) {
			$time11 = explode(":", $_POST['timing']);
			$time22 = explode(":", $_POST['timing2']);
			if($time11[0] < 12) $time1 = $timing." am";
			else {
				if($time11[0] == 12) $time1 = $timing." pm";
				else $time1 = ($time11[0]-12).":".$time11[1]." pm";
			}
			if($time22[0] < 12) $time2 = $timing2." am";
			else {
				if($time22[0] == 12) $time2 = $timing2." pm";
				else $time2 = ($time22[0]-12).":".$time22[1]." pm";
			}
			$newtime = $time1."-".$time2;
			$created_time = Date("Y-m-d");
			$name = $_POST['name'];
			$mobile = $_POST['mobile'];
			$email = $_POST['email'];
			$type = $_POST['type'];
			$salary = $_POST['salary'];
			$salary2 = $_POST['salary2'];
			$address = $_POST['address'];
			$remarks = $_POST['remarks'];
			$need = $_POST['needed'];
			$db_handle = mysqli_connect("localhost","root","redhat@11111p","bluenet_v0");
			mysqli_query ($db_handle, "INSERT INTO service_request (name, mobile, email, requirements, timings, needed_from, 
										min_salary, max_salary, address, remarks, status, created_time)
									VALUES ('$name', '$mobile', '$email', '$type', '$newtime', '$need', '$salary', 											'$salary2', '$address', '$remarks', 'open', '$created_time');");

			$serviceRequestObj = new ServiceRequest (
													$_POST['name'],
													$_POST['mobile'],
													$_POST['address'],
													$_POST['type'],
													$_POST['remarks'],
													null,
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
		}*/
	}

	function getInTouch (){
/*		if (isset($_POST['contactname'], $_POST['contactemail'], $_POST['contactsubject'], $_POST['contactmessage'])) {

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
		}*/
	}

}

?>
