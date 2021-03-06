<?php
	/**
	 * Object represents collection 'workers'
	 *
     	 * @author: anil
     	 * @date: 2015-17-12 22:40	 
	 */
	class Worker{
		
		private $firstName;
		private $lastName;
		private $age;
		private $currentAddress;
		private $permanentAddress;
		private $mobile;
		private $gender;
		private $education;
		private $languages;
		private $skills;
		private $experience;
		private $guessedSalary;
		private $remarks;
		private $police;
		private $birthDate;
		private $workingDomain;
		private $currentWorkingCity;
		private $currentWorkingArea;
		private $preferredWorkingCity;
		private $preferredWorkingArea;
		private $workTimeSlots;
		private $freeTimeSlots;
		private $emergencyMobile;
		private $addressProofName;
		private $addressProofId;
		private $idProofName;
		private $idProofId;
		private $agentId;
		private $addedOn;
		private $lastUpdateOn;
		private $uuid;

		function __construct ($firstName, $lastName, $age, $currentAddress, $permanentAddress, $mobile, $gender, $education, $languages,
								$skills, $experience, $guessedSalary, $remarks, $police, $birthDate, $workingDomain, $currentWorkingCity,
								$currentWorkingArea, $preferredWorkingCity, $preferredWorkingArea, $workTimeSlots, $freeTimeSlots,
								$emergencyMobile, $addressProofName, $addressProofId, $idProofName, $idProofId, $agentId, $addedOn,
								$lastUpdateOn, $uuid) {
			
			$this -> firstName = $firstName;
			$this -> lastName = $lastName;
			$this -> age = $age;
			$this -> currentAddress = $currentAddress;
			$this -> permanentAddress = $permanentAddress;
			$this -> mobile = $mobile;
			$this -> gender = $gender;
			$this -> education = $education;
			$this -> languages = $languages;
			$this -> skills = $skills;
			$this -> mobile = $mobile;
			$this -> experience = $experience;
			$this -> guessedSalary = $guessedSalary;
			$this -> remarks = $remarks;
			$this -> police = $police;
			$this -> birthDate = $birthDate;
			$this -> workingDomain = $workingDomain;
			$this -> currentWorkingCity = $currentWorkingCity;
			$this -> currentWorkingArea = $currentWorkingArea;
			$this -> preferredWorkingCity = $preferredWorkingCity;
			$this -> preferredWorkingArea = $preferredWorkingArea;
			$this -> workTimeSlots = $workTimeSlots;
			$this -> freeTimeSlots = $freeTimeSlots;
			$this -> emergencyMobile = $emergencyMobile;
			$this -> addressProofName = $addressProofName;
			$this -> addressProofId = $addressProofId;
			$this -> idProofName = $idProofName;
			$this -> idProofId = $idProofId;
			$this -> agentId = $agentId;
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

		function setSkills($skills){
			$this -> skills = $skills;
		}
		function getSkills(){
			return $this-> skills;
		}

		function setExperience($experience){
			$this -> experience = $experience;
		}
		function getExperience(){
			return $this-> experience;
		}

		function setWorkingDomain($workingDomain){
			$this -> working_domain = $workingDomain;
		}
		function getWorkingDomain(){
			return $this-> workingDomain;
		}

		function setCurrentWorkingArea($currentWorkingArea){
			$this -> current_working_area = $currentWorkingArea;
		}
		function getCurrentWorkingArea(){
			return $this-> currentWorkingArea;
		}

		function setCurrentWorkingCity($currentWorkingCity){
			$this -> current_working_city = $currentWorkingCity;
		}
		function getCurrentWorkingCity(){
			return $this-> currentWorkingCity;
		}

		function setPreferredWorkingArea($preferredWorkingArea){
			$this -> preferred_working_area = $preferredWorkingArea;
		}
		function getPreferredWorkingArea(){
			return $this-> preferredWorkingArea;
		}

		function setPreferredWorkingCity($preferredWorkingCity){
			$this -> preferred_working_city = $preferredWorkingCity;
		}
		function getPreferredWorkingCity(){
			return $this-> preferredWorkingCity;
		}

		function setGuessedSalary($guessedSalary){
			$this -> salary_expected = $guessedSalary;
		}
		function getGuessedSalary(){
			return $this-> guessedSalary;
		}

		function setWorkTimeSlots($workTimeSlots){
			$this -> work_time_slots = $workTimeSlots;
		}
		function getWorkTimeSlots(){
			return $this-> workTimeSlots;
		}

		function setFreeTimeSlots($freeTimeSlots){
			$this -> free_time_slots = $freeTimeSlots;
		}
		function getFreeTimeSlots(){
			return $this-> freeTimeSlots;
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

		function setAgentId($agentId){
			$this -> employee_id  = $agentId;
		}
		function getAgentId(){
			return $this-> agentId;
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

		function setRemarks($remarks){
			$this -> remarks = $remarks;
		}
		function getRemarks(){
			return $this-> remarks;
		}

		function setPolice($police){
			$this -> police = $police;
		}
		function getPolice(){
			return $this-> police;
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
							age => $this -> age,
							mobile => $this -> mobile,
							emergency_mobile=> $this -> emergencyMobile,
							education => $this -> education,
							languages => $this-> languages,
							skills => $this-> skills,
							experience => $this -> experience,
							working_domain=> $this -> workingDomain,
							current_working_city => $this -> currentWorkingCity,
							current_working_area => $this -> currentWorkingArea,
							preferred_working_city => $this -> preferredWorkingCity,
							preferred_working_area => $this -> preferredWorkingArea,
							salary_expected => $this -> guessedSalary,
							work_time_slots=> $this -> workTimeSlots,
							free_time_slots => $this -> freeTimeSlots,
							birth_date => $this -> birthDate,
							gender => $this -> gender,
							timings => $this -> timings,
							home_town => $this -> home_town,
							police => $this -> police,
							remarks => $this -> remarks,
							employee_id => $this -> agentId,
							added_on => $this -> addedOn,
							last_updated => $this -> lastUpdateOn
						);
		}

	}
	?>