<?php

namespace App\BackendModule\Grids;

use Grido\Grid;
use Grido\Components\Columns\Text;
use Nette\Utils\Html;


class Boolean extends Text
{

	public static $ITEMS = ['' => '', 1 => 'Yes', 0 => 'No'];


	public static function register()
	{
		Grid::extensionMethod('addColumnBoolean', function (Grid $grid, $name, $label) {
			return new Boolean($grid, $name, $label);
		});
	}


	public function getCellPrototype($row = NULL)
	{
		$cell = parent::getCellPrototype($row = NULL);
		$cell->class[] = 'center';
		return $cell;
	}


	protected function formatValue($value)
	{
		$icon = $value ? 'check text-success' : 'times text-danger';
		return Html::el('i')->class("fa fa-$icon");
	}

}