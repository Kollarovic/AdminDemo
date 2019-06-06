<?php

namespace App\BackendModule\Forms;

use Kollarovic\Admin\Form\IBaseFormFactory;
use App\Model\ISettingManager;
use Nette\Forms\Form;


class SettingFormFactory
{

	/** @var IBaseFormFactory */
	private $baseFormFactory;

	/** @var ISettingManager */
	private $setting;

	/** @var array */
	private $skins = [
		'red' => 'Red',
		'blue' => 'Blue',
		'green' => 'Green',
		'yellow' => 'Yellow',
		'purple' => 'Purple',
		'black' => 'Black'
	];


	function __construct(IBaseFormFactory $baseFormFactory, ISettingManager $setting)
	{
		$this->baseFormFactory = $baseFormFactory;
		$this->setting = $setting;
	}


	public function create()
	{
		$form = $this->baseFormFactory->create();
		$form->addText('email', 'Email')->setType('email')->setRequired()->addRule(Form::EMAIL);
		$form->addRadioList('skin', 'Skin', $this->skins)->setRequired();
		$form->setValues($this->setting->getValues());
		$form->addSubmit('submit', 'Save');
		$form->onSuccess[] = [$this, 'process'];
		return $form;
	}


	public function process(Form $form)
	{
		foreach ($form->values as $key => $value) {
			$this->setting->set($key, $value);
		}
		$this->setting->flush();
	}

}