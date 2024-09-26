<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class <seeder>_seeder {

	protected $CI;
	protected $table = '<table>';

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function run()
	{
		$data = array(
			// Data todo insert
		);

		$this->CI->db->insert($this->table, $data);
	}
}
