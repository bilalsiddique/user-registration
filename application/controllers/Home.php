<?php


class Home extends CI_Controller {

    public function index()
    {
        $data['content'] = $this->load->view('home' , null, true);
        $this->load->view('template', $data);
    }

    public function submit_form()
    {
        $this->load->model('user_model');
        if ($this->input->post()) {

            $rules = $this->user_model->validations_rules();
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $data['content'] = $this->load->view('home', null, true);
                $this->load->view('template', $data);
            } else {
                $post_data = $this->input->post();
                $filter_data ['first_name'] = $post_data['first_name'];
                $filter_data ['last_name'] = $post_data['last_name'];
                $filter_data ['date_of_birth'] = $post_data['date_of_birth'];
                $filter_data ['address'] = $post_data['address'];
                $experiences = $post_data['experiences'];
                $last_inserted_id = $this->user_model->add($filter_data);
                if ($last_inserted_id) {
                    /*Insert Users experiences*/
                    $make_experiences_data = make_user_experience_data($last_inserted_id, $experiences);
                    $this->db->insert_batch('user_experiences', $make_experiences_data);

                    /*Insert Users Portfolios*/
                    $uploaded_fileNames = [];
                    if (isset($_FILES['files'])) {
                        $uploaded_fileNames = [];
                        foreach ($_FILES['files']['name'] as $k => $img)
                        {
                            if (!empty($img))
                            {
                                $error = [];
                                $image_allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'ico'];
                                $logo_file_name = $img;
                                $logo_file_extension = explode('.', $logo_file_name);
                                $logo_file_extension = strtolower(end($logo_file_extension));
                                $logo_file_temp = $_FILES['files']['tmp_name'][$k];
                                if (!in_array($logo_file_extension, $image_allowed_extensions)) {
                                    $error[]= 'You can upload only jpg,jpeg,png,svg and ico files.';
                                }
                                $uploads_dir = UPLOADS_PATH;
                                if (!file_exists($uploads_dir)) {
                                    $error[]= 'permission denied to create directory.';
                                }
                                if (empty($error)) {
                                    $logo_file_name = str_replace(" " , "_" , $logo_file_name);
                                    $logo_new_name = md5(time() . rand()) . $logo_file_name . '.' . $logo_file_extension;
                                    try {
                                        move_uploaded_file($logo_file_temp, $uploads_dir . $logo_new_name);
                                        $uploaded_fileNames[] = array(
                                            'user_id' => $last_inserted_id,
                                            'image' => $logo_new_name,
                                            'date_added' => date('Y-m-d' , time()),
                                        );

                                    } catch (\Exception $exception) {
                                        $error[] = "File Upload Issue";
                                    }
                                }
                            }
                        }
                    }
                    if (count($uploaded_fileNames))
                    {
                        $this->db->insert_batch('user_portfolios', $uploaded_fileNames);
                    }
                    redirect('users');
                } else {
                    redirect('users');
                }
            }
        }
    }

}