<?php
require_once APPPATH . '/models/YZ_Model.php';
/**
 * 对应表manager_user_action
 */
class Manageruseraction_model extends YZ_Model {
	/**
	 * 数据库表名称
	 */
	public $db_table_name = '`manager_user_action`';
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 获取分组的权限
	 *
	 * @param unknown $manager_group_id        	
	 */
	public function get_manager_user_action_by_manager_group_id($manager_group_id){
		$query = $this->db->get_where($this->db_table_name, array(
				'manager_group_id' => $manager_group_id 
		));
		return $query->result_array();
	}
	
	/**
	 * 批量添加分组权限
	 *
	 * @param unknown $add_user_action        	
	 */
	public function batch_add_manager_user_action($add_user_action){
		return $this->db->insert_batch($this->db_table_name, $add_user_action);
	}
	
	/**
	 * 批量删除分组权限
	 *
	 * @param unknown $id        	
	 */
	public function batch_delete_manager_user_action_by_id($ids){
		$this->db->where_in('id', $ids);
		return $this->db->delete($this->db_table_name);
	}
	
	/**
	 * 检查管理员权限
	 *
	 * @param unknown $manager_group_id        	
	 * @param unknown $class        	
	 * @param unknown $method        	
	 */
	public function check_manager_user_action($manager_group_id, $action_id){
		$sql = 'select * from manager_user_action where manager_group_id=? and action_id=?';
		$query = $this->db->query($sql, array(
				$manager_group_id,
				$action_id 
		));
		return $query->row_array();
	}
}