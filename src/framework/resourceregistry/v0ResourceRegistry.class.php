<?php

	/**
	 * @author Rahul Lahoria
	 */

	require_once 'ResourceRegistry.interface.php';

    class v0ResourceRegistry implements ResourceRegistry{

        private $resource = null;

        public function lookupResource ($resourceType) {

            switch($resourceType) {

                case '/users': 
                    require_once 'resources/UsersResource.class.php';
                    $this -> resource = new UsersResource();
                break;
            	
                case '/employees': 
                    require_once 'resources/EmployeesResource.class.php';
                    $this -> resource = new EmployeesResource();
                break;

                case '/services': 
                    require_once 'resources/ServicesResource.class.php';
                    $this -> resource = new ServicesResource();
                break;

                case '/service_request': 
                    require_once 'resources/ServiceRequestResource.class.php';
                    $this -> resource = new ServiceRequestResource();
                break;

                case '/workers': 
                    require_once 'resources/WorkersResource.class.php';
                    $this -> resource = new WorkersResource();
                break;

                case '/feedback/workers': 
                    require_once 'resources/FeedbackWorkerResource.class.php';
                    $this -> resource = new FeedbackWorkerResource();
                break;

                case '/feedback/users': 
                    require_once 'resources/FeedbackUserResource.class.php';
                    $this -> resource = new FeedbackUserResource();
                break;

                case '/match': 
                    require_once 'resources/MatchResource.class.php';
                    $this -> resource = new MatchResource();
                break;

                case '/followback/workers': 
                    require_once 'resources/FollowbackWorkerResource.class.php';
                    $this -> resource = new FollowbackWorkerResource();
                break;
                
                case '/followback/users': 
                    require_once 'resources/FollowbackUserResource.class.php';
                    $this -> resource = new FollowbackUserResource();
                break;

                default:
                    require_once 'exceptions/UnsupportedResourceTypeException.class.php';
            		throw new UnsupportedResourceTypeException();
                break;
            }
        	return $this -> resource;
        }

        public function toString() {
            return "Resource: " . $this -> resource;
        }
    }
