<?php

	/**
     * @author rajnish
	**/

	//require_once 'dao/CustomerIdMappingDAO.interface.php';
    //require_once 'dao/mysql/CustomerIdMappingMySqlDAO.class.php';
    //require_once 'models/customer/Customer.class.php';
    
    require_once 'dao/GetInTouchDAO.interface.php';
    require_once 'models/GetInTouch.class.php';

    require_once 'utils/mongo/MongoDBUtil.class.php';
    require_once 'exceptions/MongoDbException.class.php';
    require_once 'exceptions/DuplicateEntityException.class.php';
    //require_once 'exceptions/customers/CustomerNotFoundException.class.php';

	class GetInTouchMongoDAO implements GetInTouchDAO {

        private $mongo;
        
        public function __construct () {
            $this -> mongo = new MongoDBUtil(array('db_name' => 'blueteam'));
            $this -> mongo -> init();

        }

        public function insert($getInTouchObj) {
            global $logger, $warnings_payload;
            $logger -> debug("Insert the customer into `customers` collection");

            $logger -> debug ("Selecting collection: get_in_touch");
            $this -> mongo -> selectCollection('get_in_touch');


            $logger -> debug("Mongo Customer: " . json_encode($getInTouchObj->toArray() ));
            $result = $this -> mongo -> insert($getInTouchObj->toArray()); 
            console.log($result);
            $logger -> debug("Result: " . $result ['ok']);

            return $result;

            //return $return;
        }


        public function multiInsert($customerObjs, $raw) {

        }

        public function update($customer, $raw) {
        }  


        public function delete($uuid) {
        }
        
        public function deleteByOtherIdentifier($idType, $idValue) {
        
        }


        public function load($uuidValues, $orgId = null, $projection = null) {
        
        }

        public function loadByExternalIdentifier($idType, $idValues, $orgId = null, $projection = null) {
        
        }

        public function loadByMultipleIdentifiers($identifiers, $orgId = null, $projection = null) {
        
        }        
        
        public function loadByProfileAttribute($profileAttributeName, $profileAttributeValue) {}
        
        public function loadAll() {
        
        }
        
        public function loadAllInOrderOf($sortByKey) {
        
        }
                
        public function loadFromCustomerIdMapping($idType, $idValue) {
            return $this -> customerIdDAO -> queryByIdentifierTypeValue ($idType, $idValue);
        }

        private function checkIfAllNewIdentifiers ($identifiers) {
        
        }

        public function loadConflict($conflictUuid) {
        
        }

        public function loadAllConflicts() {
        
        }

        public function loadCustomerInConflict($conflictCustomerUuid) {
        
        }

        public function loadAllCustomersInConflict() {
        
        }

        public function insertCustomer($custToInsert) {

            global $logger;    
            $logger -> debug("Insert the customer into `customers` collection");

            $logger -> debug ("Selecting collection: customers");
            $this -> mongo -> selectCollection('customers');

            $logger -> debug("Mongo Customer: " . json_encode($custToInsert));
            $result = $this -> mongo -> insert($custToInsert); 
            $logger -> debug("Result: " . $result ['ok']);

            return $result;
        }

        private function mapCustomerIdentifiers($identifiers, $uuid) {
            global $logger;
            $identifierMappings = $result = array();
            $logger -> debug("Map all the identifiers against UUID: $uuid");

            foreach ($identifiers as $idType => $idValues) {

                foreach ($idValues as $idValue) {
                
                    $result = $this -> customerIdDAO -> insert($uuid, $idType, $idValue);
                    $logger -> debug("Result - " . json_encode($result));
                    
                    if (! $result) {
                        require_once 'exceptions/DuplicateEntityException.class.php';
                        throw new DuplicateEntityException (
                            "Customer with '$idType' '$idValue' already exists in the system");
                    }
                    $identifierMappings [$result] = array($idType => $idValue);
                }
            } 
            return $identifierMappings;
        }

        public function insertConflict($conflictUuid, $conflictCases) {

            global $logger;    
            $logger -> debug("Insert the conflicted customer into `conflictedCustomers` and get it's UUID");

            /* Take the UUID and the conflict cases and insert into `conflict` collection */
            $logger -> debug ("Selecting collection: conflicts");
            $this -> mongo -> selectCollection('conflicts');

            $conflict = array(
                'conflictUuid' => $conflictUuid, 
                'cases' => $conflictCases
            );

            $logger -> debug("Mongo Conflict Details: " . json_encode($conflict));
            $result = $this -> mongo -> insert($conflict); 
            $logger -> debug("Result: " . $result ['ok']);

            return $result;
        }

        public function insertCustomerInConflict($custToInsert) {

            global $logger;    
            $logger -> debug("Insert the conflicted customer into `conflictedCustomers` and get it's UUID");
            
            $logger -> debug ("Selecting collection: conflictCustomers");
            $this -> mongo -> selectCollection('conflictCustomers');

            $logger -> debug("Mongo Conflicted Customer: " . json_encode($custToInsert));
            $result = $this -> mongo -> insert($custToInsert); 
            $logger -> debug("Result: " . $result ['ok']);

            return $result;
        }

        public function insertRawdata($raw) {

            global $logger;    
            $logger -> debug("Insert the raw data into the 'customersInput' collection");

            $this -> mongo -> selectCollection('customersInput');
            $result = $this -> mongo -> insert($raw); 

            if ($result ['ok']) {
                $rawUuid = $raw['_id'] -> {'$id'};
                $logger -> debug("Raw data stored - UUID: $rawUuid");
            } else {
                $logger -> debug("Raw data could not be stored: " . json_encode($result));
            }

            return $result;
        }
	}  