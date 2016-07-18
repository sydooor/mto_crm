<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php echo $header; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Project Management</title>

<script language="javascript">
function addRow(obj,pre,num){
	var mytable=document.getElementById(obj);

	for(var i=0;i < num;i++){

		//添加行
		var newTr = mytable.insertRow(-1);
		newTr.bgColor = '#ffffff';
		//添加列
		var newTd0 = newTr.insertCell();
		var newTd1 = newTr.insertCell();
		var newTd2 = newTr.insertCell();
		var newTd3 = newTr.insertCell();
		var newTd4 = newTr.insertCell();
		var newTd5 = newTr.insertCell();

		//设置列内容和属性

		newTd0.innerHTML = '<input name="' + pre + 'column[]" type="text" id="' + pre + 'column[]" size="12" />';
		newTd1.innerHTML= '<select name="' + pre + 'type[]" id="' + pre + 'type[]"><option></option><option value="1">numeral </option><option value="2">varchar</option><option value="3">date</option><option value="4">enum</option><option value="5">set</option><option value="6">text</option></select>';
		newTd2.innerHTML = '<input name="' + pre + 'values[]" type="text" id="' + pre + 'values[]" size="12" />';
		newTd3.innerHTML= '<select name="' + pre + 'isnull[]" id="' + pre + 'isnull[]"><option></option><option value="not null">not null</option><option value="null">null</option></select>';
		newTd4.innerHTML = '<input name="' + pre + 'default[]" type="text" id="' + pre + 'default[]" size="12" />';
		newTd5.innerHTML= '<input name="' + pre + 'order[]" type="text" id="' + pre + 'order[]" size="5" />';

	}


}
function chkdata(){

	if(form1.nick_name.value==""){
		alert('Nick name is requeried,please enter.') ;
		form1.nick_name.focus();
		return false;
	}
	else{
		var exp=  /^[A-Za-z][a-zA-Z0-9_]{0,10}$/;
		if(!exp.test(form1.nick_name.value)){
			alert("The nick name you enter is invalid.");
			form1.nick_name.focus();
			return false;
		}
	}


}
</script>
<link href="/assets/css/Style.css" rel="stylesheet" type="text/css" />
<?php echo include_resource('css/bootstrap.css', 1); ?>
	<?php echo include_resource('css/sb-admin.css', 1); ?>
	<?php echo include_resource('css/font-awesome/css/font-awesome.min.css', 1); ?>
	<?php echo include_resource('js/jquery-2.1.3.js', 2); ?>
	<?php echo include_resource('js/jquery.cookie.js', 2); ?>
	<?php echo include_resource('ubox/ubox.css', 1); ?>
  	<?php echo include_resource('ubox/ubox.js', 2); ?>


</head>

