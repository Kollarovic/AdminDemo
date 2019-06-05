<?php

namespace App\Model;

use Nette\Database\Context;
use Kollarovic\Navigation\Item;


class Manager
{

	/** @var Context */
	private $database;


	function __construct(Context $database)
	{
		$this->database = $database;
	}


	public function count(Item $item)
	{
		return $this->database->table($item->getName())->count();
	}

}