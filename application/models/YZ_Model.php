<?php

/**
 * 基础数据模型
 * @author michael
 *
 */
class YZ_Model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	
	
	/**
	 * 数据库表名
	 */
	public $db_table_name = '';
	
	/**
	 * 主关键字名称
	 *
	 * @var string
	 */
	public $private_key_name = '';
	
	/**
	 * 添加
	 */
	public function add($aRecord){
		$this->db->insert($this->db_table_name, $aRecord);
		return $this->db->insert_id();
	}
	
	/**
	 * 修改
	 */
	public function update($aRecord){
		$this->db->where($this->private_key_name, $aRecord[$this->private_key_name]);
		return $this->db->update($this->db_table_name, $aRecord);
	}
	
	/**
	 * 删除
	 */
	public function delete($id){
		$this->db->where($this->private_key_name, $id);
		$this->db->delete($this->db_table_name);
		$result = $this->db->affected_rows();
		return $result;
	}
	
	// --------------------------------------
	// 查询
	// --------------------------------------
	
	/**
	 * 通过主关键字获取数据记录
	 */
	public function get_record_by_private_key($id){
		$query = $this->db->get_where($this->db_table_name, array(
				$this->private_key_name => $id
		));
		return $query->row_array();
	}
	
	
	
	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param string $key        	
	 */
	public function __get($key){
		//这里确保数据库只有需要的时候才会连接
		$instance = get_instance();
		if($key == 'db'){
			if(! property_exists($instance, 'db')){
				$instance->load->database();
				if(false === $instance->db->conn_id){
					$instance->db->initialize();
				}
			}
		}
		return $instance->$key;
	}
}