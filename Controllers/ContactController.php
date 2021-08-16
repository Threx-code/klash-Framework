<?php

namespace App\Controllers;

/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@skopos.io>
 * @package Klash Framework
 */

use App\Core\Request;
use App\Core\Controller;
use App\Core\Application;


class ContactController extends Controller
{

	public function index()
	{
		return $this->render('contact');
	}

	public function handleContact(Request $request)
	{
		return $request->getBody();
	}

}