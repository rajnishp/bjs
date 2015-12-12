<?php
	/**
	 * Object represents collection 'service_requests'
	 *
     	 * @author: rajnish
     	 * @date: 2015-09-08 12:40	 
	 */
	class ServiceRequest{
		
		private $uid;
		private $name;
		private $mobile;
		private $address;
		private $service;
		private $type;
		private $salaryCriteria;

		private $workingHour;
		private $requirements ;
		
		private $status;
		private $addedOn;
		private $lastUpdateOn;

		function __construct ($name, $mobile, $address, $service, $type, $salaryCriteria, $requirements, $workingHour, $status, $addedOn, $lastUpdateOn, $uid = null) {
			
			$this -> uid = $uid;
			$this -> name = $name;
			$this -> mobile = $mobile;
			$this -> address = $address;
			$this -> service = $service;
			$this -> type = $type;
			$this -> salary_criteria = $salaryCriteria;
			$this -> requirements = $requirements;
			$this -> working_hour = $workingHour;
			$this -> status = $status;
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

		function setAddress($address){
			$this -> address = $address;
		}
		function getAddress(){
			return $this-> address;
		}

		function setService($service){
			$this -> service = $service;
		}
		function getService(){
			return $this-> service;
		}

		function setType($type){
			$this -> type = $type;
		}
		function getType(){
			return $this-> type;
		}

		function setSalaryCriteria($salaryCriteria){
			$this -> salary_criteria = $salaryCriteria;
		}
		function getSalaryCriteria(){
			return $this-> salaryCriteria;
		}

		function setRequirements($requirements){
			$this -> requirements = $requirements;
		}
		function getRequirements(){
			return $this-> requirements;
		}
		
		function setWorkingHour($workingHour){
			$this -> working_hour = $workingHour;
		}
		function getWorkingHour(){
			return $this-> workingHour;
		}

		function setStatus($status){
			$this -> status = $status;
		}
		function getStatus(){
			return $this-> status;
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
							uid => $this -> uid,
							name => $this -> name,
							mobile=> $this -> mobile,
							address => $this -> address,
							service => $this -> service,
							type => $this -> type,
							salary_criteria => $this -> salaryCriteria,
							requirements => $this -> requirements,
							working_hour => $this -> workingHour,
							status => $this -> status,
							added_on => $this -> addedOn,									
							last_updated => $this -> lastUpdateOn									
						);
		}

	}
?>