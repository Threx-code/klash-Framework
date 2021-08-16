<?php
/**
 * @author Oluwatosin Amokeodo<oluwatosin.amokeodo@skopos.io>
 * @package klash
 * @class Request handles all the http request for routing 
 */

namespace App\Models;

use App\Core\Model;
use App\Core\DBModel;
use App\Core\Request;
use App\Core\Controller;


class User extends DBModel
{
	const STATUS_INACTIVE = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_DELETED = 2;

	public string $firstname = "";
	public string $lastname = "";
	public string $email = "";
	public int $status = self::STATUS_INACTIVE;
	public string $password = "";
	public string $password_confirm = "";

	public function tableName(): string
	{
		return 'users';
	}


	public function save()
	{
		$this->status = self::STATUS_INACTIVE;

		$this->password = password_hash($this->password, PASSWORD_DEFAULT);
		return parent::save();
	}

	public function rules(): array
	{
		return [
			"firstname"	=> [self::RULE_REQUIRED],
			"lastname" 	=> [self::RULE_REQUIRED],
			"email" 	=> [self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class ]],
			"password" 	=> [self::RULE_REQUIRED, [self::RULE_MIN, "min"=>8], [self::RULE_MAX, "max"=>20]],
			"password_confirm" => [self::RULE_REQUIRED, [self::RULE_MATCH, "match"=> "password"]]
		];
	}

	public function labels(): array
	{
		return [
			'firstname' => 'First name',
			'lastname' => 'Last name',
			'email' => 'Email',
			'password' => 'Password',
			'password_confirm' => 'Confirm Password'
		];
	}


	public function attributes(): array
	{
		return ['firstname', 'lastname', 'email', 'password', 'status'];
	}
}