<?php
defined('BASEPATH') or exit('No direct script access allowed');

// ------------------------------------------------------------------------

if(! function_exists('include_resouce')){
	/**
	 * 引入资源文件
	 * $type 1 样式 2 JS
	 */
	function include_resource($path, $type = 1, $resource_root = 'assets/'){
		$resource_string = '';
		$link = '';
		if(false === strpos($path, $resource_root)){
			$link = IMAGE_ROOT . "/" . $resource_root . $path;
		}else{
			$link = IMAGE_ROOT . "/" . $path;
		}
		
		if($type == 1){
			$link = $link . "?time=" . time();
			$resource_string = '<link rel="stylesheet" type="text/css" href="' . $link . '">';
		}elseif($type == 2){
			$resource_string = '<script type="text/javascript" src="' . $link . '"></script>';
		}
		return $resource_string;
	}
}

// 导入图片资源
if(! function_exists('include_image_resource')){
	function include_image_resource($path, $resource_root = 'assets/'){
		$link = '';
		if(false === strpos($path, $resource_root)){
			$link = RES_ROOT . "/" . $resource_root . $path;
		}else{
			$link = RES_ROOT . "/" . $path;
		}
		return $link;
	}
}

if ( ! function_exists('alert'))
{
	function alert($msg, $status = 1, $data = ''){
		$isAjax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || !empty($_POST['ajax']) || !empty($_GET['ajax']);
		if(!$isAjax){
			exit('msg:' . $msg . '   status:' . $status . '   data:' . print_r($data) );
		}

		header('Content-Type:application/json; charset=utf-8');
		$aResult = array(
				'status' => $status,
				'msg' => $msg,
				'data' => $data,
		);

		$json = json_encode($aResult);

		if($jsonError = json_last_error()){
			$json = json_encode(array(
					'status' => 0,
					'msg' => '抱歉,数据处理出错!',
					'data' => $jsonError == JSON_ERROR_UTF8 ? 1 : 0,
			));
		}

		//jQuery跨域支持
		if(isset($_GET['jsoncallback']) && $_GET['jsoncallback']){
			$callBack = (string)$_GET['jsoncallback'];
			exit($callBack . '(' . $json . ')');
		}else{
			exit($json);
		}
	}
}
