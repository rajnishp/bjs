<?php

    /**
     * @author anil
    **/

/*
* Good Programmer practicis
* 1. Expection should be catched and thrown at right place
* 2. Comment should be made at trike placas.
*
*/
    //require_once 'dao/CustomerIdMappingDAO.interface.php';
    //require_once 'dao/mysql/CustomerIdMappingMySqlDAO.class.php';
    //require_once 'models/customer/Customer.class.php';
    
    require_once 'utils/mongo/MongoDBUtil.class.php';
    require_once 'exceptions/MongoDbException.class.php';
    require_once 'exceptions/DuplicateEntityException.class.php';
    //require_once 'exceptions/service_requests/CustomerNotFoundException.class.php';

    class ServiceRequestsMongoDAO implements ServiceRequestsDAO {

        private $mongo;
        
        public function __construct () {
            $this -> mongo = new MongoDBUtil(array('db_name' => 'blueteam'));
            $this -> mongo -> init();

        }

        public function insert($serviceRequestObj) {
            global $logger, $warnings_payload;

            $logger -> debug("Insert the customer into `service_requests` collection");

            $logger -> debug ("Selecting collection: service_requests");
            $this -> mongo -> selectCollection('service_requests');


            $logger -> debug("Mongo Customer: " . json_encode($serviceRequestObj->toArray() ));
            $result = $this -> mongo -> insert($serviceRequestObj->toArray()); 
	    $logger -> debug("Result: " . $result ['ok']);

            return $result;

            //return $return;
        }

        public function insert1($customerObj, $raw = null) {
            global $logger, $warnings_payload;

            $customerResult = $identifierMappingsResult = $rawResult = array(); 
            $customerInConflictResult = $conflictResult = array(); 
            try {
                /* Check whether all identifiers are new ones */
                $identifiers = $customerObj -> getIdentifiers();
                $result = $this -> checkIfAllNewIdentifiers($identifiers);

                $duplicate = $result ['duplicate'];
                if ($duplicate) {

                    /* Throw exception if identifier already exists in the system */
                    require_once 'exceptions/service_requests/DuplicateCustomerException.class.php';
                    throw new DuplicateCustomerException($result ['duplicate_uuid']);

                } else {

                    $conflict = $result ['conflict'];
                    if ($conflict) {

                        /* Insert the conflicted customer into the `conflictedservice_requests` and get it's UUID */
                        $custToInsert = $customerObj -> serialize();
                        $customerInConflictResult = $this -> insertCustomerInConflict($custToInsert);
                        $conflictUuid = $custToInsert['_id'] -> {'$id'};

                        if ($customerInConflictResult ['ok']) {
                            $cases = $result ['conflictCases'];
                            $conflictResult = $this -> insertConflict($conflictUuid, $cases);                    
                        }

                        /* Store the raw data */
                        if (! is_null($raw)) {
                            $raw ['customerUUID'] = $conflictUuid;
                            $raw ['inConflict'] = 'true';
                            $rawResult = $this -> insertRawdata($raw);
                        }

                        $return = array(
                            'insertResults' => array (
                                'conflict' => $conflictResult,
                                'customerInConflict' => $customerInConflictResult, 
                                'raw' => $rawResult
                            ), 
                            'conflict' => true, 
                            'customer' => $customerObj
                        );

                    } else {
                        /* Insert the customer into `service_requests` collection */
                        $custToInsert = $customerObj -> serialize();
                        $customerResult = $this -> insertCustomer($custToInsert);

                        /* Map the identifiers against the UUID in the `customer_id_mapping` table */
                        $uuid = null;
                        if ($customerResult ['ok']) {
                            $uuid = $custToInsert['_id'] -> {'$id'};
                            $customerObj -> setUuid ($uuid);
                            $identifierMappingsResult = $this -> mapCustomerIdentifiers($identifiers, $uuid);
                            $logger -> debug("Identifiers Mapped: " . json_encode($identifierMappings));
                        }

                        /* Store the raw data */
                        if (! is_null($raw)) {
                            $raw ['customerUUID'] = $uuid;
                            $raw ['inConflict'] = 'false';
                            $rawResult = $this -> insertRawdata($raw);
                        }

                        $return = array(
                            'insertResults' => array (
                                'customer' => $customerResult, 
                                'customerIdMappings' => $identifierMappingsResult,
                                'raw' => $rawResult
                            ), 
                            'conflict' => false, 
                            'customer' => $customerObj
                        );
                    }
                }
            } catch(MongoException $e) {
                $logger -> error("MongoException: " . $e -> getMessage());
                throw new MongoDbException($e, $e);
            } catch(Exception $e) {
                throw $e;
            }

            return $return;
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
                $logger -> debug ("Selecting collection: service_requests");
                $this -> mongo -> selectCollection('service_requests');

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

            $logger -> debug ("Selecting collection: service_requests");
            $this -> mongo -> selectCollection('service_requests');     

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
                /* In case of an entry in the `customer_id_mapping` table but not in the `service_requests` collection */
                throw new CustomerNotFoundException($idType, $idValue, null, $e);
            } catch (Exception $e) {
                throw $e;
            }
            return $result;
        }


        public function load($uuidValues, $orgId = null, $projection = null) {
            global $logger;
            //$customerObjs = $output = array();

            $logger -> debug ("Selecting collection: service_requests");
            $this -> mongo -> selectCollection('service_requests');  
            $serviceRequest = $this -> mongo -> findByObjectId($uuidValues );   

            /*if (sizeof($uuidValues) == 1) {
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

            $service_requests = $output ['result'];
            unset($output ['result']);
            foreach ($service_requests as $uuid => $customer) {
                $output ['result'] [] = Customer :: deserialize($customer);
            }*/
            return new ServiceRequest($serviceRequest['name'], $serviceRequest['mobile'], $serviceRequest['address'], $serviceRequest['service'],
                                    $serviceRequest['type'], $serviceRequest['salary_criteria'], $serviceRequest['working_hour'],
                                    $serviceRequest['requirements'], $serviceRequest['remarks'], $serviceRequest['requirements'],
                                    $serviceRequest['added_on'], $serviceRequest['last_updated'], $serviceRequest['_id']->{'$id'});
        }

        public function loadByExternalIdentifier($idType, $idValues, $orgId = null, $projection = null) {
            global $logger;
            $customerObj = null;

            $mappingOutput = $this -> customerIdDAO 
                                -> queryBySameTypeButMultipleIdentifiers($idType, $idValues);
            try {
                if (! empty($mappingOutput ['result'])) {
                    $uuids = array_keys($mappingOutput ['result']);
                    $service_requestsOutput = $this -> load($uuids, $orgId, $projection);
                }
                if (! empty($service_requestsOutput ['failures'] ['uuid'])) {
                    foreach ($service_requestsOutput ['failures'] ['uuid'] as $uuid) {
                        $mappingOutput ['failures'] [$idType] [] = 
                            $mappingOutput ['result'] [$uuid] ['idValue'];
                    }
                }
            } catch (Exception $e) {
                throw $e;
            }

            return array (
                'failures' => $mappingOutput ['failures'],
                'result' => $service_requestsOutput ['result']
            );
        }

        public function loadByMultipleIdentifiers($identifiers, $orgId = null, $projection = null) {
            global $logger;
            $customerObj = null;

            $mappingOutput = $this -> customerIdDAO 
                                -> queryByMultipleTypesAndMultipleIdentifiers($identifiers);

            try {
                $uuids = array_keys($mappingOutput ['result']);
                $service_requestsOutput = $this -> load($uuids, $orgId, $projection);

                if (! empty($service_requestsOutput ['failures'] ['uuid'])) {
                    foreach ($service_requestsOutput ['failures'] ['uuid'] as $uuid) {
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
                'result' => $service_requestsOutput ['result']
            );
        }        
        
        public function loadByProfileAttribute($profileAttributeName, $profileAttributeValue) {}
        
        public function loadAllServiceRequests() {
            global $logger;
            //$allservice_requests = $mongoservice_requestsInConflict = null;

            $logger -> debug ("Selecting collection: service_requests");
            $this -> mongo -> selectCollection('service_requests');     

            $mongoserviceRequests = $this -> mongo -> find(array());
            //$timings, $home_town, $remarks, $police, $agentId, $addedOn, $lastUpdateOn, $uuid = null
            foreach ($mongoserviceRequests as $serviceRequest) {
                //var_dump($serviceRequest['first_name']);die();
                $allservice_requests [] = new ServiceRequest($serviceRequest['name'], $serviceRequest['mobile'], $serviceRequest['address'], 
                                                            $serviceRequest['service'], $serviceRequest['type'], $serviceRequest['salary_criteria'], 
                                                            $serviceRequest['working_hour'], $serviceRequest['requirements'], $serviceRequest['remarks'], 
                                                            $serviceRequest['requirements'], $serviceRequest['added_on'], 
                                                            $serviceRequest['last_updated'], $serviceRequest['_id']->{'$id'});
            } 
            return $allservice_requests;
        }

        public function loadAll() {
            global $logger;
            $services = null;

            $logger -> debug ("Selecting collection: service_requests");
            $this -> mongo -> selectCollection('service_requests');     

            $mongoServices = $this -> mongo -> find(array());
            
            foreach ($mongoServices as $key => $value) {
                //$name, $img, $status, $addedOn, $lastUpdateOn, $uuid = null
                $logger -> debug ("mongo array : " . json_encode($value));

                $services[] =  new ServiceRequest($value['name'], $value['mobile'], $value['address'], $value ['service'], $value["type"], $value ['timestamp']);
            }
            
            return $services;
        }
        
        public function loadAllInOrderOf($sortByKey) {
            global $logger;
            $service_requests = $mongoservice_requests = null;

            $logger -> debug ("Selecting collection: service_requests");
            $this -> mongo -> selectCollection('service_requests');     

            $mongoservice_requests = $this -> mongo -> find(array(), array('$sortByKey' => 1));
            foreach ($mongoservice_requests as $mongoCustomer) {
                $service_requests [] = Customer :: deserialize($mongoCustomer);
            }
            
            return $service_requests;
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

            $logger -> debug ("Selecting collection: conflictservice_requests");
            $this -> mongo -> selectCollection('conflictservice_requests');     

            $conflictCustomer = $this -> mongo -> findByObjectId($conflictCustomerUuid);

            $conflictCustomerObj = Customer :: deserialize($conflictCustomer);
            return $conflictCustomerObj;
        }

        public function loadAllservice_requestsInConflict() {
            global $logger;
            $service_requestsInConflict = $mongoservice_requestsInConflict = null;

            $logger -> debug ("Selecting collection: conflictservice_requests");
            $this -> mongo -> selectCollection('conflictservice_requests');     

            $mongoservice_requestsInConflict = $this -> mongo -> find(array());
            foreach ($mongoservice_requestsInConflict as $mongoCustomerInConflict) {
                $service_requestsInConflict [] = Customer :: deserialize($mongoCustomerInConflict);
            }
            
            return $service_requestsInConflict;
        }

        public function insertCustomer($custToInsert) {

            global $logger;    
            $logger -> debug("Insert the customer into `service_requests` collection");

            $logger -> debug ("Selecting collection: service_requests");
            $this -> mongo -> selectCollection('service_requests');

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
            $logger -> debug("Insert the conflicted customer into `conflictedservice_requests` and get it's UUID");

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
            $logger -> debug("Insert the conflicted customer into `conflictedservice_requests` and get it's UUID");
            
            $logger -> debug ("Selecting collection: conflictservice_requests");
            $this -> mongo -> selectCollection('conflictservice_requests');

            $logger -> debug("Mongo Conflicted Customer: " . json_encode($custToInsert));
            $result = $this -> mongo -> insert($custToInsert); 
            $logger -> debug("Result: " . $result ['ok']);

            return $result;
        }

        public function insertRawdata($raw) {

            global $logger;    
            $logger -> debug("Insert the raw data into the 'service_requestsInput' collection");

            $this -> mongo -> selectCollection('service_requestsInput');
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
