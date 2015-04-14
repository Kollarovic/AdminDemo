<?php

namespace App\FrontendModule\Presenters;

use Kollarovic\ShoppingCart\ICartControlFactory;
use Nette\Database\Context;
use App\Model\Facades\CartFacade;
use Nette\InvalidArgumentException;


class CartPresenter extends BasePresenter
{

	/** @var ICartControlFactory @inject */
	public $cartControlFactory;

	/** @var CartFacade @inject */
	public $cartFacade;


	public function actionAdd($id)
	{
		try {
			$this->cartFacade->add($id);
		} catch (InvalidArgumentException $e) {
			$this->error($e->getMessage());
		}
		$this->redirect('default');
	}


	protected function createComponentCartControl()
	{
		$cart = $this->cartControlFactory->create();

		$cart->onClickContinue[] = function() {
			$this->redirect('Homepage:default');
		};

		$cart->onClickNext[] = function() {
			$this->redirect('Order:default');
		};
		return $cart;
	}

}
