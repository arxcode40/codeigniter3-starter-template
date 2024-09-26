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

		if (file_exists(APPPATH . "controllers/{$name}.php") === FALSE)
		{
			$template = read_file(APPPATH . 'templates/Controller.php');
			$template = str_replace('<controller>', $name, $template);

			write_file(APPPATH . "controllers/{$name}.php", $template);
		}
		else
		{
			echo "n\"{$name}\" controller already exists\n\n";
		}
	}

	public function config($name)
	{
		if (file_exists(APPPATH . "config/{$name}.php") === FALSE)
		{
			$template = read_file(APPPATH . 'templates/Config.php');

			write_file(APPPATH . "config/{$name}.php", $template);
		}
		else
		{
			$name = ucfirst($name);
			echo "\n\"{$name}\" config already exists\n\n";
		}
	}

	public function core($name)
	{
		$name = ucfirst($name);

		if (file_exists(BASEPATH . "core/{$name}.php") === FALSE AND file_exists(APPPATH . "core/{$name}.php") === FALSE)
		{
			$template = read_file(APPPATH . 'templates/Core.php');
			$template = str_replace('<core>', $name, $template);

			write_file(APPPATH . "core/{$name}.php", $template);
		}
		else
		{
			echo "\n\"{$name}\" core already exists\n\n";
		}
	}

	public function database($name)
	{
		$this->load->dbforge();

		$this->dbforge->create_database($name);

		$database = read_file(APPPATH . 'config/database.php');
		$database = preg_replace("/'database' => '.*'/", "'database' => '{$name}'", $database);

		write_file(APPPATH . 'config/database.php', $database);
	}

	public function environment($env)
	{
		if (in_array($env, array('development', 'testing', 'production', 'maintenance')) === TRUE)
		{
			$htaccess = read_file(FCPATH . '.htaccess');
			$htaccess = preg_replace("/SetEnv CI_ENV (development|testing|production|maintenance)/", "SetEnv CI_ENV {$env}", $htaccess);

			write_file(FCPATH . '.htaccess', $htaccess);
		}
		else
		{
			$env = ucfirst($env);
			echo "\n\"{$env}\" environment not found\n\n";
		}
	}

	public function helper($name)
	{
		if (file_exists(BASEPATH . "helpers/{$name}_helper.php") === FALSE AND file_exists(APPPATH . "helpers/{$name}_helper.php") === FALSE)
		{
			$template = read_file(APPPATH . 'templates/Helper.php');

			write_file(APPPATH . "helpers/{$name}_helper.php", $template);
		}
		else
		{
			$name = ucfirst($name);
			echo "\n\"{$name}\" helper already exists\n\n";
		}
	}

	public function hook($name)
	{
		$name = ucfirst($name);

		if (file_exists(APPPATH . "hooks/{$name}.php") === FALSE)
		{
			$template = read_file(APPPATH . 'templates/Hook.php');
			$template = str_replace('<hook>', $name, $template);

			write_file(APPPATH . "hooks/{$name}.php", $template);
		}
		else
		{
			echo "\n\"{$name}\" hook already exists\n\n";
		}
	}

	public function key($length = 16)
	{
		$this->load->library('encryption');

		$encryption_key = bin2hex($this->encryption->create_key($length));

		$config = read_file(APPPATH . 'config/config.php');
		$config = preg_replace('/\$config\[\'encryption_key\'\] = hex2bin\(\'[0-9a-f]*\'\);/', "\$config['encryption_key'] = hex2bin('{$encryption_key}');", $config);

		write_file(APPPATH . 'config/config.php', $config);

		echo "\nEncryption key: {$encryption_key}\n\n";
	}

	public function language($name)
	{
		$localization = config_item('language');

		if (file_exists(APPPATH . "language/{$localization}/{$name}_lang.php") === FALSE)
		{
			$template = read_file(APPPATH . 'templates/Language.php');
			$template = str_replace('<language>', $name, $template);

			write_file(APPPATH . "language/{$localization}/{$name}_lang.php", $template);
		}
		else
		{
			$name = ucfirst($name);
			echo "\n\"{$name}\" language already exists\n\n";
		}
	}

	public function library($name)
	{
		$name = ucfirst($name);

		if (file_exists(BASEPATH . "libraries/{$name}.php") === FALSE AND file_exists(APPPATH . "libraries/{$name}.php") === FALSE)
		{
			$template = read_file(APPPATH . 'templates/Library.php');
			$template = str_replace('<library>', $name, $template);

			write_file(APPPATH . "libraries/{$name}.php", $template);
		}
		else
		{
			echo "\n\"{$name}\" library already exists\n\n";
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

		if (file_exists(APPPATH . "migrations/{$timestamp}_{$name}.php") === FALSE)
		{
			$template = read_file(APPPATH . 'templates/Migration.php');
			$template = str_replace(
				array('<migration>', '<table>'),
				array(ucfirst($name), $table),
				$template
			);

			write_file(APPPATH . "migrations/{$timestamp}_{$name}.php", $template);

			$migration = read_file(APPPATH . 'config/migration.php');
			$migration = preg_replace('/(\$config\[\'migration_version\'\] =) \d+;/', '$1 ' . $timestamp . ';', $migration);

			write_file(APPPATH . 'config/migration.php', $migration);
		}
		else
		{
			$name = ucfirst(str_replace('_', ' ', $name));
			echo "\n\"{$name}\" migration already exists\n\n";
		}
	}

	public function model($name)
	{
		$name = ucfirst($name);

		if (file_exists(APPPATH . "models/{$name}_model.php") === FALSE)
		{
			$template = read_file(APPPATH . 'templates/Model.php');
			$template = str_replace('<model>', $name, $template);

			write_file(APPPATH . "models/{$name}_model.php", $template);
		}
		else
		{
			echo "\n\"{$name}\" model already exists\n\n";
		}
	}

	public function seed()
	{
		$this->load->library('seeder');

		$seeders = get_filenames(APPPATH . 'seeders/');

		foreach ($seeders as $seeder)
		{
			if (str_contains($seeder, '.php'))
			{
				$name = str_replace('.php', '', $seeder);

				$this->seeder->call($name);
			}
		}
	}

	public function seeder($name)
	{
		$name = ucfirst($name);

		if (file_exists(APPPATH . "seeders/{$name}_seeder.php") === FALSE)
		{
			$template = read_file(APPPATH . 'templates/Seeder.php');
			$template = str_replace(
				array('<seeder>', '<table>'),
				array($name, strtolower($name)),
				$template
			);

			write_file(APPPATH . "seeders/{$name}_seeder.php", $template);
		}
		else
		{
			echo "\n\"{$name}\" seeder already exists\n\n";
		}
	}
}
