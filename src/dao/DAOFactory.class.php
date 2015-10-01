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
		require_once('models/ServiceRequests.class.php');
		require_once('mongo/ServiceRequestsMongoDAO.class.php');

		return new ServiceRequestsMongoDAO();
	}

	public static function getGetInTouchDAO(){
		
		require_once('GetInTouchDAO.interface.php');
		require_once('models/GetInTouch.class.php');
		require_once('mongo/GetInTouchMongoDAO.class.php');

		return new GetInTouchMongoDAO();
	}

}
?>