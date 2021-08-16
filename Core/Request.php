<?php
/**
 * @author Oluwatosin Amokeodo<oluwatosin.amokeodo@skopos.io>
 * @package klash
 * @class Request handles all the http request for routing 
 */

namespace App\Core;

class Request
{

	/**
	 * @method getPath get the url path
	 * 
	 * @var $path holds the $_SERVER['REQUEST_URI'] value 
	 * if the value is empty, it takes you back to the home url
	 *
	 * @var $position this searches for the ?values in the url to 
	 * determine if the url has some extra values such as id
	 *
	 * @return $path
	 */
	public function getPath()
	{
		$path = $_SERVER['REQUEST_URI'] ?? '/';
		$position = strpos($path, '?');

		if($position === false){
			return $path;
		}

		return substr($path, 0, $position);
	}


	/**
	 * @method method returns the current method in a url
	 * 
	 */
	public function method()
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}


	/**
	 * @method getBody
	 * 
	 */
	public function getBody()
	{
		$formBody = [];

		/*if the request is get*/
		if($this->method() === 'get'){
			foreach ($_GET as $key => $value) {
				$formBody[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}

		if($this->method() === 'post'){
			foreach ($_POST as $key => $value) {
				$formBody[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}

		return $formBody;
	}

}