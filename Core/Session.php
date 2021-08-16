<?php
/**
 * class Application
 *
 * @package Klash 
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@skopos.io>
 */
namespace App\Core;

class Session
{
	protected const FLASH_KEY = 'flash_messages';

	public function __construct()
	{
		session_start();

		$flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

		/* get the session by reference*/
		foreach ($flashMessages as $key => &$flashMessage) {

			$flashMessage['remove'] = true;
		}

		$_SESSION[self::FLASH_KEY] = $flashMessages;
		
	}


	public function setFlash($key, $message)
	{
		$_SESSION[self::FLASH_KEY][$key] = [
			'remove' =>false,
			'value'=>$message
		];

	}

	public function getFlash($key)
	{
		return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
	}


	public function __destruct()
	{
		$flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

		/* get the session by reference*/
		foreach ($flashMessages as $key => &$flashMessage) {

			if(!empty($flashMessage['remove'])){
				unset($flashMessages[$key]);
			}
		}

		$_SESSION[self::FLASH_KEY] = $flashMessages;
	}

	

}

