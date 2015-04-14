<?php

namespace App\BackendModule\Grids;

use Nette\Object;
use Nette\Database\Context;
use Nette\Localization\ITranslator;
use Grido\Grid;
use Grido\Components\Filters\Filter;


/**
 * @method string getTable()
 * @method ITranslator getTranslator()
 * @method Context getDatabase()
 * @method AbstractGridFactory setTable($table)
 */
abstract class AbstractGridFactory extends Object
{

	/** @var array */
	public $onPreDelete;

	/** @var array */
	public $onPostDelete;

	/** @var string */
	protected $table;

	/** @var Context */
	private $database;

	/** @var  ITranslator */
	protected $translator;


	function __construct(Context $database,  ITranslator $translator = NULL)
	{
		$this->database = $database;
		$this->translator = $translator;
	}


	public function create()
	{
		$grid = new Grid;
		$this->translator and $grid->setTranslator($this->translator);
		$grid->setModel($this->getSelection());
		$grid->filterRenderType = Filter::RENDER_INNER;
		$this->setupGrid($grid);
		return $grid;
	}


	abstract protected function setupGrid(Grid $grid);


	public function delete($id)
	{
		$this->onPreDelete($id);
		$this->getSelection()->where('id', $id)->delete();
		$this->onPostDelete($id);
	}


	protected function getSelection()
	{
		return $this->database->table($this->table);
	}

}