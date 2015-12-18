<?php
	/**
	 * Object represents collection 'users'
	 *
     	 * @author: anil
     	 * @date: 2015-17-12 12:40	 
	 */
	class Feedback{
		
		private $uuid;
		private $feedback;
		private $name;
		private $mobile;
		private $address;
		private $date;

		function __construct ($feedback, $name, $mobile, $address, $date, $uuid = null) {
			
			$this -> uuid = $uuid;
			$this -> name = $name;
			$this -> mobile = $mobile;
			$this -> address = $address;
			$this -> feedback = $feedback;
			$this -> date = $date;
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
		function setFeedback($feedback){
			$this -> feedback = $feedback;
		}
		function getFeedback(){
			return $this-> feedback;
		}

		function setDate($date){
			$this -> date = $date;
		}
		function getDate(){
			return $this-> date;
		}

		function toArray() {
			return array (
							name => $this -> name,
							mobile=> $this -> mobile,
							address=> $this -> address,
							feedback => $this -> feedback,
							date => $this -> date
						);
		}	

	}
?>