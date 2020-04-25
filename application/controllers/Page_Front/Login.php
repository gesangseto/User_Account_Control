<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->session->userdata('id'))) {
            redirect(site_url("Dashboard"));
        }
        $this->load->model('_Login');
    }

    function hash($string)
    {
        return hash('sha224', $string . config_item('encryption_key'));
    }
    public function index()
    {
        if (!empty($_POST)) {
            $username = $this->input->post('username', TRUE);
            $pass = $this->input->post('password', TRUE);
            $password = $this->hash($pass);
            $check_login = $this->_Login->_check_login($username, $password);
            if ($check_login == TRUE) {
                $data['response'] = array(
                    "statusCode" => 00,
                    "message" => "Login Success"
                );
                redirect(site_url("Dashboard"));
            } else if ($check_login == FALSE) {
                $data['response'] = array(
                    "statusCode" => 01,
                    "message" => "username or password did not match"
                );
            }
            $this->load->view('Login/Index', $data);
        } else {
            $this->load->view('Login/Index');
        }
    }
}

/* End of file Login.php */
