<?php
require_once APPPATH . '/models/YZ_Model.php';
/**
 * 权限数据模型
 * 
 * @author michael
 *        
 */
class Actions_model extends YZ_Model {
	
	/**
	 * 数据库表名称
	 */
	public $db_table_name = '`actions`';
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * 获取所有的权限
	 */
	public function get_actions(){
		$sql = 'select * from ' . $this->db_table_name . ' order by category_colunm_id asc, action_id asc';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/**
	 * 检查类和方法是否纳入权限
	 *
	 * @param unknown $class        	
	 * @param unknown $method        	
	 */
	public function check_action($class, $method){
		$sql = 'select * from actions where class=? and method=?';
		$query = $this->db->query($sql, array(
				$class,
				$method 
		));
		return $query->row_array();
	}
	
	/**
	 * 获取纳入权限管理的第三级栏目ID集合
	 */
	public function get_category_colunm_id_from_actions(){
		$sql = 'select category_colunm_id from actions group by category_colunm_id';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
?>