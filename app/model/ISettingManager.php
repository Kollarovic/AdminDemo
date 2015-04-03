<?php

namespace App\Model;


interface ISettingManager
{


	/**
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function get($key, $default = NULL);


	/**
	 * @param string $key
	 * @param mixed $value
	 */
	public function set($key, $value);


	/**
	 * @return array
	 */
	public function getValues();


	/**
	 * @return void
	 */
	public function flush();

}