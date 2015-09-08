<?php
	/**
	 * Object represents collection 'service_requests'
	 *
     	 * @author: rajnish
     	 * @date: 2015-09-08 12:40	 
	 */
	class ServiceRequests{
		
		private $uid;
		private $name;
		private $mobile;
		private $address;
		private $status;
		private $addedOn;
		private $lastUpdateOn;

		function __construct ($name, $mobile, $address, $status, $addedOn, $lastUpdateOn, $uid = null) {
			
			$this -> uid = $uid;
			$this -> name = $name;
			$this -> mobile = $mobile;
			$this -> address = $address;
			$this -> status = $status;
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

		function setStatus($status){
			$this -> status = $status;
		}
		function getStatus(){
			return $this-> status;
		}

		function setAddress($address){
			$this -> address = $address;
		}
		function getAddress(){
			return $this-> address;
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
		
	}
?>