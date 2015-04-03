<?php

namespace App\BackendModule\Grid;

use Grido\Grid;
use Nette\Utils\Strings;


class PageGridFactory extends AbstractGridFactory
{


	/** @var string */
	protected $table = 'page';


	protected function setupGrid(Grid $grid)
	{
		$grid->addColumnText('name', 'Name')
			->setSortable()->setFilterText()->setSuggestion();

		$grid->addColumnText('content', 'Content')
			->setCustomRender($this->renderContent)
			->setSortable()->setFilterText();

		$grid->addColumnBoolean('active', 'Active')
			->setSortable()->setFilterSelect(['' => '', 1 => 'Yes', 0 => 'No']);

		$grid->addActionHref('update', 'Update')->setIcon('pencil');
		$grid->addActionEvent('delete', 'Delete', $this->delete)->setIcon('trash-o')
			->setConfirm(function($item) {
			return "Are you sure you want to delete {$item->name}?";
		});
	}


	public function renderContent($item)
	{
		$content = strip_tags($item->content);
		return Strings::truncate($content, 60);
	}
}