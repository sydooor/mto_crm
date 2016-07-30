<?php
require_once APPPATH . '/models/YZ_Model.php';
/**
 * 权限数据模型
 *
 * @author michael
 *
 */
class Callreason_model extends YZ_Model {
	/**
	 * 数据库表名
	 */
	public $db_table_name = '`call_reason`';
	
	/**
	 * 主关键字名称
	 *
	 * @var string
	 */
	public $private_key_name = 'id';
	
	
	
	function __construct(){
		parent::__construct();
	}
	
}