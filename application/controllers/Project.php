<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'controllers/Base.php';
class Project extends Base {
	public function index(){
		
		$aData = array();
		$aData = $this->layout('管理页面', $aData, $this->aUser, __CLASS__, __FUNCTION__);
		$this->load->view('setting/project_setting', $aData);
	}
}