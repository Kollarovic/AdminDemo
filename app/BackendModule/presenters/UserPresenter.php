<?php

namespace App\BackendModule\Presenters;

use App\BackendModule\Form\UserFormFactory;
use App\BackendModule\Grid\UserGridFactory;
use Nette\InvalidArgumentException;


class UserPresenter extends BasePresenter
{

	/** @var UserFormFactory @inject */
	public $formFactory;

	/** @var UserGridFactory @inject */
	public $gridFactory;

	/** @var int */
	private $id;


	public function actionUpdate($id)
	{
		$this->id = $id;
	}


	protected function createComponentForm()
	{
		try {
			$form = $this->formFactory->create($this->id);
		} catch (InvalidArgumentException $e) {
			$this->error($e->getMessage());
		}

		$form->onSuccess[] = function() {
			$this->flashMessage('User has been saved.');
			$this->redirect('default');
		};
		return $form;
	}


	protected function createComponentGrid()
	{
		$this->gridFactory->onPreDelete[] = function($id) {
			if ($this->user->id == $id) {
				$this->flashMessage('The user can not be deleted.');
				$this->redirect('default');
			}
		};

		$this->gridFactory->onPostDelete[] = function() {
			$this->flashMessage('The user has been deleted.');
			$this->redirect('default');
		};
		return $this->gridFactory->create();
	}

}
