<?php
require_once APPPATH . '/models/YZ_Model.php';
class Manageruserlog_model extends YZ_Model {
	
	/**
	 * 数据库表名称
	 */
	public $db_table_name = '`manager_user_logs`';
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 添加管理员操作日志
	 *
	 * @param unknown $log        	
	 */
	public function add_manager_user_log($aLog){
		return $this->db->insert($this->db_table_name, $aLog);
	}
	
	/**
	 * 获取后台日志总数
	 *
	 * @param unknown $aWhere        	
	 */
	public function get_count($aWhere){
		$this->db->from($this->db_table_name);
		$where = $this->_parseWhere($aWhere);
		if($where){
			$this->db->where($where);
		}
		return $this->db->count_all_results();
	}
	
	/**
	 * 获取后台日志列表
	 *
	 * @param unknown $aWhere        	
	 * @param unknown $page        	
	 * @param unknown $per_page        	
	 */
	public function get_manager_user_log_list($aWhere, $page, $per_page){
		$offset = ($page - 1) * $per_page;
		$where = $this->_parseWhere($aWhere);
		$this->db->order_by('create_time', 'desc');
		if($where){
			$query = $this->db->get_where($this->db_table_name, $where, $per_page, $offset);
		}else{
			$query = $this->db->get($this->db_table_name, $per_page, $offset);
		}
		return $query->result_array();
	}
	
	/**
	 * 条件
	 *
	 * @param unknown $aWhere        	
	 * @return multitype:string unknown
	 */
	private function _parseWhere($aWhere){
		$where = array();
		if(isset($aWhere['manager_user_id']) && $aWhere['manager_user_id'] != - 1){
			$where['manager_user_id'] = $aWhere['manager_user_id'];
		}
		
		if(isset($aWhere['type']) && $aWhere['type'] != - 1){
			$where['type'] = $aWhere['type'];
		}
		
		if(isset($aWhere['start_create_time']) && $aWhere['start_create_time']){
			$where['create_time >='] = $aWhere['start_create_time'] . ' 00:00:00';
		}
		if(isset($aWhere['end_create_time']) && $aWhere['end_create_time']){
			$where['create_time <='] = $aWhere['end_create_time'] . ' 23:59:59';
		}
		
		return $where;
	}
}
?>