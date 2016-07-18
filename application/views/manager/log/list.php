<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH.'enums/YZEnum.prefix.php';
?>
<?php echo $header; ?>
<?php 
	echo include_resource('data_picker/skin/WdatePicker.css', 1);
	echo include_resource('data_picker/WdatePicker.js', 2); 
?>
	<div class="row">
	  <div class="col-lg-12">
		<h1><?php echo $title; ?></h1>
		<ol class="breadcrumb">
		  <li class="active"><i class="fa fa-dashboard"></i> <?php echo $title; ?></li>
		</ol>
		<div class="form-group">
			<form id="log_qry_form" action="<?php echo base_url('manage/log_list'); ?>" method="post">
			<div class="col-lg-pull-14">
			管理员：
			</div>
			<div class="col-lg-pull-13">
				<select class="form-control" id="manager_user_id" name="manager_user_id" value="<?php echo $aWhere['manager_user_id'];?>">
					<option value="-1">全部</option>
					<?php foreach ($aManagerUser as $user) {?>
				  	<option value="<?php echo $user->manager_user_id;?>"><?php echo $user->manager_user_name;?></option>
				  	<?php }?>
				</select>
			</div> 
			<div class="col-lg-pull-14">
			日志类型：
            </div>
            <div class="col-lg-pull-13">
				<select class="form-control" id="type" name="type" value="<?php echo $aWhere['type'];?>">
				  	<option value="-1">全部</option>
				  	<option value="<?php echo ManagerUserLogEnum::LOGIN;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::LOGIN);?></option>
				  	<option value="<?php echo ManagerUserLogEnum::ADD_MANAGER;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_MANAGER);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_MANAGER;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_MANAGER);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_MANAGER_GROUP;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_MANAGER_GROUP);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_MANAGER_GROUP;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_MANAGER_GROUP);?></option>
                    <option value="<?php echo ManagerUserLogEnum::AUTHORIZATION;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::AUTHORIZATION);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_CATEGORY;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_CATEGORY);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_CATEGORY;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_CATEGORY);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_CARD;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_CARD);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_CARD;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_CARD);?></option>
                    <option value="<?php echo ManagerUserLogEnum::DELETE_CARD;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::DELETE_CARD);?></option>
                    <option value="<?php echo ManagerUserLogEnum::IMPORT_CARD;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::IMPORT_CARD);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_PACKAGES;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_PACKAGES);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_PACKAGES;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_PACKAGES);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_OWN_INFO;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_OWN_INFO);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_EXPRESS_COMPANY;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_EXPRESS_COMPANY);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_EXPRESS_COMPANY;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_EXPRESS_COMPANY);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_ORDER_STATUS;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_ORDER_STATUS);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ORDER_EXPRESS_SET;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ORDER_EXPRESS_SET);?></option>
                    <option value="<?php echo ManagerUserLogEnum::GENERATE_ASD_ORDER;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::GENERATE_ASD_ORDER);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ASD_CARD_RECHARGE;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ASD_CARD_RECHARGE);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_PACKAGE_AREA;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_PACKAGE_AREA);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_PACKAGE_AREA;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_PACKAGE_AREA);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_TRAVELTIPS_CATEGORY;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_TRAVELTIPS_CATEGORY);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_TRAVELTIPS_CATEGORY;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_TRAVELTIPS_CATEGORY);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_WX_POST;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_WX_POST);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_WX_POST;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_WX_POST);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_WX_KEYWORD;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_WX_KEYWORD);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_WX_KEYWORD;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_WX_KEYWORD);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_PACKAGES_CATEGORY;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_PACKAGES_CATEGORY);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_PACKAGES_CATEGORY;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_PACKAGES_CATEGORY);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_WX_KEYWORD_MESSAGE;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_WX_KEYWORD_MESSAGE);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_WX_KEYWORD_MESSAGE;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_WX_KEYWORD_MESSAGE);?></option>
                    <option value="<?php echo ManagerUserLogEnum::CLEAN_PACKAGE_ACTIVATION;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::CLEAN_PACKAGE_ACTIVATION);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_ORDER;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_ORDER);?></option>
                    <option value="<?php echo ManagerUserLogEnum::VERIFY_USER_POST;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::VERIFY_USER_POST);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_CHANNEL;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_CHANNEL);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_CHANNEL;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_CHANNEL);?></option>
                    <option value="<?php echo ManagerUserLogEnum::CHANNEL_ORDER;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::CHANNEL_ORDER);?></option>
                    <option value="<?php echo ManagerUserLogEnum::ADD_YZ_QUESTION;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::ADD_YZ_QUESTION);?></option>
                    <option value="<?php echo ManagerUserLogEnum::UPDATE_YZ_QUESTION;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::UPDATE_YZ_QUESTION);?></option>
                    <option value="<?php echo ManagerUserLogEnum::DELETE_YZ_QUESTION;?>"><?php echo ManagerUserLogEnum::getDescription(ManagerUserLogEnum::DELETE_YZ_QUESTION);?></option>
				</select>
		   </div> 
		   <div class="col-lg-pull-14">
			日志时间：
            </div>
            <div class="col-lg-pull-13">
                <input onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" id="start_create_time" name="start_create_time" value="<?php if(!is_null($aWhere['start_create_time'])) echo $aWhere['start_create_time']; ?>" type="text" class="form-control">
            </div>
			<div class="col-lg-pull-13">
                <input onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" id="end_create_time" name="end_create_time" value="<?php if(!is_null($aWhere['end_create_time'])) echo $aWhere['end_create_time']; ?>" type="text" class="form-control">
            </div>
			<div class="col-lg-pull-13">
                <button type="submit" class="btn btn-primary btn-lg">查询</button> 
            </div>
            
            </form>
		</div>
	   </div>
	</div>
		<div class="table-responsive">
		  <table class="table table-bordered table-hover tablesorter">
			<thead>
			  <tr>
				<th>管理员ID </th>
				<th>管理员名称</th>
				<th>日志类型</th>
				<th>日志时间</th>
				<th>详细内容 </th>
			  </tr>
			</thead>
			<tbody>
			<?php foreach ($log_list as $log) {?>
				<tr>
					<td><?php echo $log->manager_user_id;?></td>
					<td><?php echo $log->manager_user_name;?></td>
					<td><?php echo ManagerUserLogEnum::getDescription($log->type); ?></td>
					<td><?php echo $log->create_time;?></td>
					<td><?php echo $log->detail;?></td>
				</tr>
			<?php }?>
			</tbody>
		  </table>
		</div>
		<div id="log_pagination" class="col-lg-12">
          <div class="bs-example">
              <ul class="pagination">
                <?php echo $this->pagination->create_links();?>
              </ul>
            </div>
          </div>
		共 <?php echo $nums ?> 条日志
