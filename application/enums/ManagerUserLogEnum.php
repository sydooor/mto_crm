<?php

/**
 * 管理员操作日志类型枚举
 */
class ManagerUserLogEnum
{

    /**
     * 登录
     *
     * @var unknown
     */
    const LOGIN = 1;

    /**
     * 添加管理员
     *
     * @var unknown
     */
    const ADD_MANAGER = 2;

    /**
     * 修改管理员
     *
     * @var unknown
     */
    const UPDATE_MANAGER = 3;

    /**
     * 添加分组
     *
     * @var unknown
     */
    const ADD_MANAGER_GROUP = 4;

    /**
     * 修改分组
     *
     * @var unknown
     */
    const UPDATE_MANAGER_GROUP = 5;

    /**
     * 权限分配
     *
     * @var unknown
     */
    const AUTHORIZATION = 6;

    /**
     * 添加栏目
     *
     * @var unknown
     */
    const ADD_CATEGORY = 7;

    /**
     * 修改栏目
     *
     * @var unknown
     */
    const UPDATE_CATEGORY = 8;

    /**
     * 添加号卡
     *
     * @var unknown
     */
    const ADD_CARD = 9;

    /**
     * 修改号卡
     *
     * @var unknown
     */
    const UPDATE_CARD = 10;

    /**
     * 删除号卡
     *
     * @var unknown
     */
    const DELETE_CARD = 11;

    /**
     * 导入号卡
     *
     * @var unknown
     */
    const IMPORT_CARD = 12;

    /**
     * 添加柚子卡套餐
     *
     * @var unknown
     */
    const ADD_PACKAGES = 13;

    /**
     * 修改柚子卡套餐
     *
     * @var unknown
     */
    const UPDATE_PACKAGES = 14;

    /**
     * 修改资料
     *
     * @var unknown
     */
    const UPDATE_OWN_INFO = 15;

    /**
     * 添加物流公司
     *
     * @var unknown
     */
    const ADD_EXPRESS_COMPANY = 16;

    /**
     * 修改物流公司
     *
     * @var unknown
     */
    const UPDATE_EXPRESS_COMPANY = 17;

    /**
     * 订单状态修改
     *
     * @var unknown
     */
    const UPDATE_ORDER_STATUS = 18;

    /**
     * 物流设置
     *
     * @var unknown
     */
    const ORDER_EXPRESS_SET = 19;

    /**
     * 订购
     *
     * @var unknown
     */
    const GENERATE_ASD_ORDER = 20;

    /**
     * 号卡充值
     *
     * @var unknown
     */
    const ASD_CARD_RECHARGE = 21;

    /**
     * 添加套餐地区
     *
     * @var unknown
     */
    const ADD_PACKAGE_AREA = 22;

    /**
     * 修改套餐地区
     *
     * @var unknown
     */
    const UPDATE_PACKAGE_AREA = 23;

    /**
     * 添加小贴士类别
     *
     * @var unknown
     */
    const ADD_TRAVELTIPS_CATEGORY = 24;

    /**
     * 修改小贴士类别
     *
     * @var unknown
     */
    const UPDATE_TRAVELTIPS_CATEGORY = 25;

    /**
     * 添加小贴士文章
     *
     * @var unknown
     */
    const ADD_WX_POST = 26;

    /**
     * 修改小贴士文章
     *
     * @var unknown
     */
    const UPDATE_WX_POST = 27;

    /**
     * 添加关键字
     *
     * @var unknown
     */
    const ADD_WX_KEYWORD = 28;

    /**
     * 修改关键字
     *
     * @var unknown
     */
    const UPDATE_WX_KEYWORD = 29;

    /**
     * 添加柚子套餐类型
     *
     * @var unknown
     */
    const ADD_PACKAGES_CATEGORY = 30;

    /**
     * 修改柚子套餐类型
     *
     * @var unknown
     */
    const UPDATE_PACKAGES_CATEGORY = 31;

    /**
     * 添加关键字消息
     *
     * @var unknown
     */
    const ADD_WX_KEYWORD_MESSAGE = 32;

    /**
     * 修改关键字消息
     *
     * @var unknown
     */
    const UPDATE_WX_KEYWORD_MESSAGE = 33;

    /**
     * 清除用户柚子套餐激活
     *
     * @var unknown
     */
    const CLEAN_PACKAGE_ACTIVATION = 34;

    /**
     * 修改订单
     *
     * @var unknown
     */
    const UPDATE_ORDER = 35;

    /**
     * 旅行分享审核
     *
     * @var unknown
     */
    const VERIFY_USER_POST = 36;

