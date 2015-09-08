<?php
session_start();

// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 728000);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(728000);



include_once "controllers/HomeController.class.php";


require_once 'utils/Util.php';
require_once 'utils/Timer.php';
require_once 'utils/ShopbookLogger.php';
require_once 'cache/AppCacheRegistry.class.php';

/*

type
1.		Landing Page

2. 		Search Page *****
..................................
admin.blueteam.com

operate.blueteam.com

*/

/* Setting up the app-configurations globally for use across classes */
global $configs;
$configs = json_decode (file_get_contents('blueteam-configs.json'), true);

/* Setting up the logger globally for use across classes */
global $logger;
$logger = new ShopbookLogger();
$logger -> enabled = true;
$logger -> debug ("Setting up ...");




$route = explode("/",$_SERVER[REQUEST_URI]);

//router hack for uploads
if(in_array('uploads', $route)){
	$redir = $configs['BLUETEAM_BASE_URL'];
	$flag = false;

	foreach ($route as $key => $value) {
		if($value == 'uploads')
			$flag = true;
		if($flag)
			$redir .= $value."/";
	}
	//rtrim($redir, "\/");
	header("location:".substr($redir,0,-1));
}

//router uploads hack end
$logger -> debug ("router :: " .json_encode($route));

$logger -> debug ("post :: " .json_encode($_POST));

$logger -> debug ("get :: " .json_encode($_GET));


		$page = $route[1];
		//single page app
		switch ($page) {


			case "fileUpload":
				require_once "controllers/FilesController.class.php";
					
				break;


			case "home":
				$homeController = new HomeController();
				$where = $route[2];

				switch ($where) {

					case 'serviceRequest':
						$homeController ->  serviceRequest();
						break;
					
					default:
						$homeController -> render ();
						break;
				}

				break;
				

			default:

				//langing page of blueteam
				// Can also be routed to 404 page
				$homeController = new HomeController();
				$homeController -> render ();

				break;

		}

?>