<?php

namespace App\BackendModule\Grids;

use Grido\Grid;


class UserGridFactory extends AbstractGridFactory
{


	/** @var string */
	protected $table = 'user';


	protected function setupGrid(Grid $grid)
	{
		$grid->addColumnText('name', 'Name')
			->setSortable()->setFilterText()->setSuggestion();
		$grid->addColumnEmail('email', 'Email')
			->setSortable()->setFilterText()->setSuggestion();
		$grid->addColumnText('role', 'Role')
			->setSortable()->setFilterText()->setSuggestion();

		$grid->addActionHref('update', 'Update')->setIcon('pencil');
		$grid->addActionEvent('delete', 'Delete', $this->delete)->setIcon('trash-o')
			->setConfirm(function($item) {
			return "Are you sure you want to delete {$item->name}?";
		});
	}

}