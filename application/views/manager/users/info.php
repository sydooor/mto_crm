<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo $header; ?>
        <div class="row">
          <div class="col-lg-12">
            <h1><?php echo $title; ?></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> <?php echo $title; ?></li>
            </ol>
            </div>
            <div class="col-lg-6">
            <form role="form">
              <div class="form-group">
                <label>管理员名称：</label>
                <input class="form-control" maxlength="20" value="<?php echo $aManagerUser->manager_user_name;?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label>管理员分组：</label>
				<input class="form-control" maxlength="20" value="<?php echo $aManagerUser->group_name;?>" disabled="disabled">
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
                <input id="u_email" class="form-control" maxlength="100" value="<?php if(!is_null($aManagerUser->email)) {echo $aManagerUser->email;}?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label>密码：</label>
                <input id="u_password" type="password" class="form-control" maxlength="45" placeholder="可不填表示不修改">
              </div>
				 <div class="col-lg-pull-15">
					<a id="update" class="btn btn-primary btn-lg">修改</a>
				 </div>
				<input id="manager_user_id" type="hidden" value="<?php echo $aManagerUser->manager_user_id;?>">
            </form>
          </div>
        </div>

<script type="text/javascript">
	function update_user(){
		/*验证输入数据*/
		var password = $.trim($('#u_password').val());
		if(password != '' && password.length < 6){
			UBox.show('亲！填写长度至少6位的密码好吗?', -1);
			$('#u_password').focus();
			return;
		}
		var user_nick = $.trim($('#user_nick').val());
		var mobile = $.trim($('#mobile').val());
		var manager_user_id = $.trim($('#manager_user_id').val());

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('manageuser/update') . '/'; ?>",
			data: {
				manager_user_id:manager_user_id,
				user_nick:user_nick,
				mobile:mobile,
				password:password
			},
			dataType: "json",
			success: function(aData){
				UBox.show(aData.msg, aData.status);
			}
		});
	}

	/*修改资料事件*/
	$('#update').click(function(){
		update_user();
	});
</script>
<?php echo $footer; ?>