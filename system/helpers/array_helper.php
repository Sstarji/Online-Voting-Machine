<?php
.
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('element'))
{
	/**
	 * Element
	 *
	 * Lets you determine whether an array index is set and whether it has a value.
	 * If the element is empty it returns NULL (or whatever you specify as the default value.)
	 *
	 * @param	string
	 * @param	array
	 * @param	mixed
	 * @return	mixed	depends on what the array contains
	 */
	function element($item, array $array, $default = NULL)
	{
		return array_key_exists($item, $array) ? $array[$item] : $default;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('random_element'))
{
	/**
	 * Random Element - Takes an array as input and returns a random element
	 *
	 * @param	array
	 * @return	mixed	depends on what the array contains
	 */
	function random_element($array)
	{
		return is_array($array) ? $array[array_rand($array)] : $array;
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('elements'))
{
	/**
	 * Elements
	 *
	 * Returns only the array items specified. Will return a default value if
	 * it is not set.
	 *
	 * @param	array
	 * @param	array
	 * @param	mixed
	 * @return	mixed	depends on what the array contains
	 */
	function elements($items, array $array, $default = NULL)
	{
		$return = array();

		is_array($items) OR $items = array($items);

		foreach ($items as $item)
		{
			$return[$item] = array_key_exists($item, $array) ? $array[$item] : $default;
		}

		return $return;
	}
}
