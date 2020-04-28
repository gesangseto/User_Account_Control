<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UAC_Permission extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('id'))) {
            redirect(site_url("Login"));
        }
        $this->_save_logs();
        $this->_check_permission();
        $this->load->model('UAC/_UAC_Permission');
    }
    public function index()
    {
        $data['user'] = $this->_UAC_Permission->_view_all_role();
        $data['all_user'] = $this->_UAC_Permission->_view_all_user();
        $this->load->view('UAC/UAC_Permission/Index', $data);
        $this->load->view('Templates/Footer');
    }
    public function create()
    {
        $access_map_id = $_POST['access_map_id'];
        $group_id = $_POST['group_id'];
        if (empty($_POST['create'])) {
            $create = 0;
        } else {
            $create = 1;
        }
        if (empty($_POST['read'])) {
            $read = 0;
        } else {
            $read = 1;
        }
        if (empty($_POST['update'])) {
            $update = 0;
        } else {
            $update = 1;
        }
        if (empty($_POST['delete'])) {
            $delete = 0;
        } else {
            $delete = 1;
        }
        $data = array(
            'access_map_id' => $access_map_id,
            'group_id' => $group_id,
            'create' => $create,
            'read' => $read,
            'update' => $update,
            'delete' => $delete,
        );
        $check = $this->_UAC_Permission->_check_role($data);
        if ($check['status'] == 0) {
            $dataRs = $check;
        } else {
            $dataRs = $this->_UAC_Permission->_create_permission($data);
        }
        $dataRs['group_info'] = $this->_UAC_Permission->_view_group($group_id);
        $dataRs['uac_permission'] = $this->_UAC_Permission->_view_user_permission($group_id);
        $dataRs['access_map'] = $this->_UAC_Permission->_view_access_map();
        $dataRs['parent_map'] = $this->_UAC_Permission->_view_parent_map();
        $this->load->view('UAC/UAC_Permission/Read', $dataRs);
        $this->load->view('Templates/Footer');
    }
    public function read()
    {
        $id = $this->input->get('id', TRUE);
        $data['group_info'] = $this->_UAC_Permission->_view_group($id);
        $data['uac_permission'] = $this->_UAC_Permission->_view_user_permission($id);
        $data['access_map'] = $this->_UAC_Permission->_view_access_map();
        $data['parent_map'] = $this->_UAC_Permission->_view_parent_map();
        $this->load->view('UAC/UAC_Permission/Read', $data);
        $this->load->view('Templates/Footer');
    }
    public function update()
    {
        $permission_id = $_POST['permission_id'];
        $group_id = $_POST['group_id'];
        if (empty($_POST['create'])) {
            $create = 0;
        } else {
            $create = 1;
        }
        if (empty($_POST['read'])) {
            $read = 0;
        } else {
            $read = 1;
        }
        if (empty($_POST['update'])) {
            $update = 0;
        } else {
            $update = 1;
        }
        if (empty($_POST['delete'])) {
            $delete = 0;
        } else {
            $delete = 1;
        }
        $data = array(
            'create' => $create,
            'read' => $read,
            'update' => $update,
            'delete' => $delete,
        );
        $dataRs = $this->_UAC_Permission->_update_role($permission_id, $data);
        $dataRs['group_info'] = $this->_UAC_Permission->_view_group($group_id);
        $dataRs['uac_permission'] = $this->_UAC_Permission->_view_user_permission($group_id);
        $dataRs['access_map'] = $this->_UAC_Permission->_view_access_map();
        $dataRs['parent_map'] = $this->_UAC_Permission->_view_parent_map();
        $dataRs['response'] = array(
            'statusCode' => 00,
            'message' => 'Update success'
        );
        $this->load->view('UAC/UAC_Permission/Read', $dataRs);
        $this->load->view('Templates/Footer');
        // Here You Code for Update
    }
    public function delete()
    {
        $permission_id = $_GET['permission_id'];
        $group_id = $_GET['group_id'];
        $this->db->delete('uac_permission', array('id' => $permission_id));
        $dataRs['response'] = array(
            'statusCode' => 00,
            'message' => 'delete success'
        );
        $dataRs['group_info'] = $this->_UAC_Permission->_view_group($group_id);
        $dataRs['uac_permission'] = $this->_UAC_Permission->_view_user_permission($group_id);
        $dataRs['access_map'] = $this->_UAC_Permission->_view_access_map();
        $dataRs['parent_map'] = $this->_UAC_Permission->_view_parent_map();
        $this->load->view('UAC/UAC_Permission/Read', $dataRs);
        $this->load->view('Templates/Footer');


        // Here You Code for Delete
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
            // echo get_class($this);
            // die;
            // echo '<script type="text/javascript"> alert("Access Denied"); window.location.href = "' . site_url("$controller") . '"; </script>';
            echo '<script type="text/javascript"> alert("Access Denied"); window.history.back(); </script>';
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
