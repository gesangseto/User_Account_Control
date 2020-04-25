<?php

defined('BASEPATH') or exit('No direct script access allowed');

class _UAC_Group extends CI_Model
{
    public function _view_group($id)
    {
        $query = $this->db->get_where('view_group', array('id' => $id));
        return ($query->result_array());
    }
    public function _view_group_user($id)
    {
        $query = $this->db->query("SELECT * FROM `uac_user` WHERE group_id=$id");
        return ($query->result_array());
    }
    public function _view_group_permission($id)
    {
        $query = $this->db->query("	SELECT
        `a`.`access_map_id` AS `id`,
        `a`.`access_map_id` AS `access_map_id`,
        `c`.`parent_map`    AS `parent_map`,
        `b`.`access_map`    AS `access_map`,
        `a`.`create` AS `create`,
        `a`.`read`  AS `read`,
        `a`.`update` AS `update`,
        `a`.`delete` AS `delete`
      FROM ((`uac_permission` `a`
          JOIN `uac_menu_mapping` `b`
            ON (`a`.`access_map_id` = `b`.`id`))
         JOIN `uac_parent_menu` `c`
           ON (`b`.`parent_map_id` = `c`.`id`))
      WHERE a.`group_id`='" . $id . "'");
        return ($query->result_array());
    }
}
