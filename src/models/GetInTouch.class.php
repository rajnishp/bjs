<?php
	/**
	 * Object represents collection 'service_requests'
	 *
     	 * @author: rajnish
     	 * @date: 2015-09-08 12:40	 
	 */
	class GetInTouch{
		
		private $uuid;
		private $contactName;
		private $contactEmail;
		private $contactSubject;
		private $contactMessage;
		private $status;
		private $addedOn;

		function __construct ($contactName, $contactEmail, $contactSubject, $contactMessage, $status, $addedOn, $uuid = null) {
			
			$this -> uuid = $uuid;
			$this -> contactName = $contactName;
			$this -> contactEmail = $contactEmail;
			$this -> contactSubject = $contactSubject;
			$this -> contactMessage = $contactMessage;
			$this -> status = $status;
			$this -> addedOn = $addedOn;
		}

		function setUuid($uuid){
			$this -> uuid = $uuid;
		}
		function getUuid(){
			return $this-> uuid;
		}

		function setContactName($contactName){
			$this -> contactName = $contactName;
		}
		function getContactName(){
			return $this-> contactName;
		}

		function setContactEmail($contactEmail){
			$this -> contactEmail = $contactEmail;
		}
		function getContactEmail(){
			return $this-> contactEmail;
		}

		function setStatus($status){
			$this -> status = $status;
		}
		function getStatus(){
			return $this-> status;
		}

		function setContactSubject($contactSubject){
			$this -> contactSubject = $contactSubject;
		}
		function getContactSubject(){
			return $this-> contactSubject;
		}


		function setAddedOn($addedOn){
			$this -> addedOn = $addedOn;
		}
		function getAddedOn(){
			return $this-> addedOn;
		}

		function setContactMessage($contactMessage){
			$this -> contactMessage = $contactMessage;
		}
		function getContactMessage(){
			return $this-> contactMessage;
		}

		function toArray() {
			return array (
							contactName => $this -> contactName,
							contactEmail=> $this -> contactEmail,
							contactSubject => $this -> contactSubject,
							contactMessage => $this -> contactMessage,
							status => $this -> status,
							addedOn => $this -> addedOn							
						);
		}

	}
?>