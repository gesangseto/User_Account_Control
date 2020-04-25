<?php

defined('BASEPATH') or exit('No direct script access allowed');

class _UAC_Menu_Mapping extends CI_Model
{
    public function _view_all_access_map()
    {
        $query = $this->db->query("SELECT A.id,A.access_map,A.create_time,A.update_time,B.parent_map,A.parent_map_id
                                    FROM  `uac_menu_mapping` AS `A` 
                                    JOIN  `uac_parent_menu` AS `B` ON `A`.`parent_map_id` = `B`.`id` ORDER BY `A`.`access_map` ASC");
        return ($query->result_array());
    }
    public function _view_all_parent_map()
    {
        $query = $this->db->query("SELECT * FROM  `uac_parent_menu` ORDER BY 'parent_map' ASC");
        return ($query->result_array());
    }
    public function _count_access_map()
    {
        $query = $this->db->query("SELECT access_map FROM `uac_permission` AS `A` JOIN  `uac_menu_mapping` AS `B` ON `A`.`access_map_id` = `B`.`id` ");
        return ($query->result_array());
    }
    public function _count_parent_map()
    {
        $query = $this->db->query("SELECT access_map,count(*) as `total`
        FROM `uac_permission` AS `A` JOIN  `uac_menu_mapping` AS `B` ON `A`.`access_map_id` = `B`.`id` 
        GROUP BY access_map");
        return ($query->result_array());
    }
    public function _view_user($id)
    {
        $query = $this->db->get_where('uac_user', array('id' => $id));
        return ($query->result_array());
    }
    public function _check_update($id, $field)
    {
        $check_email = $this->db->get_where('uac_user', array('id!=' => $id, 'email' => $field['email']), 1);
        $check_username = $this->db->get_where('uac_user', array('id!=' => $id, 'username' => $field['username']), 1);
        if ($check_email->num_rows() > 0) {
            $data['response'] = array(
                'statusCode' => '0',
                'message' => 'duplicate email'
            );
        } else if ($check_username->num_rows() > 0) {
            $data = array(
                'status' => '0',
                'message' => 'duplicate username'
            );
        } else {
            $data = array(
                'status' => '1',
                'message' => 'data ready'
            );
        }
        return $data;
    }
    public function _update_user($id, $field)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('uac_user', $field);
        if ($query == 1) {
            $data['response'] = array(
                'statusCode' => 00,
                'message' => 'success update data'
            );
        } else {
            $data['response'] = array(
                'statusCode' => 99,
                'message' => 'system error'
            );
        }
        return $data;
    }
    public function _check_delete_parent($id)
    {
        $query = $this->db->query("SELECT * FROM  `uac_parent_menu` as A JOIN uac_menu_mapping  as B ON A.id = B.parent_map_id WHERE A.id = $id", 1);
        if ($query->num_rows() > 0) {
            $data = array(
                'status' => '0',
                'message' => 'failed, please remove Access Map first'
            );
        } else {
            $data = array(
                'status' => '1',
                'message' => 'success deleting map'
            );
        }
        return $data;
    }
    public function _check_delete_access($id)
    {
        $query = $this->db->query("SELECT * FROM  `uac_menu_mapping` as A JOIN uac_permission  as B ON A.id = B.access_map_id WHERE A.id = $id", 1);
        if ($query->num_rows() > 0) {
            $data = array(
                'status' => '0',
                'message' => 'failed, please remove user permission to delete this Access Map first'
            );
        } else {
            $data = array(
                'status' => '1',
                'message' => 'success deleting access map'
            );
        }
        return $data;
    }
    public function _update_parent_map($id, $field)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('uac_parent_menu', $field);
        if ($query == 1) {
            $data = array(
                'status' => '1',
                'message' => 'success update parent map data'
            );
        } else {
            $data = array(
                'status' => '0',
                'message' => 'system error'
            );
        }
        return $data;
    }
    public function _update_access_map($id, $field)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('uac_menu_mapping', $field);
        if ($query == 1) {
            $data = array(
                'status' => '1',
                'message' => 'success update access mapdata'
            );
        } else {
            $data = array(
                'status' => '0',
                'message' => 'system error'
            );
        }
        return $data;
    }
    public function _create_parent_map($field)
    {
        $query = $this->db->insert('uac_parent_menu', $field);
        if ($query == 1) {
            $data = array(
                'status' => '1',
                'message' => 'success create parent map data'
            );
        } else {
            $data = array(
                'status' => '0',
                'message' => 'system error'
            );
        }
        return $data;
    }
    public function _create_access_map($field)
    {
        $query = $this->db->insert('uac_menu_mapping', $field);
        if ($query == 1) {
            $data = array(
                'status' => '1',
                'message' => 'success create access map data'
            );
        } else {
            $data = array(
                'status' => '0',
                'message' => 'system error'
            );
        }
        return $data;
    }
    public function _check_parent_map($field)
    {
        $query = $this->db->get_where('uac_parent_menu', array('parent_map' => $field['parent_map']), 1);
        if ($query->num_rows() > 0) {
            $data = array(
                'status' => '0',
                'message' => 'duplicate parent map name'
            );
        } else {
            $data = array(
                'status' => '1',
                'message' => 'ready'
            );
        }
        return $data;
    }
    public function _check_access_map($field)
    {
        $query = $this->db->get_where('uac_menu_mapping', array('access_map' => $field['access_map']), 1);
        if ($query->num_rows() > 0) {
            $data = array(
                'status' => '0',
                'message' => 'duplicate access map name'
            );
        } else {
            $data = array(
                'status' => '1',
                'message' => 'ready'
            );
        }
        return $data;
    }
    public function _view_access_map($id)
    {
        $query = $this->db->get_where('view_mapping', array('id' => $id));
        return ($query->result_array());
    }
}
