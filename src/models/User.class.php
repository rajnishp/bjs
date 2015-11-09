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
		private $gpsLocation;
		private $addedOn;
		private $lastUpdateOn;

		function __construct ($name, $mobile, $email, $gpsLocation, $addedOn, $lastUpdateOn, $uid = null) {
			
			$this -> uid = $uid;
			$this -> name = $name;
			$this -> mobile = $mobile;
			$this -> email = $email;
			$this -> gpsLocation = $gpsLocation;
			$this -> addedOn = $addedOn;
			$this -> lastUpdateOn = $lastUpdateOn;

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
		function setGpsLocation($gpsLocation){
			$this -> gpsLocation = $gpsLocation;
		}
		function getGpsLocation(){
			return $this-> gpsLocation;
		}

		function setAddedOn($addedOn){
			$this -> addedOn = $addedOn;
		}
		function getAddedOn(){
			return $this-> addedOn;
		}

		function setLastUpdateOn($lastUpdateOn){
			$this -> lastUpdateOn = $lastUpdateOn;
		}
		function getLastUpdateOn(){
			return $this-> lastUpdateOn;
		}

		function toArray() {
			return array (
							name => $this -> name,
							mobile=> $this -> mobile,
							email=> $this -> email,
							gpsLocaiton=> $this -> gpsLocaiton,
							addedOn => $this -> addedOn									
						);
		}

	}
?>