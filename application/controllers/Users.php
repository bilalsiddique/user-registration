<?php


class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {

        $user_query = $this->user_model->get_query();
        $users =  $user_query->get()->row();
        $res['users'] = $users;
        $data['content'] = $this->load->view('users/list' , null, true);
        $this->load->view('template', $data);
    }


    function table()
    {
        $data = array();
        // Fetch member's records
        if ($this->input->post())
            $users = $this->user_model->get_rows($this->input->post());
        $start = $this->input->post('start');
        foreach ($users as $user) {
            $start++;
            $data[] = array(
                $user->user_id,
                $user->first_name . ' ' . $user->last_name,
                $user->date_of_birth,
                $user->address,
                $user->date_added,
                $this->user_model->get_actions_column($user)
            );
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->user_model->count_all(),
            "recordsFiltered" => $this->user_model->count_filtered($this->input->post()),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }

    function preview()
    {
        $user_id = $this->input->post("user_id");
        $this->load->model('user_experience_model');
        $this->load->model('user_portfolio_model');
        $res = [];
        if ($user_id) {
            $user_query = $this->user_model->get_query($user_id);
            $user =  $user_query->get()->row();
            $user_experiences = $this->user_experience_model->get($user_id);
            $user_portfolios = $this->user_portfolio_model->get($user_id);
            $res ['user'] = $user;
            $res ['experiences'] = $user_experiences;
            $res ['user_portfolios'] = $user_portfolios;
        }
        $this->load->view('users/preview_user', $res);
    }

    function destroy()
    {
        $success = false;
        $message = 'Something going is wrong!';
        $user_id = $this->input->post("user_id");
        if ($user_id) {
            $success = $this->user_model->destroy($user_id);
            $message = '';
            if ($success) {
                $message = "User delete successfully";
            }
        }
        echo json_encode([
            'success' => $success,
            'message' => $message,
        ]);
    }


}