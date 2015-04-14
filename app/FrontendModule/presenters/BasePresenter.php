<?php

namespace App\FrontendModule\Presenters;

use Nette\Application\UI\Presenter;
use WebLoader\Nette\LoaderFactory;
use Kollarovic\ShoppingCart\Cart;


abstract class BasePresenter extends Presenter
{

	/** @var LoaderFactory @inject */
	public $webLoader;

	/** @var Cart @inject */
	public $cart;


	protected function createTemplate()
	{
		$template = parent::createTemplate();
		$template->cart = $this->cart;
		return $template;
	}


	protected function createComponentCss()
	{
		return $this->webLoader->createCssLoader('frontend');
	}


	protected function createComponentJs()
	{
		return $this->webLoader->createJavaScriptLoader('frontend');
	}


	protected function createComponentLtIe9()
	{
		return $this->webLoader->createJavaScriptLoader('ltIe9');
	}

}
