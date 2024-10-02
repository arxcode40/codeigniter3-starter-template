<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {
	
	protected $CI;
	
	protected $layout;
	protected $current_section;
	protected $sections = array();

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function view($view, $vars = array())
	{
		$this->CI->load->view($view, $vars);
		$this->CI->load->view($this->layout);
	}

	public function extend($layout)
	{
		$this->layout = $layout;
	}

	public function section($name, $contents)
	{
		if (is_array($contents) === FALSE)
		{
			$content = $contents;
		}
		else
		{
			$content = implode('', $contents);
		}

		$this->current_section = $name;
		$this->sections[$this->current_section] = $content;
	}

	public function render_section($section_name)
	{
		if (isset($this->sections[$section_name]) === FALSE)
		{
			return '';
		}
		else
		{
			return $this->sections[$section_name];
		}
	}

	public function include($view, $vars = array())
	{
		return $this->CI->load->view($view, $vars, TRUE);
	}
}
