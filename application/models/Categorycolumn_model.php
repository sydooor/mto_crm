<?php
require_once APPPATH . '/models/YZ_Model.php';
/**
 * 栏目分类目录
 * 
 * @author michael
 *        
 */
class Categorycolumn_model extends YZ_Model {
	
	/**
	 * 数据库表名称
	 */
	public $db_table_name = '`category_column`';
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * 获取所有的分类目录
	 */
	public function get_category_columns(){
		$sql = 'select * from ' . $this->db_table_name . ' order by `level` asc, `order` asc';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/**
	 * 添加栏目分类目录
	 *
	 * @param unknown $aCategory        	
	 */
	public function add_category_columns($aCategory){
		return $this->db->insert($this->db_table_name, $aCategory);
	}
	
	/**
	 * 根据栏目Id查找栏目分类目录
	 *
	 * @param unknown $category_colunm_id        	
	 */
	public function get_category_columns_by_category_columns_id($category_colunm_id){
		$query = $this->db->get_where($this->db_table_name, array(
				'category_colunm_id' => $category_colunm_id 
		));
		return $query->row_array();
	}
	
	/**
	 * 根据栏目Id修改栏目分类目录
	 *
	 * @param unknown $category_column_id        	
	 * @param unknown $aCategory        	
	 */
	public function update_category_columns($category_column_id, $aCategory){
		$this->db->where('category_colunm_id', $category_column_id);
		return $this->db->update($this->db_table_name, $aCategory);
	}
}