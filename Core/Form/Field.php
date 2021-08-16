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

class Field
{
	const TYPE_TEXT = "text";
	const TYPE_NUMBER = "number";
	const TYPE_CHECKBOX = "checkbox";
	const TYPE_PASSWORD = "password";

	public string $type;

	public Model $model;
	public string $attribute;

	public function __construct(Model $model, $attribute)
	{
		$this->model = $model;
		$this->attribute = $attribute;

		$this->type = self::TYPE_TEXT;
	}

	public function __toString()
	{
		return sprintf('
			<div class="mb-3">
				<label class="form-label">%s</label>
				<input type="%s"  name="%s" value="%s" class="form-control %s"  >
				<div class="invalid-feedback">%s</div>
			</div>
  			', 	$this->model->getLabels($this->attribute),
  				$this->type,
  				$this->attribute,
  				$this->model->{$this->attribute},
  				$this->model->hasError($this->attribute) ? ' is-invalid' : '',
  				$this->model->getFirstError($this->attribute)
  			);

	}

	public function passwordField()
	{
		$this->type = self::TYPE_PASSWORD;

		return $this;
	}

}