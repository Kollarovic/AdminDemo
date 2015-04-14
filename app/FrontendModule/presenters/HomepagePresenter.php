<?php

namespace App\FrontendModule\Presenters;

use Nette\Database\Context;


class HomepagePresenter extends BasePresenter
{

	/** @var Context @inject */
	public $database;


	public function renderDefault()
	{
		$this->template->products = $this->database->table('product')->fetchAll();
	}

}
