<?php

defined('BASEPATH') OR exit('No direct script access allowed');


// ------------------------------------------------------------------------

if ( ! function_exists('xml_convert'))
{
	/**
	 * Convert Reserved XML characters to Entities
	 *
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	function xml_convert($str, $protect_all = FALSE)
	{
		$temp = '__TEMP_AMPERSANDS__';

		// Replace entities to temporary markers so that
		// ampersands won't get messed up
		$str = preg_replace('/&#(\d+);/', $temp.'\\1;', $str);

		if ($protect_all === TRUE)
		{
			$str = preg_replace('/&(\w+);/', $temp.'\\1;', $str);
		}

		$str = str_replace(
			array('&', '<', '>', '"', "'", '-'),
			array('&amp;', '&lt;', '&gt;', '&quot;', '&apos;', '&#45;'),
			$str
		);

		// Decode the temp markers back to entities
		$str = preg_replace('/'.$temp.'(\d+);/', '&#\\1;', $str);

		if ($protect_all === TRUE)
		{
			return preg_replace('/'.$temp.'(\w+);/', '&\\1;', $str);
		}

		return $str;
	}
}
