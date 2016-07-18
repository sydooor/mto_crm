<?php
require_once 'BaseVo.php';
/**
 * 管理员操作日志VO
 *
 * 对应表 -- manager_user_logs
 */
class ManagerUserLogVo extends BaseVo {
	
	/**
	 * 管理员操作日志Id，自增
	 *
	 * @var unknown
	 */
	public $id;
	
	/**
	 * 管理员Id
	 *
	 * @var unknown
	 */
	public $manager_user_id;
	
	/**
	 * 管理员名称
	 *
	 * @var unknown
	 */
	public $manager_user_name;
	
	/**
	 * 日志类型
	 *
	 * @see ManagerUserLogEnum
	 * @var unknown
	 */
	public $type;
	
	/**
	 * 日志创建时间
	 *
	 * @var unknown
	 */
	public $create_time;
	
	/**
	 * detail
	 *
	 * @var unknown
	 */
	public $detail;
	
	/**
	 * 数据库字段转化对象
	 */
	static function dbToObjKeys(){
		return array(
				'id' => 'id',
				'manager_user_id' => 'manager_user_id',
				'manager_user_name' => 'manager_user_name',
				'type' => 'type',
				'create_time' => 'create_time',
				'detail' => 'detail' 
		);
	}
	
	/**
	 * 对象转换成数组
	 */
	static function objTodbKeys(){
		return array(
				'id' => 'id',
				'manager_user_id' => 'manager_user_id',
				'manager_user_name' => 'manager_user_name',
				'type' => 'type',
				'create_time' => 'create_time',
				'detail' => 'detail' 
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