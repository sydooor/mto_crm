<?php
/**
 * 数据逻辑删除状态
 * @author michael
 */
class DataLogicDeleteStatusEnum {
	
	/**
	 * 已删除
	 */
	const YES = 1;
	
	/**
	 * 未删除
	 */
	const NO = 0;
	
	/**
	 * 获取枚举描述
	 *
	 * @param unknown $member        	
	 * @return string
	 */
	public static function getDescription($member){
		$desc = '';
		
		switch($member){
			case DataLogicDeleteStatusEnum::YES:
				$desc = '已删除';
				break;
			case DataLogicDeleteStatusEnum::NO:
				$desc = '未删除';
				break;
		}
		
		return $desc;
	}
}