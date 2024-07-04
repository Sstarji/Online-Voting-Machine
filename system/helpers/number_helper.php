<?php

defined('BASEPATH') OR exit('No direct script access allowed');



// ------------------------------------------------------------------------

if ( ! function_exists('byte_format'))
{
	/**
	 * Formats a numbers as bytes, based on size, and adds the appropriate suffix
	 *
	 * @param	mixed	will be cast as int
	 * @param	int
	 * @return	string
	 */
	function byte_format($num, $precision = 1)
	{
		$CI =& get_instance();
		$CI->lang->load('number');

		if ($num >= 1000000000000)
		{
			$num = round($num / 1099511627776, $precision);
			$unit = $CI->lang->line('terabyte_abbr');
		}
		elseif ($num >= 1000000000)
		{
			$num = round($num / 1073741824, $precision);
			$unit = $CI->lang->line('gigabyte_abbr');
		}
		elseif ($num >= 1000000)
		{
			$num = round($num / 1048576, $precision);
			$unit = $CI->lang->line('megabyte_abbr');
		}
		elseif ($num >= 1000)
		{
			$num = round($num / 1024, $precision);
			$unit = $CI->lang->line('kilobyte_abbr');
		}
		else
		{
			$unit = $CI->lang->line('bytes');
			return number_format($num).' '.$unit;
		}

		return number_format($num, $precision).' '.$unit;
	}
}
