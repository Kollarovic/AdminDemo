<?php

namespace App\Model\Facades;

use Nette\Database\Context;
use Nette\InvalidArgumentException;
use Nette\Object;
use Kollarovic\ShoppingCart\Cart;


class CartFacade extends Object
{

	/** @var Context */
	private $database;

	/** @var Cart */
	private $cart;


	function __construct(Context $database, Cart $cart)
	{
		$this->database = $database;
		$this->cart = $cart;
	}


	public function add($id, $quantity = 1 , array $options = [])
	{
		$product = $this->database->table('product')->get($id);

		if (!$product) {
			throw new InvalidArgumentException('Product not found.');
		}

		$this->cart->addItem($product->id, $product->price, $quantity, $options)
			->setName($product->name)
			->setImage($product->image)
			->setUnit($product->unit)
			->setVatRate($product->vat)
			->setLink('Product:default')
			->setLinkArgs($product->id);
	}


	public function save($order)
	{
		// save....
		$this->cart->clear();
	}


}