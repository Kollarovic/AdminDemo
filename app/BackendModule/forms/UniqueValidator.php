<?php

namespace App\BackendModule\Forms;

use Nette\Database\Context;
use Nette\Forms\Controls\BaseControl;


class UniqueValidator
{

	/** @var Context */
	private $database;


	function __construct(Context $database)
	{
		$this->database = $database;
	}


	public function validate(BaseControl $control, $params)
	{
		$condition[$control->name] = $control->value;
		if (isset($params[1])) {
			$condition['id!='] = $params[1];
		}
		return $this->database->table($params[0])->where($condition)->count() ? false : true;
	}

}