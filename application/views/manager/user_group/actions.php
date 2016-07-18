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
            <h3>分组：<?php echo $aUserGroup->group_name;?></h3>
            <form role="form">
            	<?php 
            	$tmp = '';
            	foreach ($actions as $idx => $val) {
            		if($tmp != $val->category_colunm_id) {
            			$tmp = $val->category_colunm_id;
            			if($idx > 0) {
            				?>
            				<br><br>
            				<?php
            			}
            		}
            	?>
            	<label style="font-weight:normal;"><input type="checkbox" name="actions" value="<?php echo $val->action_id;?>">&nbsp;&nbsp;<?php echo $val->name;?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            	<?php }?>
				 <div class="col-lg-pull-15">
					<a id="distribution" class="btn btn-primary btn-lg">分配</a>
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
	function distribution(){
		/*验证输入数据*/
		var slt_actions = [];
		$('input[name="actions"]:checked').each(function() {
			slt_actions[slt_actions.length] = this.value;
		});
		if(slt_actions.length <= 0) {
			UBox.show('亲！请选择权限好吗?', -1);
			return;
		}
		var manager_group_id = $.trim($('#manager_group_id').val());

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('manage/action_distribution') . '/'; ?>",
			data: {
				manager_group_id:manager_group_id,
				slt_actions:slt_actions.join(',')
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

	$('#distribution').click(function(){
		distribution();
	});

	$(function() {
		var user_action = "<?php echo implode(',',$user_action);?>".split(',');
		if(user_action.length > 0) {
			$('input[name="actions"]').each(function() {
				for (var i = 0; i < user_action.length; i++) {
					if(user_action[i] == this.value) {
						this.checked = true;
					}
				}
			});
		}
	});
	<?php }?>
</script>
<?php echo $footer; ?>