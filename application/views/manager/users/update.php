<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
            <?php if(!is_null($aManagerUser)) {?>
            <form role="form">
              <div class="form-group">
                <label>管理员名称：</label>
                <input id="manager_user_name" class="form-control" maxlength="20" value="<?php echo $aManagerUser->manager_user_name;?>">
              </div>
              <div class="form-group">
                <label>管理员分组：</label>
				<select class="form-control" id="manager_group" value="<?php echo $aManagerUser->manager_group_id;?>">
				<?php foreach ($user_groups as $group) {?>
				<option value="<?php echo $group->manager_group_id;?>"><?php echo $group->group_name;?></option>
				<?php }?>
				</select>
              </div>
              <div class="form-group">
                <label>管理员昵称：</label>
                <input id="user_nick" class="form-control" maxlength="20" value="<?php if(!is_null($aManagerUser->user_nick)) {echo $aManagerUser->user_nick;}?>">
              </div>
              <div class="form-group">
                <label>手机号：</label>
                <input id="mobile" class="form-control" maxlength="30" value="<?php if(!is_null($aManagerUser->mobile)) {echo $aManagerUser->mobile;}?>">
              </div>
              <div class="form-group">
                <label>邮箱：</label>
                <input id="u_email" class="form-control" maxlength="100" value="<?php if(!is_null($aManagerUser->email)) {echo $aManagerUser->email;}?>">
              </div>
              <div class="form-group">
                <label>密码：</label>
                <input id="u_password" type="password" class="form-control" maxlength="45" placeholder="可不填表示不修改">
              </div>
              <div class="form-group">
                <label>状态：</label>
				<select class="form-control" id="status" value="<?php echo $aManagerUser->status;?>">
					<option value="<?php echo ManagerUserStatusEnum::NORMAL;?>"><?php echo ManagerUserStatusEnum::getDescription(ManagerUserStatusEnum::NORMAL);?></option>
				  	<option value="<?php echo ManagerUserStatusEnum::DISABLE;?>"><?php echo ManagerUserStatusEnum::getDescription(ManagerUserStatusEnum::DISABLE);?></option>
				</select>
              </div>
				 <div class="col-lg-pull-15">
					<a id="update" class="btn btn-primary btn-lg">修改</a>
				 </div>
				<input id="manager_user_id" type="hidden" value="<?php echo $manager_user_id;?>">
            </form>
            <?php } else {echo "管理员用户不存在，管理员用户ID：".$manager_user_id;}?>
          </div>
        </div>

<script type="text/javascript">
	function back() {
		window.location.href="<?php echo base_url('manage/manager_users_list') . '/'; ?>";
	}

	<?php if(!is_null($aManagerUser)) {?>
	function update_user(){
		/*验证输入数据*/
		var manager_user_name = $.trim($('#manager_user_name').val());
		if(!manager_user_name || manager_user_name == ''){
			UBox.show('亲！填写管理员用户名称好吗?', -1);
			$('#manager_user_name').focus();
			return;
		}
		var password = $.trim($('#u_password').val());
		if(password != '' && password.length < 6){
			UBox.show('亲！填写长度至少6位的密码好吗?', -1);
			$('#u_password').focus();
			return;
		}
		var manager_group = $.trim($('#manager_group').val());
		var user_nick = $.trim($('#user_nick').val());
		var mobile = $.trim($('#mobile').val());
		var email = $.trim($('#u_email').val());
		var emailreg = /([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i;
		if(!emailreg.test(email)){
			UBox.show('请填写合法的邮箱', -1);
			$('#u_email').focus();
			return;
		}
		var status = $.trim($('#status').val());
		var manager_user_id = $.trim($('#manager_user_id').val());

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('manage/update_manager_users') . '/'; ?>",
			data: {
				manager_user_id:manager_user_id,
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
						back();
					}, 1500);
				}
			}
		});
	}

	/*修改管理员事件*/
	$('#update').click(function(){
		update_user();
	});

	$(function() {
		/*初始下列列表值*/
		$('#status,#manager_group').each(function() {
			var $this = $(this);
			$this.val($this.attr("value"));
		});
    });
	<?php }?>
</script>
<?php echo $footer; ?>