<?php
class MY_Controller extends CI_Controller {
	/**
	 * 获取表单传递的数据,优先从post获取，post拿不到就取get，再拿不到就去cookie
	 * 
	 * @param unknown $var_name
	 *        	优先查找变量
	 * @param string $next
	 *        	第一个查找不到再找第二个
	 */
	public function getVars($var_name, $next = ''){
		if($var_name){
			if(isset($_POST[$var_name])){
				$input_var = $this->input->post($var_name);
				return $input_var;
			}
			if(isset($_GET[$var_name])){
				$input_var = $this->input->get($var_name);
				return $input_var;
			}
			if(isset($_COOKIE[$var_name])){
				$input_var = $this->input->cookie($var_name);
				return $input_var;
			}
		}
		if(! empty($next)){
			
			if(isset($_POST[$next])){
				$input_var = $this->input->post($next);
				return $input_var;
			}
			if(isset($_GET[$next])){
				$input_var = $this->input->get($next);
				return $input_var;
			}
			if(isset($_COOKIE[$next])){
				$input_var = $this->input->cookie($next);
				return $input_var;
			}
		}
		return null;
	}
}