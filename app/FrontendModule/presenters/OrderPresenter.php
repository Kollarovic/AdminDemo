<?php

namespace App\FrontendModule\Presenters;

use App\FrontendModule\Form\OrderFormFactory;


class OrderPresenter extends BasePresenter
{

	/** @var OrderFormFactory @inject */
	public $orderFormFactory;


	protected function createComponentOrderForm()
	{
		$form = $this->orderFormFactory->create();
		$form->onSuccess[] = function() {
			$this->flashMessage('Thank you for your order.');
			$this->redirect('Homepage:default');
		};
		return $form;
	}

}
