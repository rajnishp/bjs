<?php
	/**
	 * Object represents collection 'users'
	 *
     	 * @author: anil
     	 * @date: 2015-17-12 12:40	 
	 */
	class Followback{
		
		private $uuid;
		private $status;
		private $name;
		private $mobile;
		private $address;
		private $date;

		function __construct ($status, $name, $mobile, $address, $date, $uuid = null) {
			
			$this -> uuid = $uuid;
			$this -> name = $name;
			$this -> mobile = $mobile;
			$this -> address = $address;
			$this -> status = $status;
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
		function setStatus($status){
			$this -> status = $status;
		}
		function getStatus(){
			return $this-> status;
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
							status => $this -> status,
							date => $this -> date
						);
		}	

	}
?>