<?php
class Migrations extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index()
    {
        /*MATCHED KEY FOR SECURITY*/
        if (isset($_GET['key']) == "987654321")
        {
            if (!$this->migration->current()) {
                $this->db->error();
            } else {
                echo 'Migrations run successfully!';
            }
        }else{
            echo "Bad Request";
        }

    }
}