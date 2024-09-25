<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArX extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if ($this->input->is_cli_request() === FALSE)
		{
			show_404();
		}

		$this->load->helper('file');
	}

	public function controller($name)
	{
		$name = ucfirst($name);

		if ( ! file_exists(APPPATH . "controllers/{$name}.php"))
		{
			$template = read_file(APPPATH . 'templates/Controller.php');
			$template = str_replace('<controller>', $name, $template);

			write_file(APPPATH . "controllers/{$name}.php", $template);
		}
		else
		{
			echo "\n{$name} controller already exists\n\n";
		}
	}

	public function database($name)
	{
		$this->load->dbforge();

		$this->dbforge->create_database($name);
	}

	public function helper($name)
	{
		if ( ! file_exists(APPPATH . "helpers/{$name}_helper.php"))
		{
			$template = read_file(APPPATH . 'templates/Helper.php');

			write_file(APPPATH . "helpers/{$name}_helper.php", $template);
		}
		else
		{
			$name = ucfirst($name);
			echo "\n{$name} helper already exists\n\n";
		}
	}

	public function key($length = 16)
	{
		$this->load->library('encryption');

		$encryption_key = bin2hex($this->encryption->create_key($length));

		$config = read_file(APPPATH . 'config/config.php');
		$config = str_replace("'<encryption_key>'", "bin2hex('{$encryption_key}')", $config);

		write_file(APPPATH . 'config/config.php', $config);

		echo "\nEncryption key: {$encryption_key}\n\n";
	}

	public function library($name)
	{
		$name = ucfirst($name);

		if ( ! file_exists(APPPATH . "libraries/{$name}.php"))
		{
			$template = read_file(APPPATH . 'templates/Library.php');
			$template = str_replace('<library>', $name, $template);

			write_file(APPPATH . "libraries/{$name}.php", $template);
		}
		else
		{
			echo "\n{$name} library already exists\n\n";
		}
	}

	public function migrate()
	{
		$this->load->library('migration');

    if ($this->migration->current() === FALSE)
    {
      show_error($this->migration->error_string());
    }
	}

	public function migration($name)
	{
		$timestamp = mdate('%Y%m%d%H%i%s');
		$table = explode('_', $name);
		$table = end($table);

		if ( ! file_exists(APPPATH . "migrations/{$timestamp}_{$name}.php"))
		{
			$template = read_file(APPPATH . 'templates/Migration.php');
			$template = str_replace(
				array('<migration>', '<table>'),
				array(ucfirst($name), $table),
				$template
			);

			write_file(APPPATH . "migrations/{$timestamp}_{$name}.php", $template);

			$migration = read_file(APPPATH . 'config/migration.php');
			$migration = str_replace("'<version>'", $timestamp, $migration);

			write_file(APPPATH . 'config/migration.php', $migration);
		}
		else
		{
			$name = ucfirst(str_replace('_', ' ', $name));
			echo "\n{$name} migration already exists\n\n";
		}
	}

	public function model($name)
	{
		$name = ucfirst($name);

		if ( ! file_exists(APPPATH . "models/{$name}_model.php"))
		{
			$template = read_file(APPPATH . 'templates/Model.php');
			$template = str_replace('<model>', $name, $template);

			write_file(APPPATH . "models/{$name}_model.php", $template);
		}
		else
		{
			echo "\n{$name} model already exists\n\n";
		}
	}

	public function seed()
	{
		return;
	}

	public function seeder()
	{
		return;
	}
}