<script type="text/javascript">
$(function() {
	try{
		/*初始化*/
		$('#type').val($('#type').attr('value'));
		$('#manager_user_id').val($('#manager_user_id').attr('value'));
	} catch(e){}

	/*日志查询表单提交*/
	$('#log_qry_form').submit(function(event) {
		event.preventDefault();
		if(this.start_create_time.value != '') {
			if(this.end_create_time.value == '') {
				UBox.show("请选择日志截止时间", -1);
				return;
			}
			if(this.start_create_time.value > this.end_create_time.value) {
				UBox.show("日志时间选择的开始时间不能大于截止时间", -1);
				return;
			}
		}
		this.action = "<?php echo base_url('manage/log_list');?>";
		this.submit();
	});

	/*分页*/
	var query_params = {
		manager_user_id : '<?php if(!is_null($aWhere['manager_user_id'])) echo $aWhere['manager_user_id']; ?>',
		type : <?php echo $aWhere['type'];?>,
		start_create_time : '<?php if(!is_null($aWhere['start_create_time'])) echo $aWhere['start_create_time']; ?>',
		end_create_time : '<?php if(!is_null($aWhere['end_create_time'])) echo $aWhere['end_create_time']; ?>'
	};
	$('#log_pagination a').click(function(event) {
		event.preventDefault();
		var log_qry_form = document.forms['log_qry_form'];
		log_qry_form.action = this.href;
		$('#manager_user_id').val(query_params.manager_user_id);
		$('#type').val(query_params.type);
		$('#start_create_time').val(query_params.start_create_time);
		$('#end_create_time').val(query_params.end_create_time);
		log_qry_form.submit();
	});
});
</script>
<?php echo $footer; ?>