<?php


class User_experience_model extends  CI_Model
{
    function __construct()
    {
        $this->load->helper('date');
        // Set table name
        $this->table = 'user_experiences';
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
            $this->db->where('user_experiences.user_id', $user_id);
        }
        return $this->db->order_by('experience_id', 'asc')->get()->result();
    }
}