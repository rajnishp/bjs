<?php

    /**
     * @author Jessy James
     */

    class InternalStatuses {
        
        public static $list = array(

            /* [800 - 899] - Database Exceptions */
            '800' => array('httpStatusCode' => 500, 
                            'message' => 'Mongo Database Error', 'otherHeaders' => array()), 

            /* [900 - 999] - Database Exceptions */
            '900' => array('httpStatusCode' => 500, 
                            'message' => 'MySQL Database Error', 'otherHeaders' => array()), 
            '902' => array('httpStatusCode' => 400, 
                            'message' => 'Invalid Attribute Type ', 'otherHeaders' => array()), 


            '903' => array('httpStatusCode' => 400, 
                            'message' => 'Invalid time for reminder ', 'otherHeaders' => array()),

            /* [1000 - 1004] - Authorization Exceptions  */
            '1000' => array('httpStatusCode' => 400, 
                            'message' => 'Authentication Required for Nucleus API Access; See http://nucleus.capillary.in/docs',
                            'otherHeaders' => array('WWW-Authenticate: Basic realm="Capillary Nucleus Restricted"')
            ), 


            /* [1005 - 1009] - Request / Payload Exceptions  */
            '1005' => array('httpStatusCode' => 400, 
                            'message' => 'Data In Unsupported Format', 'otherHeaders' => array()),
            '1006' => array('httpStatusCode' => 400, 
                            'message' => 'Malformed Request Data Sent', 'otherHeaders' => array()),
            '1007' => array('httpStatusCode' => 404, 
                            'message' => 'Unsupported API Version Requested', 'otherHeaders' => array()),
            '1008' => array('httpStatusCode' => 404, 
                            'message' => 'Unsupported Resource Requested', 'otherHeaders' => array()),
            '1009' => array('httpStatusCode' => 404, 
                            'message' => 'Unsupported Resource Method Requested', 'otherHeaders' => array()),
            '1010' => array('httpStatusCode' => 400, 
                            'message' => 'Required Parameters Missing', 'otherHeaders' => array()),
            '1011' => array('httpStatusCode' => 409, 
                            'message' => 'Entity Already Exists', 'otherHeaders' => array()),


            /* [2000 - 2999] - Channel Resource Exceptions  */
            '2000' => array('httpStatusCode' => 200, 
                            'message' => 'Channel Fetched', 'otherHeaders' => array()),
            '2001' => array('httpStatusCode' => 200, 
                            'message' => 'Channel Created', 'otherHeaders' => array()),
            '2002' => array('httpStatusCode' => 200, 
                            'message' => 'Channel Updated', 'otherHeaders' => array()),
            '2003' => array('httpStatusCode' => 200, 
                            'message' => 'Channel Deleted', 'otherHeaders' => array()),
            '2004' => array('httpStatusCode' => 404, 
                            'message' => 'Channel Not Found', 'otherHeaders' => array()),
            '2010' => array('httpStatusCode' => 500, 
                            'message' => 'Channel Could Not Be Fetched', 'otherHeaders' => array()),
            '2011' => array('httpStatusCode' => 500, 
                            'message' => 'Channel Could Not Be Created', 'otherHeaders' => array()),
            '2012' => array('httpStatusCode' => 500, 
                            'message' => 'Channel Could Not Be Updated', 'otherHeaders' => array()),
            '2013' => array('httpStatusCode' => 500, 
                            'message' => 'Channel Could Not Be Deleted', 'otherHeaders' => array()),


            /* [3000 - 3999] - Validator Exceptions  */
            '3000' => array('httpStatusCode' => 200, 
                            'message' => 'Validator Fetched', 'otherHeaders' => array()),
            '3001' => array('httpStatusCode' => 200, 
                            'message' => 'Validator Created', 'otherHeaders' => array()),
            '3002' => array('httpStatusCode' => 200, 
                            'message' => 'Validator Updated', 'otherHeaders' => array()),
            '3003' => array('httpStatusCode' => 200, 
                            'message' => 'Validator Deleted', 'otherHeaders' => array()),
            '3004' => array('httpStatusCode' => 404, 
                            'message' => 'Validator Not Found', 'otherHeaders' => array()),
            '3010' => array('httpStatusCode' => 500, 
                            'message' => 'Validator Could Not Be Fetched', 'otherHeaders' => array()),
            '3011' => array('httpStatusCode' => 500, 
                            'message' => 'Validator Could Not Be Created', 'otherHeaders' => array()),
            '3012' => array('httpStatusCode' => 500, 
                            'message' => 'Validator Could Not Be Updated', 'otherHeaders' => array()),
            '3013' => array('httpStatusCode' => 500, 
                            'message' => 'Validator Could Not Be Deleted', 'otherHeaders' => array()),
            '3015' => array('httpStatusCode' => 400, 
                            'message' => 'Validation Failed', 'otherHeaders' => array()),

            /*'3100' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3101' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3102' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3103' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3104' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3105' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3106' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3107' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3108' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3109' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3110' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3111' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3112' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3113' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3114' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3115' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3116' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3117' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3118' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),
            '3119' => array('httpStatusCode' => 400, 
                            'message' => 'Failed To Validate Field', 'otherHeaders' => array()),*/

            /* [4000 - 4999] - Data-Field-Type Resource Exceptions  */
            '4000' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field-Type Fetched', 'otherHeaders' => array()),
            '4001' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field-Type Created', 'otherHeaders' => array()),
            '4002' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field-Type Updated', 'otherHeaders' => array()),
            '4003' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field-Type Deleted', 'otherHeaders' => array()),
            '4004' => array('httpStatusCode' => 404, 
                            'message' => 'Data-Field-Type Not Found', 'otherHeaders' => array()),
            '4010' => array('httpStatusCode' => 500, 
                            'message' => 'Data-Field-Type Could Not Be Fetched', 'otherHeaders' => array()),

            /* [5000 - 5999] - Data-Field Resource Exceptions  */
            '5000' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field Fetched', 'otherHeaders' => array()),
            '5001' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field Created', 'otherHeaders' => array()),
            '5002' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field Updated', 'otherHeaders' => array()),
            '5003' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field Deleted', 'otherHeaders' => array()),
            '5004' => array('httpStatusCode' => 404, 
                            'message' => 'Data-Field Not Found', 'otherHeaders' => array()),
            '5005' => array('httpStatusCode' => 404, 
                            'message' => 'Data-Field-Type Not Found', 'otherHeaders' => array()),
            '5006' => array('httpStatusCode' => 404, 
                            'message' => 'Data-Field-Validator Not Found', 'otherHeaders' => array()),
            '5010' => array('httpStatusCode' => 500, 
                            'message' => 'Data-Field Could Not Be Fetched', 'otherHeaders' => array()),
            '5011' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field Could Not Be Created', 'otherHeaders' => array()),
            '5012' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field Could Not Be Updated', 'otherHeaders' => array()),
            '5013' => array('httpStatusCode' => 200, 
                            'message' => 'Data-Field Could Not Be Deleted', 'otherHeaders' => array()),


            /* [6000 - 6999] - Organization Resource Exceptions  */
            '6000' => array('httpStatusCode' => 200, 
                            'message' => 'Organization Fetched', 'otherHeaders' => array()),
            '6001' => array('httpStatusCode' => 200, 
                            'message' => 'Organization Created', 'otherHeaders' => array()),
            '6002' => array('httpStatusCode' => 200, 
                            'message' => 'Organization Updated', 'otherHeaders' => array()),
            '6003' => array('httpStatusCode' => 200, 
                            'message' => 'Organization Deleted', 'otherHeaders' => array()),
            '6004' => array('httpStatusCode' => 404, 
                            'message' => 'Organization Not Found', 'otherHeaders' => array()),


            /* [6100 - 6199] - Organization-Channel Resource Exceptions  */
            '6100' => array('httpStatusCode' => 200, 
                            'message' => 'Organization-Channel Fetched', 'otherHeaders' => array()),
            '6104' => array('httpStatusCode' => 404, 
                            'message' => 'Organization-Channel Not Found', 'otherHeaders' => array()),
            '6105' => array('httpStatusCode' => 404, 
                            'message' => 'Organization Not Found', 'otherHeaders' => array()),
            '6106' => array('httpStatusCode' => 404, 
                            'message' => 'Channel Not Found', 'otherHeaders' => array()),


            /* [6200 - 6299] - Organization-Channel-Field Resource Exceptions  */
            '6200' => array('httpStatusCode' => 200, 
                            'message' => 'Organization-Channel-Field Fetched', 'otherHeaders' => array()),
            '6201' => array('httpStatusCode' => 200, 
                            'message' => 'Organization-Channel-Field Created', 'otherHeaders' => array()),
            '6202' => array('httpStatusCode' => 200, 
                            'message' => 'Organization-Channel-Field Updated', 'otherHeaders' => array()),
            '6203' => array('httpStatusCode' => 200, 
                            'message' => 'Organization-Channel-Field Deleted', 'otherHeaders' => array()),
            '6204' => array('httpStatusCode' => 404, 
                            'message' => 'Organization-Channel-Field Not Found', 'otherHeaders' => array()),
            '6205' => array('httpStatusCode' => 404, 
                            'message' => 'Organization Not Found', 'otherHeaders' => array()),
            '6206' => array('httpStatusCode' => 404, 
                            'message' => 'Channel Not Found', 'otherHeaders' => array()),
            '6207' => array('httpStatusCode' => 404, 
                            'message' => 'Data-Field Not Found', 'otherHeaders' => array()),
            '6208' => array('httpStatusCode' => 404, 
                            'message' => 'Validator Not Found', 'otherHeaders' => array()),


            /* [7000 - 7799] - Customer Resource Exceptions  */
            '7000' => array('httpStatusCode' => 200, 
                            'message' => 'Customer Fetched', 'otherHeaders' => array()),
            '7001' => array('httpStatusCode' => 200, 
                            'message' => 'Customer Created', 'otherHeaders' => array()),
            '7002' => array('httpStatusCode' => 200, 
                            'message' => 'Customer Updated', 'otherHeaders' => array()),
            '7003' => array('httpStatusCode' => 200, 
                            'message' => 'Customer Deleted', 'otherHeaders' => array()),
            '7004' => array('httpStatusCode' => 404, 
                            'message' => 'Customer Not Found', 'otherHeaders' => array()),
            '7005' => array('httpStatusCode' => 404, 
                            'message' => 'Organization Not Found', 'otherHeaders' => array()),
            '7006' => array('httpStatusCode' => 404, 
                            'message' => 'Channel Not Found', 'otherHeaders' => array()),
            '7007' => array('httpStatusCode' => 404, 
                            'message' => 'Source Not Found', 'otherHeaders' => array()),
            '7008' => array('httpStatusCode' => 404, 
                            'message' => 'Org-Data-Field Not Found', 'otherHeaders' => array()),
            '7009' => array('httpStatusCode' => 404, 
                            'message' => 'Org-Data-Field-Validator Not Found', 'otherHeaders' => array()),

            /* [7800 - 7899] - Conflicts Resource Exceptions  */
            '7800' => array('httpStatusCode' => 200, 
                            'message' => 'Conflict Fetched', 'otherHeaders' => array()),
            '7801' => array('httpStatusCode' => 200, 
                            'message' => 'Conflict Created', 'otherHeaders' => array()),
            '7802' => array('httpStatusCode' => 200, 
                            'message' => 'Conflict Updated', 'otherHeaders' => array()),
            '7803' => array('httpStatusCode' => 200, 
                            'message' => 'Conflict Deleted', 'otherHeaders' => array()),
            '7804' => array('httpStatusCode' => 404, 
                            'message' => 'Conflict Not Found', 'otherHeaders' => array()),

            /* [7900 - 7999] - Customer Resource Exceptions  */
            '7900' => array('httpStatusCode' => 200, 
                            'message' => 'Customer-in-conflict Fetched', 'otherHeaders' => array()),
            '7901' => array('httpStatusCode' => 200, 
                            'message' => 'Customer-in-conflict Created', 'otherHeaders' => array()),
            '7902' => array('httpStatusCode' => 200, 
                            'message' => 'Customer-in-conflict Updated', 'otherHeaders' => array()),
            '7903' => array('httpStatusCode' => 200, 
                            'message' => 'Customer-in-conflict Deleted', 'otherHeaders' => array()),
            '7904' => array('httpStatusCode' => 404, 
                            'message' => 'Customer-in-conflict Not Found', 'otherHeaders' => array()),
        );
    }