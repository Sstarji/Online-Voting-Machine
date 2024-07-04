<?php

defined('BASEPATH') OR exit('No direct script access allowed');



// ------------------------------------------------------------------------

if ( ! function_exists('valid_email'))
{
	/**
	 * Validate email address
	 *
	 * @deprecated	3.0.0	Use PHP's filter_var() instead
	 * @param	string	$email
	 * @return	bool
	 */
	function valid_email($email)
	{
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('send_email'))
{
	/**
	 * Send an email
	 *
	 * @deprecated	3.0.0	Use PHP's mail() instead
	 * @param	string	$recipient
	 * @param	string	$subject
	 * @param	string	$message
	 * @return	bool
	 */
	function send_email($recipient, $subject, $message)
	{
		return mail($recipient, $subject, $message);
	}
}
