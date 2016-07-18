<?php
/**
 * 基类VO
 *        
 */
class BaseVo {
	
	/**
	 * 特殊转化字段
	 *
	 * @param unknown $key        	
	 * @param unknown $value        	
	 */
	static function transformerForKey($key, $value){
		return $value;
	}
	/**
	 * 重写set方法
	 *
	 * @param unknown $name        	
	 * @param unknown $value        	
	 */
	public function __set($name, $value){
		$cls = get_class($this);
		// 获取转换数组
		$properties = call_user_func($cls . '::dbToObjKeys');
		$key = $name;
		if(key_exists($name, $properties)){
			$key = $properties[$name];
		}
		$this->{$key} = call_user_func($cls . '::transformerForKey', $key, $value);
	}
	/**
	 * 把对象转化成数组
	 *
	 * @param boolean $ignore_null
	 *        	是否忽略null，如果为true,null的内容将不赋值到数组
	 * @return multitype:unknown
	 */
	public function toArray($ignore_null = false){
		$cls = get_class($this);
		// 获取转换数组
		$properties = call_user_func($cls . '::objTodbKeys');
		$array = array();
		foreach(get_object_vars($this) as $key => $val){
			if(! is_object($val) && ! is_array($val) && $key !== '_parent_name'){
				if($ignore_null && is_null($val)){
					continue;
				}
				$mykey = $key;
				if(key_exists($key, $properties)){
					$mykey = $properties[$key];
				}
				$array[$mykey] = call_user_func($cls . '::transformerForKey', $mykey, $val);
			}
		}
		return $array;
	}
	
	/**
	 * 根据数组初始化
	 *
	 * @param array $data        	
	 */
	public function wrapWithArray($dataArr){
		if(! is_null($dataArr) && is_array($dataArr)){
			foreach($dataArr as $key => $value){
				$this->{$key} = $value;
			}
		}
	}
	/**
	 * 把数据表的数组转换成对象
	 */
	public function toObject($dataArr){
		$cls = get_class($this);
		// 获取转换数组
		$properties = call_user_func($cls . '::dbToObjKeys');
		if(! is_null($dataArr) && is_array($dataArr)) {
			foreach ($dataArr as $key => $val) {
				$mykey = $key;
				if (key_exists($key, $properties)) {
					$mykey = $properties[$key];
				}
				$this->{$mykey} = call_user_func($cls . '::transformerForKey', $key, $val);
			}
		}
	}
}