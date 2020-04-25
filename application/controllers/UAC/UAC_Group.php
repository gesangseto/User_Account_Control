<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UAC_Group extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('id'))) {
            redirect(site_url("Login"));
        }
        $this->_save_logs();
        $this->_check_permission();
        $this->load->model('UAC/_UAC_Group');
    }
    public function index()
    {
        // $data['all_group'] = $this->UAC_Group->_view_all_group();
        $this->load->view('UAC/UAC_Group/Index');
        $this->load->view('Templates/Footer');
    }
    public function create()
    {
        if (isset($_POST['group_name'])) {
            $field = array('group_name' => $_POST['group_name'], 'group_info' => $_POST['group_info']);
            $check = $this->db->get_where('uac_group', array('group_name' => $field['group_name']), 1);
            if ($check->num_rows() > 0) {
                $data['response'] = array('statusCode' => 11, 'message' => "Duplicate Group Name");
                $this->load->view('UAC/UAC_Group/Create', $data);
            } else {
                $this->db->insert('uac_group', $field);
                $data['response'] = array('statusCode' => 00, 'message' => "Success Create Group");
                $this->load->view('UAC/UAC_Group/Index', $data);
            }
        } else {
            $this->load->view('UAC/UAC_Group/Create');
        }
        $this->load->view('Templates/Footer');
    }
    public function read()
    {
        $group_id = $this->input->get('id', TRUE);
        $data['group_info'] = $this->_UAC_Group->_view_group($group_id);
        $data['group_user'] = $this->_UAC_Group->_view_group_user($group_id);
        $data['group_permission'] = $this->_UAC_Group->_view_group_permission($group_id);
        $this->load->view('UAC/UAC_Group/Read', $data);
        $this->load->view('Templates/Footer');

        // Here You Code for Read
    }
    public function update()
    {
        if (isset($_GET['group_id']) && isset($_GET['user_id'])) {
            $data = array('group_id' => $_GET['group_id']);
            $this->db->where('id', $_GET['user_id']);
            $this->db->update('uac_user', $data);
            $data['response'] = array('statusCode' => 00, 'message' => "Success Change User Group");
            $this->load->view('UAC/UAC_Group/Index', $data);
        } elseif (isset($_POST['id']) && isset($_POST['group_name'])) {
            $data = array(
                'group_name' => $_POST['group_name'],
                'group_info' => $_POST['group_info'],
            );
            $this->db->where('id', $_POST['id']);
            $this->db->update('uac_group', $data);
            $data['response'] = array('statusCode' => 00, 'message' => "Success Update Group");
            $this->load->view('UAC/UAC_Group/Index', $data);
        } else {
            $data['group'] = $this->db->get_where('uac_group', array('id' => $_GET['id']))->result_array();
            $this->load->view('UAC/UAC_Group/Update', @$data);
        }
        // Here You Code for Update
    }
    public function delete()
    {
        $id = $_GET['id'];
        $this->db->delete('uac_group', array('id' => $id));
        $this->db->delete('uac_permission', array('group_id' => $id));

        $data = array('group_id' => NULL);
        $this->db->where('group_id', $id);
        $this->db->update('uac_user', $data);

        $data['response'] = array('statusCode' => 00, 'message' => "Success Delete Group");
        $this->load->view('UAC/UAC_Group/Index', $data);
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
