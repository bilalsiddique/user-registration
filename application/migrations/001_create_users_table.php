<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Create_Users_table extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }
    public function up()
    {
        //Add Role_Column In Admin Table
        $fields = array(
            'user_id'=> array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),

            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'date_of_birth' => array(
                'type' => 'Date'
            ),
            'address' => array(
                'type' => 'TEXT'
            ),
            'date_added' => array(
                'type' => 'DATE',
                'default' => NULL
            ),

        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}