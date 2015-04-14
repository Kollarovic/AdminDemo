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

	/** @var array */
	private $roles;


	function __construct(array $roles, Context $database, IBaseFormFactory $baseFormFactory)
	{
		$this->roles = $roles;
		parent::__construct($database, $baseFormFactory);
	}


	protected function setupForm(Form $form)
	{
		$uniqueValidator = new UniqueValidator($this->database->table($this->table), $this->getId());

		$form->addText('name', 'Name')->setRequired();
		$form->addText('email', 'Email')
			->setRequired()->setType('email')->addRule(Form::EMAIL)
			->addRule($uniqueValidator->validate, 'This email is already registered.');

		$form->addPassword('password', 'Password')
			->addCondition(Form::FILLED)->addRule(Form::MIN_LENGTH, NULL, 6);

		$roles = array_combine($this->roles, $this->roles);
		$form->addRadioList('role', 'Role', $roles)->setRequired();
		$form->addSubmit('submit', 'Submit');
		$this->onPreSave[] = $this->hashPassword;
	}


	public function hashPassword(ArrayHash $values)
	{
		if ($values->password) {
			$values->password = Passwords::hash($values->password);
		} else {
			unset($values->password);
		}
	}

}