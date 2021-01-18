<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Create_User_Experiences_table extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }
    public function up()
    {
        //Add Role_Column In Admin Table
        $fields = array(
            'experience_id'=> array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ),

            'user_id' => array(
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 5
            ),

            'company_name' => array(
                'type' => 'TEXT'
            ),
            'description' => array(
                'type' => 'TEXT'
            ),
            'date_added' => array(
                'type' => 'DATE',
                'default' => NULL
            )

        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('experience_id', TRUE);
        $this->dbforge->create_table('user_experiences');
        $this->dbforge->add_column('user_experiences',[
            'CONSTRAINT user_experience_id FOREIGN KEY(user_id) REFERENCES users(user_id)',
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('user_experiences');
    }
}