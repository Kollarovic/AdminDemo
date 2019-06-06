<?php

namespace App\FrontendModule\Forms;

use App\Model\Facades\CartFacade;
use Kollarovic\Admin\Form\IBaseFormFactory;
use Nette\Forms\Form;


class CartFormFactory
{


	/** @var array */
	private $options;

	/** @var CartFacade */
	private $cartFacade;

	/** @var IBaseFormFactory */
	private $baseFormFactory;

	/** @var mixed */
	private $id;


	function __construct($options, CartFacade $cartFacade, IBaseFormFactory $baseFormFactory)
	{
		$this->options = $options;
		$this->cartFacade = $cartFacade;
		$this->baseFormFactory = $baseFormFactory;
	}


	public function create($id)
	{
		$this->id = $id;
		$form = $this->baseFormFactory->create();
		$form->addSelect('quantity', 'Quantity', array_combine(range(1,5), range(1,5)));

		$container = $form->addContainer('options');
		foreach ($this->options as $key => $values) {
			$container->addSelect($key, $key, $values)->setPrompt(NULL)->setRequired();
		}

		$form->addSubmit('submit', 'Add to Cart');
		$form->onSuccess[] = [$this, 'process'];
		return $form;
	}


	public function process(Form $form)
	{
		$this->cartFacade->add($this->id, $form->values->quantity, (array)$form->values->options);
	}

}
