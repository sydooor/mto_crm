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
            <?php if(!is_null($aUserGroup)) {?>
            <form role="form">
              <div class="form-group">
                <label>管理员分组名称：</label>
                <input id="group_name" class="form-control" maxlength="15" value="<?php echo $aUserGroup->group_name;?>">
              </div>
              <div class="form-group">
                <label>描述：</label>
                <input id="description" class="form-control" maxlength="100" value="<?php if(!is_null($aUserGroup->description)) {echo $aUserGroup->description;}?>">
              </div>
				 <div class="col-lg-pull-15">
					<a id="update" class="btn btn-primary btn-lg">修改</a>
				 </div>
				<input id="manager_group_id" type="hidden" value="<?php echo $manager_group_id;?>">
            </form>
            <?php } else{echo "管理员分组不存在，管理员分组ID：".$manager_group_id;}?>
          </div>
        </div>

<script type="text/javascript">
	function back() {
		window.location.href="<?php echo base_url('manage/manager_user_group_list') . '/'; ?>";
	}

	<?php if(!is_null($aUserGroup)) {?>
	function update_user_group(){
		/*验证输入数据*/
		var group_name = $.trim($('#group_name').val());
		if(!group_name || group_name == ''){
			UBox.show('亲！填写管理员分组名称好吗?', -1);
			$('#group_name').focus();
			return;
		}
		var description = $.trim($('#description').val());
		var manager_group_id = $.trim($('#manager_group_id').val());

		/*添加分组*/
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('manage/update_user_group') . '/'; ?>",
			data: {
				manager_group_id:manager_group_id,
				group_name:group_name,
				description:description
			},
			dataType: "json",
			success: function(aData){
				UBox.show(aData.msg, aData.status);
			}
		});
	}

	/*添加分组事件*/
	$('#update').click(function(){
		update_user_group();
	});
	<?php }?>
</script>
<?php echo $footer; ?>