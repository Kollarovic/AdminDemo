<?php

namespace App\FrontendModule\Form;

use Kollarovic\Admin\Form\IBaseFormFactory;
use Nette\Application\UI\Form;
use App\Model\Facades\CartFacade;


class OrderFormFactory
{


	/** @var IBaseFormFactory */
	private $baseFormFactory;

	/** @var CartFacade */
	private $cartFacade;


	function __construct(CartFacade $cartFacade, IBaseFormFactory $baseFormFactory)
	{
		$this->cartFacade = $cartFacade;
		$this->baseFormFactory = $baseFormFactory;
	}


	public function create()
	{
		$form = $this->baseFormFactory->create();
		$form->addGroup('Contact');
		$form->addText('name', 'Name')->setRequired();
		$form->addText('phone', 'Phone')->setRequired();
		$form->addText('email', 'Email')->setRequired()->setType("email")->addRule(Form::EMAIL);
		$form->addGroup('Address');
		$form->addText('street', 'Street')->setRequired();
		$form->addText('city', 'City')->setRequired();
		$form->addText('zip', 'Zip')->setRequired();
		$form->addGroup('Description');
		$form->addTextArea('description', 'Description', NULL, 5);
		$form->addSubmit('submit', 'Submit');
		$form->onSuccess[] = [$this, 'process'];
		return $form;
	}


	public function process(Form $form)
	{
		$this->cartFacade->save($form->values);
	}

}