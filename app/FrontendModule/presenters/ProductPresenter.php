<?php

namespace App\FrontendModule\Presenters;

use Nette\Database\Context;
use App\FrontendModule\Forms\CartFormFactory;


class ProductPresenter extends BasePresenter
{

	/** @var Context @inject */
	public $database;

	/** @var CartFormFactory @inject */
	public $cartFormFactory;

	/** int */
	private $productId;


	public function actionDefault($id)
	{
		$product = $this->database->table('product')->get($id);
		if (!$product) $this->error();
		$this->template->product = $product;
		$this->productId = $id;
	}


	protected function createComponentCartForm()
	{
		$form = $this->cartFormFactory->create($this->productId);
		$form->onSuccess[] = function() {
			$this->redirect('Cart:default');
		};
		return $form;
	}

}
