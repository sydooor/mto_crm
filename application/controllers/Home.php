<?php
require_once APPPATH.'models/vo/ManageUserVo.php';
require_once APPPATH.'models/vo/ManagerUserLogVo.php';
require_once APPPATH . 'controllers/MY_Controller.php';

/**
 * 后台首页控制器
 * @author michael
 *
 */
class Home extends MY_Controller{

	public function __construct(){
		parent::__construct();
		
	}
	
	/**
	 * 登陆页
	 */
	public function index(){
		$this->load->view('home/index');
	}
	
	/**
	 * 登陆
	 */
	public function login(){
	    $manageUser = new ManageUserVo();
		$email = $this->getVars('email');
		if(!preg_match("/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i", $email)){
			alert('邮箱格式非法', -1);
		}
		$password = $this->getVars('password');
		if(strlen($password) < 6){
			alert('咱的密码最低6位', -1);
		}
		
		$this->load->model('Manage_model');

		$aManager = $this->Manage_model->get_manager_by_email($email);
		if(!is_null($aManager) && isset($aManager)) {
		    $manageUser->wrapWithArray($aManager);
			if($manageUser->status != ManagerUserStatusEnum::NORMAL) {
				alert('账号已被禁用', -1);
			}
			if($manageUser->password == md5($password)){
				$expire = 86400 * 15;
				$this->load->helper('cookie');
				$this->input->set_cookie('manager_user_id', $manageUser->manager_user_id, $expire, $_SERVER['HTTP_HOST']);
				$xid = md5($manageUser->email . $manageUser->password . $manageUser->status . $this->input->user_agent());	//$_SERVER['REMOTE_ADDR']
				$this->input->set_cookie('xid', $xid, $expire, $_SERVER['HTTP_HOST']);
				
				
				alert('登陆成功', 1, base_url('manage/index') . '/');
			} else {
				alert('账号或密码错误', -1);
			}
		} else {
			alert('账号或密码错误', -1);
		}
	}
	
	/**
	 * 登陆
	 */
	public function logout(){
		$this->input->set_cookie('manager_user_id', 0, 0, $_SERVER['HTTP_HOST']);
		$this->input->set_cookie('xid', 0, 0, $_SERVER['HTTP_HOST']);
		header("Location: " . base_url('home/index') . '/');
		exit();
	
	}
	
	/**
	 * 检查登陆
	 */
	public function check_login(){
		$this->load->model('Manage_model');
		$is_login = $this->Manage_model->is_login();
		if($is_login){
			$status = 1;
		}else{
			$status = 0;
		}
		alert('登陆状态', $status, base_url('manage/index') . '/');
	}
	
}