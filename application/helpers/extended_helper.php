<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('csrf_field'))
{
	function csrf_field()
	{
		echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());
	}
}

if ( ! function_exists('nanoid'))
{
	function nanoid($size = 21)
	{
		$randomizer = new \Random\Randomizer();

		return $randomizer->getBytesFromString('useandom-26T198340PX75pxJACKVERYMINDBUSHWOLF_GQZbfghjklqvwyzrict', $size);
	}
}
