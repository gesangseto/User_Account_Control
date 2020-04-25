<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function index()
    {
        $this->load->view('FrontPage/Register');
    }
    function hash($string)
    {
        return hash('sha224', $string . config_item('encryption_key'));
    }
    public function Add()
    {
        $datetime = strtotime(date('Y-m-d H:i:s'));
        $email = $this->input->post('email', TRUE);
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $re_password = $this->input->post('re_password', TRUE);
        $this->db->where('email', $email);
        $query = $this->db->get('uac_user');
        if ($query->num_rows() >= 1) {
            $data = array(
                "email" => $email,
                "username" => $username,
                "password" => $password,
                "status" => "0",
                "message" => "Email already exist"
            );
            $this->load->view('FrontPage/Register', $data);
        }
        // Check Password 
        else if ($password != $re_password) {
            $data = array(
                "email" => $email,
                "username" => $username,
                "password" => $password,
                "status" => "0",
                "message" => "Password did not match"
            );

            $this->load->view('FrontPage/Register', $data);
        }
        // Lulus Check
        else {
            $data = array(
                "admin_id" => $datetime,
                "email" => $this->input->post('email', TRUE),
                "password" => $this->hash($password),
                "username" => $this->input->post('username', TRUE)
                // "level" => $this->input->post('level', TRUE)
            );
            $this->db->insert('uac_user', $data);
            $data = array(
                "status" => 1,
                "message" => "Success Add User"
            );
            $this->load->view('FrontPage/Login', $data);
        }
    }
}

/* End of file Login.php */
