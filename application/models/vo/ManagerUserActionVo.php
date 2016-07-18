<?php
require_once 'BaseVo.php';
/**
 * 分组权限VO
 *
 * 对应表 - manager_user_action
 */
class ManagerUserActionVo extends BaseVo {
	
	/**
	 * 分组权限Id，自增
	 *
	 * @var unknown
	 */
	public $id;
	
	/**
	 * 权限Id
	 *
	 * @var unknown
	 */
	public $action_id;
	
	/**
	 * 管理员分组Id
	 *
	 * @var unknown
	 */
	public $manager_group_id;
	
	/**
	 * 数据库字段转化对象
	 */
	static function dbToObjKeys(){
		return array(
				'id' => 'id',
				'action_id' => 'action_id',
				'manager_group_id' => 'manager_group_id' 
		);
	}
	
	/**
	 * 对象转换成数组
	 */
	static function objTodbKeys(){
		return array(
				'id' => 'id',
				'action_id' => 'action_id',
				'manager_group_id' => 'manager_group_id' 
		);
	}
	
	/**
	 * 特殊转化字段
	 *
	 * @param unknown $key        	
	 * @param unknown $value        	
	 * @return unknown
	 */
	static function transformerForKey($key, $value){
		return $value;
	}
}