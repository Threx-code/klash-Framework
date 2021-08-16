<?php
/**
 * class Application
 *
 * @package Klash 
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@skopos.io>
 */
namespace App\Core;

class Response
{
	public function setStatusCode(int $code)
	{
		http_response_code($code);

	}

	public function redirect(string $url)
	{
		header("Location:".$url);
	}

}