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

abstract class DBModel extends Model
{
	/*this abstract method returns a string*/
	abstract public function tableName(): string;

	abstract public function attributes(): array;

	public function save()
	{
		$tableName = $this->tableName();
		$attributes = $this->attributes();
		$params = array_map(fn($attr)=>":$attr", $attributes);
		$statement = self::prepare("INSERT INTO $tableName(".implode(',', $attributes).") 
									VALUES (".implode(',', $params).")");

		foreach ($attributes as $attribute) {
			$statement->bindValue($attribute, $this->{$attribute});
		}

		$statement->execute();
		return true;


		
	}

	public static function prepare($sql)
	{
		return Application::$app->db->pdo->prepare($sql);
	}

}