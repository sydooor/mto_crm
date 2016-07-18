<?php
require_once APPPATH . 'controllers/Base.php';
require_once COMMON_APP_PATH . 'models/vo/ManageUserVo.php';
require_once COMMON_APP_PATH . 'models/vo/ManageUserGroupVo.php';

class Manageuser extends Base{
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 管理员资料页面
	 */
	public function info() {
		$manager_user_id = $this->aUser['manager_user_id'];
		$tmp = $this->Manage_model->get_manager_users_by_manager_user_id($manager_user_id);
		if($tmp) {
		    $aManagerUser = new ManageUserVo();
		    $aManagerUser->wrapWithArray($tmp);
		}
		$aData = array(
				'aManagerUser'=>$aManagerUser
		);
		$aData = $this->layout('修改资料', $aData, $this->aUser, __CLASS__, __FUNCTION__);
		$this->load->view('manager/users/info.php', $aData);
	}
	
	/**
	 * 管理员资料修改
	 */
	public function update() {
		/* 请求参数 */
		$manager_user_id = $this->getVars('manager_user_id');
		$user_nick = $this->getVars('user_nick');
		$mobile = $this->getVars('mobile');
		$password = trim(strval($this->getVars('password')));
		
		/*验证*/
		$result = $this->Manage_model->get_manager_users_by_manager_user_id($manager_user_id);
		if(!isset($result)) {
			alert('修改资料失败，管理员用户不存在', 0);
		}
		$old_password = $result['password'];
		
		if(strlen(trim($password))>0) {
		    if(strlen(trim($password))<6) {
		        alert('亲！填写密码好吗?', -1);
		    }
		    $password = md5(trim($password));
		} else {
		    $password = $old_password;
		}
		
		/* 保存到数据库中 */
		$manager = new ManageUserVo();
		$manager->user_nick = $user_nick;
		$manager->mobile = $mobile;
		$manager->password = $password;
		$aManagerUser = $manager->toArray(1);
		$result = $this->Manage_model->update_manager_users($manager_user_id, $aManagerUser);
		
		/* 添加操作员日志 */
		$log_content = array(
				'管理员昵称：'.$user_nick,
				'手机号：'.$mobile,
				'邮箱：'.$email
		);
		$this->add_admin_log(ManagerUserLogEnum::UPDATE_OWN_INFO, implode('，', $log_content));
		
		/* 响应 */
		if($result) {
			alert('修改资料成功', 1);
		} else {
			alert('修改资料失败', 0);
		}
	}
	
}
?>