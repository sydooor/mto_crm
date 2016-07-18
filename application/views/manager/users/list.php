<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once APPPATH.'enums/YZEnum.prefix.php';
?>
<?php echo $header; ?>
	<div class="row">
	  <div class="col-lg-12">
		<h1><?php echo $title; ?></h1>
		<ol class="breadcrumb">
		  <li class="active"><i class="fa fa-dashboard"></i> <?php echo $title; ?></li>
		</ol>
		<div class="form-group">
			 <div class="col-lg-pull-13">
                <button onclick="show_add()" id="add_column" type="button" class="btn btn-default">增加管理员用户</button> 
            </div> 
		</div>
	   </div>
	</div>
		<div class="table-responsive">
		  <table class="table table-bordered table-hover tablesorter">
			<thead>
			  <tr>
				<th>管理员ID </th>
				<th>管理员名称</th>
				<th>分组ID</th>
				<th>分组名称</th>
				<th>管理员昵称</th>
				<th>手机号</th>
				<th>邮箱</th>
				<th>状态</th>
				<th>操作</th>
			  </tr>
			</thead>
			<tbody>
			<?php
				foreach($users as $aUser){
			?>
			  <tr>
				<td><?php echo $aUser->manager_user_id; ?></td>
				<td><?php echo $aUser->manager_user_name; ?></td>
				<td><?php echo $aUser->manager_group_id; ?></td>
				<td><?php echo $aUser->group_name; ?></td>
				<td><?php echo $aUser->user_nick; ?></td>
				<td><?php echo $aUser->mobile; ?></td>
				<td><?php echo $aUser->email; ?></td>
				<td><?php echo ManagerUserStatusEnum::getDescription($aUser->status); ?></td>
				<td><a href="<?php echo base_url('manage/show_update_manager_users/' . $aUser->manager_user_id); ?>">修改</a></td>
			  </tr>
			<?php
				}
			?>
			</tbody>
		  </table>
		</div>
		共 <?php echo count($users); ?> 个管理员用户
  
<script type="text/javascript">
	function show_add(){
		window.location.href = '<?php echo base_url('manage/show_add_manager_users') . '/'; ?>';
	}
</script>
<?php echo $footer; ?>