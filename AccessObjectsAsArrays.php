<?php

/**
 * access objects as arrays
 */
class AccessObjectsAsArrays implements ArrayAccess
{
	/**
	 * 
	 * @var array $data
	 */
	private $data = [];

	/**
	 * set a new item to the array
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	private function set($key, $value)
	{
		$this->data[$key] = $value;
	}

	/**
	 * get an item from the array
	 *
	 * @param string $key
	 * @return mixed
	 */
	private function get($key)
	{
		return $this->data[$key];
	}

	/**
	 * check if the item is in the array or not
	 *
	 * @param string $key
	 * @return boolean
	 */
	private function isset($key)
	{
		return isset($this->data[$key]);
	}

	/**
	 * remove an item from the array
	 *
	 * @param string $key
	 * @return void
	 */
	private function unset($key)
	{
		unset($this->data[$key]);
	}

	/**
	 * set a new item to the array
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return void
	 */
	public function offsetSet($key, $value)
	{
		return $this->set($key, $value);
	}

	/**
	 * get an item from the array
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function offsetGet($key)
	{
		return $this->get($key);
	}

	/**
	 * check if the item is in the array or not
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function offsetExists($key)
	{
		return $this->isset($key);
	}

	/**
	 * remove an item from the array
	 *
	 * @param string $key
	 * @return void
	 */
	public function offsetUnset($key)
	{
		return $this->unset($key);
	}

}

// example:
$array = new AccessObjectsAsArrays;
$array['name'] = 'Mahmood Ahmad';
echo $array['name'];