<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Staff List</title>
<link href="/Style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.title {	color: #007DC5;
	font-weight: bold;
	font-size:14px;
}
-->
</style>
</head>

<body>


<table width="98%"  border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="16"><img src="/images/title_1.gif" width="15" height="19" /></td>
    <td background="/images/title_2.gif"><span class="title">&nbsp;处理结果</span></td>
  </tr>
</table>
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="3" cellspacing="0">
	  <form id="form1" name="form1" method="post" action="{{$SearchURL}}" target="_self">
        <tr>
          <td nowrap="nowrap" class="tableTitle">Agent</td>
          <td nowrap="nowrap" class="tableTitle"><input name="username" type="text" id="username" size="5" /></td>
          <td nowrap="nowrap" class="tableTitle">full name </td>
          <td nowrap="nowrap" class="tableTitle"><input name="fullname" type="text" id="fullname" size="12" /></td>
          <td nowrap="nowrap" class="tableTitle"><input type="image" name="imageField" src="../../images/Staff_Btn_Submit.gif" /></td>
          <td nowrap="nowrap" class="tableTitle"><input name="search" type="hidden" id="search" value="1" /></td>
          <td align="center" nowrap="nowrap" class="tableTitle"><a href="{{$addURL}}">Add New Agent </a></td>
          <td width="100%" align="center" class="tableTitle">&nbsp;</td>
        </tr>
	    </form>
      </table>
       
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="2" cellspacing="1">
  <tr>
    <td align="center" class="tableTitle">NO</td>
    <td align="center" class="tableTitle">Agent</td>
    <td align="center" class="tableTitle">Full Name </td>
    <td align="center" class="tableTitle">Position</td>
    <td align="center" class="tableTitle">Jion Date </td>
    <td colspan="2" align="center" class="tableTitle"><p>Action  </p>    </td>
  </tr>
{{assign var="RSTART" value=$SUM.RSTART}}
{{section name=i loop=$RS}}  
  <tr>
    <td align="center" class="tableBody">{{$RSTART}}{{assign var="RSTART" value="`$RSTART+1`"}}</td>
    <td align="left" class="tableBody">{{$RS[i].username}}</td>
    <td align="left" class="tableBody">{{$RS[i].fullname}}</td>
    <td align="left" class="tableBody">{{$RS[i].roles[0].rolename}}</td>
    <td align="center" class="tableBody">{{$RS[i].joindate|date_format:"%Y-%m-%d %H:%M"}}</td>
    <td align="center" class="tableBody"><a href="{{$editURL}}{{$RS[i].user_id}}">Edit</a></td>
    <td align="center" class="tableBody"><a href="{{$deleURL}}{{$RS[i].user_id}}">Del</a></td>
  </tr>
{{/section}}  
  <tr>
    <td class="tableBody">&nbsp;</td>
    <td class="tableBody">&nbsp;</td>
    <td class="tableBody">&nbsp;</td>
    <td class="tableBody">&nbsp;</td>
    <td class="tableBody">&nbsp;</td>
    <td colspan="2" class="tableBody"><a href="{{$AddNew}}"></a></td>
  </tr>
  <tr>
    <td colspan="7" align="center" class="tableBody">
	<a href="{{$URL.FP}}">FIRST</a>&nbsp;
	<a href="{{$URL.PP}}">PREV</a>&nbsp;
	<a href="{{$URL.NP}}">NEXT</a>&nbsp;
	<a href="{{$URL.LP}}">LAST</a>&nbsp;
	
	 [{{$SUM.RSTART}}-{{$SUM.REND}}]/{{$SUM.COUNT}} &nbsp; Page:{{$SUM.CURPAGE}}/{{$SUM.TOTALPAGE}} </td>
  </tr>
</table>

<p>&nbsp;</p>
</body>
</html>
