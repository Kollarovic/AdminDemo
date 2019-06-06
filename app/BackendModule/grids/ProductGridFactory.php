<?php

namespace App\BackendModule\Grids;

use Grido\Grid;
use Nette\Utils\Strings;


class ProductGridFactory extends AbstractGridFactory
{


	protected $table = 'product';


	protected function setupGrid(Grid $grid)
	{
		$grid->addColumnText('image', 'Image')
			->setCustomRender(__DIR__ . '/_image.latte')
			->setSortable()->setFilterText();

		$grid->addColumnText('name', 'Name')
			->setSortable()->setFilterText()->setSuggestion();

		$grid->addColumnText('price', 'Price')
			->setSortable()->setFilterNumber();

		$grid->addColumnBoolean('active', 'Active')
			->setSortable()->setFilterSelect(['' => '', 1 => 'Yes', 0 => 'No']);

		$grid->addActionHref('update', 'Update')->setIcon('pencil');
		$grid->addActionEvent('delete', 'Delete', [$this, 'delete'])->setIcon('trash-o')
			->setConfirm(function($item) {
			return "Are you sure you want to delete {$item->name}?";
		});
	}


}