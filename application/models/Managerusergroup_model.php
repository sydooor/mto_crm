<?php
require_once APPPATH . '/models/YZ_Model.php';
/**
 * 对应表manager_user_group
 */
class Managerusergroup_model extends YZ_Model {
	/**
	 * 数据库表名称
	 */
	public $db_table_name = '`manager_user_group`';
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 获取所有的管理员分组
	 */
	public function get_manager_user_group(){
		$sql = 'select * from ' . $this->db_table_name;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/**
	 * 根据管理员分组名称获取分组信息
	 *
	 * @param unknown $group_name        	
	 */
	public function get_manager_user_group_by_group_name($group_name){
		$query = $this->db->get_where($this->db_table_name, array(
				'group_name' => $group_name 
		));
		return $query->row_array();
	}
	
	/**
	 * 添加管理员分组
	 *
	 * @param unknown $aUserGroup        	
	 */
	public function add_manager_user_group($aUserGroup){
		return $this->db->insert($this->db_table_name, $aUserGroup);
	}
	
	/**
	 * 根据管理员分组ID获取分组信息
	 *
	 * @param unknown $manager_group_id        	
	 */
	public function get_manager_user_group_by_manager_group_id($manager_group_id){
		$query = $this->db->get_where($this->db_table_name, array(
				'manager_group_id' => $manager_group_id 
		));
		return $query->row_array();
	}
	
	/**
	 * 根据管理员分组Id修改管理员分组
	 *
	 * @param unknown $manager_group_id        	
	 * @param unknown $aUserGroup        	
	 */
	public function update_manager_user_group($manager_group_id, $aUserGroup){
		$this->db->where('manager_group_id', $manager_group_id);
		return $this->db->update($this->db_table_name, $aUserGroup);
	}
}