<?php
/**
 * Created by PhpStorm.
 * User: adnansiddiq
 * Date: 6/12/19
 * Time: 11:16 PM
 */

class User_model extends  CI_Model
{
    function __construct()
    {
        $this->load->helper('date');
        // Set table name
        $this->table = 'users';
        // Set orderable column fields
        $this->teacher_column_order = array('user_id', 'first_name' , 'last_name' ,'date_of_birth','address' , 'date_added');
       // Set searchable column fields
        $this->teacher_column_search = array('user_id', 'first_name' , 'last_name' ,'date_of_birth','address' , 'date_added');
        // Set default order
        $this->order = array('user_id' => 'desc');
    }

    /**
     * Get estimate/s
     * @param  mixed $user_id    User id
     * @param  array  $where perform where
     * @return mixed
     */
    public function get_query($user_id = '', $where = [] , $select = '', $whereIn = [] , $whereInColumn = '')
    {
        if($select !=''){
            $this->db->select($select);
        }else{
            $this->db->select('*');
        }
        $this->db->from('users');
        if(count($where) > 0){
            $this->db->where($where);
        }
        if(count($whereIn) > 0 && $whereInColumn !=''){
            $this->db->where_in($whereInColumn , $whereIn);
        }
        if (is_numeric($user_id)) {
            return $this->db->where('users.user_id', $user_id);
        }
        return $this->db->order_by('users.user_id', 'asc');
    }

    public function update($data,$user_id){
        try{
            $this->db->where('user_id', $user_id);
            $this->db->update($this->table, $data);
            return true;
        }catch (Exception $exception){
            return false;
        }
    }
    public function add($data){
        try{
            $data['date_added'] = date('Y-m-d' , time());
            $this->db->insert($this->table, $data);
            return $this->db->insert_id() ;
        }catch (Exception $exception){
            return false;
        }
    }

    public function destroy($user_id){

        /*First Delete the dependencies*/
        $this->db->where('user_id', $user_id);
        $this->db->delete('user_experiences');
        $this->db->affected_rows();

        $this->db->where('user_id', $user_id);
        $this->db->delete('user_portfolios');
        $this->db->affected_rows();

        $this->db->where('user_id', $user_id);
        $this->db->delete($this->table);


        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    /*
  * Fetch members data from the database
  * @param $_POST filter data based on the posted parameters
  */
    public function get_rows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
    * Count all records
    */
    public function count_all(){
        $this->_get_datatables_query($this->input->post());
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function count_filtered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    /*
        * Perform the SQL queries needed for an server-side processing requested
        * @param $_POST filter data based on the posted parameters
        */
    private function _get_datatables_query($postData){
        $this->db->select('*');
        $this->db->from($this->table);
        $start = 0;
        $column_search = $this->teacher_column_search;
        // loop searchable columns
        $this->db->group_start();
        foreach($column_search as $item){
            if ($item != '')
            {
                if ($item =='first_name'){
                    $expode = explode(' ' , $postData['search']['value']);
                    $this->db->or_like('first_name', $expode[0]);
                    if (isset($expode[1]) && !empty($expode[1]))
                    {
                        $this->db->or_like('last_name', $expode[1]);
                    }
                }
                else{
                    // if datatable send POST for search
                    if($postData['search']['value']){
                        // first loop
                        $this->db->or_like($item, $postData['search']['value']);
                    }
                }

            }
            $start++;
        }
        $this->db->group_end();
        if(isset($postData['order'])){
            $column_order = $this->teacher_column_order;
            $this->db->order_by($column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function validations_rules(){
        return array(
            array(
                'field'=>'first_name',
                'label' =>'User First Name',
                'rules'=>'required'
            ),array(
                'field'=>'last_name',
                'label' =>'User Last Name',
                'rules'=>'required'
            ),array(
                'field'=>'date_of_birth',
                'label' =>'Date Of Birth',
                'rules'=>'required'
            ),array(
                'field'=>'address',
                'label' =>'Address',
                'rules'=>'required|trim'
            )
        );
    }

    function get_actions_column($user)
    {
        $html = '';
        $html.=  '<a href="#" id="preview'.$user->user_id.'" onclick="preview_user('.$user->user_id.')" class="">Preview</a>';
        $html.=  '<a href="#" id="delete'.$user->user_id.'" onclick="delete_user('.$user->user_id.')" class=""> / Delete</a>';
        return $html;
    }

}