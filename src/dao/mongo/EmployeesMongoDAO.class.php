<?php

	/**
     * @author rajnish
	**/
    
    require_once 'dao/EmployeesDAO.interface.php';
    require_once 'models/Employee.class.php';

    require_once 'utils/mongo/MongoDBUtil.class.php';
    require_once 'exceptions/MongoDbException.class.php';
    require_once 'exceptions/DuplicateEntityException.class.php';

	class EmployeesMongoDAO implements EmployeesDAO {

        private $mongo;
        
        public function __construct () {
            $this -> mongo = new MongoDBUtil(array('db_name' => 'blueteam'));
            $this -> mongo -> init();

        }

        public function insert($EmployeeObj) {
            global $logger, $warnings_payload;

            $logger -> debug("Insert the employee details into `employees` collection");

            $logger -> debug ("Selecting collection: employees");
            $this -> mongo -> selectCollection('employees');


            $logger -> debug("Mongo employee: " . json_encode($EmployeeObj->toArray() ));
            $result = $this -> mongo -> insert($EmployeeObj->toArray()); 
            $logger -> debug("Result: " . $result ['ok']);

            return $result;

            //return $return;
        }

        public function countFreeEmployees(){

                try {
                    $this -> mongo -> selectCollection('employees');
                    return count($this -> mongo -> find(array('status' => 1)));


                } catch(Exception $e) {
                    throw $e;
                }

        }

        public function multiInsert($employeeObjs, $raw) {

            $inserts = $conflicts = $duplicates = array();

            foreach ($employeeObjs as $key => $employeeObj) {
                try {
                    $result = $this -> insert($employeeObj);

                    if ($result ['conflict']) {
                        $inserts [$key] = $result ['employee'];
                    } else {
                        $conflicts [$key] = $result ['employee'];
                    }
                } catch(DuplicateemployeeException $e) {
                    $duplicates [$key] = array(
                        'existingUuid' => $e -> getExistingEmployeeUuid(), 
                        'employee' => $employeeObj
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


        public function loadAllEmployees() {
            global $logger;
            //$allemployees = $mongoemployeesInConflict = null;

            $logger -> debug ("Selecting collection: employees");
            $this -> mongo -> selectCollection('employees');     

            $mongoemployees = $this -> mongo -> find(array());
            //$timings, $home_town, $remarks, $police, $agentId, $addedOn, $lastUpdateOn, $uuid = null
            foreach ($mongoemployees as $employee) {

                $allemployees [] = new employee($employee['firstName'], $employee['lastName'],null, null, null, null, null, 
                                            $employee['mobile'],null, null, null, $employee['skills'], $employee['experience'], null,
                                            $employee['currentWorkingCity'], $employee['currentWorkingArea'], $employee['preferredWorkingCity'],$employee['preferredWorkingArea'],null, null, null, null, null,
                                            $employee['gender'], $employee['timings'], $employee['home_town'], $employee['remarks'], $employee['police'], $employee['agentId'], 
                                            $employee['addedOn'], $employee['lastUpdateOn'], $employee['_id']->{'$id'});
            }
            
            return $allemployees;
        }

        public function update($employee, $raw) {
            global $logger, $warnings_payload;
            $employeeResult = $deleteIdentifierMappings = $identifierMappingsResult = $rawResult = array(); 

            try {
                $logger -> debug ("Selecting collection: employees");
                $this -> mongo -> selectCollection('employees');

                $uuid = $employee -> getUuid();
                $custToUpdate = $employee -> serialize();
                $logger -> debug("Mongo employee: " . json_encode($custToUpdate));
                $employeeResult = $this -> mongo -> updateByObjectId($uuid, $custToUpdate); 
                $logger -> debug("Result: " . $result ['ok']);

                if ($employeeResult ['ok']) {
                    $existingIds = array();
                    $existingIdentifierMappings = $this -> employeeIdDAO -> load($uuid);
                    foreach ($existingIdentifierMappings as $mapping) {
                        $existingIds [$mapping ['idType']] [] = $mapping ['idValue'];
                    }

                    $nonExistantIds = array();
                    $currentIds = $employee -> getIdentifiers();
                    foreach ($currentIds as $idType => $idValues) {
                        foreach ($idValues as $idValue) {
                            if (! in_array($idValue, $existingIds [$idType])) {
                                $nonExistantIds [$idType] [] = $idValue;
                            }
                        }
                    }

                    $newIdentifierMappingsResult = $this -> mapemployeeIdentifiers($nonExistantIds, $uuid);
                    $logger -> debug("New Identifiers Mapped: " . json_encode($newIdentifierMappingsResult));
                }

                if ($employeeResult ['ok']) {
                    if ($raw) {
                        $rawResult = $this -> insertRawdata($raw);
                    }
                } else {
                    throw new employeeNotFoundException($uuid);
                }
            } catch(MongoException $e) {
                $logger -> error("MongoException: " . $e -> getMessage());
                throw new MongoDbException($e, $e);
            } catch(Exception $e) {
                throw $e;
            }

            return $employee;
        }  


        public function delete($uuid) {
            global $logger;

            $logger -> debug ("Selecting collection: employees");
            $this -> mongo -> selectCollection('employees');     

            $result = $this -> mongo -> removeByObjectId($uuid);

            if ($result ['ok'] && $result ['n'] > 0) 
                $hasBeenDeleted = true;
            else if ($result ['ok'] && $result ['n'] == 0)
                throw new employeeNotFoundException('uuid', $uuid);
            else 
                $hasBeenDeleted = false;

            if ($hasBeenDeleted) {
                return $this -> employeeIdDAO -> delete($uuid);
            }

            return $hasBeenDeleted;
        }
        
        public function deleteByOtherIdentifier($idType, $idValue) {
            global $logger;

            $employeeIdMapping = $this -> loadFromemployeeIdMapping($idType, $idValue);
            if (empty($employeeIdMapping [0])) {
                throw new employeeNotFoundException($idType, $idValue);
            }

            try {
                $result = $this -> delete($employeeIdMapping [0] ['uuid']);
            } catch (employeeNotFoundException $e) {
                /* In case of an entry in the `employee_id_mapping` table but not in the `employees` collection */
                throw new employeeNotFoundException($idType, $idValue, null, $e);
            } catch (Exception $e) {
                throw $e;
            }
            return $result;
        }


        public function load($uuidValues) {
            global $logger;
            $employeeObjs = $output = array();

            $logger -> debug ("Selecting collection: employees");
            $this -> mongo -> selectCollection('employees');     

            /*if (sizeof($uuidValues) == 1) {*/
                $employee = $this -> mongo -> findByObjectId($uuidValues );

                
                //if (empty($employee)) 
                  //  $output ['failures'] ['uuid'] [] = $uuidValues [0];

                //$output ['result'] [$uuidValues [0]] = $employee;
           /* } else {
                $output = $this -> mongo -> findManyByObjectIdAndOrgId($uuidValues, $orgId, $projection);

                $failures = $output ['failures'];
                unset($output ['failures']);
                if (! empty($failures))
                    $output ['failures'] ['uuid'] = $failures;
            }*/

           /* $employees = $output ['result'];
            unset($output ['result']);
            foreach ($employees as $uuid => $employee) {
                $output ['result'] [] = employee :: deserialize($employee);
            }*/
           
            return new employee($employee['firstName'], $employee['lastName'],null, null, null, null, null, 
                                            $employee['mobile'],null, null, null, $employee['skills'], $employee['experience'], null,
                                            $employee['currentWorkingCity'], $employee['currentWorkingArea'], $employee['preferredWorkingCity'],$employee['preferredWorkingArea'],null, null, null, null, null,
                                            $employee['gender'], $employee['timings'], $employee['home_town'], $employee['remarks'], $employee['police'], $employee['agentId'], 
                                            $employee['addedOn'], $employee['lastUpdateOn'], $employee['_id']->{'$id'});
        }

        public function loadByExternalIdentifier($idType, $idValues, $orgId = null, $projection = null) {
            global $logger;
            $employeeObj = null;

            $mappingOutput = $this -> employeeIdDAO 
                                -> queryBySameTypeButMultipleIdentifiers($idType, $idValues);
            try {
                if (! empty($mappingOutput ['result'])) {
                    $uuids = array_keys($mappingOutput ['result']);
                    $employeesOutput = $this -> load($uuids, $orgId, $projection);
                }
                if (! empty($employeesOutput ['failures'] ['uuid'])) {
                    foreach ($employeesOutput ['failures'] ['uuid'] as $uuid) {
                        $mappingOutput ['failures'] [$idType] [] = 
                            $mappingOutput ['result'] [$uuid] ['idValue'];
                    }
                }
            } catch (Exception $e) {
                throw $e;
            }

            return array (
                'failures' => $mappingOutput ['failures'],
                'result' => $employeesOutput ['result']
            );
        }

        public function loadByMultipleIdentifiers($identifiers, $orgId = null, $projection = null) {
            global $logger;
            $employeeObj = null;

            $mappingOutput = $this -> employeeIdDAO 
                                -> queryByMultipleTypesAndMultipleIdentifiers($identifiers);

            try {
                $uuids = array_keys($mappingOutput ['result']);
                $employeesOutput = $this -> load($uuids, $orgId, $projection);

                if (! empty($employeesOutput ['failures'] ['uuid'])) {
                    foreach ($employeesOutput ['failures'] ['uuid'] as $uuid) {
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
                'result' => $employeesOutput ['result']
            );
        }        
        
        public function loadByProfileAttribute($profileAttributeName, $profileAttributeValue) {}
        
        public function loadAll() {
            global $logger;
            $employees = $mongoemployees = null;

            $logger -> debug ("Selecting collection: employees");
            $this -> mongo -> selectCollection('employees');     

            $mongoemployees = $this -> mongo -> find(array());
            foreach ($mongoemployees as $mongoemployee) {
                $employees [] = employee :: deserialize($mongoemployee);
            }
            
            return $employees;
        }
        
        public function loadAllInOrderOf($sortByKey) {
            global $logger;
            $employees = $mongoemployees = null;

            $logger -> debug ("Selecting collection: employees");
            $this -> mongo -> selectCollection('employees');     

            $mongoemployees = $this -> mongo -> find(array(), array('$sortByKey' => 1));
            foreach ($mongoemployees as $mongoemployee) {
                $employees [] = employee :: deserialize($mongoemployee);
            }
            
            return $employees;
        }
                
        public function loadFromemployeeIdMapping($idType, $idValue) {
            return $this -> employeeIdDAO -> queryByIdentifierTypeValue ($idType, $idValue);
        }

        private function checkIfAllNewIdentifiers ($identifiers) {
            global $logger;
            $logger -> debug("CHECK - If any of the identifiers already exists in employee_id_mapping relation");
            
            $result = $employeeIdMappings = $conflictCases = $uuids = array();
            $previousUniqueCount = $currentUniqueCount = 0;
            foreach ($identifiers as $idType => $idValues) {

                foreach ($idValues as $idValue) {
                
                    $employeeIdMapping = $this -> loadFromemployeeIdMapping($idType, $idValue);
                    $logger -> debug("CHECK Result - " . json_encode($employeeIdMapping));

                    if (isset($employeeIdMapping [0] ['uuid'])) {
                        $uuids [] = $employeeIdMapping [0] ['uuid'];

                        $uuids = array_unique($uuids);
                        $currentUniqueCount = count($uuids);
                        if ($currentUniqueCount > $previousUniqueCount) {
                            $conflictCases [] = $employeeIdMapping [0];
                        }
                        $previousUniqueCount = $currentUniqueCount;
                    }

                    $employeeIdMappings[] = $employeeIdMapping [0];
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
                $result ['employeeIdMappings'] = $employeeIdMappings;
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

        public function loademployeeInConflict($conflictemployeeUuid) {
            global $logger;

            $logger -> debug ("Selecting collection: conflictemployees");
            $this -> mongo -> selectCollection('conflictemployees');     

            $conflictemployee = $this -> mongo -> findByObjectId($conflictemployeeUuid);

            $conflictemployeeObj = employee :: deserialize($conflictemployee);
            return $conflictemployeeObj;
        }

        public function loadAllemployeesInConflict() {
            global $logger;
            $employeesInConflict = $mongoemployeesInConflict = null;

            $logger -> debug ("Selecting collection: conflictemployees");
            $this -> mongo -> selectCollection('conflictemployees');     

            $mongoemployeesInConflict = $this -> mongo -> find(array());
            foreach ($mongoemployeesInConflict as $mongoemployeeInConflict) {
                $employeesInConflict [] = employee :: deserialize($mongoemployeeInConflict);
            }
            
            return $employeesInConflict;
        }

        public function insertemployee($custToInsert) {

            global $logger;    
            $logger -> debug("Insert the employee into `employees` collection");

            $logger -> debug ("Selecting collection: employees");
            $this -> mongo -> selectCollection('employees');

            $logger -> debug("Mongo employee: " . json_encode($custToInsert));
            $result = $this -> mongo -> insert($custToInsert); 
            $logger -> debug("Result: " . $result ['ok']);

            return $result;
        }

        private function mapemployeeIdentifiers($identifiers, $uuid) {
            global $logger;
            $identifierMappings = $result = array();
            $logger -> debug("Map all the identifiers against UUID: $uuid");

            foreach ($identifiers as $idType => $idValues) {

                foreach ($idValues as $idValue) {
                
                    $result = $this -> employeeIdDAO -> insert($uuid, $idType, $idValue);
                    $logger -> debug("Result - " . json_encode($result));
                    
                    if (! $result) {
                        require_once 'exceptions/DuplicateEntityException.class.php';
                        throw new DuplicateEntityException (
                            "employee with '$idType' '$idValue' already exists in the system");
                    }
                    $identifierMappings [$result] = array($idType => $idValue);
                }
            } 
            return $identifierMappings;
        }

        public function insertConflict($conflictUuid, $conflictCases) {

            global $logger;    
            $logger -> debug("Insert the conflicted employee into `conflictedemployees` and get it's UUID");

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

        public function insertemployeeInConflict($custToInsert) {

            global $logger;    
            $logger -> debug("Insert the conflicted employee into `conflictedemployees` and get it's UUID");
            
            $logger -> debug ("Selecting collection: conflictemployees");
            $this -> mongo -> selectCollection('conflictemployees');

            $logger -> debug("Mongo Conflicted employee: " . json_encode($custToInsert));
            $result = $this -> mongo -> insert($custToInsert); 
            $logger -> debug("Result: " . $result ['ok']);

            return $result;
        }

        public function insertRawdata($raw) {

            global $logger;    
            $logger -> debug("Insert the raw data into the 'employeesInput' collection");

            $this -> mongo -> selectCollection('employeesInput');
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