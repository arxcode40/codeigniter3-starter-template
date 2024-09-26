<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_<migration> extends CI_Migration {

	public function __construct()
	{
		$this->load->dbforge();
	}

	public function up() {
		$this->dbforge->add_field(
			array(
	      'id' => array(
	        'auto_increment' => TRUE,
	        'type' => 'BIGINT',
	        'unsigned' => TRUE
	      )
	    )
    );
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('<table>');
	}

	public function down() {
		$this->dbforge->drop_table('<table>');
	}
}
