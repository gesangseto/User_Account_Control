<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_Search extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('id'))) {
            redirect(site_url("Login"));
        }
        // $this->load->model('_Ajax_Data');
    }
    public function search_group()
    {
        $filter = $this->input->get('filter');
        // $sdm = $this->_Ajax_Data->_get_sdm($filter);
        $this->db->like('group_name', $filter);
        $this->db->or_like('group_info', $filter);
        $query = $this->db->get_where('uac_group');
        echo '<select name="group_id" required class="form-control">';
        if ($query->num_rows() == 0) {
            echo '<option value="">Not Found</option>';
        } else {
            foreach ($query->result_array() as $row) {
                echo '<option value="' . $row["id"] . '">' . $row["group_name"] . '</option>';
            }
        }
        echo '</select>';
    }
}

/* End of Index Controllername.php */
