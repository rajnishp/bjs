<?php

//require_once 'dao/DAOFactory.class.php';
//require_once 'components/xxx.class.php';
//require_once '.class.php';

// this will be a single page app

abstract class BaseController {

	protected $baseUrl;
	protected $serviceRequestDAO;
	protected $getInTouchDAO;
	protected $blueteamContactNumber;
	protected $bookLink;


	function __construct (  ){
		
		global $configs;
		$this->baseUrl = $configs["BLUETEAM_BASE_URL"];
		
		$this->adminMembers = $configs["BLUETEAM_ADMIN_MEMBERS"];

		$this->blueteamContactNumber = $configs["BLUETEAM_CONTACT_NUMBER"];

		$this->url = rtrim($this->baseUrl,"/").$_SERVER[REQUEST_URI];

	/*	global $logger;
		$this -> logger = $logger;

		$this -> logger -> debug("BaseController started");
		*/

//		$DAOFactory = new DAOFactory();
		
//		$this -> serviceRequestDAO = $DAOFactory->getServiceRequestsDAO();
//		$this -> getInTouchDAO = $DAOFactory->getGetInTouchDAO();
		
		$this->process();

	}

	function process (){
		$this-> setBookLink();
	}

	function setBookLink(){
		$os = $this->getOS();
		//iPhone, iPod, Mobile, BlackBerry, Android, iPad
		if($os == "Android")
			$this-> bookLink = "href=\"//goo.gl/EGxeu3\"";

		else if($os == "iPhone" || $os == "iPod" || $os == "Mobile" || $os == "BlackBerry" || $os == "iPad" )
			$this-> bookLink = "href=\"//goo.gl/Ko19Gq\"";
		else
			$this-> bookLink = "href=\"//goo.gl/545wov\"";//"href=\"#\" data-target=\"#iframe\" data-toggle=\"modal\" ";
	}

	function getOS() {

	    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];

	    $os_platform    =   "Unknown OS Platform";
	    
	    $os_array       =   array(
	        '/windows nt 10/i'     =>  'Windows 10',
	        '/windows nt 6.3/i'     =>  'Windows 8.1',
	        '/windows nt 6.2/i'     =>  'Windows 8',
	        '/windows nt 6.1/i'     =>  'Windows 7',
	        '/windows nt 6.0/i'     =>  'Windows Vista',
	        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
	        '/windows nt 5.1/i'     =>  'Windows XP',
	        '/windows xp/i'         =>  'Windows XP',
	        '/windows nt 5.0/i'     =>  'Windows 2000',
	        '/windows me/i'         =>  'Windows ME',
	        '/win98/i'              =>  'Windows 98',
	        '/win95/i'              =>  'Windows 95',
	        '/win16/i'              =>  'Windows 3.11',
	        '/macintosh|mac os x/i' =>  'Mac OS X',
	        '/mac_powerpc/i'        =>  'Mac OS 9',
	        '/linux/i'              =>  'Linux',
	        '/ubuntu/i'             =>  'Ubuntu',
	        '/iphone/i'             =>  'iPhone',
	        '/ipod/i'               =>  'iPod',
	        '/ipad/i'               =>  'iPad',
	        '/android/i'            =>  'Android',
	        '/blackberry/i'         =>  'BlackBerry',
	        '/webos/i'              =>  'Mobile'
	    );

	    foreach ($os_array as $regex => $value) {

	        if (preg_match($regex, $user_agent)) {
	            $os_platform    =   $value;
	        }

	    }

	    return $os_platform;

	}


}

?>