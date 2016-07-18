<?php

/**
 * 管理员状态枚举
 */
class ManagerUserStatusEnum
{

    /**
     * 正常
     *
     * @var unknown
     */
    const NORMAL = 1;

    /**
     * 禁用
     *
     * @var unknown
     */
    const DISABLE = 2;

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
            case ManagerUserStatusEnum::NORMAL:
                $desc = '正常';
                break;
            case ManagerUserStatusEnum::DISABLE:
                $desc = '禁用';
                break;
        }
        
        return $desc;
    }
}