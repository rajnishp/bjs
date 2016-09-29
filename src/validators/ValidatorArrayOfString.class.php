<?php
/**
 * check only [a-z] or [A-Z] present 
 *
 * @author: Rahul Lahoria (rahul_lahoria@capillarytech.com)
 * @date: 16.12.2014
 */
class ValidatorArrayOfString implements Validator{

	/**not Done
	 *
	 * @param string $value 
	 * @Return same value or exception 
	 */
	public function validate($value){
		if($value === null)
			throw new InvalidAttributeTypeException('3100', " $value  is null");
			//throw new Exception($value.' is null');
		
		if(is_array($value)){
			
			foreach ($value as $element) {
    			
    			if (!is_string($element)) 
        			//throw new Exception(" invalid value for $value ");
        			/*throw new InvalidAttributeTypeException('3102', " invalid value for $value ");*/
                    throw new ValidationFailedException(get_class(), $value);
    			
			}
		
			return $value;
		}
 				
 		//throw new Exception(" invalid value for $value ");
 		throw new InvalidAttributeTypeException('3100', " invalid value for $value ");

	}

}

?>