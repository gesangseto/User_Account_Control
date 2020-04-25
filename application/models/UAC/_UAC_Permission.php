<?php

defined('BASEPATH') or exit('No direct script access allowed');

class _UAC_permission extends CI_Model
{
    public function _view_all_role()
    {
        $query = $this->db->query("SELECT A.id AS group_id,A.username AS username,A.email AS email,B.id AS permission_id,B.access_map_id AS access_map_id,count(*) as total_permission 
        FROM  `uac_user` AS `A` JOIN `uac_permission` AS `B` ON `A`.`id` = `B`.`group_id` 
        GROUP BY `A`.`username` ASC");
        return ($query->result_array());
    }
    public function _view_all_user()
    {
        $query = $this->db->query("SELECT * FROM  `uac_user`  GROUP BY `username` ASC");
        return ($query->result_array());
    }
    public function _view_group($id)
    {
        $query = $this->db->get_where('view_group', array('id' => $id));
        return ($query->result_array());
    }
    public function _view_user_permission($id)
    {
        $query = $this->db->query("SELECT `A`.`id` AS `permission_id`, `B`.`access_map` AS `access_map`, `C`.`parent_map` AS `parent_map` ,`A`.`create` AS `create`, `A`.`read` AS `read`,`A`.`update` AS `update`,`A`.`delete` AS `delete`
                                    FROM `uac_permission` AS `A` 
                                    JOIN  `uac_menu_mapping` AS `B` ON `A`.`access_map_id` = `B`.`id` 
                                    JOIN  `uac_parent_menu`AS C ON B.parent_map_id=C.id
                                    WHERE A.group_id=$id");
        return ($query->result_array());
    }
    public function _update_role($id, $field)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('uac_permission', $field);
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
    public function _check_delete_permission($id)
    {
        $execute = $this->db->get_where('view_group', array('id' => $id));
        if ($execute->num_rows() > 0) {
            $data = array(
                'status' => '0',
                'message' => 'Must Delete Group'
            );
        } else {
            $data = array(
                'status' => '0',
                'message' => 'system error'
            );
        }
        return $data;
    }
    public function _view_access_map()
    {
        $query = $this->db->query("SELECT A.id AS id,A.access_map AS access_map, B.parent_map AS parent_map FROM  `uac_menu_mapping` as `A`
                                    JOIN  `uac_parent_menu` as `B` ON `A`.`parent_map_id` = `B`.`id`
                                    ORDER BY 'parent_map' ASC");
        return ($query->result_array());
    }
    public function _view_parent_map()
    {
        $query = $this->db->query("SELECT * FROM  `uac_parent_menu` ORDER BY 'parent_map' ASC");
        return ($query->result_array());
    }
    public function _check_role($field)
    {
        $query = $this->db->get_where('uac_permission', array('group_id' => $field['group_id'], 'access_map_id' => $field['access_map_id']));
        if ($query->num_rows() == 0) {
            $data = array(
                'status' => '1',
                'message' => 'success update data'
            );
        } else {
            $data = array(
                'status' => '0',
                'message' => 'duplicate permission'
            );
        }
        return $data;
    }
    public function _create_permission($field)
    {
        $query = $this->db->insert('uac_permission', $field);
        if ($query) {
            $data = array(
                'status' => '1',
                'message' => 'success add permission'
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
