<?php

namespace App\BackendModule\Forms;

use Nette\Object;
use Nette\Forms\Controls\BaseControl;
use Nette\Database\Table\Selection;


class UniqueValidator extends Object
{

	/** @var Selection */
	private $selection;
	
	/** @var int */
	private $id;


	function __construct(Selection $selection, $id = NULL)
	{
		$this->selection = $selection;
		$this->id = $id;
	}


	public function validate(BaseControl $control)
	{
		$condition[$control->name] = $control->value;
		if ($this->id) {
			$condition['id!='] = $this->id;
		}
		return $this->selection->where($condition)->count() ? FALSE : TRUE;
	}

}
