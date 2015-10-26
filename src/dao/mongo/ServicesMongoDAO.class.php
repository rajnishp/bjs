<?php

	/**
     * @author rahul
	**/

	//require_once 'dao/CustomerIdMappingDAO.interface.php';
    //require_once 'dao/mysql/CustomerIdMappingMySqlDAO.class.php';
    //require_once 'models/customer/Customer.class.php';
    
    require_once 'dao/ServiceRequestsDAO.interface.php';
    require_once 'models/ServiceRequests.class.php';

    require_once 'utils/mongo/MongoDBUtil.class.php';
    require_once 'exceptions/MongoDbException.class.php';
    require_once 'exceptions/DuplicateEntityException.class.php';
    //require_once 'exceptions/customers/CustomerNotFoundException.class.php';

	class ServicesMongoDAO implements ServicesDAO {

        private $mongo;
        
        public function __construct () {
            $this -> mongo = new MongoDBUtil(array('db_name' => 'blueteam'));
            $this -> mongo -> init();

        }

        // should be implemented in future
        public function insert($serviceListObj) {
            global $logger, $warnings_payload;

            $logger -> debug("Insert the customer into `services` collection");
            try {
            $logger -> debug ("Selecting collection: services");
            $this -> mongo -> selectCollection('services');


            $logger -> debug("Mongo Customer: " . json_encode($serviceListObj->toArray() ));
            $result = $this -> mongo -> insert($serviceListObj->toArray()); 
            $logger -> debug("Result: " . $result ['ok']);
            } catch(MongoException $e) {
                $logger -> error("MongoException: " . $e -> getMessage());
                throw new MongoDbException($e, $e);
            } catch(Exception $e) {
                throw $e;
            }

            return $result;

        }


        public function multiInsert($customerObjs, $raw) {

            $inserts = $conflicts = $duplicates = array();

            foreach ($customerObjs as $key => $customerObj) {
                try {
                    $result = $this -> insert($customerObj);

                    if ($result ['conflict']) {
                        $inserts [$key] = $result ['customer'];
                    } else {
                        $conflicts [$key] = $result ['customer'];
                    }
                } catch(DuplicateCustomerException $e) {
                    $duplicates [$key] = array(
                        'existingUuid' => $e -> getExistingCustomerUuid(), 
                        'customer' => $customerObj
                    );
                } catch(Exception $e) {
                    throw $e;
                }
            }

            /* Store the raw data */
            if (! is_null($raw)) 
                $rawResult = $this -> insertRawdata($raw);

            return array(
                'inserts' => $inserts, 
                'conflicts' => $conflicts, 
                'duplicates' => $duplicates
            );
        }

        public function update($customer, $raw) {
            global $logger, $warnings_payload;
            $customerResult = $deleteIdentifierMappings = $identifierMappingsResult = $rawResult = array(); 

            try {
                $logger -> debug ("Selecting collection: customers");
                $this -> mongo -> selectCollection('customers');

                $uuid = $customer -> getUuid();
                $custToUpdate = $customer -> serialize();
                $logger -> debug("Mongo Customer: " . json_encode($custToUpdate));
                $customerResult = $this -> mongo -> updateByObjectId($uuid, $custToUpdate); 
                $logger -> debug("Result: " . $result ['ok']);

                if ($customerResult ['ok']) {
                    $existingIds = array();
                    $existingIdentifierMappings = $this -> customerIdDAO -> load($uuid);
                    foreach ($existingIdentifierMappings as $mapping) {
                        $existingIds [$mapping ['idType']] [] = $mapping ['idValue'];
                    }

                    $nonExistantIds = array();
                    $currentIds = $customer -> getIdentifiers();
                    foreach ($currentIds as $idType => $idValues) {
                        foreach ($idValues as $idValue) {
                            if (! in_array($idValue, $existingIds [$idType])) {
                                $nonExistantIds [$idType] [] = $idValue;
                            }
                        }
                    }

                    $newIdentifierMappingsResult = $this -> mapCustomerIdentifiers($nonExistantIds, $uuid);
                    $logger -> debug("New Identifiers Mapped: " . json_encode($newIdentifierMappingsResult));
                }

                if ($customerResult ['ok']) {
                    if ($raw) {
                        $rawResult = $this -> insertRawdata($raw);
                    }
                } else {
                    throw new CustomerNotFoundException($uuid);
                }
            } catch(MongoException $e) {
                $logger -> error("MongoException: " . $e -> getMessage());
                throw new MongoDbException($e, $e);
            } catch(Exception $e) {
                throw $e;
            }

            return $customer;
        }  


        public function delete($uuid) {
            global $logger;

            $logger -> debug ("Selecting collection: customers");
            $this -> mongo -> selectCollection('customers');     

            $result = $this -> mongo -> removeByObjectId($uuid);

            if ($result ['ok'] && $result ['n'] > 0) 
                $hasBeenDeleted = true;
            else if ($result ['ok'] && $result ['n'] == 0)
                throw new CustomerNotFoundException('uuid', $uuid);
            else 
                $hasBeenDeleted = false;

            if ($hasBeenDeleted) {
                return $this -> customerIdDAO -> delete($uuid);
            }

            return $hasBeenDeleted;
        }
        
        public function deleteByOtherIdentifier($idType, $idValue) {
            global $logger;

            $customerIdMapping = $this -> loadFromCustomerIdMapping($idType, $idValue);
            if (empty($customerIdMapping [0])) {
                throw new CustomerNotFoundException($idType, $idValue);
            }

            try {
                $result = $this -> delete($customerIdMapping [0] ['uuid']);
            } catch (CustomerNotFoundException $e) {
                /* In case of an entry in the `customer_id_mapping` table but not in the `customers` collection */
                throw new CustomerNotFoundException($idType, $idValue, null, $e);
            } catch (Exception $e) {
                throw $e;
            }
            return $result;
        }


        public function load($uuidValues, $orgId = null, $projection = null) {
            global $logger;
            $customerObjs = $output = array();

            $logger -> debug ("Selecting collection: customers");
            $this -> mongo -> selectCollection('customers');     

            if (sizeof($uuidValues) == 1) {
                $customer = $this -> mongo -> findByObjectIdAndOrgId($uuidValues [0], $orgId, $projection);
                
                if (empty($customer)) 
                    $output ['failures'] ['uuid'] [] = $uuidValues [0];

                $output ['result'] [$uuidValues [0]] = $customer;
            } else {
                $output = $this -> mongo -> findManyByObjectIdAndOrgId($uuidValues, $orgId, $projection);

                $failures = $output ['failures'];
                unset($output ['failures']);
                if (! empty($failures))
                    $output ['failures'] ['uuid'] = $failures;
            }

            $customers = $output ['result'];
            unset($output ['result']);
            foreach ($customers as $uuid => $customer) {
                $output ['result'] [] = Customer :: deserialize($customer);
            }

            return $output;
        }

        public function loadByExternalIdentifier($idType, $idValues, $orgId = null, $projection = null) {
            global $logger;
            $customerObj = null;

            $mappingOutput = $this -> customerIdDAO 
                                -> queryBySameTypeButMultipleIdentifiers($idType, $idValues);
            try {
                if (! empty($mappingOutput ['result'])) {
                    $uuids = array_keys($mappingOutput ['result']);
                    $customersOutput = $this -> load($uuids, $orgId, $projection);
                }
                if (! empty($customersOutput ['failures'] ['uuid'])) {
                    foreach ($customersOutput ['failures'] ['uuid'] as $uuid) {
                        $mappingOutput ['failures'] [$idType] [] = 
                            $mappingOutput ['result'] [$uuid] ['idValue'];
                    }
                }
            } catch (Exception $e) {
                throw $e;
            }

            return array (
                'failures' => $mappingOutput ['failures'],
                'result' => $customersOutput ['result']
            );
        }

        public function loadByMultipleIdentifiers($identifiers, $orgId = null, $projection = null) {
            global $logger;
            $customerObj = null;

            $mappingOutput = $this -> customerIdDAO 
                                -> queryByMultipleTypesAndMultipleIdentifiers($identifiers);

            try {
                $uuids = array_keys($mappingOutput ['result']);
                $customersOutput = $this -> load($uuids, $orgId, $projection);

                if (! empty($customersOutput ['failures'] ['uuid'])) {
                    foreach ($customersOutput ['failures'] ['uuid'] as $uuid) {
                        $idType = $mappingOutput ['result'] [$uuid] ['idType'];
                        $idValue = $mappingOutput ['result'] [$uuid] ['idValue'];

                        $mappingOutput ['failures'] [$idType] [] = $idValue;
                    }
                }
            } catch (Exception $e) {
                throw $e;
            }

            return array (
                'failures' => $mappingOutput ['failures'],
                'result' => $customersOutput ['result']
            );
        }        
        
        public function loadByProfileAttribute($profileAttributeName, $profileAttributeValue) {}
        
        public function loadAll() {
            global $logger;
            $services = null;

            $logger -> debug ("Selecting collection: services");
            $this -> mongo -> selectCollection('services');     

            $mongoServices = $this -> mongo -> find(array());
            
            foreach ($mongoServices as $key => $value) {
                //$name, $img, $status, $addedOn, $lastUpdateOn, $uuid = null
                $logger -> debug ("mongo array : " . json_encode($value["name"]));

                $services[] = new Service($value["name"], $value["img"], $value["status"], null, null, $key );
            }
            
            return $services;
        }
        
        public function loadAllInOrderOf($sortByKey) {
            global $logger;
            $customers = $mongoCustomers = null;

            $logger -> debug ("Selecting collection: customers");
            $this -> mongo -> selectCollection('customers');     

            $mongoCustomers = $this -> mongo -> find(array(), array('$sortByKey' => 1));
            foreach ($mongoCustomers as $mongoCustomer) {
                $customers [] = Customer :: deserialize($mongoCustomer);
            }
            
            return $customers;
        }
                
        public function loadFromCustomerIdMapping($idType, $idValue) {
            return $this -> customerIdDAO -> queryByIdentifierTypeValue ($idType, $idValue);
        }

        private function checkIfAllNewIdentifiers ($identifiers) {
            global $logger;
            $logger -> debug("CHECK - If any of the identifiers already exists in customer_id_mapping relation");
            
            $result = $customerIdMappings = $conflictCases = $uuids = array();
            $previousUniqueCount = $currentUniqueCount = 0;
            foreach ($identifiers as $idType => $idValues) {

                foreach ($idValues as $idValue) {
                
                    $customerIdMapping = $this -> loadFromCustomerIdMapping($idType, $idValue);
                    $logger -> debug("CHECK Result - " . json_encode($customerIdMapping));

                    if (isset($customerIdMapping [0] ['uuid'])) {
                        $uuids [] = $customerIdMapping [0] ['uuid'];

                        $uuids = array_unique($uuids);
                        $currentUniqueCount = count($uuids);
                        if ($currentUniqueCount > $previousUniqueCount) {
                            $conflictCases [] = $customerIdMapping [0];
                        }
                        $previousUniqueCount = $currentUniqueCount;
                    }

                    $customerIdMappings[] = $customerIdMapping [0];
                }
            } 

            if (empty($uuids)) {
                $result ['conflict'] = false;
            } else if (count($uuids) === 1) {
                $result ['duplicate'] = true;
                $result ['duplicate_uuid'] = $uuids [0];
            } else {
                $result ['conflict'] = true;
                $result ['conflictCases'] = $conflictCases;
                $result ['uuids'] = $uuids;
                $result ['customerIdMappings'] = $customerIdMappings;
            } 

            return $result;
        }

        public function loadConflict($conflictUuid) {
            global $logger;

            $logger -> debug ("Selecting collection: conflicts");
            $this -> mongo -> selectCollection('conflicts');     

            $conflict = $this -> mongo -> findByObjectId($conflictUuid);

            unset($conflict ['_id']);
            $conflict ['id'] = $conflictUuid;

            return $conflict;
        }

        public function loadAllConflicts() {
            global $logger;
            $conflicts = null;

            $logger -> debug ("Selecting collection: conflicts");
            $this -> mongo -> selectCollection('conflicts');     

            $result = $this -> mongo -> find(array());

            foreach ($result as $conflictUuid => $conflict) {
                unset($conflict ['_id']);
                $conflict ['id'] = $conflictUuid;
                $conflicts [] = $conflict;
            }

            return $conflicts;
        }

        public function loadCustomerInConflict($conflictCustomerUuid) {
            global $logger;

            $logger -> debug ("Selecting collection: conflictCustomers");
            $this -> mongo -> selectCollection('conflictCustomers');     

            $conflictCustomer = $this -> mongo -> findByObjectId($conflictCustomerUuid);

            $conflictCustomerObj = Customer :: deserialize($conflictCustomer);
            return $conflictCustomerObj;
        }

        public function loadAllCustomersInConflict() {
            global $logger;
            $customersInConflict = $mongoCustomersInConflict = null;

            $logger -> debug ("Selecting collection: conflictCustomers");
            $this -> mongo -> selectCollection('conflictCustomers');     

            $mongoCustomersInConflict = $this -> mongo -> find(array());
            foreach ($mongoCustomersInConflict as $mongoCustomerInConflict) {
                $customersInConflict [] = Customer :: deserialize($mongoCustomerInConflict);
            }
            
            return $customersInConflict;
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