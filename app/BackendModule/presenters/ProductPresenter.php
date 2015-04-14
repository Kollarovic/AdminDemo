<?php

namespace App\BackendModule\Presenters;

use App\BackendModule\Forms\ProductFormFactory;
use App\BackendModule\Grids\ProductGridFactory;
use Nette\InvalidArgumentException;


class ProductPresenter extends BasePresenter
{

	/** @var ProductFormFactory @inject */
	public $formFactory;

	/** @var ProductGridFactory @inject */
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
			$this->flashMessage('The product has been saved.');
			$this->redirect('default');
		};
		return $form;
	}


	protected function createComponentGrid()
	{
		$this->gridFactory->onPostDelete[] = function() {
			$this->flashMessage('The product has been deleted.');
			$this->redirect('default');
		};
		return $this->gridFactory->create();
	}

}
