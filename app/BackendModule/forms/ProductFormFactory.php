<?php

namespace App\BackendModule\Forms;

use Kollarovic\Admin\Form\IBaseFormFactory;
use Nette\Database\Context;
use Nette\Forms\Form;
use Nette\Utils\ArrayHash;


class ProductFormFactory extends AbstractFormFactory
{

	/** @var string */
	protected $table = 'product';

	/** @var string */
	protected $uploadManager;


	function __construct(Context $database, IBaseFormFactory $baseFormFactory, UploadManager $uploadManager)
	{
		$this->uploadManager = $uploadManager;
		parent::__construct($database, $baseFormFactory);
	}


	protected function setupForm(Form $form)
	{
		$form->addText('name', 'Name')->setRequired();
		$form->addTextArea('description', 'Description')->setAttribute('class', 'editor-standard');
		$form->addText('price', 'Price')->setType('number')->setRequired();
		$form->addUpload('image', 'Image')->addCondition(Form::FILLED)->addRule(Form::IMAGE);
		$form->addText('unit', 'Unit')->setRequired();
		$form->addText('vat', 'Vat Rate')->setType('number')->setRequired();
		$form->addCheckbox('active', 'Active');
		$form->addSubmit('submit', 'Submit');
	}


	public function process(Form $form, ArrayHash $values)
	{
		$image = $this->uploadManager->save($values->image);
		if ($image) {
			$values->image = $image['src'];
		} else {
			unset($values->image);
		}
		parent::process($form, $values);
	}

}
