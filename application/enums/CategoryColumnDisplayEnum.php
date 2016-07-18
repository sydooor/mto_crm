<?php

/**
 * 栏目显示枚举
 */
class CategoryColumnDisplayEnum
{

    /**
     * 不显示
     *
     * @var unknown
     */
    const N = 0;

    /**
     * 显示
     *
     * @var unknown
     */
    const Y = 1;

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
            case CategoryColumnDisplayEnum::Y:
                $desc = '显示';
                break;
            case CategoryColumnDisplayEnum::N:
                $desc = '不显示';
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
            case CategoryColumnDisplayEnum::Y:
            case CategoryColumnDisplayEnum::N:
                $target = true;
                break;
        }
        
        return $target;
    }
}