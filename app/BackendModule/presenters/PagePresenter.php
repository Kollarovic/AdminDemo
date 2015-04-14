<?php

namespace App\BackendModule\Presenters;

use App\BackendModule\Forms\PageFormFactory;
use App\BackendModule\Grids\PageGridFactory;
use Nette\InvalidArgumentException;


class PagePresenter extends BasePresenter
{

	/** @var PageFormFactory @inject */
	public $formFactory;

	/** @var PageGridFactory @inject */
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
			$this->flashMessage('The page has been saved.');
			$this->redirect('default');
		};
		return $form;
	}


	protected function createComponentGrid()
	{
		$this->gridFactory->onPostDelete[] = function() {
			$this->flashMessage('The page has been deleted.');
			$this->redirect('default');
		};
		return $this->gridFactory->create();
	}

}
