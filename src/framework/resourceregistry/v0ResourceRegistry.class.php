<?php

	/**
	 * @author Rahul Lahoria
	 */

	require_once 'ResourceRegistry.interface.php';

    class v0ResourceRegistry implements ResourceRegistry{

        private $resource = null;

        public function lookupResource ($resourceType) {

            switch($resourceType) {

                case '/user': 
                    require_once 'resources/UserResource.class.php';
                    $this -> resource = new UserResource();
                break;
            	
                case '/services': 
                    require_once 'resources/ServicesResource.class.php';
                    $this -> resource = new ServicesResource();
                break;

                case '/service_request': 
                    require_once 'resources/ServiceRequestResource.class.php';
                    $this -> resource = new ServiceRequestResource();
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
