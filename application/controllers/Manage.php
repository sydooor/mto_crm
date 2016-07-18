<?php
require_once APPPATH . 'controllers/Base.php';
require_once APPPATH . 'models/vo/ManageUserVo.php';
require_once APPPATH . 'models/vo/ManageUserGroupVo.php';
require_once APPPATH . 'models/vo/ActionsVo.php';
require_once APPPATH . 'models/vo/ManagerUserActionVo.php';
require_once APPPATH . 'models/vo/ManagerUserLogVo.php';

/**
 * 后台管理控制器
 *
 * @author michael
 *        
 */
class Manage extends Base
{

    private $emailreg = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $key = $this->getVars('key');
        
        $aData = array();
        $aData = $this->layout('管理页面', $aData, $this->aUser, __CLASS__, __FUNCTION__);
        $this->load->view('manager/index', $aData);
    }

    /**
     * 管理员分组
     */
    public function manager_user_group_list()
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        /* 查询所有的管理员分组 */
        $result = $this->Managerusergroup_model->get_manager_user_group();
        $user_groups = array();
        foreach ($result as $val) {
            $group = new ManageUserGroupVo();
            $group->wrapWithArray($val);
            $user_groups[] = $group;
        }
        $aData = array(
            'user_groups' => $user_groups
        );
        $aData = $this->layout('管理员分组', $aData, $this->aUser, __CLASS__, __FUNCTION__);
        $this->load->view('manager/user_group/list', $aData);
    }

    /**
     * 添加管理员分组页面
     */
    public function show_add_user_group()
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        $aData = array();
        $aData = $this->layout('添加管理员分组', $aData, $this->aUser, __CLASS__, __FUNCTION__);
        $this->load->view('manager/user_group/add', $aData);
    }

    /**
     * 添加管理员分组
     */
    public function add_user_group()
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        /* 请求参数 */
        $group_name = $this->getVars('group_name');
        $description = $this->getVars('description');
        
        /* 验证 */
        if (! isset($group_name)) {
            $group_name = '';
        }
        $group_name = trim($group_name);
        if (strlen($group_name) <= 0) {
            alert('亲！填写管理员分组名称好吗?', - 1);
        }
        /* 分组名称是否存在 */
        $result = $this->Managerusergroup_model->get_manager_user_group_by_group_name($group_name);
        if (isset($result)) {
            alert('添加管理员分组失败，管理员分组已存在', 0);
        }
        
        /* 保存到数据库中 */
        $usergroup = new ManageUserGroupVo();
        $usergroup->group_name = $group_name;
        $usergroup->description = $description;
        $result = $this->Managerusergroup_model->add_manager_user_group($usergroup->toArray());
        
        /* 添加操作员日志 */
        $this->add_admin_log(ManagerUserLogEnum::ADD_MANAGER_GROUP, '分组名称：' . $group_name . '，描述：' . $description);
        
        /* 响应 */
        if ($result) {
            alert('添加管理员分组成功', 1);
        } else {
            alert('添加管理员分组失败', 0);
        }
    }

    /**
     * 修改管理员分组页面
     *
     * @param unknown $manager_group_id            
     */
    public function show_update_user_group($manager_group_id)
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        $tmp = $this->Managerusergroup_model->get_manager_user_group_by_manager_group_id($manager_group_id);
        $group = null;
        if ($tmp) {
            $group = new ManageUserGroupVo();
            $group->wrapWithArray($tmp);
        }
        
        $aData = array(
            'manager_group_id' => $manager_group_id,
            'aUserGroup' => $group
        );
        $aData = $this->layout('修改管理员分组', $aData, $this->aUser, __CLASS__, __FUNCTION__);
        $this->load->view('manager/user_group/update', $aData);
    }

    /**
     * 修改管理员分组
     */
    public function update_user_group()
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        /* 请求参数 */
        $manager_group_id = $this->getVars('manager_group_id');
        $group_name = $this->getVars('group_name');
        $description = $this->getVars('description');
        
        /* 验证 */
        /* 分组ID是否存在 */
        $result = $this->Managerusergroup_model->get_manager_user_group_by_manager_group_id($manager_group_id);
        if (! isset($result)) {
            alert('修改管理员分组失败，管理员分组不存在，管理员分组ID：' . $manager_group_id, - 1);
        }
        $old_group_name = $result['group_name'];
        $old_description = $result['description'];
        if (! isset($group_name)) {
            $group_name = '';
        }
        $group_name = trim($group_name);
        if (strlen($group_name) <= 0) {
            alert('亲！填写管理员分组名称好吗?', - 1);
        }
        /* 分组名称是否存在 */
        $result = $this->Managerusergroup_model->get_manager_user_group_by_group_name($group_name);
        if (isset($result) && $result['manager_group_id'] != $manager_group_id) {
            alert('修改管理员分组失败，管理员分组已存在', 0);
        }
        
        /* 保存到数据库中 */
        $usergroup = new ManageUserGroupVo();
        $usergroup->group_name = $group_name;
        $usergroup->description = $description;
        $aUserGroup = $usergroup->toArray(1);
        $result = $this->Managerusergroup_model->update_manager_user_group($manager_group_id, $aUserGroup);
        if ($result) {
            /* 修改管理员表中的管理员分组名称 */
            $this->Manage_model->update_group_name_by_manager_group_id($manager_group_id, $group_name);
        }
        
        /* 添加操作员日志 */
        $this->add_admin_log(ManagerUserLogEnum::UPDATE_MANAGER_GROUP, '分组ID：' . $manager_group_id . '，分组名称：' . $group_name . '，描述：' . $description);
        
        /* 响应 */
        if ($result) {
            alert('修改管理员分组成功', 1);
        } else {
            alert('修改管理员分组失败', 0);
        }
    }

    /**
     * 管理分组权限页面
     *
     * @param unknown $manager_group_id            
     */
    public function show_manager_user_action($manager_group_id)
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        /* 查询所有的权限 */
        $tmp = $this->Actions_model->get_actions();
        $actions = array();
        foreach ($tmp as $val) {
            $a = new ActionsVo();
            $a->wrapWithArray($val);
            $actions[] = $a;
        }
        
        /* 查询分组的权限 */
        $tmp = $this->Manageruseraction_model->get_manager_user_action_by_manager_group_id($manager_group_id);
        $group_actions = array();
        foreach ($tmp as $val) {
            $a = new ManagerUserActionVo();
            $a->wrapWithArray($val);
            $group_actions[] = $a;
        }
        
        $tmp = $this->Managerusergroup_model->get_manager_user_group_by_manager_group_id($manager_group_id);
        $aUserGroup = new ManageUserGroupVo();
        $aUserGroup->wrapWithArray($tmp);
        
        $user_action = array();
        foreach ($group_actions as $idx => $val) {
            $user_action[$idx] = $val->action_id;
        }
        $aData = array(
            'actions' => $actions,
            'user_action' => $user_action,
            'aUserGroup' => $aUserGroup,
            'manager_group_id' => $manager_group_id
        );
        $aData = $this->layout('分组权限管理', $aData, $this->aUser, __CLASS__, __FUNCTION__);
        $this->load->view('manager/user_group/actions', $aData);
    }

    /**
     * 权限分配
     */
    public function action_distribution()
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        /* 请求参数 */
        $manager_group_id = $this->getVars('manager_group_id');
        $slt_actions = $this->getVars('slt_actions');
        $slt_actions = explode(',', $slt_actions);
        
        if (empty($slt_actions)) {
            alert('亲！请选择权限好吗?', - 1);
        }
        
        $log_content = array();
        
        /* 分组ID是否存在 */
        $result = $this->Managerusergroup_model->get_manager_user_group_by_manager_group_id($manager_group_id);
        if (! isset($result)) {
            alert('权限分配失败，管理员分组不存在，管理员分组ID：' . $manager_group_id, - 1);
        }
        $manager_group = new ManageUserGroupVo();
        $manager_group->wrapWithArray($result);
        $log_content[0] = '分组ID：' . $manager_group_id;
        $log_content[1] = '分组名称：' . $manager_group->group_name;
        $log_content[2] = '权限ID：' . implode(',', $slt_actions);
        
        /* 查询分组的权限 */
        $group_actions = $this->Manageruseraction_model->get_manager_user_action_by_manager_group_id($manager_group_id);
        $user_action = array();
        foreach ($group_actions as $idx => $val) {
            $user_action[$idx] = $val['action_id'];
        }
        
        /* 找出要删除的 */
        $count = 0;
        $remove_user_action = array();
        $slt_actions_str = ',' . implode(',', $slt_actions) . ',';
        foreach ($group_actions as $val) {
            if (stripos($slt_actions_str, ',' . $val['action_id'] . ',') === false) {
                $remove_user_action[$count] = $val['id'];
                $count += 1;
            }
        }
        
        /* 批量删除 */
        $is_remove = false;
        if (count($remove_user_action) > 0) {
            $is_remove = $this->Manageruseraction_model->batch_delete_manager_user_action_by_id($remove_user_action);
        }
        
        /* 找出要添加的 */
        $count = 0;
        $add_user_action = array();
        $user_action_str = ',' . implode(',', $user_action) . ',';
        foreach ($slt_actions as $action_id) {
            if (stripos($user_action_str, ',' . $action_id . ',') === false) {
                $add_user_action[$count] = array(
                    'action_id' => $action_id,
                    'manager_group_id' => $manager_group_id
                );
                $count += 1;
            }
        }
        /* 批量添加 */
        $is_add = false;
        if (count($add_user_action) > 0) {
            $is_add = $this->Manageruseraction_model->batch_add_manager_user_action($add_user_action);
        }
        
        /* 添加操作员日志 */
        $this->add_admin_log(ManagerUserLogEnum::AUTHORIZATION, implode('，', $log_content));
        
        /* 响应 */
        if ($is_remove || $is_add) {
            alert('权限分配成功', 1);
        } else {
            alert('权限分配失败', 0);
        }
    }

    /**
     * 管理员列表
     */
    public function manager_users_list()
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        /* 查询所有的管理员用户 */
        $result = $this->Manage_model->get_manager_users();
        $users = array();
        foreach ($result as $val) {
            $manager = new ManageUserVo();
            $manager->wrapWithArray($val);
            $users[] = $manager;
        }
        $aData = array(
            'users' => $users
        );
        $aData = $this->layout('管理员列表', $aData, $this->aUser, __CLASS__, __FUNCTION__);
        $this->load->view('manager/users/list', $aData);
    }

    /**
     * 添加管理员页面
     */
    public function show_add_manager_users()
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        /* 查询所有的管理员分组 */
        $result = $this->Managerusergroup_model->get_manager_user_group();
        $user_groups = array();
        foreach ($result as $val) {
            $group = new ManageUserGroupVo();
            $group->wrapWithArray($val);
            $user_groups[] = $group;
        }
        $aData = array(
            'user_groups' => $user_groups
        );
        $aData = $this->layout('添加管理员', $aData, $this->aUser, __CLASS__, __FUNCTION__);
        $this->load->view('manager/users/add', $aData);
    }

    /**
     * 添加管理员
     */
    public function add_manager_users()
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        /* 请求参数 */
        $manager_user_name = $this->getVars('manager_user_name');
        $manager_group_id = $this->getVars('manager_group_id');
        $user_nick = $this->getVars('user_nick');
        $mobile = $this->getVars('mobile');
        $email = $this->getVars('email');
        $password = $this->getVars('password');
        $status = $this->getVars('status');
        
        $log_content = array();
        
        /* 验证 */
        if (! isset($manager_user_name) || strlen(trim($manager_user_name)) <= 0) {
            alert('亲！填写管理员名称好吗?', - 1);
        }
        $manager_user_name = trim($manager_user_name);
        $result = $this->Manage_model->get_manager_users_by_manager_user_name($manager_user_name);
        if (isset($result)) {
            alert('添加管理员失败，管理员名称已存在', 0);
        }
        
        if (! isset($manager_group_id) || strlen(trim($manager_group_id)) <= 0) {
            alert('亲！请选择管理分组好吗?', - 1);
        }
        $manager_group_id = trim($manager_group_id);
        $result = $this->Managerusergroup_model->get_manager_user_group_by_manager_group_id($manager_group_id);
        if (! isset($result)) {
            alert('添加管理员失败，管理员分组不存在', 0);
        }
        $group_name = $result['group_name'];
        
        if (! preg_match($this->emailreg, $email)) {
            alert('邮箱格式非法', - 1);
        }
        $email = trim($email);
        $result = $this->Manage_model->get_manager_by_email($email);
        if (isset($result)) {
            alert('添加管理员失败，管理员邮箱已存在', 0);
        }
        
        if (! isset($password) || strlen(trim($password)) < 6) {
            alert('亲！填写长度至少6位的密码好吗?', - 1);
        }
        $password = md5(trim($password));
        
        if ($status != ManagerUserStatusEnum::NORMAL && $status != ManagerUserStatusEnum::DISABLE) {
            $status = ManagerUserStatusEnum::NORMAL;
        }
        
        /* 保存到数据库中 */
        $manager = new ManageUserVo();
        $manager->manager_user_name = $manager_user_name;
        $manager->manager_group_id = $manager_group_id;
        $manager->group_name = $group_name;
        $manager->user_nick = $user_nick;
        $manager->mobile = $mobile;
        $manager->email = $email;
        $manager->password = $password;
        $manager->status = $status;
        $aManagerUser = $manager->toArray();
        $result = $this->Manage_model->add_manager_users($aManagerUser);
        
        /* 添加操作员日志 */
        $log_content[0] = '管理员名称：' . $manager_user_name;
        $log_content[1] = '分组ID：' . $manager_group_id;
        $log_content[2] = '分组名称：' . $group_name;
        $log_content[3] = '管理员昵称：' . $user_nick;
        $log_content[4] = '手机号：' . $mobile;
        $log_content[5] = '邮箱：' . $email;
        $log_content[6] = '状态：' . ($status == '1' ? '正常' : '禁用');
        $this->add_admin_log(ManagerUserLogEnum::ADD_MANAGER, implode('，', $log_content));
        
        /* 响应 */
        if ($result) {
            alert('添加管理员成功', 1);
        } else {
            alert('添加管理员失败', 0);
        }
    }

    /**
     * 修改管理员页面
     */
    public function show_update_manager_users($manager_user_id)
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        $tmp = $this->Manage_model->get_manager_users_by_manager_user_id($manager_user_id);
        $aManagerUser = null;
        if ($tmp) {
            $aManagerUser = new ManageUserVo();
            $aManagerUser->wrapWithArray($tmp);
        }
        
        $aGroup = $this->Managerusergroup_model->get_manager_user_group();
        $user_groups = array();
        foreach ($aGroup as $val) {
            $group = new ManageUserGroupVo();
            $group->wrapWithArray($val);
            $user_groups[] = $group;
        }
        $aData = array(
            'manager_user_id' => $manager_user_id,
            'aManagerUser' => $aManagerUser,
            'user_groups' => $user_groups
        );
        $aData = $this->layout('修改管理员', $aData, $this->aUser, __CLASS__, __FUNCTION__);
        $this->load->view('manager/users/update', $aData);
    }

    /**
     * 修改管理员
     */
    public function update_manager_users()
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        /* 请求参数 */
        $manager_user_id = $this->getVars('manager_user_id');
        $manager_user_name = $this->getVars('manager_user_name');
        $manager_group_id = $this->getVars('manager_group_id');
        $user_nick = $this->getVars('user_nick');
        $mobile = $this->getVars('mobile');
        $email = $this->getVars('email');
        $password = trim(strval($this->getVars('password')));
        $status = $this->getVars('status');
        
        /* 验证 */
        $result = $this->Manage_model->get_manager_users_by_manager_user_id($manager_user_id);
        if (! isset($result)) {
            alert('修改管理员失败，管理员不存在', 0);
        }
        if (! isset($manager_user_name) || strlen(trim($manager_user_name)) <= 0) {
            alert('亲！填写管理员名称好吗?', - 1);
        }
        $manager_user_name = trim($manager_user_name);
        $result = $this->Manage_model->get_manager_users_by_manager_user_name($manager_user_name);
        if (isset($result) && $result['manager_user_id'] != $manager_user_id) {
            alert('修改管理员失败，管理员名称已存在', 0);
        }
        $old_password = $result['password'];
        
        if (! isset($manager_group_id) || strlen(trim($manager_group_id)) <= 0) {
            alert('亲！请选择管理分组好吗?', - 1);
        }
        $manager_group_id = trim($manager_group_id);
        $result = $this->Managerusergroup_model->get_manager_user_group_by_manager_group_id($manager_group_id);
        if (! isset($result)) {
            alert('添加管理员失败，管理员分组不存在', 0);
        }
        $group_name = $result['group_name'];
        
        if (! preg_match($this->emailreg, $email)) {
            alert('邮箱格式非法', - 1);
        }
        $email = trim($email);
        $result = $this->Manage_model->get_manager_by_email($email);
        if (isset($result) && $result['manager_user_id'] != $manager_user_id) {
            alert('添加管理员失败，管理员邮箱已存在', 0);
        }
        
        if (strlen($password) > 0) {
            if (strlen($password) < 6) {
                alert('亲！填写长度至少6位的密码好吗?', - 1);
            }
            $password = md5(trim($password));
        } else {
            $password = $old_password;
        }
        
        if ($status != ManagerUserStatusEnum::NORMAL && $status != ManagerUserStatusEnum::DISABLE) {
            $status = ManagerUserStatusEnum::NORMAL;
        }
        
        /* 保存到数据库中 */
        $manager = new ManageUserVo();
        $manager->manager_user_name = $manager_user_name;
        $manager->manager_group_id = $manager_group_id;
        $manager->group_name = $group_name;
        $manager->user_nick = $user_nick;
        $manager->mobile = $mobile;
        $manager->email = $email;
        $manager->password = $password;
        $manager->status = $status;
        $aManagerUser = $manager->toArray(1);
        $result = $this->Manage_model->update_manager_users($manager_user_id, $aManagerUser);
        
        /* 添加操作员日志 */
        $log_content[0] = '管理员ID：' . $manager_user_id;
        $log_content[1] = '管理员名称：' . $manager_user_name;
        $log_content[2] = '分组ID：' . $manager_group_id;
        $log_content[3] = '分组名称：' . $group_name;
        $log_content[4] = '管理员昵称：' . $user_nick;
        $log_content[5] = '手机号：' . $mobile;
        $log_content[6] = '邮箱：' . $email;
        $this->add_admin_log(ManagerUserLogEnum::UPDATE_MANAGER, implode('，', $log_content));
        
        /* 响应 */
        if ($result) {
            alert('修改管理员成功', 1);
        } else {
            alert('修改管理员失败', 0);
        }
    }

    /**
     * 管理员操作日志列表
     *
     * @param unknown $page_no            
     */
    public function log_list($page_no)
    {
        /* 权限验证 */
        $this->check_action(__CLASS__, __FUNCTION__);
        
        /* 请求参数 */
        $manager_user_id = $this->getVars('manager_user_id');
        $type = $this->getVars('type');
        $start_create_time = $this->getVars('start_create_time');
        $end_create_time = $this->getVars('end_create_time');
        $per_page = 20;
        if (is_null($manager_user_id)) {
            $manager_user_id = - 1;
        }
        if (! preg_match('/^(\-)?\d+$/', $type)) {
            $type = - 1;
        }
        if (! preg_match('/^[1-9]\d*$/', $page_no)) {
            $page_no = 1;
        }
        
        $aWhere = array(
            'manager_user_id' => $manager_user_id,
            'type' => $type,
            'start_create_time' => $start_create_time,
            'end_create_time' => $end_create_time
        );
        
        $aData = array();
        $aData['aWhere'] = $aWhere;
        
        /* 条件查询操作日志列表 */
        $log_list = array();
        $tmp = $this->Manageruserlog_model->get_manager_user_log_list($aWhere, $page_no, $per_page);
        foreach ($tmp as $val) {
            $log = new ManagerUserLogVo();
            $log->wrapWithArray($val);
            $log_list[] = $log;
        }
        $aData['log_list'] = $log_list;
        /* 操作日志列表数量 */
        $aData['nums'] = $this->Manageruserlog_model->get_count($aWhere);
        
        /* 加载分页组件 */
        $this->load->library('pagination');
        $config['base_url'] = base_url('manage/log_list');
        $config['total_rows'] = $aData['nums'];
        $config['per_page'] = $per_page;
        $config['num_links'] = 4;
        $config['use_page_numbers'] = true;
        $this->pagination->initialize($config);
        
        /* 获取所有管理员 */
        $tmp = $this->Manage_model->get_manager_users();
        $aManagerUser = array();
        foreach ($tmp as $val) {
            $u = new ManageUserVo();
            $u->wrapWithArray($val);
            $aManagerUser[] = $u;
        }
        $aData['aManagerUser'] = $aManagerUser;
        
        $aData = $this->layout('管理员操作日志', $aData, $this->aUser, __CLASS__, __FUNCTION__);
        $this->load->view('manager/log/list', $aData);
    }
}