    /**
     * 添加渠道
     *
     * @var unknown
     */
    const ADD_CHANNEL = 37;

    /**
     * 修改渠道
     *
     * @var unknown
     */
    const UPDATE_CHANNEL = 38;

    /**
     * 内部下单（分销下单）
     *
     * @var unknown
     */
    const CHANNEL_ORDER = 39;

    /**
     * 添加寻找旅途队友问题
     *
     * @var unknown
     */
    const ADD_YZ_QUESTION = 40;

    /**
     * 修改寻找旅途队友问题
     *
     * @var unknown
     */
    const UPDATE_YZ_QUESTION = 41;

    /**
     * 删除寻找旅途队友问题
     *
     * @var unknown
     */
    const DELETE_YZ_QUESTION = 42;
    
    /**
     * 添加测试白名单
     *
     * @var unknown
     */
    const ADD_WHITE_LISTS = 43;
    
    /**
     * 删除测试白名单
     *
     * @var unknown
     */
    const DELETE_WHITE_LISTS = 44;
    
    /**
     * 添加归属地
     *
     * @var unknown
     */
    const ADD_ATTRIBUTION = 45;
    
    /**
     * 删除归属地
     *
     * @var unknown
     */
    const DELETE_ATTRIBUTION = 46;
    
    /**
     * 更新归属地
     *
     * @var unknown
     */
    const UPDATE_ATTRIBUTION = 47;
    
    /**
     * 添加套餐详情
     *
     * @var unknown
     */
    const ADD_PACKAGEINFO = 48;
    
    /**
     * 删除套餐详情
     *
     * @var unknown
     */
    const DELETE_PACKAGEINFO = 49;
    
    /**
     * 更新套餐详情
     *
     * @var unknown
     */
    const UPDATE_PACKAGEINFO = 50;
	
    /**
     * 删除地区
     *
     * @var unknown
     */
    const DELETE_AREA = 51;
    
     /**
     * 删除渠道
     *
     * @var unknown
     */
    const DELETE_CHANNEL = 52;
    
     /**
     * 导入订单
     *
     * @var unknown
     */
    const IMPORT_ORDER = 53;
    
    /**
     * 订单退款
     *
     * @var unknown
     */
    const REFUND_ORDER = 54;
    
    /**
     * 处理订单退款
     *
     * @var unknown
     */
    const DONG_REFUND_ORDER = 55;
    
    /**
     * 添加banner
     *
     * @var unknown
     */
    const ADD_BANNER = 56;
    
    /**
     * 修改banner
     *
     * @var unknown
     */
    const UPDATE_BANNER = 57;
    
    /**
     * 删除banner
     *
     * @var unknown
     */
    const DEL_BANNER = 58;
    
     /**
     * 添加continent
     *
     * @var unknown
     */
    const ADD_CONTINENT = 59;
    
    /**
     * 修改continent
     *
     * @var unknown
     */
    const UPDATE_CONTINENT = 60;
    
    /**
     * 删除continent
     *
     * @var unknown
     */
    const DEL_CONTINENT = 61;

    /**
     * 修改流量包信息
     * @var unknown
     */
    const UPDATE_FLOW_BAG = 62;
    
     /**
     * 修改voip通话管理
     *
     * @var unknown
     */
    const UPDATE_VOIPGETPHONETINE = 63;
    
    /**
     * 删除voip通话管理
     *
     * @var unknown
     */
    const DEL_VOIPGETPHONETINE = 64;

    /**
     * 添加voip通话管理
     * @var unknown
     */
    const ADD_VOIPGETPHONETINE = 65;
    
    /**
     * 修改领卡记录
     *
     * @var unknown
     */
    const UPDATE_GETCARD = 66;
    
    /**
     * 删除领卡记录
     *
     * @var unknown
     */
    const DEL_GETCARD = 67;

    /**
     * 添加领卡记录
     * @var unknown
     */
    const ADD_GETCARD = 68;
    
    /**
     * 修改领卡记录详情
     *
     * @var unknown
     */
    const UPDATE_GETCARDLOG = 69;
    
    /**
     * 删除领卡记录详情
     *
     * @var unknown
     */
    const DEL_GETCARDLOG = 70;

    /**
     * 添加领卡记录详情
     * @var unknown
     */
    const ADD_GETCARDLOG = 71;
    
    /**
     * 修改系统语音
     *
     * @var unknown
     */
    const UPDATE_USERCALLBINDSYSTEMVOICE = 72;
    
