<?php

namespace App\BackendModule\Forms;

use Nette\Database\Context;
use Kollarovic\Admin\Form\IBaseFormFactory;
use Nette\Forms\Form;
use Nette\Security\Passwords;
use Nette\Utils\ArrayHash;


class UserFormFactory extends AbstractFormFactory
{

	/** @var string */
	protected $table = 'user';

	/** @var UniqueValidator */
	private $uniqueValidator;

	/** @var array */
	private $roles;


	function __construct(array $roles, Context $database, UniqueValidator $uniqueValidator, IBaseFormFactory $baseFormFactory)
	{
		$this->roles = $roles;
		$this->uniqueValidator = $uniqueValidator;
		parent::__construct($database, $baseFormFactory);
	}


	protected function setupForm(Form $form)
	{
		$form->addText('name', 'Name')->setRequired();
		$form->addText('email', 'Email')
			->setRequired()->setType('email')->addRule(Form::EMAIL)
			->addRule([$this->uniqueValidator, 'validate'], 'This email is already registered.', [$this->table, $this->getId()]);

		$form->addPassword('password', 'Password')
			->addCondition(Form::FILLED)->addRule(Form::MIN_LENGTH, NULL, 6);

		$roles = array_combine($this->roles, $this->roles);
		$form->addRadioList('role', 'Role', $roles)->setRequired();
		$form->addSubmit('submit', 'Submit');
	}


	public function process(Form $form, ArrayHash $values)
	{
		if ($values->password) {
			$values->password = Passwords::hash($values->password);
		} else {
			unset($values->password);
		}
		parent::process($form, $values);
	}

}