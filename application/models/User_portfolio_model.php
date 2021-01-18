<?php

class User_portfolio_model extends  CI_Model
{

    function __construct()
    {
        $this->load->helper('date');
        // Set table name
        $this->table = 'user_portfolios';
    }

    function get($user_id = '', $where = [] , $select = '')
    {
        if($select !=''){
            $this->db->select($select);
        }else{
            $this->db->select('*');
        }
        $this->db->from($this->table);
        if(count($where) > 0){
            $this->db->where($where);
        }
        if (is_numeric($user_id)) {
            $this->db->where('user_portfolios.user_id', $user_id);
        }
        return $this->db->order_by('portfolio_id', 'asc')->get()->result();
    }
}