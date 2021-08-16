<?php
/**
 * @author Oluwatosin Amokeodo<oluwatosin.amokeodo@skopos.io>
 * @package klash
 * @class Request handles all the http request for routing 
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;
use App\Core\Application;

class RegisterController extends Controller
{	
	public $user;
	
	public function __construct()
	{
		$this->user = new User();
	}
	

	public function index()
	{
		$this->setLayout('auth');
		return $this->render('register', ["model"=>$this->user]);
	}

	public function store(Request $request)
	{
		$error =[];
		
		$this->user->loadData($request->getBody());

		

		if($this->user->validate() && $this->user->save()){
			Application::$app->session->setFlash('success', 'Account created successfully');
			Application::$app->response->redirect('/');
		}

		return $this->render('register', [
			"model"=>$this->user
		]);
		
	}

}