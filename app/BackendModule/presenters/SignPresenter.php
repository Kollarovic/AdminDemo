<?php

namespace App\BackendModule\Presenters;

use Kollarovic\Admin\ILoginControlFactory;
use Nette\Application\UI\Presenter;


class SignPresenter extends Presenter
{

	/** @var  ILoginControlFactory @inject */
	public $loginControlFactory;


	protected function createComponentLoginControl()
	{
		$loginControl = $this->loginControlFactory->create();
		$loginControl->onLoggedIn[] = function() {
			$this->redirect('Homepage:default');
		};
		return $loginControl;
	}

}
