<?php
require_once APPPATH . 'models/vo/ActionsVo.php';
require_once APPPATH . 'models/vo/ManagerUserLogVo.php';
require_once APPPATH . 'controllers/MY_Controller.php';

/**
 * 控制器基类
 * 
 * @author michael
 *        
 */
class Base extends MY_Controller
{

    /**
     * 用户信息
     */
    protected $aUser;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Manage_model');
        $this->load->model('Managerusergroup_model');
        $this->load->model('Manageruseraction_model');
        $this->load->model('Actions_model');
        $this->load->model('Manageruserlog_model');
        $this->check_login();
    }

    protected function check_login()
    {
        $data = $this->Manage_model->is_login();
        if (false === $data) {
            /* 跳转到登录页 */
            redirect(base_url('home/index'));
        } else {
            $this->aUser = $data;
        }
    }

    /**
     * 权限检查
     * 
     * @param unknown $class            
     * @param unknown $method            
     */
    protected function check_action($class, $method)
    {
        $isAjax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || ! empty($_POST['ajax']) || ! empty($_GET['ajax']);
        
        if (! $this->aUser) {
            if ($isAjax) {
                alert('亲！你还未登录', 0, base_url('home/index') . '/');
            } else {
                redirect(base_url('home/index'));
            }
        }
        
        /* 首先检查类和方法是否纳入权限 */
        $result = $this->Actions_model->check_action($class, $method);
        if (isset($result)) {
            $actions = new ActionsVo();
            $actions->wrapWithArray($result);
            
            /* 再检查分组是否具有该权限 */
            $result = $this->Manageruseraction_model->check_manager_user_action($this->aUser['manager_group_id'], $actions->action_id);
            if (! isset($result)) {
                if ($isAjax) {
                    alert('亲！你无权限访问', 0);
                } else {
                    $aData = array(
                        'error' => '亲！你无权限访问'
                    );
                    $aData = $this->layout('错误提示', $aData, $this->aUser, __CLASS__, __FUNCTION__);
                    $this->load->view('manager/error', $aData);
                    exit($this->output->get_output());
                }
            }
        }
    }

    /**
     * 添加管理员日志
     * 
     * @param unknown $type            
     * @param unknown $content            
     */
    protected function add_admin_log($type, $content)
    {
        /* 设置时区，避免获取当前时间问题 */
        date_default_timezone_set('PRC');
        $aLog = new ManagerUserLogVo();
        $aLog->manager_user_id = $this->aUser['manager_user_id'];
        $aLog->manager_user_name = $this->aUser['manager_user_name'];
        $aLog->type = $type;
        $aLog->create_time = date('Y-m-d H:i:s');
        $aLog->detail = $content;
        $aLogArr = $aLog->toArray(true);
        $this->Manageruserlog_model->add_manager_user_log($aLogArr);
    }

    protected function layout($title, $aData, $aUser, $class, $function)
    {
        $aData['title'] = $title;
        $aData['aUser'] = $aUser;
        
        // 获取分类栏目
        $this->load->model('Categorycolumn_model');
        $categorys = $this->Categorycolumn_model->get_category_columns();
        
        /* 根据栏目的显示属性决定栏目是否展示（0:不展示, 1:展示） */
        foreach ($categorys as $idx => $category) {
            $categorys[$idx]['exhibition'] = 0;
            if ($category['display'] == 1) {
                $categorys[$idx]['exhibition'] = 1;
            }
        }
        
        // 分类栏目权限检查这里处理
        /* 获取纳入权限管理的第三级栏目 */
        $result = $this->Actions_model->get_category_colunm_id_from_actions();
        if (isset($result) && count($result) > 0) {
            $action_category = array();
            foreach ($result as $k => $v) {
                $action_category[$k] = $v['category_colunm_id'];
            }
            $action_category = ',' . implode(',', $action_category) . ',';
            
            /* 对所有纳入权限管理的第三级栏目默认不展示 */
            foreach ($categorys as $idx => $category) {
                if ($category['level'] == 3 && $category['display'] == 1 && ! (stripos($action_category, ',' . $category['category_colunm_id'] . ',') === false)) {
                    $categorys[$idx]['exhibition'] = 0;
                }
            }
            
            /* 获取管理员能访问的第三级栏目ID集合 */
            $manager_group_id = $this->aUser['manager_group_id'];
            $result = $this->Manage_model->get_user_visit_category_colunm_id($manager_group_id);
            if (isset($result) && count($result) > 0) {
                /* 对纳入权限管理的第三级栏目，有访问权限的进行展示 */
                $three_level = array();
                foreach ($result as $k => $v) {
                    $three_level[$k] = $v['category_colunm_id'];
                }
                $three_level = ',' . implode(',', $three_level) . ',';
                foreach ($categorys as $idx => $category) {
                    if ($category['level'] == 3 && $category['display'] == 1 && ! (stripos($three_level, ',' . $category['category_colunm_id'] . ',') === false)) {
                        $categorys[$idx]['exhibition'] = 1;
                    }
                }
            }
            
            foreach ($categorys as $lv_2_idx => $lv_2) {
                if ($lv_2['level'] == 2) {
                    $categorys[$lv_2_idx]['exhibition'] = 0;
                    foreach ($categorys as $lv_3) {
                        if ($lv_3['level'] == 3 && $lv_3['parent'] == $lv_2['category_colunm_id'] && $lv_3['exhibition'] == 1) {
                            $categorys[$lv_2_idx]['exhibition'] = 1;
                            break;
                        }
                    }
                }
            }
            
            foreach ($categorys as $lv_1_idx => $lv_1) {
                if ($lv_1['level'] == 1) {
                    $categorys[$lv_1_idx]['exhibition'] = 0;
                    foreach ($categorys as $lv_2) {
                        if ($lv_2['level'] == 2 && $lv_2['parent'] == $lv_1['category_colunm_id'] && $lv_2['exhibition'] == 1) {
                            $categorys[$lv_1_idx]['exhibition'] = 1;
                            break;
                        }
                    }
                }
            }
        }
        
        $aData['categorys'] = $categorys;
        $aData['footer'] = $this->load->view('common/footer', null, true);
        $aData['header'] = $this->load->view('common/header', $aData, true);
        return $aData;
    }
    
    
}