<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$this->load->library('template');
		$this->load->helper('html5');

		$data['name'] = array('Arya', 'Putra', 'Sadewa');

		$this->template->view('test', $data);
	}
}
