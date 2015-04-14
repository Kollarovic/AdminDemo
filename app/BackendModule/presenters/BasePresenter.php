<?php

namespace App\BackendModule\Presenters;

use Nette\Application\UI\Presenter;
use Kollarovic\Admin\IAdminControlFactory;
use App\Model\ISettingManager;


abstract class BasePresenter extends Presenter
{

	/** @var IAdminControlFactory @inject */
	public $adminControlFactory;

	/** @var ISettingManager @inject */
	public $setting;


	protected function startup()
	{
		parent::startup();
		if (!$this->user->isLoggedIn()) {
			$this->redirect('Sign:in', array('backlink' => $this->storeRequest()));
		}
	}


	protected function createComponentAdminControl()
	{
		$adminControl = $this->adminControlFactory->create();
		$adminControl->setUserName($this->user->identity->name)->setUserImage('images/user.png');
		$adminControl->setProfileUrl($this->link('User:update', ['id' => $this->user->id]));
		$adminControl->setSkin($this->setting->get('skin', 'red'));
		$adminControl->onLoggedOut[] = function() {
			$this->redirect('Sign:in');
		};
		return $adminControl;
	}

}
