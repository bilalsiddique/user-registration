<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Create_User_Portfolios_table extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }
    public function up()
    {
        //Add Role_Column In Admin Table
        $fields = array(
            'portfolio_id'=> array(
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

            'image' => array(
                'type' => 'TEXT'
            ),
            'date_added' => array(
                'type' => 'DATE',
                'default' => NULL
            )

        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('portfolio_id', TRUE);
        $this->dbforge->create_table('user_portfolios');

        $this->dbforge->add_column('user_portfolios',[
            'CONSTRAINT user_portfolios_id FOREIGN KEY(user_id) REFERENCES users(user_id)',
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('user_portfolios');
    }
}