<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_Datatables extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('id'))) {
            redirect(site_url("Login"));
        }
        $this->load->model('UAC/_Ajax_Datatables');
    }
    function get_data_user_admin()
    {
        $BaseData = array(
            'table' => 'view_user',
            'column_order' => array(null, 'fullname', 'email', 'phone_number', 'group_name'),
            'column_search' => array('fullname', 'email', 'phone_number', 'group_name'),
            'order' => array('id' => 'asc')
        );
        $list = $this->_Ajax_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->fullname;
            $row[] = $field->email;
            $row[] = $field->phone_number;
            $row[] = $field->group_name;
            $row[] = $field->update_time;
            $row[] = '
        <button onclick="hapus(' . $field->id . ')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            <a href="' . site_url('UAC_User/Update') . '?id=' . $field->id . '" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
            <a href="' . site_url('UAC_User/Read') . '?id=' . $field->id . '" class="btn btn-success"><i class="fas fa-search"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Ajax_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Ajax_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_data_user_group()
    {
        $BaseData = array(
            'table' => 'view_group',
            'column_order' => array(null, 'group_name', 'total_user', 'total_permission'),
            'column_search' => array('group_name', 'total_user', 'total_permission'),
            'order' => array('id' => 'asc')
        );
        // table from view table
        $list = $this->_Ajax_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->group_name;
            $row[] = $field->group_info;
            $row[] = $field->total_user;
            $row[] = $field->update_time;
            $row[] = '
        <button onclick="hapus(' . $field->id . ')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            <a href="' . site_url('UAC_Group/Update') . '?id=' . $field->id . '" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
            <a href="' . site_url('UAC_Group/Read') . '?id=' . $field->id . '" class="btn btn-success"><i class="fa fa-search"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Ajax_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Ajax_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    function get_data_permission()
    {
        $BaseData = array(
            'table' => 'view_group',
            'column_order' => array(null, 'group_name', 'total_user', 'total_permission'),
            'column_search' => array('group_name', 'total_user', 'total_permission'),
            'order' => array('id' => 'asc')
        );
        // table from view table
        $list = $this->_Ajax_Datatables->get_datatables($BaseData);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->group_name;
            $row[] = $field->total_user;
            $row[] = $field->total_permission;
            $row[] = $field->update_time;
            $row[] = '
         <a href="' . site_url('UAC_Permission/Read') . '?id=' . $field->id . '" class="btn btn-success"><i class="fa fa-search"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->_Ajax_Datatables->count_all($BaseData),
            "recordsFiltered" => $this->_Ajax_Datatables->count_filtered($BaseData),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}

/* End of file Login.php */
