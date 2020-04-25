<?php
defined('BASEPATH') or exit('No direct script access allowed');

class _BaseRole extends CI_Model
{
  public function _check_permission()
  {
    $id = $this->session->userdata('group_id');
    $query_access_map = $this->db->query("SELECT * FROM `uac_permission` AS `A` 
                            JOIN  `uac_menu_mapping` AS `B` ON `A`.`access_map_id` = `B`.`id` 
                            JOIN  `uac_parent_menu` AS `C` ON `B`.`parent_map_id` = `C`.`id` 
                            WHERE `group_id` = '$id' ORDER BY parent_map ASC");
    $i = 0;
    if ($query_access_map->num_rows() > 0) {
      foreach ($query_access_map->result_array() as $row) {
        $data[$i] = $row;
        $i++;
      }
      return $data;
    } else {
      return FALSE;
    }
  }
  public function _load_logs()
  {
    $user_id = $this->session->userdata('id');
    $query_logs = $this->db->query("SELECT * FROM `logs` WHERE `user_id` = '$user_id' ORDER BY `time` DESC Limit 5");
    return $query_logs->result_array();
  }
}