<body>
	<table width="100%" border="0" cellspacing="0" cellpadding="0"
		align="center">
		<tr>
			<td width="16"><img src="/assets/images/title_1.gif" width="15"
				height="19"></td>
			<td background="/assets/images/title_2.gif"><span class="title">&nbsp;Project
					Management</span></td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="right"><INPUT name="btnAdd" type="button" class="button"
				id="btnAdd" value=" Cancel "
				onclick="javascript:window.location.href='1';"></td>
		</tr>
	</table>
	<table width="100%" border="0" align="center" cellpadding="2"
		cellspacing="1">
		<form action="1" method="post" name="form1" id="form1"
			onsubmit="return chkdata();">
			<tr>
				<td class="tableTitle"><strong>Base Information</strong></td>
			</tr>
			<tr>
				<td class="tableBody"><table width="100%" border="0" cellpadding="2"
						cellspacing="1">
						<tr class="tableBody">
							<td align="center">Project Name:</td>
							<td><input name="project_name" type="text" id="project_name" /></td>
							<td align="center">Nick Name:</td>
							<td><input name="nick_name" type="text" id="nick_name" /></td>
						</tr>
						<tr class="tableBody">
							<td align="center">Type:</td>
							<td align="left"><select name="type" id="type">
									<option value="O">Outbound</option>
									<option value="I">Inbound</option>
							</select></td>
							<td rowspan="4" align="center">Remark:</td>
							<td rowspan="4"><textarea name="remark" rows="4" id="remark"></textarea></td>
						</tr>
						<tr class="tableBody">
							<td align="center">Status:</td>
							<td align="left"><select name="status" id="status">
									<option value="Y" selected="selected">Active</option>
									<option value="N">Inactive</option>
							</select></td>
						</tr>
						<tr class="tableBody">
							<td align="center">Start Time:</td>
							<td><input name="starttime" type="text" id="starttime" /></td>
						</tr>
						<tr class="tableBody">
							<td align="center">Finish Time:</td>
							<td><input name="endtime" type="text" id="endtime" /></td>
						</tr>
					</table></td>
			</tr>
			<tr>
				<td class="tableTitle"><strong>Customer Field</strong></td>
			</tr>
			<tr>
				<td class="tableBody"><table width="100%" border="0" cellpadding="2"
						cellspacing="1" id="customer">
						<tr class="tableTitle">
							<td>Field</td>
							<td>Type</td>
							<td>Length/value</td>
							<td>NULL</td>
							<td>Default</td>
							<td>Seq.</td>
						</tr>
						<tr>
							<td><input name="column[]" type="text" id="column[]"
								value="phone" size="12" readonly /></td>
							<td><select name="type[]" id="type[]">
									<option value="2" selected="selected">varchar</option>
							</select></td>
							<td><input name="values[]" type="text" id="values[]" value="20"
								size="12" /></td>
							<td><select name="isnull[]" id="isnull[]" disabled="disabled">
									<option></option>
									<option value="not null">not null</option>
									<option value="null">null</option>
							</select></td>
							<td><input name="default[]" type="text" id="default[]" size="12" /></td>
							<td><input name="order[]" type="text" id="order[]" size="5" /></td>
						</tr>
					</table></td>
			</tr>
			<tr>
				<td align="right">Add <input name="nums" type="text" id="nums"
					size="5" value="1" /> Field <input name="add" type="button"
					class="button" id="add"
					onclick="addRow('customer','',form1.nums.value);" value="ADD" /></td>
			</tr>
			<tr>
				<td class="tableTitle"><strong>Success Case Field</strong></td>
			</tr>
			<tr>
				<td><table width="100%" border="0" cellpadding="2" cellspacing="1"
						id="order">
						<tr class="tableTitle">
							<td>Field</td>
							<td>Type</td>
							<td>Length/value</td>
							<td>NULL</td>
							<td>Default</td>
							<td>Seq.</td>
						</tr>
						<tr class="tableBody">
							<td bgcolor="#FFFFFF"><input name="order_column[]" type="text"
								id="order_column[]" size="12" /></td>
							<td bgcolor="#FFFFFF"><select name="order_type[]"
								id="order_type[]">
									<option></option>
									<option value="1">numeral</option>
									<option value="2">varchar</option>
									<option value="3">date</option>
									<option value="4">enum</option>
									<option value="5">set</option>
									<option value="6">text</option>
							</select></td>
							<td bgcolor="#FFFFFF"><input name="order_values[]" type="text"
								id="order_values[]" size="12" /></td>
							<td bgcolor="#FFFFFF"><select name="order_isnull[]"
								id="order_isnull[]">
									<option></option>
									<option value="not null">not null</option>
									<option value="null">null</option>
							</select></td>
							<td bgcolor="#FFFFFF"><input name="order_default[]" type="text"
								id="order_default[]" size="12" /></td>
							<td bgcolor="#FFFFFF"><input name="order_order[]" type="text"
								id="order_order[]" size="5" /></td>
						</tr>
					</table></td>
			</tr>
			<tr>
				<td align="right">Add <input name="nums2" type="text" id="nums2"
					size="5" value="1" /> Field <input name="add2" type="button"
					class="button" id="add2"
					onclick="addRow('order','order_',form1.nums.value);" value="ADD" /></td>
			</tr>
			<tr>
				<td bgcolor="#CCCCCC"><strong class="tableTitle">Call Reason </strong></td>
			</tr>
			<tr>
				<td>
					<!--Call Reason Start-->

				</TD>
			</TR>
	
	</TABLE>
	<SCRIPT language=JavaScript>
		/***************************************
		**控制callreason子项的显示/隐藏
		****************************************/
		function actMenu(menuid)
		{
			var menuidobj = eval(menuid);
			if(menuidobj.style.display=='none'){
				 menuidobj.style.display='';
			}else{
				 menuidobj.style.display='none';
			}
		}
		</SCRIPT>
	<!--Call Reason End-->
	</td>
	</tr>
	<tr>
		<td align="center"><input name="Submit" type="submit" class="button"
			value=" Submit " /> &nbsp;&nbsp; <input name="reset" type="reset"
			class="button" id="reset" value=" Reset " /></td>
	</tr>
	</form>
	</table>
</body>
</html>
<?php echo $footer; ?>
