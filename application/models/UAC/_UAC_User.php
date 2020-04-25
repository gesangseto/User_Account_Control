<?php

defined('BASEPATH') or exit('No direct script access allowed');

class _UAC_User extends CI_Model
{
    public function _view_all_user()
    {
        $query = $this->db->get('uac_user');
        return ($query->result_array());
    }
    public function _view_user($id)
    {
        $query = $this->db->get_where('view_user', array('id' => $id));
        return ($query->result_array());
    }

    public function _update_user($id, $field)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('uac_user', $field);
        if ($query == 1) {
            $data = array(
                'status' => '1',
                'message' => 'success update data'
            );
        } else {
            $data = array(
                'status' => '0',
                'message' => 'system error'
            );
        }
        return $data;
    }
}
