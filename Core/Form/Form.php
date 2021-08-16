<?php
/**
 * class Application handles the running of the 
 * instantiation of the Router and the running of the  
 * application
 *
 * @package Klash 
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@skopos.io>
 */

namespace App\Core\Form;

use App\Core\Model;
use App\Core\Form\Field;

class Form
{
	public static function begin($action, $method)
	{
		echo sprintf('<form action="%s" method="%s" >', $action, $method);

		return new Form();
	}

	public static function end()
	{
		echo "</form>";
	}

	public function field(Model $model, $attribute)
	{
		return new Field($model, $attribute);
	}
}