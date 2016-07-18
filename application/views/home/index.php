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
    <title>后台登陆--柚子旅行后台</title>

	<?php echo include_resource('css/bootstrap.css', 1); ?>
	<?php echo include_resource('css/sb-admin.css', 1); ?>
	<?php echo include_resource('css/font-awesome/css/font-awesome.min.css', 1); ?>
	<?php echo include_resource('js/jquery-2.1.3.js', 2); ?>
	<?php echo include_resource('ubox/ubox.css', 1); ?>
  	<?php echo include_resource('ubox/ubox.js', 2); ?>
  <style>
  .form-control{ height: 46px;}
  </style>
  </head>
  <body>
    <div id="wrapper" style="padding-left:0px;">
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-6" style="margin-left:auto; margin-right:auto; float:none">
            <h1>用户登录</h1>
            <form role="form">
              <div class="form-group input-group">
                <span class="input-group-addon">邮箱</span>
                <input type="text" id="email" class="form-control" placeholder="邮箱">
              </div>
			<div class="form-group input-group">
                <span class="input-group-addon">密码</span>
                <input type="password" name="" id="password" class="form-control" placeholder="密码">
              </div>
				 <button id="login_btn" type="button" class="btn btn-primary btn-lg">登录</button>
            </form>
          </div>
        </div><!-- /.row -->
      </div><!-- /#page-wrapper -->
	<script type="text/javascript">
		$(function(){
			function login(){
				var email = $.trim($('#email').val());
				var emailreg = /([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i;
				if(!emailreg.test(email)){
					UBox.show('请填写合法的邮箱', -1);
					return;
				}
				
				var password = $('#password').val();
				if(password.length < 6){
					UBox.show('密码长度最低6位', -1);
					return;
				}
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('home/login'); ?>",

					data: {email:email, password:password},
					dataType: "json",
					success: function(aData){
						UBox.show(aData.msg, aData.status);
						if(aData.status == 1){
							window.location.href = aData.data;
						}
					}
				});
				
			}
			
			$('#login_btn').click(function(){
				login();
			});
			
			function check_login(){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('home/check_login'); ?>",
					dataType: "json",
					success: function(aData){
						if(aData.status == 1){
							location.href = aData.data;
						}
					}
				});
			}
			check_login();
			
			function keyLogin(event){
				var e = event ? event : (window.event ? window.event : null);
				if(e.keyCode == 13){
					login();
				}
			}
			$('#password').keydown(function(event){
				keyLogin(event);
			});
			
			
		});
	</script>
    </div><!-- /#wrapper -->

    <!-- JavaScript -->
	 <?php echo include_resource('js/bootstrap.js', 2); ?>
  </body>
</html>