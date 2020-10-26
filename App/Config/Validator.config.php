<?php 
	/**
     * this is the root validator file
     * package built by 
     * @Orutu Akposieyefa Williams
     * Twitter => @Orutu_AW
     * Phone => 08100788859
     * Email => orutu1@gmail.com
    */
	class Validator
	{
	    private static $_errors = [];

        /***
         * @param $request
         * @param array $rules
         * Core Validator Method
         */
	    public static function coreValidator($request, $rules = [] )
	    {
	        foreach($request as $item => $item_value) {

	            if (key_exists($item, $rules)) {

	                foreach($rules[$item] as $rule => $rule_value) {

	                    if (is_int($rule))
	                         $rule = $rule_value;
	                    switch ($rule) {

	                        case 'required':
		                        if(empty($item_value) && $rule_value) {
		                            self::addError($item,ucwords($item). ' required');
		                        }
	                        break;

	                        case 'min':
		                        if (strlen($item_value) < $rule_value) {
		                            self::addError($item, ucwords($item). ' should be minimum '.$rule_value. ' characters');
		                        }       
	                        break;

	                        case 'max':
		                        if (strlen($item_value) > $rule_value) {
		                            self::addError($item, ucwords($item). ' should be maximum '.$rule_value. ' characters');
		                        }
	                        break;

	                        case 'numeric':
		                        if (!ctype_digit($item_value) && $rule_value) {
		                            self::addError($item, ucwords($item). ' should be numeric');
		                        }
							break;
							
	                        case 'alpha':
		                        if (!ctype_alpha($item_value) && $rule_value) {
		                            self::addError($item, ucwords($item). ' should be alphabetic characters');
		                        }
							break;
							
	                        case 'email':
		                        if (!filter_var($item_value, FILTER_VALIDATE_EMAIL) && $rule_value) {
		                            self::addError($item, ucwords($item). ' must be valid');
		                        }
							break;
							
	                        case 'trim':
		                        trim($item_value);
							break;
							
	                        case 'strip':
		                        stripcslashes($item_value);
							break;
							
	                        case 'html':
		                        htmlspecialchars($item_value);
		                    break;
	                    }
	                }
	            }
			} 
			  
	    }//End of validation 

        /***
         * @param $item
         * @param $error
         * Add Error Method
         */
	    private static function addError($item, $error)
	    {
	        self::$_errors[$item][] = $error;
	    }//End


        /***
         * @return array|false
         * Error Check Method
         */
	    public static function error()
	    {
	        if (empty(self::$_errors)) {
	        	return false;
	        } else {
                return self::$_errors;
	        }
	    }//End


        /***
         * @param $errors
         * Error Loop Method
         */
	    public static  function errorLoop($errors)
        {
            ?>
            <div class="alert alert-danger">
                <ol>
                <?php
                    foreach ($errors as $errorList) {
                        ?>
                            <li class="text-danger">
                                <?php
                                    echo  json_encode($errorList);
                                ?>
                            </li>
                        <?php
                    }?>
                </ol>
            </div>
                <?php
        }//End

	}
