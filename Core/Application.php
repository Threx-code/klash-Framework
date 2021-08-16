<?php
/**
 * class Application handles the running of the 
 * instantiation of the Router and the running of the  
 * application
 *
 * @package Klash 
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@skopos.io>
 */

namespace App\Core;

class Application
{
	/**
	 * @var Type-properties Router, Request [this are a PHP 7.4 >= features]
	 */
	
	public Router $router;
	public Request $request;
	public Response $response;
	public Session $session;
	public Controller $controller;
	public static Application $app;
	public Database $db;

	public static string $ROOT_DIR;

	/**
	 * Application constructor 
	 * instantiating the class properties
	 *
	 */
	public function __construct($rootPath, array $config)
	{
		self::$ROOT_DIR = $rootPath;

		self::$app = $this;

		$this->request = new Request();
		$this->response = new Response();
		$this->session = new Session();
		$this->router = new Router($this->request, $this->response);
		$this->db = new Database($config['db']);
		
	}

	/**
	 * Application constructor 
	 * instantiating the class properties
	 *
	 */
	
	public function getController() : Controller
	{
		return $this->controller;
	}


	/**
	 * Application constructor 
	 * instantiating the class properties
	 *
	 */
	
	public function setController(Controller $controller) : void
	{
		$this->controller = $controller;
	}

	/**
	 * @method run to run the application by calling the @method resolve
	 * @method resolve declared inside the Router 
	 * class to handles the current method and url 
	 */
	
	public function run()
	{
		echo $this->router->resolve();
	}
}