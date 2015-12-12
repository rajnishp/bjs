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
			$this -> contact_name = $contactName;
			$this -> contact_email = $contactEmail;
			$this -> contact_subject = $contactSubject;
			$this -> contact_message = $contactMessage;
			$this -> status = $status;
			$this -> added_on = $addedOn;
		}

		function setUuid($uuid){
			$this -> uuid = $uuid;
		}
		function getUuid(){
			return $this-> uuid;
		}

		function setContactName($contactName){
			$this -> contact_name = $contactName;
		}
		function getContactName(){
			return $this-> contactName;
		}

		function setContactEmail($contactEmail){
			$this -> contact_email = $contactEmail;
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
			$this -> contact_subject = $contactSubject;
		}
		function getContactSubject(){
			return $this-> contactSubject;
		}


		function setAddedOn($addedOn){
			$this -> added_on = $addedOn;
		}
		function getAddedOn(){
			return $this-> addedOn;
		}

		function setContactMessage($contactMessage){
			$this -> contact_message = $contactMessage;
		}
		function getContactMessage(){
			return $this-> contactMessage;
		}

		function toArray() {
			return array (
							contact_name => $this -> contactName,
							contact_email=> $this -> contactEmail,
							contact_subject => $this -> contactSubject,
							contact_message => $this -> contactMessage,
							status => $this -> status,
							added_on => $this -> addedOn							
						);
		}

	}
?>