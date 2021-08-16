<?php
/**
 * @author Oluwatosin Amokeodo<oluwatosin.amokeodo@skopos.io>
 * @package klash
 * @class Request handles all the http request for routing 
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;


class LoginController extends Controller
{
	public function index()
	{
		$this->setLayout('auth');
		
		return $this->render('login');
	}

	public function store(Request $request)
	{
		return "Login will happen here";
	}

}