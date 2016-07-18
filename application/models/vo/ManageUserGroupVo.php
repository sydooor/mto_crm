<?php
require_once 'BaseVo.php';
/**
 * 管理员分组管理VO
 *
 * 对应表 - manager_users
 *
 * @author johnson
 *        
 */
class ManageUserGroupVo extends BaseVo {
	
	/**
	 * 管理员分组ID，自增
	 */
	public $manager_group_id;
	
	/**
	 * 管理员分组名字
	 */
	public $group_name;
	
	/**
	 * 管理员分组描述
	 */
	public $description;
	
	/**
	 * 数据库字段转化对象
	 */
	static function dbToObjKeys(){
		return array(
				'manager_group_id' => 'manager_group_id',
				'group_name' => 'group_name',
				'description' => 'description' 
		);
	}
	
	/**
	 * 对象转换成数组
	 */
	static function objTodbKeys(){
		return array(
				'manager_group_id' => 'manager_group_id',
				'group_name' => 'group_name',
				'description' => 'description' 
		);
	}
	
	/**
	 * 特殊转化字段
	 *
	 * @param unknown $key        	
	 * @param unknown $value        	
	 */
	static function transformerForKey($key, $value){
		return $value;
	}
}