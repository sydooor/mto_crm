<?php
require_once 'BaseVo.php';
/**
 * 权限VO
 *
 * 对应表 -- actions
 */
class ActionsVo extends BaseVo {
	
	/**
	 * 权限Id，自增
	 *
	 * @var unknown
	 */
	public $action_id;
	
	/**
	 * 权限名称
	 *
	 * @var unknown
	 */
	public $name;
	
	/**
	 * 实现权限的类名称
	 *
	 * @var unknown
	 */
	public $class;
	
	/**
	 * 实现权限的方法名称
	 *
	 * @var unknown
	 */
	public $method;
	
	/**
	 * 权限关键字
	 *
	 * @var unknown
	 */
	public $action;
	
	/**
	 * 所属分类ID
	 *
	 * @var unknown
	 */
	public $category_colunm_id;
	
	/**
	 * 数据库字段转化对象
	 */
	static function dbToObjKeys(){
		return array(
				'action_id' => 'action_id',
				'name' => 'name',
				'class' => 'class',
				'method' => 'method',
				'action' => 'action',
				'category_colunm_id' => 'category_colunm_id' 
		);
	}
	
	/**
	 * 对象转换成数组
	 */
	static function objTodbKeys(){
		return array(
				'action_id' => 'action_id',
				'name' => 'name',
				'class' => 'class',
				'method' => 'method',
				'action' => 'action',
				'category_colunm_id' => 'category_colunm_id' 
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