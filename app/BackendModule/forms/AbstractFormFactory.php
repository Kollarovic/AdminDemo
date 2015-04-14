<?php

namespace App\BackendModule\Forms;

use Nette\Object;
use Nette\Database\Context;
use Kollarovic\Admin\Form\IBaseFormFactory;
use Nette\Database\Table\ActiveRow;
use Nette\Forms\Form;
use Nette\InvalidArgumentException;


/**
 * @method string getTable()
 * @method Context getDatabase()
 * @method IBaseFormFactory getBaseFormFactory()
 * @method ActiveRow getRow()
 * @method int getId()
 *
 * @method AbstractFormFactory setTable($table)
 */
abstract class AbstractFormFactory extends Object
{

	/** @var array */
	public $onPreSave;

	/** @var array */
	public $onPostSave;

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
		$form->onSuccess[] = $this->process;
		return $form;
	}


	abstract protected function setupForm(Form $form);


	public function process(Form $form)
	{
		$values = $form->values;
		$this->onPreSave($values);
		if ($this->row) {
			$this->row->update($values);
		} else {
			$this->row = $this->database->table($this->table)->insert($values);
		}
		$this->onPostSave($this->row);
	}


}
