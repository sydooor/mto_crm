<?php
require_once 'BaseVo.php';
/**
 * 管理员管理VO
 *
 * 对应表 - manager_users
 *
 * @author johnson
 *        
 */
class ManageUserVo extends BaseVo {
	/**
	 * 管理员用户ID，自增
	 */
	public $manager_user_id;
	/**
	 * 管理员用户名称
	 */
	public $manager_user_name;
	/**
	 * 管理员分组ID
	 */
	public $manager_group_id;
	/**
	 * 管理员分组名字(冗余字段)
	 */
	public $group_name;
	/**
	 * 管理员用户昵称
	 */
	public $user_nick;
	/**
	 * 手机号
	 */
	public $mobile;
	/**
	 * 邮箱，登录所用
	 */
	public $email;
	/**
	 * 登录密码
	 */
	public $password;
	/**
	 * 1正常，2禁用
	 */
	public $status;
	
	/**
	 * 数据库字段转化对象
	 */
	static function dbToObjKeys(){
		return array(
				'manager_user_id' => 'manager_user_id',
				'manager_user_name' => 'manager_user_name',
				'manager_group_id' => 'manager_group_id',
				'group_name' => 'group_name',
				'user_nick' => 'user_nick',
				'mobile' => 'mobile',
				'email' => 'email',
				'password' => 'password',
				'status' => 'status' 
		);
	}
	
	/**
	 * 对象转换成数组
	 */
	static function objTodbKeys(){
		return array(
				'manager_user_id' => 'manager_user_id',
				'manager_user_name' => 'manager_user_name',
				'manager_group_id' => 'manager_group_id',
				'group_name' => 'group_name',
				'user_nick' => 'user_nick',
				'mobile' => 'mobile',
				'email' => 'email',
				'password' => 'password',
				'status' => 'status' 
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