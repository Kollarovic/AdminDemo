<?php

namespace App\BackendModule\Forms;

use Nette\Forms\Form;


class PageFormFactory extends AbstractFormFactory
{

	/** @var string */
	protected $table = 'page';


	protected function setupForm(Form $form)
	{
		$form->addText('name', 'Name')->setRequired();
		$form->addTextArea('content', 'Content')->setAttribute('class', 'editor-standard');
		$form->addCheckbox('active', 'Active');
		$form->addSubmit('submit', 'Submit');
	}

}