    /**
     * 删除系统语音
     *
     * @var unknown
     */
    const DEL_USERCALLBINDSYSTEMVOICE = 73;

    /**
     * 添加系统语音
     * @var unknown
     */
    const ADD_USERCALLBINDSYSTEMVOICE = 74;
    
    /**
     * 修改用户语音
     *
     * @var unknown
     */
    const UPDATE_USERCALLBINDUPLOADVOICE = 75;
    
    /**
     * 删除用户语音
     *
     * @var unknown
     */
    const DEL_USERCALLBINDUPLOADVOICE = 76;

    /**
     * 添加用户语音
     * @var unknown
     */
    const ADD_USERCALLBINDUPLOADVOICE = 77;
    
    /**
     * 修改订单收货人信息
     * @var unknown
     */
    const UPDATE_ORDEREXPRESSINFO = 78;
    
    /**
     * 修改voip套餐赠送管理信息
     * @var unknown
     */
    const UPDATE_VOIPRECHARGECARD = 79;
    
    /**
     * 添加voip套餐赠送管理信息
     * @var unknown
     */
    const ADD_VOIPRECHARGECARD = 80;

    /**
     * 撤销用户套餐
     * @var unknown
     */
    const CANCEL_USER_PACKAGE = 100;
    
	/**
     * 添加API调试分类
     * @var unknown
     */
    const ADD_API_DEBUG_CLASS = 201;

     /**
     * 修改API调试分类
     * @var unknown
     */
    const UPDATE_API_DEBUG_CLASS = 202;
	
     /**
     * 删除API调试分类
     * @var unknown
     */
    const DEL_API_DEBUG_CLASS = 203;

    /**
     * 添加API调试接口
     * @var unknown
     */
    const ADD_API_DEBUG_FORM = 204;

     /**
     * 修改API调试接口
     * @var unknown
     */
    const UPDATE_API_DEBUG_FORM = 205;
	
     /**
     * 删除API调试接口
     * @var unknown
     */
    const DEL_API_DEBUG_FORM = 206;


    /**
     * 添加API调试接口的参数
     * @var unknown
     */
    const ADD_API_DEBUG_ARGS = 207;

     /**
     * 修改API调试接口的参数
     * @var unknown
     */
    const UPDATE_API_DEBUG_ARGS = 208;
	
     /**
     * 删除API调试接口的参数
     * @var unknown
     */
    const DEL_API_DEBUG_ARGS = 209;

