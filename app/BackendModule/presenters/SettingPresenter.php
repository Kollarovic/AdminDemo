<?php

namespace App\BackendModule\Presenters;

use App\BackendModule\Forms\SettingFormFactory;


class SettingPresenter extends BasePresenter
{

	/** @var SettingFormFactory @inject */
	public $formFactory;


	protected function createComponentForm()
	{
		$form = $this->formFactory->create();
		$form->onSuccess[] = function() {
			$this->flashMessage('Setting has been saved.');
			$this->redirect('this');
		};
		return $form;
	}

}
