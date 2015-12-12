<?php

/**
 * DAOFactory
 * @author: rajnish
 * @date: ${date}
 */
require_once('utils/sql/Connection.class.php');
require_once('utils/sql/ConnectionFactory.class.php');
require_once('utils/sql/ConnectionProperty.class.php');
require_once('utils/sql/QueryExecutor.class.php');
require_once('utils/sql/Transaction.class.php');
require_once('utils/sql/SqlQuery.class.php');
require_once('utils/ArrayList.class.php');

class DAOFactory{

	/**
	 * @return ServiceRequestsDAO
	 */
	public static function getServiceRequestDAO(){
		
		require_once('ServiceRequestsDAO.interface.php');
		require_once('models/ServiceRequest.class.php');
		require_once('mongo/ServiceRequestsMongoDAO.class.php');

		return new ServiceRequestsMongoDAO();
	}

	public static function getGetInTouchDAO(){
		
		require_once('GetInTouchDAO.interface.php');
		require_once('models/GetInTouch.class.php');
		require_once('mongo/GetInTouchMongoDAO.class.php');

		return new GetInTouchMongoDAO();
	}

	//getServicesDAO

	public static function getServicesDAO(){
		
		require_once('ServicesDAO.interface.php');
		require_once('models/Service.class.php');
		require_once('mongo/ServicesMongoDAO.class.php');

		return new ServicesMongoDAO();
	}

	//getUsersDAO
	public static function getUsersDAO(){
		
		require_once('UsersDAO.interface.php');
		require_once('models/User.class.php');
		require_once('mongo/UsersMongoDAO.class.php');

		return new UsersMongoDAO();
	}

	//getServiceRequestsDAO()

	public static function getServiceRequestsDAO(){
		
		require_once('ServiceRequestsDAO.interface.php');
		require_once('models/ServiceRequest.class.php');
		require_once('mongo/ServiceRequestsMongoDAO.class.php');

		return new ServiceRequestsMongoDAO();
	}

	//getWorkersDAO

	public static function getWorkersDAO(){
		
		require_once('WorkersDAO.interface.php');
		require_once('models/Worker.class.php');
		require_once('mongo/WorkersMongoDAO.class.php');

		return new WorkersMongoDAO();
	}

}
?>