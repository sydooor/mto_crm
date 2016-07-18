<?php

/**
 * 栏目级别枚举
 */
class CategoryColumnLevelEnum
{

    /**
     * 一级栏目
     *
     * @var unknown
     */
    const ONE = 1;

    /**
     * 二级栏目
     *
     * @var unknown
     */
    const TWO = 2;

    /**
     * 三级栏目
     *
     * @var unknown
     */
    const THREE = 3;

    /**
     * 获取枚举描述
     *
     * @param unknown $member            
     * @return string
     */
    public static function getDescription($member)
    {
        $desc = '未知';
        
        switch ($member) {
            case CategoryColumnLevelEnum::ONE:
                $desc = '一级栏目';
                break;
            case CategoryColumnLevelEnum::TWO:
                $desc = '二级栏目';
                break;
            case CategoryColumnLevelEnum::THREE:
                $desc = '三级栏目';
                break;
        }
        
        return $desc;
    }

    /**
     * 检查
     *
     * @param unknown $member            
     * @return boolean
     */
    public static function check($member)
    {
        $target = false;
        
        switch ($member) {
            case CategoryColumnLevelEnum::ONE:
            case CategoryColumnLevelEnum::TWO:
            case CategoryColumnLevelEnum::THREE:
                $target = true;
                break;
        }
        
        return $target;
    }
}