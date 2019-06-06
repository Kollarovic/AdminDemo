<?php

namespace App\Model;

use Nette\Object;
use Nette\Database\Context;


class SettingManager implements ISettingManager
{

	/** @var string */
	private $table;

	/** @var Context */
	private $database;

	/** @var array */
	private $default;

	/** @var array */
	private $data;


	function __construct(Context $database, $table = 'setting')
	{
		$this->database = $database;
		$this->table = $table;
	}


	public function get($key, $default = NULL)
	{
		$this->getValues();
		return isset($this->data[$key]) ? $this->data[$key] : $default;
	}


	public function set($key, $value)
	{
		$this->getValues();
		$this->data[$key] = $value;
	}


	public function getValues()
	{
		if ($this->data === NULL) {
			$this->data = $this->default = $this->getSelection()->fetchPairs('key', 'value');
		}
		return $this->data;
	}


	public function flush()
	{
		$updated = array_diff_assoc($this->data, $this->default);
		$new = array_diff_key($updated, $this->default);
		$dirty = array_diff_key($updated, $new);

		$selection = $this->getSelection();
		foreach ($new as $key => $value) {
			$selection->insert(['key' => $key, 'value' => $value]);
		}

		foreach ($dirty as $key => $value) {
			$selection->where('key', $key)->update(['value' => $value]);
		}
	}


	private function getSelection()
	{
		return $this->database->table($this->table);
	}

}