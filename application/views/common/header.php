<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title; ?>--MTO-CRM</title>

	<?php echo include_resource('css/bootstrap.css', 1); ?>
	<?php echo include_resource('css/sb-admin.css', 1); ?>
	<?php echo include_resource('css/font-awesome/css/font-awesome.min.css', 1); ?>
	<?php echo include_resource('js/jquery-2.1.3.js', 2); ?>
	<?php echo include_resource('js/jquery.cookie.js', 2); ?>
	<?php echo include_resource('ubox/ubox.css', 1); ?>
  	<?php echo include_resource('ubox/ubox.js', 2); ?>
  </head>

  <body>
    <div id="wrapper">
	  <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url('manage/index') . '/';?>">MTO-CRM</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
			 <li><a href="<?php echo base_url('manage/index') . '/';?>"><i class="fa fa-desktop"></i> 首页</a></li>
			<?php
				foreach($categorys as $lv_1){
					if($lv_1['level'] == '1' && $lv_1['exhibition'] == '1'){
			?>
	            <li class="dropdown"  >
                <!--data-toggle=dropdown   data-toggle="dropdown"-->
	              <a href="#" class="dropdown-toggle" >
	              <i class="fa fa-caret-square-o-down"></i> <?php echo $lv_1['name']; ?> <b class="caret"></b></a>
	              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
					<?php
						foreach ($categorys as $lv_2){
							if($lv_2['parent'] == $lv_1['category_colunm_id'] && $lv_2['exhibition'] == '1'){
					?>
						<li class="dropdown-submenu">
							<a href="#" class="dropdown-toggle"  >
							 <i class="fa fa-caret-square-o-down"></i> <?php echo $lv_2['name']; ?><b class="caret"></b></a>
							<?php
								if($lv_2['level'] == '2'){
							?> <!--background:none; border:none; box-shadow:none; -webkit-box-shadow:none;-->
									<ul class="dropdown-menu " style="position:relative !important; margin-left:30px;">
									<?php
									foreach ($categorys as $lv_3_idx => $lv_3){
										if($lv_3['parent'] == $lv_2['category_colunm_id'] && $lv_3['exhibition'] == '1'){
									?><!--style=" color:#999;background:none;"-->
											<li ><a href="<?php echo base_url('/'.$lv_3['links']);?>"  menu-flag="menu-<?php echo $lv_3_idx;?>"><?php echo $lv_3['name'];?></a></li>
									<?php
										}
									}
									?>
									</ul>
							<?php
								}
							?>
						</li>
					  <?php
							}
						}
					  ?>
	              </ul>
	            </li>
				<?php
					}
				}
			?>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $aUser['manager_user_name']; ?> (<?php echo $aUser['email']; ?>) <b class="caret"></b></a>
              <ul id="ul_personal_center" class="dropdown-menu">
                <li><a href="<?php echo base_url('manageuser/info') . '/'; ?>"><i class="fa fa-user"></i> 修改资料</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url('home/logout') . '/'; ?>"><i class="fa fa-power-off"></i> 退出</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
      
      <script>
	  $('.dropdown-toggle').click(function(event){
		  event.preventDefault();
		  /*点击显示菜单*/
 		$(this).next().toggle();
	  });
	  $(function() {
		  try{
			  /*从Cookie中读取要展开的菜单*/
			  var menu_flag = $.cookie('menu-flag');
			  if(menu_flag != null && menu_flag != '') {
				  var submenu = $('a[menu-flag="'+menu_flag+'"]');
				  submenu.parents('ul').show();
			  }
		  } catch(e) {
			try{console.error(e);} catch(er){}
		  }

		  $('a[menu-flag]').click(function() {
			  /*把点击的菜单标志位保存到Cookie中*/
			  $.cookie('menu-flag', $(this).attr('menu-flag'), {path: '/', domain: "<?php echo $_SERVER['HTTP_HOST'];?>"});
		  });

		  $('#ul_personal_center a').click(function() {
			  /*清空Cookie中的菜单标志位*/
			  $.cookie('menu-flag', null, {path: '/', domain: "<?php echo $_SERVER['HTTP_HOST'];?>"});
		  });
	  });
	  </script>
	<div id="page-wrapper">