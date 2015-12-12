<?php
	/**
	 * Object represents collection 'users'
	 *
     	 * @author: rahul
     	 * @date: 2015-25-10 12:40	 
	 */
	class Service{
		
		private $uuid;
		private $name;
		private $img;
		private $status;
		private $plans;
		private $addedOn;
		private $lastUpdateOn;

		function __construct ($name, $img, $status, $plans, $addedOn, $lastUpdateOn, $uuid = null) {
			
			$this -> uuid = $uuid;
			$this -> name = $name;
			$this -> plans = $plans;
			$this -> img = $img;
			$this -> status = $status;
			$this -> added_on = $addedOn;
			$this -> last_updated = $lastUpdateOn;

		}

		function setUuid($uid){
			$this -> uid = $uid;
		}
		function getUuid(){
			return $this-> uid;
		}

		function setName($name){
			$this -> name = $name;
		}
		function getName(){
			return $this-> name;
		}

		function setPlans($plans){
			$this -> plans = $plans;
		}
		function getPlans(){
			return $this-> plans;
		}

		function setImg($img){
			$this -> img = $img;
		}
		function getImg(){
			return $this-> img;
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
							name => $this -> name,
							img=> $this -> img,
							status=> $this -> status,
							plans => $this -> plans,
							addedon => $this -> addedOn,
							last_updated => $this -> lastUpdateOn

						);
		}	

	}
?>