<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH.'enums/YZEnum.prefix.php';
?>
<?php echo $header; ?>
        <div class="row">
          <div class="col-lg-12">
            <h1><?php echo $title; ?><span style="margin-left:10px;"><a href="javascript:back()">返回</a></span></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> <?php echo $title; ?></li>
            </ol>
            </div>
            <div class="col-lg-6">
            <form role="form">
              <div class="form-group">
                <label>管理员名称：</label>
                <input id="manager_user_name" class="form-control" maxlength="20">
              </div>
              <div class="form-group">
                <label>管理员分组：</label>
				<select class="form-control" id="manager_group">
				<?php foreach ($user_groups as $group) {?>
				<option value="<?php echo $group->manager_group_id;?>"><?php echo $group->group_name;?></option>
				<?php }?>
				</select>
              </div>
              <div class="form-group">
                <label>管理员昵称：</label>
                <input id="user_nick" class="form-control" maxlength="20">
              </div>
              <div class="form-group">
                <label>手机号：</label>
                <input id="mobile" class="form-control" maxlength="30">
              </div>
              <div class="form-group">
                <label>邮箱：</label>
                <input id="u_email" class="form-control" maxlength="100">
              </div>
              <div class="form-group">
                <label>密码：</label>
                <input id="u_password" type="password" class="form-control" maxlength="45">
              </div>
              <div class="form-group">
                <label>状态：</label>
				<select class="form-control" id="status">
					<option value="<?php echo ManagerUserStatusEnum::NORMAL;?>"><?php echo ManagerUserStatusEnum::getDescription(ManagerUserStatusEnum::NORMAL);?></option>
				  	<option value="<?php echo ManagerUserStatusEnum::DISABLE;?>"><?php echo ManagerUserStatusEnum::getDescription(ManagerUserStatusEnum::DISABLE);?></option>
				</select>
              </div>
				 <div class="col-lg-pull-15">
					<a id="add" class="btn btn-primary btn-lg">添加</a>
				 </div>
            </form>
          </div>
        </div>
  
<script type="text/javascript">
	function back() {
		window.location.href="<?php echo base_url('manage/manager_users_list') . '/'; ?>";
	}

	function add_user(){
		/*验证输入数据*/
		var manager_user_name = $.trim($('#manager_user_name').val());
		if(!manager_user_name || manager_user_name == ''){
			UBox.show('亲！填写管理员用户名称好吗?', -1);
			$('#manager_user_name').focus();
			return;
		}
		var password = $.trim($('#u_password').val());
		if(!password || password == '' || password.length < 6){
			UBox.show('亲！填写长度至少6位的密码好吗?', -1);
			$('#u_password').focus();
			return;
		}
		var manager_group = $.trim($('#manager_group').val());
		var user_nick = $.trim($('#user_nick').val());
		var mobile = $.trim($('#mobile').val());
		var status = $.trim($('#status').val());
		var email = $.trim($('#u_email').val());
		var emailreg = /([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i;
		if(!emailreg.test(email)){
			UBox.show('请填写合法的邮箱', -1);
			$('#u_email').focus();
			return;
		}

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('manage/add_manager_users') . '/'; ?>",
			data: {
				manager_user_name:manager_user_name,
				manager_group_id:manager_group,
				user_nick:user_nick,
				mobile:mobile,
				email:email,
				password:password,
				status:status
			},
			dataType: "json",
			success: function(aData){
				UBox.show(aData.msg, aData.status);
				if(aData.status == 1){
					setTimeout(function(){
						window.location.href=window.location.href;
					}, 1500);
				}
			}
		});
	}

	/*添加管理员事件*/
	$('#add').click(function(){
		add_user();
	});
</script>
<?php echo $footer; ?>