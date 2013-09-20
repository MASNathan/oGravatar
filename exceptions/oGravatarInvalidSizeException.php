<?php

/**
 * Exception for invalid image size
 * 
 * @package	oGravatar
 * @subpackage exceptions
 * @author	André Filipe <andre.r.flip@gmail.com>
 * @license	MIT
 * @version	1.0
 */
class oGravatarInvalidSizeException extends Exception
{
	public function __construct($message = '', $code = 0, $previous = null) {

    	if (!$message) {
       		$message = "Invalid image size.";
    	}
        parent::__construct($message, $code, $previous);
    }
}