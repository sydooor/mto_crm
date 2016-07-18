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
		<div class="form-group">
			 <div class="col-lg-pull-13">
                <button onclick="show_add()" id="add_column" type="button" class="btn btn-default">增加管理员分组</button> 
            </div> 
		</div>
	   </div>
	</div>
		<div class="table-responsive">
		  <table class="table table-bordered table-hover tablesorter">
			<thead>
			  <tr>
				<th>ID </th>
				<th>管理员分组名称</th>
				<th>描述</th>
				<th>操作</th>
			  </tr>
			</thead>
			<tbody>
			<?php
				foreach($user_groups as $aGroup){
			?>
			  <tr>
				<td><?php echo $aGroup->manager_group_id; ?></td>
				<td><?php echo $aGroup->group_name; ?></td>
				<td><?php echo $aGroup->description; ?></td>
				<td>
					<a href="<?php echo base_url('manage/show_update_user_group/' . $aGroup->manager_group_id); ?>">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="<?php echo base_url('manage/show_manager_user_action/' . $aGroup->manager_group_id); ?>">权限</a>
				</td>
			  </tr>
			<?php
				}
			?>
			</tbody>
		  </table>
		</div>
		共 <?php echo count($user_groups); ?> 个管理员分组
  
<script type="text/javascript">
	function show_add(){
		window.location.href = '<?php echo base_url('manage/show_add_user_group') . '/'; ?>';
	}
</script>
<?php echo $footer; ?>