<?php
/**
 * class Application
 *
 * @package Klash 
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@skopos.io>
 */
namespace App\Core;

class Router
{
	/* create an array to hold the paths*/
	protected $routes = [];

	public Request $request;
	public Response $response;

	public function __construct(Request $request, Response $response)
	{
		$this->request = $request;
		$this->response = $response;
	}


	/*creating get route paths*/
	public function get($path, $callback)
	{
		$this->routes['get'][$path] = $callback;
	}

	/*creating get route paths*/
	public function post($path, $callback)
	{
		$this->routes['post'][$path] = $callback;
	}

	/**
	 * @method resolve calls the @method getPath()  and @method method()
	 * in the class Request
	 */
	
	public function resolve()
	{
		$path = $this->request->getPath();
		$method = $this->request->method();

		$callback = $this->routes[$method][$path] ?? false;

		/*check if the call back is empty/false then the callback does not exist*/
		if($callback === false){
			$this->response->setStatusCode(404);
			return $this->renderView("_404");
		}

		/*check if the call back is a string, then return the rendered view*/
		if(is_string($callback)){
			return $this->renderView($callback);
		}

		/*check if the call back is an array. then instntiate the index 0 as a class*/
		if(is_array($callback)){
			Application::$app->controller = new $callback[0]();
			$callback[0] = Application::$app->controller;
		}

		return call_user_func($callback, $this->request);
	}

	/**
	 * for rendering pages 
	 */
	public function renderView($view, $params = [])
	{
		$viewDefaultPage = $this->viewDefaultPage();
		$viewPage = $this->viewPage($view, $params);

		return str_replace("{{content}}", $viewPage, $viewDefaultPage);
	}


	/**
	 * primary view layout
	 */

	protected function viewDefaultPage()
	{
		$layout = Application::$app->controller->layout;
		ob_start();

		include Application::$ROOT_DIR."/views/layouts/$layout.php";

		return ob_get_clean();
	}


	/**
	 *  other pages sent to the primary view layout
	 */

	protected function viewPage($view, $params)
	{
		foreach ($params as $key => $value) {
			$$key = $value;
		}
		ob_start();

		include_once Application::$ROOT_DIR."/views/$view.php";

		return ob_get_clean();
	}

}