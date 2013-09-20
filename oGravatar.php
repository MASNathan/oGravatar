<?php

require_once 'exceptions/oGravatarRequestFailedException.php';
require_once 'exceptions/oGravatarInvalidEmailException.php';
require_once 'exceptions/oGravatarInvalidSizeException.php';
require_once 'exceptions/oGravatarInvalidRatingException.php';


class oGravatar
{

	/**
	 * Image rating constants
	 */
	const RATING_G 	= 'g';
	const RATING_PG = 'pg';
	const RATING_R 	= 'r';
	const RATING_X 	= 'x';
	
	/*
	 * Default images constants
	 */
	const DEFAULT_404 		= '404';
	const DEFAULT_MM 		= 'mm';
	const DEFAULT_IDEnTICON = 'identicon';
	const DEFAULT_MONSTERID = 'monsterid';
	const DEFAULT_WAVATAR 	= 'wavatar';

	/**
	 * Gravatar urls constants
	 */
	const HTTP_URL 	= 'http://en.gravatar.com';
	const HTTPS_URL = 'https://secure.gravatar.com';

	/**
	 * To be secure or not, that's the question
	 * @var boolean
	 */
	private $use_secure = false;

	/**
	 * Gravatar email
	 * @var string
	 */
	private $email = '';

	/**
	 * Gravatar email hash
	 * @var string
	 */
	private $email_hash = '';

	/**
	 * Holds the parameters to use on the avatar url
	 * @var array
	 */
	private $params = array();

	/**
	 * This is the class constructor, where the entire world is initialized
	 * @param string $email This is the email you want to find
	 * @param boolean $secure_request
	 */
	public function __construct($email, $secure_request = false)
	{
		if(!$this->isEmail($email)) {
			throw new oGravatarInvalidEmailException;
		}

		$this->email = $email;
		$this->email_hash = md5($email);
		$this->use_secure = $secure_request;
	}

	/**
	 * Returns the avatar src
	 * @return string
	 */
	public function __toString()
	{
		return $this->getAvatar();
	}

	/**
	 * Checks if the email is valid
	 * @param string $email
	 */
	private function isEmail($email)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	/**
	 * Checks if is using secure mode and returns the apropriate url
	 * @return string
	 */
	private function getSource()
	{
		if($this->use_secure) {
			return self::HTTPS_URL;
		} else {
			return self::HTTP_URL;
		}
	}

	/**
	 * It'll return the img DOM element HTML
	 * @param array $attributes HTML attributes to apply to the image
	 * @return string
	 */
	public function getAvatar($attributes = array())
	{
		$tmp_attributes = '';
		foreach ($attributes as $key => $value) {
			$tmp_attributes .= sprintf(' %s="%s" ', $key, $value);
		}

		return sprintf('<img src="%s" %s />', $this->getAvatarUrl(), $tmp_attributes);
	}

	/**
	 * Returns the avatar URL
	 * @return string
	 */
	public function getAvatarUrl()
	{
		return sprintf("%s/avatar/%s?%s", $this->getSource(), $this->email_hash, http_build_query($this->params));
	}

	/**
	 * Loads the profile info to the object
	 * @return boolean
	 */
	public function getProfile()
	{
		$url = sprintf("%s/%s.php", $this->getSource(), $this->email_hash);

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		curl_close($curl);

		if(empty($curl_response)) {
			throw new oGravatarRequestFailedException;
		}

		$trash = unserialize($curl_response);
		$this->has_profile = !is_string($trash);

		if($this->has_profile) {
			foreach (reset($trash['entry']) as $key => $value) {
				$this->$key = $value;
			}
		}

		return $this->has_profile;
	}

	/**
	 * Sets the image size, in pixels, [ 1 - 2048 ]
	 * @param integer $size
	 * @return object Returns itself
	 */
	public function setSize($size)
	{
		if(!is_integer($size)) {
			throw new oGravatarInvalidSizeException("The size must be an integer.");
		}

		if($size > 2048 || $size < 1) {
			throw new oGravatarInvalidSizeException("The size must be greater than 1 and less than 2048.");
		}

		$this->params['s'] = $size;
		return $this;
	}

	/**
	 * Sets the default image
	 * @param string $default
	 * @return object Returns itself
	 */
	public function setDefault($default)
	{
		$this->params['d'] = $default;
		return $this;
	}

	/**
	 * Sets the image rating [ g | pg | r | x ]
	 * @param string $rating
	 * @return object Returns itself
	 */
	public function setRating($rating)
	{
		if(!in_array($rating, array('g', 'pg', 'r', 'x'))) {
			throw new oGravatarInvalidRatingException;
		}

		$this->params['r'] = $rating;
		return $this;
	}
}