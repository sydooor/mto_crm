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