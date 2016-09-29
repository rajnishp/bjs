<?php
	/**
	 * Object represents collection 'service_requests'
	 *
     	 * @author: anil
     	 * @date: 2015-18-12 12:40	 
	 */
	class ServiceRequest{
		
		private $name;
		private $mobile;
		private $address;
		private $service;
		private $type;
		private $salaryCriteria;
		private $workingHour;
		private $requirements ;
		private $remarks ;
		private $status;
		private $addedOn;
		private $lastUpdateOn;
		private $uuid;

		function __construct ($name, $mobile, $address, $service, $type, $salaryCriteria, $requirements, $remarks,
								$workingHour, $status, $addedOn, $lastUpdateOn, $uuid) {
			
			$this -> name = $name;
			$this -> mobile = $mobile;
			$this -> address = $address;
			$this -> service = $service;
			$this -> type = $type;
			$this -> salaryCriteria = $salaryCriteria;
			$this -> requirements = $requirements;
			$this -> remarks = $remarks;
			$this -> workingHour = $workingHour;
			$this -> status = $status;
			$this -> addedOn = $addedOn;
			$this -> lastUpdateOn = $lastUpdateOn;
			$this -> uuid = $uuid;

		}

		function setUuid($uuid){
			$this -> uuid = $uuid;
		}
		function getUuid(){
			return $this-> uuid;
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
		
		function setRemarks($remarks){
			$this -> remarks = $remarks;
		}
		function getRemarks(){
			return $this-> remarks;
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
							uuid => $this -> uuid,
							name => $this -> name,
							mobile=> $this -> mobile,
							address => $this -> address,
							service => $this -> service,
							type => $this -> type,
							salary_criteria => $this -> salaryCriteria,
							requirements => $this -> requirements,
							remarks => $this -> remarks,
							working_hour => $this -> workingHour,
							status => $this -> status,
							added_on => $this -> addedOn,									
							last_updated => $this -> lastUpdateOn								
																
						);
		}

	}
?>