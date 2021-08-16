<?php
/**
 * class Application
 *
 * @package Klash 
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@skopos.io>
 */
namespace App\Core;


class Controller
{
	public string $layout = "main";
	public function setLayout($layout)
	{
		$this->layout = $layout;
	}


	public function render($view, $params = [])
	{
		return Application::$app->router->renderView($view, $params);

	}
}