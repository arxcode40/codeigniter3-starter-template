<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class <hook> {
	
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function example($params = NULL)
	{
		return 'example';
	}
}
