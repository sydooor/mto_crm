<?php
require_once APPPATH . '/models/YZ_Model.php';
class Manage_model extends YZ_Model {
	
	/**
	 * 数据库表名称
	 */
	public $db_table_name = '`manager_users`';
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 通过邮件查找用户
	 *
	 * @param unknown $email        	
	 */
	public function get_manager_by_email($email){
		$query = $this->db->get_where($this->db_table_name, array(
				'email' => $email 
		));
		return $query->row_array();
	}
	
	/**
	 * 添加管理员
	 */
	public function add_manager($aData){
		$this->create_time = time();
		$this->db->insert($this->db_table_name, $aData);
		return $this->db->insert_id();
	}
	
	/**
	 * 修复管理员资料
	 */
	public function update_manager($aData){
		$this->db->where('id', $aData['id']);
		if(isset($aData['password']) && $aData['password']){
			$aData['password'] = md5($aData['password']);
		}
		return $this->db->update($this->db_table_name, $aData);
	}
	
	/**
	 * 判断登陆状态
	 */
	public function is_login(){
		$this->load->helper('cookie');
		$id = $this->input->cookie('manager_user_id');
		if(! $id){
			return false;
		}
		$query = $this->db->get_where($this->db_table_name, array(
				'manager_user_id' => $id 
		));
		$aManager = $query->row_array();
		if(! $aManager){
			return false;
		}
		$xid = md5($aManager['email'] . $aManager['password'] . $aManager['status'] . $this->input->user_agent()); // $_SERVER['REMOTE_ADDR']
		$key = $this->input->cookie('xid');
		if($xid != $key){
			return false;
		}
		return $aManager;
	}
	
	/**
	 * 修改管理员的分组名称
	 *
	 * @param unknown $manager_group_id        	
	 * @param unknown $group_name        	
	 */
	public function update_group_name_by_manager_group_id($manager_group_id, $group_name){
		$data = array(
				'group_name' => $group_name 
		);
		$this->db->where('manager_group_id', $manager_group_id);
		return $this->db->update($this->db_table_name, $data);
	}
	
	/**
	 * 获取所有的管理员用户
	 */
	public function get_manager_users(){
		$sql = 'select * from ' . $this->db_table_name;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/**
	 * 根据管理员用户名获取管理员信息
	 *
	 * @param unknown $manager_user_name        	
	 */
	public function get_manager_users_by_manager_user_name($manager_user_name){
		$query = $this->db->get_where($this->db_table_name, array(
				'manager_user_name' => $manager_user_name 
		));
		return $query->row_array();
	}
	
	/**
	 * 添加管理员用户
	 *
	 * @param unknown $aManagerUser        	
	 */
	public function add_manager_users($aManagerUser){
		return $this->db->insert($this->db_table_name, $aManagerUser);
	}
	
	/**
	 * 根据管理员用户ID获取管理员信息
	 *
	 * @param unknown $manager_user_id        	
	 */
	public function get_manager_users_by_manager_user_id($manager_user_id){
		$query = $this->db->get_where($this->db_table_name, array(
				'manager_user_id' => $manager_user_id 
		));
		return $query->row_array();
	}
	
	/**
	 * 修改管理员用户
	 *
	 * @param unknown $manager_user_id        	
	 * @param unknown $aManagerUser        	
	 */
	public function update_manager_users($manager_user_id, $aManagerUser){
		$this->db->where('manager_user_id', $manager_user_id);
		return $this->db->update($this->db_table_name, $aManagerUser);
	}
	
	/**
	 * 获取管理员能访问的第三级栏目ID集合
	 *
	 * @param unknown $manager_group_id        	
	 */
	public function get_user_visit_category_colunm_id($manager_group_id){
		$sql = 'select distinct a.category_colunm_id from actions a, manager_user_action b where a.action_id=b.action_id and b.manager_group_id=?';
		$query = $this->db->query($sql, array(
				$manager_group_id 
		));
		return $query->result_array();
	}
}
