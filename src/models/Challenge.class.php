<?php
	/**
	 * Object represents table 'challenges'
	 *
     	 * @author: rahullahoria
     	 * @date: 2015-03-03 14:48	 
	 */
require_once 'models/BaseModel.class.php';

	class Challenge extends BaseModel {
		
		private $id;
		private $userId;
		private $projectId;
		private $blobId;
		private $orgId;
		private $title;
		private $stmt;
		private $type;
		private $status;
		private $likes;
		private $dislikes;
		private $creationTime;
		private $lastUpdateTime;
		private $firstName;
		private $lastName;
		private $username;
		private $responses;


		function __construct( $userId, $projectId, $blobId, $orgId, $title, $stmt, $type, $status, $likes
		,$dislikes, $creationTime, $lastUpdateTime, $firstName, $lastName, $username, $id = null)
		{
			$this -> id = $id;
			$this -> userId= $userId;
			$this -> projectId = $projectId;
			$this -> blobId = $blobId;
			$this -> orgId = $orgId;
			$this -> title = $title;
			$this -> stmt = $stmt;
			$this -> type= $type;
			$this -> status = $status;
			$this -> likes = $likes;
			$this -> dislikes = $dislikes;
			$this -> creationTime = $creationTime;
			$this -> lastUpdateTime=$lastUpdateTime;
			$this -> firstName = $firstName;
			$this -> lastName = $lastName;
			$this -> username = $username;
		}
	
		function getRefinedStmt(){
			//repalace space tages
			$stmt = $this->replaceTags($this->stmt);
			
			if ($stmt[0] == "<"){

				$first=explode(' ', $stmt);
				$rest=ltrim($stmt, $first[0]);
				$stmt = $first[0] . " class=\"post-img img-responsive\" " . $rest; 
			}

			return $stmt;


		}

		function getKeywords(){
			return $this->extract_keywords($this->getRefinedTitle() ." ". $this->getRefinedStmt());
		}

		function getImage(){
			if (substr($this->stmt, 0, 4) == "<img")
				$temp = explode("\"", $this->stmt);
			else{
				global $configs; 
				return $configs["COLLAP_BASE_URL"]."static/img/collap.jpg";
				
			}
			return $temp[1];
		}

		private function replaceTags($req){

			return str_replace(
							"<s>", "&nbsp;", 
								str_replace("<r>", "'", 
										str_replace("<a>", "&",
											str_replace("<an>", "+", $req))));

		}

		function getRefinedTitle(){
			//repalace space tages
			$stmt = $this->replaceTags($this->title);
			
			if ($stmt[0] == "<"){

				$first=explode(' ', $stmt);
				$rest=ltrim($stmt, $first[0]);
				$stmt = $first[0] . " class=\"post-img img-responsive\" " . $rest; 
			}

			return $stmt;


		}

		function setId($id){
			$this -> id = $id;
		}
		function getId(){
			return $this-> id;
		}

		function setUserId($userId){
			$this -> userId = $userId;
		}
		function getUserId(){
			return $this-> userId;
		}
			
		function setProjectId($projectId){
			$this -> projectId = $projectId;
		}
		function getProjectId(){
			return $this-> projectId;
		}

		function setBlobId($blobId){
			$this -> blobId = $blobId;
		}
		function getBlobId(){
			return $this-> blobId;
		}
			
		function setTitle ($title) {
			$this -> title = $title;
		}
		function getTitle () {
			return $this -> title;
		}

		function setStmt($stmt){
			$this -> stmt = $stmt;
		}
		function getStmt(){
				return $this-> stmt;
		}
		function setLikes($likes){
			$this -> likes = $likes;
		}
		function getLikes(){
				return $this-> likes;
		}

		function setDislikes($dislikes){
			$this -> dislikes = $dislikes;
		}
		function getDislikes(){
				return $this-> dislikes;
		}
			
		function setStatus($status){
			$this -> status = $status;
		}
		function getStatus(){
			return $this-> status;
		}
		
		function setCreationTime($creationTime){
			$this -> creationTime = $creationTime;
		}
		function getCreationTime(){
			return $this-> creationTime;
		}
				
		function setOrgId($orgId){
			$this -> orgId =$orgId;
		}
		function getOrgId(){
			return $this-> orgId;
		}
		
		function setLastUpdateTime($lastUpdateTime){
			$this -> lastUpdateTime = $lastUpdateTime;
		}
		function getLastUpdateTime(){
				return $this-> lastUpdateTime;
		}

		function setType($type){
			$this -> type= $type;
		}
		function getType(){
			return $this-> type;		
		}

		function setFirstName($firstName){
			$this -> firstName = $firstName;
		}
		function getFirstName(){
			return $this-> firstName;
		}
		
		function setLastName($lastName){
			$this -> lastName = $lastName;
		}
		function getLastName(){
				return $this->lastName;
		}

		function setUsername($username){
			$this -> username = $username;
		}
		function getUsername(){
				return $this-> username;
		}

		function setResponses($responses){
			$this -> responses= $responses;
		}
		function getResponses(){
			return $this-> responses;		
		}

		function toString (){
			return $this -> id . ", " . 
					$this -> userId.",".
					$this -> projectId.",".
					$this -> blobId.",".
					$this -> orgId.",".
					$this -> title . ", " . 
					$this -> likes.",".
					$this -> dislikes.",".
					$this -> status.".".
					$this -> creationTime. ", " . 
					$this -> stmt.",".
					$this -> lastUpdateTime.",".
					$this -> type.",".
					$this -> firstName.",".
					$this -> lastName.",".
					$this -> userName;
		}

		function toArray() {
			return array (			
							id => $this-> id,
							userId => $this-> userId,
							projectId => $this-> projectId,
							blobId => $this-> blobId,
							orgId => $this-> orgId,
							title => $this-> title,
							stmt => $this-> stmt,
							type => $this-> type,
							status => $this-> status,
							likes => $this-> likes,
							dislikes => $this-> dislikes,
							creationTime => $this-> creationTime,
							lastUpdateTime => $this-> lastUpdateTime
						);
		}

		function toArrayUserChallenges() {
			return array (			
							id => $this-> id,
							projectId => $this-> projectId,
							title => $this-> title,
							stmt => $this-> stmt,
							type => $this-> type,
							status => $this-> status,
							likes => $this-> likes,
							dislikes => $this-> dislikes,
							creationTime => $this-> creationTime,
							firstName => $this-> firstName,
							lastName => $this-> lastName,
							userName => $this-> userName
						);
		}

		function toArrayTeamDashboard() {
			return array (			
							id => $this-> id,
							title => $this-> title,
							type => $this-> type,
							status => $this-> status,
							creationTime => $this-> creationTime,
							firstName => $this-> firstName,
							lastName => $this-> lastName,
							userName => $this-> userName
						);
		}		
	}
?>
