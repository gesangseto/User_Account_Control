<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UAC_User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('id'))) {
            redirect(site_url("Login"));
        }
        $this->_save_logs();
        $this->_check_permission();
        $this->load->model('UAC/_UAC_User');
    }


    public function index()
    {
        // $data['user'] = $this->_UAC_User->_view_all_user();
        $this->load->view('UAC/UAC_User/Index');
        $this->load->view('Templates/Footer');
    }
    public function create()
    {
        $datetime = strtotime(date('Y-m-d H:i:s'));
        if (empty($this->input->post('email'))) {
            $this->load->view('UAC/UAC_User/Create');
        } else {
            $data['user'] = array(
                "id" => $datetime,
                "email" => $this->input->post('email', TRUE),
                "password" => $this->hash($this->input->post('password')),
                "username" => $this->input->post('username', TRUE),
                "fullname" => $this->input->post('fullname', TRUE),
                "phone_number" => $this->input->post('phone_number', TRUE),
                "address" => $this->input->post('address', TRUE)
            );
            $email = $this->input->post('email', TRUE);
            $username = $this->input->post('username', TRUE);
            $query = $this->db->query("SELECT * FROM  `uac_user` WHERE `email` = '$email' OR `username`='$username'");
            if ($query->num_rows() >= 1) {
                $data['response'] = array("statusCode" => "11", "message" => "Email or username already exist");
                $this->load->view('UAC/UAC_User/Create', $data);
            } // Check Password 
            else if ($this->input->post('password') != $this->input->post('re_password')) {
                $data['response'] = array("statusCode" => "01", "message" => "Password did not match");
                $this->load->view('UAC/UAC_User/Create', $data);
            } else {
                $this->db->insert('uac_user', $data['user']);
                $data['response'] = array("statusCode" => "00", "message" => "Success Add User");
                $this->load->view('UAC/UAC_User/Index', $data);
            }
        }
        $this->load->view('Templates/Footer');
    }
    public function read()
    {
        if (!empty($this->input->get('id'))) {
            $id = $this->input->get('id', TRUE);
            $data['user'] = $this->_UAC_User->_view_user($id);
            $this->load->view('UAC/UAC_User/Read', $data);
        }
        $this->load->view('Templates/Footer');
    }
    public function update()
    {

        if (isset($_GET['id'])) {
            $data['user'] = $this->db->get_where('uac_user', array('id' => $_GET['id']))->result_array();
            $this->load->view('UAC/UAC_User/Update', $data);
        } else if (isset($_POST['id'])) {
            if (!empty($_POST['password']) && !empty($_POST['re_password'])) {
                $data['user'][0] = array(
                    "id" => $this->input->post('id'),
                    "username" => $this->input->post('username'),
                    "fullname" => $this->input->post('fullname'),
                    "email" => $this->input->post('email'),
                    "phone_number" => $this->input->post('phone_number'),
                    "address" => $this->input->post('address'),
                    "password" => $this->hash($this->input->post('password'))
                );
                if ($this->input->post('password') != $this->input->post('re_password')) {
                    $data['response'] = array("statusCode" => 01, "message" => "Password did not match");
                    $this->load->view('UAC/UAC_User/Update', $data);
                } else {
                    $this->update_data($data['user'][0]);
                }
            } else {
                $data['user'][0] = array(
                    "id" => $this->input->post('id'),
                    "username" => $this->input->post('username'),
                    "fullname" => $this->input->post('fullname'),
                    "email" => $this->input->post('email'),
                    "phone_number" => $this->input->post('phone_number'),
                    "address" => $this->input->post('address')
                );
                $this->update_data($data['user'][0]);
            }
        }
        $this->load->view('Templates/Footer');
    }
    public function delete()
    {
        $id = $this->input->get('id', TRUE);
        $this->db->delete('uac_permission', array('group_id' => $id));
        $this->db->delete('uac_user', array('id' => $id));
        echo '<script type="text/javascript"> alert("Success Delete"); history.back(); </script>';
    }
    function hash($string)
    {
        return hash('sha224', $string . config_item('encryption_key'));
    }
    function update_data($data)
    {
        $check_username = $this->db->get_where('uac_user', array('id!=' => $data['id'], 'username' => $data['username']), 1);
        $check_email = $this->db->get_where('uac_user', array('id!=' => $data['id'], 'email' => $data['email']), 1);
        $data['user'][0] = $data;
        if ($check_email->num_rows() > 0) {
            $data['response'] = array("statusCode" => 11, "message" => "Duplicate Email");
            $this->load->view('UAC/UAC_User/Update', $data['user'][0]);
        } elseif ($check_username->num_rows() > 0) {
            $data['response'] = array("statusCode" => 11, "message" => "Duplicate Username");
            $this->load->view('UAC/UAC_User/Update', $data['user'][0]);
        } else {
            $this->db->where('id', $data['user'][0]['id']);
            $this->db->update('uac_user', $data['user'][0]);
            $data['response'] = array("statusCode" => 00, "message" => "Success Update");
            $this->load->view('UAC/UAC_User/Update', $data);
        }
    }
    private function _check_permission()
    {
        $this->load->model('UAC/_BaseRole');
        $permission = $this->_BaseRole->_check_permission();
        $controller = $this->router->fetch_class();
        $method = strtolower($this->router->fetch_method());
        foreach ($permission as $row) {
            if ($row['access_map'] == $controller) {
                $auth = array(
                    'index' => '1',
                    'create' => $row['create'],
                    'read' => $row['read'],
                    'update' => $row['update'],
                    'delete' => $row['delete']
                );
            }
        }
        if ($auth[$method] == 1) {
            $this->load->model('UAC/_BaseRole');
            $header['data'] = $this->_BaseRole->_check_permission();
            $this->load->view('Templates/Header', $header);
            return TRUE;
        } else {
            echo '<script type="text/javascript"> alert("Access Denied"); window.history.back(); </script>';
            // echo '<script type="text/javascript"> alert("Access Denied"); window.location.href = "' . site_url("$controller") . '"; </script>';
            die;
            return FALSE;
        }
    }
    private function _save_logs()
    {
        $url = base_url('/') . $this->router->fetch_class();
        $method = strtolower($this->router->fetch_method());
        $user_id = $this->session->userdata('id');
        if (!empty($_POST)) {
            $data = array('user_id' => $user_id, 'url' => $url, 'access' => $method, 'method' => 'POST', 'body' => json_encode($_POST));
            $this->db->insert('logs', $data);
        } elseif (!empty($_GET)) {
            $data = array('user_id' => $user_id, 'url' => $url, 'access' => $method, 'method' => 'GET', 'body' => json_encode($_GET));
            $this->db->insert('logs', $data);
        }
    }
}

/* End of Index Controllername.php */
