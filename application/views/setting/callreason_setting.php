<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Script Update</title>

</head>

<body>
<form action="/index.php?controller=MBoCallReason&amp;action=Edit" method="post" name="form1" id="form1">
  <table width="100%" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td align="center" valign="middle" bgcolor="#FFFFFF"><strong>Project Management </strong></td>
    </tr>
    <tr>
      <td align="center" valign="middle" bgcolor="#FFFFFF">Select Project : </td>
    </tr>
    <tr>
      <td align="center" valign="middle" bgcolor="#FFFFFF"><select name="project_ID">
        <? for($i=0;$i<count($rowset);$i++){ ?>
		<option value="<?=$rowset[$i]['project_ID'];?>" selected="selected"><?=$rowset[$i]['project_name'];?></option>
       <? }?>
	  </select>
        <input type="submit" name="Submit" value="�ύ" class="button"/></td>
    </tr>
  </table>
</form>
</body>
</html>
