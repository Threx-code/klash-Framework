<?php

namespace App\Controllers;

/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@skopos.io>
 * @package Klash Framework
 */

use App\Core\Request;
use App\Core\Controller;
use App\Core\Application;


class HomeController extends Controller
{
	public function index()
	{
		$params =[
			'name' => 'Oluwatosin',
			'company' => 'Skopos Technology'
		];

		return $this->render('home', $params);
	}

}