    /**
     * 获取枚举描述
     * 
     * @param unknown $member            
     * @return string
     */
    public static function getDescription($member)
    {
        $desc = '';
        
        switch ($member) {
            case ManagerUserLogEnum::LOGIN:
                $desc = '登录';
                break;
            case ManagerUserLogEnum::ADD_MANAGER:
                $desc = '添加管理员';
                break;
            case ManagerUserLogEnum::UPDATE_MANAGER:
                $desc = '修改管理员';
                break;
            case ManagerUserLogEnum::ADD_MANAGER_GROUP:
                $desc = '添加分组';
                break;
            case ManagerUserLogEnum::UPDATE_MANAGER_GROUP:
                $desc = '修改分组';
                break;
            case ManagerUserLogEnum::AUTHORIZATION:
                $desc = '权限分配';
                break;
            case ManagerUserLogEnum::ADD_CATEGORY:
                $desc = '添加栏目';
                break;
            case ManagerUserLogEnum::UPDATE_CATEGORY:
                $desc = '修改栏目';
                break;
            case ManagerUserLogEnum::ADD_CARD:
                $desc = '添加号卡';
                break;
            case ManagerUserLogEnum::UPDATE_CARD:
                $desc = '修改号卡';
                break;
            case ManagerUserLogEnum::DELETE_CARD:
                $desc = '删除号卡';
                break;
            case ManagerUserLogEnum::IMPORT_CARD:
                $desc = '导入号卡';
                break;
            case ManagerUserLogEnum::ADD_PACKAGES:
                $desc = '添加柚子卡套餐';
                break;
            case ManagerUserLogEnum::UPDATE_PACKAGES:
                $desc = '修改柚子卡套餐';
                break;
            case ManagerUserLogEnum::UPDATE_OWN_INFO:
                $desc = '修改资料';
                break;
            case ManagerUserLogEnum::ADD_EXPRESS_COMPANY:
                $desc = '添加物流公司';
                break;
            case ManagerUserLogEnum::UPDATE_EXPRESS_COMPANY:
                $desc = '修改物流公司';
                break;
            case ManagerUserLogEnum::UPDATE_ORDER_STATUS:
                $desc = '订单状态修改';
                break;
            case ManagerUserLogEnum::ORDER_EXPRESS_SET:
                $desc = '物流设置';
                break;
            case ManagerUserLogEnum::GENERATE_ASD_ORDER:
                $desc = '订购';
                break;
            case ManagerUserLogEnum::ASD_CARD_RECHARGE:
                $desc = '号卡充值';
                break;
            case ManagerUserLogEnum::ADD_PACKAGE_AREA:
                $desc = '添加套餐地区';
                break;
            case ManagerUserLogEnum::UPDATE_PACKAGE_AREA:
                $desc = '修改套餐地区';
                break;
            case ManagerUserLogEnum::ADD_TRAVELTIPS_CATEGORY:
                $desc = '添加小贴士类别';
                break;
            case ManagerUserLogEnum::UPDATE_TRAVELTIPS_CATEGORY:
                $desc = '修改小贴士类别';
                break;
            case ManagerUserLogEnum::ADD_WX_POST:
                $desc = '添加小贴士文章';
                break;
            case ManagerUserLogEnum::UPDATE_WX_POST:
                $desc = '修改小贴士文章';
                break;
            case ManagerUserLogEnum::ADD_WX_KEYWORD:
                $desc = '添加关键字';
                break;
            case ManagerUserLogEnum::UPDATE_WX_KEYWORD:
                $desc = '修改关键字';
                break;
            case ManagerUserLogEnum::ADD_PACKAGES_CATEGORY:
                $desc = '添加柚子套餐类型';
                break;
            case ManagerUserLogEnum::UPDATE_PACKAGES_CATEGORY:
                $desc = '修改柚子套餐类型';
                break;
            case ManagerUserLogEnum::ADD_WX_KEYWORD_MESSAGE:
                $desc = '添加关键字消息';
                break;
            case ManagerUserLogEnum::UPDATE_WX_KEYWORD_MESSAGE:
                $desc = '修改关键字消息';
                break;
            case ManagerUserLogEnum::CLEAN_PACKAGE_ACTIVATION:
                $desc = '清除用户柚子套餐激活';
                break;
            case ManagerUserLogEnum::UPDATE_ORDER:
                $desc = '修改订单';
                break;
            case ManagerUserLogEnum::VERIFY_USER_POST:
                $desc = '旅行分享审核';
                break;
            case ManagerUserLogEnum::ADD_CHANNEL:
                $desc = '添加渠道';
                break;
            case ManagerUserLogEnum::UPDATE_CHANNEL:
                $desc = '修改渠道';
                break;
            case ManagerUserLogEnum::CHANNEL_ORDER:
                $desc = '内部下单';
                break;
            case ManagerUserLogEnum::ADD_YZ_QUESTION:
                $desc = '添加寻找旅途队友问题';
                break;
            case ManagerUserLogEnum::UPDATE_YZ_QUESTION:
                $desc = '修改寻找旅途队友问题';
                break;
            case ManagerUserLogEnum::DELETE_YZ_QUESTION:
                $desc = '删除寻找旅途队友问题';
                break;
            case ManagerUserLogEnum::ADD_WHITE_LISTS:
                $desc = '添加测试白名单';
                break;
            case ManagerUserLogEnum::DELETE_WHITE_LISTS:
                $desc = '删除测试白名单';
                break;  
			case ManagerUserLogEnum::ADD_ATTRIBUTION:
                $desc = '添加归属地';
                break;
            case ManagerUserLogEnum::DELETE_ATTRIBUTION:
                $desc = '删除归属地';
                break;
            case ManagerUserLogEnum::UPDATE_ATTRIBUTION:
                $desc = '更新归属地';
                break;
            case ManagerUserLogEnum::ADD_PACKAGEINFO:
                $desc = '添加套餐详情';
                break;
            case ManagerUserLogEnum::DELETE_PACKAGEINFO:
                $desc = '删除套餐详情';
                break;
            case ManagerUserLogEnum::UPDATE_PACKAGEINFO:
                $desc = '更新套餐详情';
                break;
            case ManagerUserLogEnum::DELETE_AREA:
                $desc = '删除地区';
                break;
            case ManagerUserLogEnum::DELETE_CHANNEL:
                $desc = '删除渠道';
                break;   
			case ManagerUserLogEnum::IMPORT_ORDER:
                $desc = '导入订单';
                break; 
            case ManagerUserLogEnum::REFUND_ORDER:
                $desc = '订单退款';
                break;   
            case ManagerUserLogEnum::DONG_REFUND_ORDER:
                $desc = '处理订单退款';
                break;  
			case ManagerUserLogEnum::ADD_BANNER:
                $desc = '添加banner';
                break; 
            case ManagerUserLogEnum::UPDATE_BANNER:
                $desc = '修改banner';
                break; 
            case ManagerUserLogEnum::DEL_BANNER:
                $desc = '删除banner';
                break; 
            case ManagerUserLogEnum::ADD_CONTINENT:
                $desc = '删除continent';
                break;
            case ManagerUserLogEnum::UPDATE_CONTINENT:
                $desc = '删除continent';
                break;
            case ManagerUserLogEnum::DEL_CONTINENT:
                $desc = '删除continent';
                break;
            case ManagerUserLogEnum::UPDATE_FLOW_BAG:
                $desc = '修改流量包信息';
                break;
            case ManagerUserLogEnum::UPDATE_VOIPGETPHONETINE:
                $desc = '修改voip通话管理';
                break;
            case ManagerUserLogEnum::DEL_VOIPGETPHONETINE:
                $desc = '删除voip通话管理';
                break;
            case ManagerUserLogEnum::ADD_VOIPGETPHONETINE:
                $desc = '添加voip通话管理';
                break;
            case ManagerUserLogEnum::UPDATE_GETCARD:
                $desc = '修改领卡记录';
                break;
            case ManagerUserLogEnum::DEL_GETCARD:
                $desc = '删除领卡记录';
                break;
            case ManagerUserLogEnum::ADD_GETCARD:
                $desc = '添加领卡记录';
                break;        
           	case ManagerUserLogEnum::UPDATE_GETCARDLOG:
                $desc = '修改领卡记录详情';
                break;
            case ManagerUserLogEnum::DEL_GETCARDLOG:
                $desc = '删除领卡记录详情';
                break;
            case ManagerUserLogEnum::ADD_GETCARDLOG:
                $desc = '添加领卡记录详情';
                break;
			case ManagerUserLogEnum::UPDATE_USERCALLBINDSYSTEMVOICE:
                $desc = '修改系统语音';
                break;
            case ManagerUserLogEnum::DEL_USERCALLBINDSYSTEMVOICE:
                $desc = '删除系统语音';
                break;
            case ManagerUserLogEnum::ADD_USERCALLBINDSYSTEMVOICE:
                $desc = '添加系统语音';
                break;
            case ManagerUserLogEnum::UPDATE_USERCALLBINDUPLOADVOICE:
                $desc = '修改用户语音';
                break;
            case ManagerUserLogEnum::DEL_USERCALLBINDUPLOADVOICE:
                $desc = '删除用户语音';
                break;
            case ManagerUserLogEnum::ADD_USERCALLBINDUPLOADVOICE:
                $desc = '添加用户语音';
                break;      
            case ManagerUserLogEnum::UPDATE_ORDEREXPRESSINFO:
                $desc = '修改订单收货人信息';
                break;    
            case ManagerUserLogEnum::UPDATE_VOIPRECHARGECARD:
                $desc = '修改voip套餐赠送管理信息';
                break;        
            case ManagerUserLogEnum::ADD_VOIPRECHARGECARD:
                $desc = '添加voip套餐赠送管理信息';
                break;      
            case ManagerUserLogEnum::CANCEL_USER_PACKAGE:
            	$desc = '撤销用户套餐';
                break;
              case ManagerUserLogEnum::ADD_API_DEBUG_CLASS:
            	$desc = '添加API调试分类';
                break;
             case ManagerUserLogEnum::UPDATE_API_DEBUG_CLASS:
            	$desc = '修改API调试分类';
                break;
             case ManagerUserLogEnum::DEL_API_DEBUG_CLASS:
            	$desc = '删除API调试分类';
                break;
             case ManagerUserLogEnum::ADD_API_DEBUG_FORM:
            	$desc = '添加API调试接口';
                break;
             case ManagerUserLogEnum::UPDATE_API_DEBUG_FORM:
            	$desc = '修改API调试接口';
                break;
             case ManagerUserLogEnum::DEL_API_DEBUG_FORM:
            	$desc = '删除API调试接口';
                break;
             case ManagerUserLogEnum::ADD_API_DEBUG_ARGS:
            	$desc = '添加API调试接口的参数';
                break;
             case ManagerUserLogEnum::UPDATE_API_DEBUG_ARGS:
            	$desc = '修改API调试接口的参数';
                break;
             case ManagerUserLogEnum::DEL_API_DEBUG_ARGS:
            	$desc = '删除API调试接口的参数';
                break;
       }
        return $desc;
    }
}