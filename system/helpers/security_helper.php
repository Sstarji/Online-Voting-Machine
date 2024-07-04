<?php

defined('BASEPATH') OR exit('No direct script access allowed');



// ------------------------------------------------------------------------

if ( ! function_exists('xss_clean'))
{
	/**
	 * XSS Filtering
	 *
	 * @param	string
	 * @param	bool	whether or not the content is an image file
	 * @return	string
	 */
	function xss_clean($str, $is_image = FALSE)
	{
		return get_instance()->security->xss_clean($str, $is_image);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('sanitize_filename'))
{
	/**
	 * Sanitize Filename
	 *
	 * @param	string
	 * @return	string
	 */
	function sanitize_filename($filename)
	{
		return get_instance()->security->sanitize_filename($filename);
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('do_hash'))
{
	/**
	 * Hash encode a string
	 *
	 * @todo	Remove in version 3.1+.
	 * @deprecated	3.0.0	Use PHP's native hash() instead.
	 * @param	string	$str
	 * @param	string	$type = 'sha1'
	 * @return	string
	 */
	function do_hash($str, $type = 'sha1')
	{
		if ( ! in_array(strtolower($type), hash_algos()))
		{
			$type = 'md5';
		}

		return hash($type, $str);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('strip_image_tags'))
{
	/**
	 * Strip Image Tags
	 *
	 * @param	string
	 * @return	string
	 */
	function strip_image_tags($str)
	{
		return get_instance()->security->strip_image_tags($str);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('encode_php_tags'))
{
	/**
	 * Convert PHP tags to entities
	 *
	 * @param	string
	 * @return	string
	 */
	function encode_php_tags($str)
	{
		return str_replace(array('<?', '?>'), array('&lt;?', '?&gt;'), $str);
	}
}
