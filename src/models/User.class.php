<?php																																																																																																																																																																																																																																																																																																																																				
	/**
	 * Object represents collection 'users'
	 *
     	 * @author: rahul
     	 * @date: 2015-25-10 12:40	 
	 */
	class User{
		
		private $uid;
		private $name;
		private $mobile;
		private $email;
		private $address;
		private $gpsLocation;
		private $addedOn;
		private $lastUpdateOn;

		function __construct ($name, $mobile, $email, $address, $gpsLocation, $addedOn, $lastUpdateOn, $uid = null) {
			
			$this -> uid = $uid;
			$this -> name = $name;
			$this -> mobile = $mobile;
			$this -> email = $email;
			$this -> address = $address;
			$this -> gps_location = $gpsLocation;
			$this -> added_on = $addedOn;
			$this -> last_updated = $lastUpdateOn;

		}

		function setUid($uid){
			$this -> uid = $uid;
		}
		function getUid(){
			return $this-> uid;
		}

		function setName($name){
			$this -> name = $name;
		}
		function getName(){
			return $this-> name;
		}

		function setMobile($mobile){
			$this -> mobile = $mobile;
		}
		function getMobile(){
			return $this-> mobile;
		}

		function setEmail($email){
			$this -> email = $email;
		}
		function getEmail(){
			return $this-> email;
		}

		function setAddress($address){
			$this -> address = $address;
		}
		function getAddress(){
			return $this-> address;
		}

		function setGpsLocation($gpsLocation){
			$this -> gps_location = $gpsLocation;
		}
		function getGpsLocation(){
			return $this-> gpsLocation;
		}

		function setAddedOn($addedOn){
			$this -> added_on = $addedOn;
		}
		function getAddedOn(){
			return $this-> addedOn;
		}

		function setLastUpdateOn($lastUpdateOn){
			$this -> last_updated = $lastUpdateOn;
		}
		function getLastUpdateOn(){
			return $this-> lastUpdateOn;
		}

		function toArray() {
			return array (
							name => $this -> name,
							mobile=> $this -> mobile,
							email=> $this -> email,
							address => $this -> address,
							gps_location=> $this -> gpsLocation,
							added_on => $this -> addedOn,									
							last_updated => $this -> lastUpdated									
						);
		}

	}
?>