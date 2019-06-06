<?php

namespace App\BackendModule\Forms;

use Nette\Database\Context;
use Kollarovic\Admin\Form\IBaseFormFactory;
use Nette\Database\Table\ActiveRow;
use Nette\Forms\Form;
use Nette\InvalidArgumentException;
use Nette\Utils\ArrayHash;


abstract class AbstractFormFactory
{

	/** @var string */
	protected $table;

	/** @var Context */
	private $database;

	/** @var IBaseFormFactory */
	private $baseFormFactory;

	/** @var ActiveRow */
	private $row;

	/** @var int */
	private $id;


	function __construct(Context $database, IBaseFormFactory $baseFormFactory)
	{
		$this->database = $database;
		$this->baseFormFactory = $baseFormFactory;
	}


	public function create($id = NULL)
	{
		$this->id = $id;
		$form = $this->baseFormFactory->create();
		$this->setupForm($form);
		if ($id) {
			$this->row = $this->database->table($this->table)->get($id);
			if (!$this->row) {
				throw new InvalidArgumentException('Row not found.');
			}
			$form->setValues($this->row);
		}
		$form->onSuccess[] = [$this, 'process'];
		return $form;
	}


	public function getId()
	{
		return $this->id;
	}


	abstract protected function setupForm(Form $form);


	public function process(Form $form, ArrayHash $values)
	{
		if ($this->row) {
			$this->row->update($values);
		} else {
			$this->row = $this->database->table($this->table)->insert($values);
		}
	}


}
