<?php

/**
 * Exception for invalid email
 * 
 * @package	oGravatar
 * @subpackage exceptions
 * @author	André Filipe <andre.r.flip@gmail.com>
 * @license	MIT
 * @version	1.0
 */
class oGravatarInvalidEmailException extends Exception
{
	public function __construct($message = '', $code = 0, $previous = null) {

    	if (!$message) {
       		$message = "Invalid email.";
    	}
        parent::__construct($message, $code, $previous);
    }
}