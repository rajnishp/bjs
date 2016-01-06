<?php
	/**
	 * Object represents collection 'workers'
	 *
     	 * @author: anil
     	 * @date: 2015-12-12 10:50	 
	 */
	class Employee{
		
		private $firstName;
		private $lastName;
		private $age;
		private $currentAddress;
		private $permanentAddress;
		private $mobile;
		private $education;
		private $languages;
		private $birthDate;
		private $gender;
		private $email;
		private $username;
		private $password;
		private $employeeType;
		private $remarks;
		private $addressProofName;
		private $addressProofId;
		private $idProofName;
		private $idProofId;
		private $emergencyMobile;
		private $addedOn;
		private $lastUpdateOn;
		private $uuid;

		function __construct ($firstName, $lastName, $age, $currentAddress, $permanentAddress, $mobile, $education, $languages, 
							$birthDate,	$gender, $email, $username, $password, $employeeType, $remarks, $addressProofName, $addressProofId, 
							$idProofName, $idProofId, $emergencyMobile,  $addedOn, $lastUpdateOn, $uuid) {
			
			$this -> firstName = $firstName;
			$this -> lastName = $lastName;
			$this -> age = $age;
			$this -> currentAddress = $currentAddress;
			$this -> permanentAddress = $permanentAddress;
			$this -> mobile = $mobile;
			$this -> education = $education;
			$this -> languages = $languages;
			$this -> birthDate = $birthDate;
			$this -> gender = $gender;
			$this -> email = $email;
			$this -> username = $username;
			$this -> password = $password;
			$this -> employeeType = $employeeType;
			$this -> remarks = $remarks;
			$this -> addressProofName = $addressProofName;
			$this -> addressProofId = $addressProofId;
			$this -> idProofName = $idProofName;
			$this -> idProofId = $idProofId;
			$this -> emergencyMobile = $emergencyMobile;
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

		function setFirstName($firstName){
			$this -> first_name = $firstName;
		}
		function getFirstName(){
			return $this-> firstName;
		}

		function setLastName($lastName){
			$this -> last_name = $lastName;
		}
		function getLastName(){
			return $this-> lastName;
		}

		function setAddressProofName ($addressProofName){
			$this -> address_proof_name = $addressProofName;
		}
		function getAddressProofName(){
			return $this-> addressProofName;
		}

		function setAddressProofId($addressProofId){
			$this -> address_proof_id = $addressProofId;
		}
		function getAddressProofId(){
			return $this-> addressProofId;
		}

		function setIdProofName($idProofName){
			$this -> id_proof_name = $idProofName;
		}
		function getIdProofName(){
			return $this-> idProofName;
		}

		function setIdProofId($idProofId){
			$this -> id_proof_id = $idProofId;
		}
		function getIdProofId(){
			return $this-> idProofId;
		}

		function setAge($age){
			$this -> age = $age;
		}
		function getAge(){
			return $this-> age;
		}

		function setCurrentAddress($currentAddress){
			$this -> current_address = $currentAddress;
		}
		function getCurrentAddress(){
			return $this-> currentAddress;
		}

		function setPermanentAddress($permanentAddress){
			$this -> permanent_address = $permanentAddress;
		}
		function getPermanentAddress(){
			return $this-> permanentAddress;
		}

		function setMobile($mobile){
			$this -> mobile = $mobile;
		}
		function getMobile(){
			return $this-> mobile;
		}

		function setEmergencyMobile($emergencyMobile){
			$this -> emergency_mobile = $emergencyMobile;
		}
		function getEmergencyMobile(){
			return $this-> emergencyMobile;
		}

		function setEducation($education){
			$this -> education = $education;
		}
		function getEducation(){
			return $this-> education;
		}

		function setLanguages($languages){
			$this -> languages = $languages;
		}
		function getLanguages(){
			return $this-> languages;
		}

		function setBirthDate($birthDate){
			$this -> birth_date = $birthDate;
		}
		function getBirthDate(){
			return $this-> birthDate;
		}

		function setGender($gender){
			$this -> gender  = $gender;
		}
		function getGender(){
			return $this-> gender;
		}		

		function setEmail($email){
			$this -> email  = $email;
		}
		function getEmail(){
			return $this-> email;
		}

		function setUsername($username){
			$this -> username = $username;
		}
		function getUsername(){
			return $this-> username;
		}

		function setPassword($password){
			$this -> password = $password;
		}
		function getPassword(){
			return $this-> password;
		}

		function setEmployeeType($employeeType){
			$this -> employee_type = $employeeType;
		}
		function getEmployeeType(){
			return $this-> employeeType;
		}

		function setRemarks($remarks){
			$this -> remarks = $remarks;
		}
		function getRemarks(){
			return $this-> remarks;
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
		
		//timings, home_town, remarks, police
		function toArray() {
			return array (
							uuid => $this -> uuid,
							first_name => $this -> firstName,
							last_name=> $this -> lastName,
							address_proof_name => $this -> addressProofName,
							address_proof_id => $this -> addressProofId,
							id_proof_name => $this -> idProofName,
							id_proof_id => $this -> idProofId,
							cuurent_address => $this -> currentAddress,
							permanent_address => $this -> permanentAddress,
							username => $this -> username,
							password => $this -> password,
							employee_type => $this -> employeeType,
							age => $this -> age,
							mobile => $this -> mobile,
							birth_date => $this -> birthDate,
							emergency_mobile=> $this -> emergencyMobile,
							education => $this -> education,
							languages => $this-> languages,
							gender => $this -> gender,
							email => $this -> email,
							remarks => $this -> remarks,
							added_on => $this -> addedOn,
							last_updated => $this -> lastUpdateOn
						);
		}
	}
	?>