<?php

	/**
     * @author rajnish
	**/
    
    require_once 'dao/WorkersDAO.interface.php';
    require_once 'models/Worker.class.php';

    require_once 'utils/mongo/MongoDBUtil.class.php';
    require_once 'exceptions/MongoDbException.class.php';
    require_once 'exceptions/DuplicateEntityException.class.php';

	class WorkersMongoDAO implements WorkersDAO {

        private $mongo;
        
        public function __construct () {
            $this -> mongo = new MongoDBUtil(array('db_name' => 'blueteam'));
            $this -> mongo -> init();

        }

        public function insert($workerObj) {
            global $logger, $warnings_payload;

            $logger -> debug("Insert the worker details into `workers` collection");

            $logger -> debug ("Selecting collection: workers");
            $this -> mongo -> selectCollection('workers');


            $logger -> debug("Mongo Worker: " . json_encode($workerObj->toArray() ));
            $result = $this -> mongo -> insert($workerObj->toArray()); 
            $logger -> debug("Result: " . $result ['ok']);

            return $result;

            //return $return;
        }

        public function countFreeWorkers(){

                try {
                    $this -> mongo -> selectCollection('workers');
                    return count($this -> mongo -> find(array('status' => 1)));


                } catch(Exception $e) {
                    throw $e;
                }

        }

        public function multiInsert($workerObjs, $raw) {

            $inserts = $conflicts = $duplicates = array();

            foreach ($workerObjs as $key => $workerObj) {
                try {
                    $result = $this -> insert($workerObj);

                    if ($result ['conflict']) {
                        $inserts [$key] = $result ['worker'];
                    } else {
                        $conflicts [$key] = $result ['worker'];
                    }
                } catch(DuplicateworkerException $e) {
                    $duplicates [$key] = array(
                        'existingUuid' => $e -> getExistingworkerUuid(), 
                        'worker' => $workerObj
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


        public function loadAllWorkers() {
            global $logger;
            //$allWorkers = $mongoworkersInConflict = null;

            $logger -> debug ("Selecting collection: workers");
            $this -> mongo -> selectCollection('workers');     

            $mongoWorkers = $this -> mongo -> find(array());
            //$timings, $home_town, $remarks, $police, $agentId, $addedOn, $lastUpdateOn, $uuid = null
            foreach ($mongoWorkers as $worker) {

                $allWorkers [] = new Worker($worker['firstName'], $worker['lastName'],null, null, null, null, null, 
                                            $worker['mobile'],null, null, null, $worker['skills'], $worker['experience'], null,
                                            $worker['currentWorkingCity'], $worker['currentWorkingArea'], $worker['preferredWorkingCity'],$worker['preferredWorkingArea'],null, null, null, null, null,
                                            $worker['gender'], $worker['timings'], $worker['home_town'], $worker['remarks'], $worker['police'], $worker['agentId'], 
                                            $worker['addedOn'], $worker['lastUpdateOn'], $worker['_id']->{'$id'});
            }
            
            return $allWorkers;
        }

        public function loadAgentWorkers($agentId) {
            // This function will load workers only added by logged-in agent
            global $logger;
            //$allWorkers = $mongoworkersInConflict = null;

            $logger -> debug ("Selecting collection: workers");
            $this -> mongo -> selectCollection('workers');     


            $agentQuery = array('agentId' => $agentId);

            $agentWorkers = $this -> mongo -> find(array($agentQuery));

            foreach ($agentWorkers as $worker) {
                $agentWorkers [] = new Worker($worker['firstName'], $worker['lastName'],null, null, null, null, null, 
                                            $worker['mobile'],null, null, null, $worker['skills'], $worker['experience'], null,
                                            $worker['currentWorkingCity'], $worker['currentWorkingArea'], $worker['preferredWorkingCity'],$worker['preferredWorkingArea'],null, null, null, null, null,
                                            $worker['gender'], null, null, null);
            }
            
            return $agentWorkers;
        }

        public function update($worker, $raw) {
            global $logger, $warnings_payload;
            $workerResult = $deleteIdentifierMappings = $identifierMappingsResult = $rawResult = array(); 

            try {
                $logger -> debug ("Selecting collection: workers");
                $this -> mongo -> selectCollection('workers');

                $uuid = $worker -> getUuid();
                $custToUpdate = $worker -> serialize();
                $logger -> debug("Mongo worker: " . json_encode($custToUpdate));
                $workerResult = $this -> mongo -> updateByObjectId($uuid, $custToUpdate); 
                $logger -> debug("Result: " . $result ['ok']);

                if ($workerResult ['ok']) {
                    $existingIds = array();
                    $existingIdentifierMappings = $this -> workerIdDAO -> load($uuid);
                    foreach ($existingIdentifierMappings as $mapping) {
                        $existingIds [$mapping ['idType']] [] = $mapping ['idValue'];
                    }

                    $nonExistantIds = array();
                    $currentIds = $worker -> getIdentifiers();
                    foreach ($currentIds as $idType => $idValues) {
                        foreach ($idValues as $idValue) {
                            if (! in_array($idValue, $existingIds [$idType])) {
                                $nonExistantIds [$idType] [] = $idValue;
                            }
                        }
                    }

                    $newIdentifierMappingsResult = $this -> mapworkerIdentifiers($nonExistantIds, $uuid);
                    $logger -> debug("New Identifiers Mapped: " . json_encode($newIdentifierMappingsResult));
                }

                if ($workerResult ['ok']) {
                    if ($raw) {
                        $rawResult = $this -> insertRawdata($raw);
                    }
                } else {
                    throw new workerNotFoundException($uuid);
                }
            } catch(MongoException $e) {
                $logger -> error("MongoException: " . $e -> getMessage());
                throw new MongoDbException($e, $e);
            } catch(Exception $e) {
                throw $e;
            }

            return $worker;
        }  


        public function delete($uuid) {
            global $logger;

            $logger -> debug ("Selecting collection: workers");
            $this -> mongo -> selectCollection('workers');     

            $result = $this -> mongo -> removeByObjectId($uuid);

            if ($result ['ok'] && $result ['n'] > 0) 
                $hasBeenDeleted = true;
            else if ($result ['ok'] && $result ['n'] == 0)
                throw new workerNotFoundException('uuid', $uuid);
            else 
                $hasBeenDeleted = false;

            if ($hasBeenDeleted) {
                return $this -> workerIdDAO -> delete($uuid);
            }

            return $hasBeenDeleted;
        }
        
        public function deleteByOtherIdentifier($idType, $idValue) {
            global $logger;

            $workerIdMapping = $this -> loadFromworkerIdMapping($idType, $idValue);
            if (empty($workerIdMapping [0])) {
                throw new workerNotFoundException($idType, $idValue);
            }

            try {
                $result = $this -> delete($workerIdMapping [0] ['uuid']);
            } catch (workerNotFoundException $e) {
                /* In case of an entry in the `worker_id_mapping` table but not in the `workers` collection */
                throw new workerNotFoundException($idType, $idValue, null, $e);
            } catch (Exception $e) {
                throw $e;
            }
            return $result;
        }


        public function load($uuidValues) {
            global $logger;
            $workerObjs = $output = array();

            $logger -> debug ("Selecting collection: workers");
            $this -> mongo -> selectCollection('workers');     

            /*if (sizeof($uuidValues) == 1) {*/
                $worker = $this -> mongo -> findByObjectId($uuidValues );

                
                //if (empty($worker)) 
                  //  $output ['failures'] ['uuid'] [] = $uuidValues [0];

                //$output ['result'] [$uuidValues [0]] = $worker;
           /* } else {
                $output = $this -> mongo -> findManyByObjectIdAndOrgId($uuidValues, $orgId, $projection);

                $failures = $output ['failures'];
                unset($output ['failures']);
                if (! empty($failures))
                    $output ['failures'] ['uuid'] = $failures;
            }*/

           /* $workers = $output ['result'];
            unset($output ['result']);
            foreach ($workers as $uuid => $worker) {
                $output ['result'] [] = worker :: deserialize($worker);
            }*/
           
            return new Worker($worker['firstName'], $worker['lastName'],null, null, null, null, null, 
                                            $worker['mobile'],null, null, null, $worker['skills'], $worker['experience'], null,
                                            $worker['currentWorkingCity'], $worker['currentWorkingArea'], $worker['preferredWorkingCity'],$worker['preferredWorkingArea'],null, null, null, null, null,
                                            $worker['gender'], $worker['timings'], $worker['home_town'], $worker['remarks'], $worker['police'], $worker['agentId'], 
                                            $worker['addedOn'], $worker['lastUpdateOn'], $worker['_id']->{'$id'});
        }

        public function loadByExternalIdentifier($idType, $idValues, $orgId = null, $projection = null) {
            global $logger;
            $workerObj = null;

            $mappingOutput = $this -> workerIdDAO 
                                -> queryBySameTypeButMultipleIdentifiers($idType, $idValues);
            try {
                if (! empty($mappingOutput ['result'])) {
                    $uuids = array_keys($mappingOutput ['result']);
                    $workersOutput = $this -> load($uuids, $orgId, $projection);
                }
                if (! empty($workersOutput ['failures'] ['uuid'])) {
                    foreach ($workersOutput ['failures'] ['uuid'] as $uuid) {
                        $mappingOutput ['failures'] [$idType] [] = 
                            $mappingOutput ['result'] [$uuid] ['idValue'];
                    }
                }
            } catch (Exception $e) {
                throw $e;
            }

            return array (
                'failures' => $mappingOutput ['failures'],
                'result' => $workersOutput ['result']
            );
        }

        public function loadByMultipleIdentifiers($identifiers, $orgId = null, $projection = null) {
            global $logger;
            $workerObj = null;

            $mappingOutput = $this -> workerIdDAO 
                                -> queryByMultipleTypesAndMultipleIdentifiers($identifiers);

            try {
                $uuids = array_keys($mappingOutput ['result']);
                $workersOutput = $this -> load($uuids, $orgId, $projection);

                if (! empty($workersOutput ['failures'] ['uuid'])) {
                    foreach ($workersOutput ['failures'] ['uuid'] as $uuid) {
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
                'result' => $workersOutput ['result']
            );
        }        
        
        public function loadByProfileAttribute($profileAttributeName, $profileAttributeValue) {}
        
        public function loadAll() {
            global $logger;
            $workers = $mongoworkers = null;

            $logger -> debug ("Selecting collection: workers");
            $this -> mongo -> selectCollection('workers');     

            $mongoworkers = $this -> mongo -> find(array());
            foreach ($mongoworkers as $mongoworker) {
                $workers [] = worker :: deserialize($mongoworker);
            }
            
            return $workers;
        }
        
        public function loadAllInOrderOf($sortByKey) {
            global $logger;
            $workers = $mongoworkers = null;

            $logger -> debug ("Selecting collection: workers");
            $this -> mongo -> selectCollection('workers');     

            $mongoworkers = $this -> mongo -> find(array(), array('$sortByKey' => 1));
            foreach ($mongoworkers as $mongoworker) {
                $workers [] = worker :: deserialize($mongoworker);
            }
            
            return $workers;
        }
                
        public function loadFromworkerIdMapping($idType, $idValue) {
            return $this -> workerIdDAO -> queryByIdentifierTypeValue ($idType, $idValue);
        }

        private function checkIfAllNewIdentifiers ($identifiers) {
            global $logger;
            $logger -> debug("CHECK - If any of the identifiers already exists in worker_id_mapping relation");
            
            $result = $workerIdMappings = $conflictCases = $uuids = array();
            $previousUniqueCount = $currentUniqueCount = 0;
            foreach ($identifiers as $idType => $idValues) {

                foreach ($idValues as $idValue) {
                
                    $workerIdMapping = $this -> loadFromworkerIdMapping($idType, $idValue);
                    $logger -> debug("CHECK Result - " . json_encode($workerIdMapping));

                    if (isset($workerIdMapping [0] ['uuid'])) {
                        $uuids [] = $workerIdMapping [0] ['uuid'];

                        $uuids = array_unique($uuids);
                        $currentUniqueCount = count($uuids);
                        if ($currentUniqueCount > $previousUniqueCount) {
                            $conflictCases [] = $workerIdMapping [0];
                        }
                        $previousUniqueCount = $currentUniqueCount;
                    }

                    $workerIdMappings[] = $workerIdMapping [0];
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
                $result ['workerIdMappings'] = $workerIdMappings;
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

        public function loadworkerInConflict($conflictworkerUuid) {
            global $logger;

            $logger -> debug ("Selecting collection: conflictworkers");
            $this -> mongo -> selectCollection('conflictworkers');     

            $conflictworker = $this -> mongo -> findByObjectId($conflictworkerUuid);

            $conflictworkerObj = worker :: deserialize($conflictworker);
            return $conflictworkerObj;
        }

        public function loadAllworkersInConflict() {
            global $logger;
            $workersInConflict = $mongoworkersInConflict = null;

            $logger -> debug ("Selecting collection: conflictworkers");
            $this -> mongo -> selectCollection('conflictworkers');     

            $mongoworkersInConflict = $this -> mongo -> find(array());
            foreach ($mongoworkersInConflict as $mongoworkerInConflict) {
                $workersInConflict [] = worker :: deserialize($mongoworkerInConflict);
            }
            
            return $workersInConflict;
        }

        public function insertworker($custToInsert) {

            global $logger;    
            $logger -> debug("Insert the worker into `workers` collection");

            $logger -> debug ("Selecting collection: workers");
            $this -> mongo -> selectCollection('workers');

            $logger -> debug("Mongo worker: " . json_encode($custToInsert));
            $result = $this -> mongo -> insert($custToInsert); 
            $logger -> debug("Result: " . $result ['ok']);

            return $result;
        }

        private function mapworkerIdentifiers($identifiers, $uuid) {
            global $logger;
            $identifierMappings = $result = array();
            $logger -> debug("Map all the identifiers against UUID: $uuid");

            foreach ($identifiers as $idType => $idValues) {

                foreach ($idValues as $idValue) {
                
                    $result = $this -> workerIdDAO -> insert($uuid, $idType, $idValue);
                    $logger -> debug("Result - " . json_encode($result));
                    
                    if (! $result) {
                        require_once 'exceptions/DuplicateEntityException.class.php';
                        throw new DuplicateEntityException (
                            "worker with '$idType' '$idValue' already exists in the system");
                    }
                    $identifierMappings [$result] = array($idType => $idValue);
                }
            } 
            return $identifierMappings;
        }

        public function insertConflict($conflictUuid, $conflictCases) {

            global $logger;    
            $logger -> debug("Insert the conflicted worker into `conflictedworkers` and get it's UUID");

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

        public function insertworkerInConflict($custToInsert) {

            global $logger;    
            $logger -> debug("Insert the conflicted worker into `conflictedworkers` and get it's UUID");
            
            $logger -> debug ("Selecting collection: conflictworkers");
            $this -> mongo -> selectCollection('conflictworkers');

            $logger -> debug("Mongo Conflicted worker: " . json_encode($custToInsert));
            $result = $this -> mongo -> insert($custToInsert); 
            $logger -> debug("Result: " . $result ['ok']);

            return $result;
        }

        public function insertRawdata($raw) {

            global $logger;    
            $logger -> debug("Insert the raw data into the 'workersInput' collection");

            $this -> mongo -> selectCollection('workersInput');
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