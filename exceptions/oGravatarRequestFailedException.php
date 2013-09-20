<?php

/**
 * Exception for failed requests
 * 
 * @package	oGravatar
 * @subpackage exceptions
 * @author	André Filipe <andre.r.flip@gmail.com>
 * @license	MIT
 * @version	1.0
 */
class oGravatarRequestFailedException extends Exception
{
	public function __construct($message = '', $code = 0, $previous = null) {

    	if (!$message) {
       		$message = "Failed to request profile info.";
    	}
        parent::__construct($message, $code, $previous);
    }
}