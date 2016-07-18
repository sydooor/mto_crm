/*
  @author: 
  @description:基础操作
  @add_date:2014-05-05
  @author(lastest modification by pzh)
*/




function GetRequest() {
    var url = location.search; //获取url中"?"符后的字串

    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
        }
    }
    return theRequest;
}

function GetRequestValue(strname) {
    var url = location.search; //获取url中"?"符后的字串

    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
        }
    }
    return theRequest[strname];
}

function getJsDataByJson(str) {
    if (str == "/Date(-28800000)/") {
        return "";
    }
    else {
        //return eval("new " + value.substr(1, value.length - 2)).toLocaleString(); 
        var stDate = str.substring(6, str.length - 2);
        var date = new Date();
        date.setFullYear(1970, 1, 1);
        date.setTime(0);
        date.setMilliseconds(stDate);
        var setDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
        return setDate;
    }
}

//转换时间
function test(str) {
    if (str == "/Date(-28800000)/") {
        return "";
    }
    var stDate = str.substring(6, str.length - 2);
    var date = new Date();
    date.setFullYear(1970, 1, 1);
    date.setTime(0);
    date.setMilliseconds(stDate);
    var setDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
    return setDate;

}
//获取当前日期yyyy-MM-dd HH:mm:ss
function getNowFormatDate() {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
            + " " + date.getHours() + seperator2 + date.getMinutes()
            + seperator2 + date.getSeconds();
    return currentdate;
}

//获取用户名
function GetName() {


    var name = getCookie("username");

    if (name == "" || name == undefined || name == null) {


        window.location.href = "Login.aspx";

    } else {
        $("#username").html("欢迎您！ " + getCookie("username"));


    }

}

/* 设置当前导航选中 */
function setNav(index) {
    $("#banner li").removeClass("cur");
    $("#banner" + index + " a").addClass("cur");

}


//查询Cookie中的历史记录
function InitialCookie() {
    try
    {
        //初始化获取名为hisArt的cookie （里面存放的是json对象）
        var json = eval(getCookie("hisArt"));
        var list = "";
        //如果有缓存，则取出遍历
        if (json != null) {
        
            var boarddiv = "";
            for (var i = 0; i <json.length; i++) {
                boarddiv += '<ul>\
                            <li><a href="#" >' + json[i].title + '</a></li>\
                        </ul>';
            }
            boarddiv += '<p class="lastClear"><a href="javascript:void(0)" onclick="clearHistory()">清除历史记录</a></p>';
            //构建页面布局 追加数据
            $("#sHistoryList").html(boarddiv);

        }
        else {
        
        }
    }
    catch (e) {

    }
}


//创建Cookie 添加历史记录
function createHistory(art_title) {
    try {
        var canAdd = true; //初始可以插入cookie信息 
        var hisArt = getCookie("hisArt");
        var len = 0;
        //初始化长度
        if (hisArt) {
            hisArt = eval(hisArt);
            len = hisArt.length;
        }

        //是否是重复访问
        var hisArt_json = eval(getCookie("hisArt"));
        var list = "";

        if (hisArt_json != null) {
            //如果cookie中存在，则不放入cookie
            for (var i = 0; i < hisArt_json.length; i++) {

                if (art_title == hisArt_json[i].title) {
                    canAdd = false;
                    return false;
                }
            }

        }
        //添加
        if (canAdd == true) {
            var json = "[";
            var endJson = "]";
            if (len < 10) {

                //只保存10个值
                json += "{\"title\":\"" + art_title + "\"},";

                for (var i = 0; i < len; i++) {

                    json += "{\"title\":\"" + hisArt[i].title + "\"},";

                }

            } else {

                //重复了替换
                json += "{\"title\":\"" + art_title + "\"},";

                for (var i = 0; i < 9; i++) {

                    json += "{\"title\":\"" + hisArt[i].title + "\"},";

                }
            }
            json = json + endJson;
            SetCookie("hisArt", json.substring(0, json.lastIndexOf(',')) + "]");
        }
    }
    catch (e)
    {

    }
}
//删除历史记录
function clearHistory() {

    delCookie("hisArt");
    $("#sHistoryList").html("");
}

//获取搜索类型编码值
function GetSearhTypeBm() {
    var searchTypeBm = "T1";
    $("#searchTab ul li").each(
       function () {
           if ($(this).attr("class") == "cur") {
               var SearchTypeName = $(this).text().replace(/[ ]/g, "");
               if (SearchTypeName == "全部")
                   searchTypeBm = "T1";
               else if (SearchTypeName == "公司名")
                   searchTypeBm = "T2";
               else if (SearchTypeName == "产品")
                   searchTypeBm = "T3";
               else if (SearchTypeName == "地址")
                   searchTypeBm = "T4";
           }
       }
      );
    return searchTypeBm;
}

//取所选择的值保存在cookie中
//skip
function evaluation(All, curProvince, curArea,skip) {
    var inputName = $.trim($("#searchInput").val());
    var selAddress = ""; //选择的地区
    if (inputName.length > 0) {
        //var curProvince = $("#curProvince").text();//省份
        //  var curArea = $("#curArea").text();//城市
        if (curArea != null && curArea != "所有地区" && curArea != "") {
            SetCookie("curArea", curArea);//城市
            selAddress = escape(curArea).replaceAll("%u", "-");
        }
        else {
            SetCookie("curArea", "");
        }

        if (curProvince != null && curProvince != "") {
            SetCookie("curProvince", curProvince);//省份
            if(selAddress=="")
                selAddress = escape(curProvince).replaceAll("%u", "-");
        }
        else { SetCookie("curProvince", "") }

        if (getCookie("currentSearchVal").indexOf("/") != -1 || getCookie("currentSearchVal").indexOf("\\") != -1) {
            ShowTipsBox("请去除搜索关键词中的特殊字符/或\\");
            return;
        }

        SetCookie("All", All)//选择的项
        SetCookie("varName", inputName);//文本框的值
        createHistory($("#searchInput").val());//添加历史记录

        if(skip==true)
        {
            ClearResultCondition();
            var keyWord = escape(getCookie("currentSearchVal")).replaceAll("%u", "-");
            
            location.href = "results_" + GetSearhTypeBm + "_"+selAddress+"_" + keyWord + "_1.html";
            //location.href = "results.aspx";
        }
    }
}

//将result页面选择的条件清空
function ClearResultCondition()
{
    SetCookie("operatingMode", "");//经营模式
    SetCookie("humanScale", "");//人员规模
    SetCookie("incomeYear", "");//年营业额
    SetCookie("includeMobile", "");//包含手机
    SetCookie("includeBoss", "");//包含法人
    SetCookie("includeFax", "");//包含传真
    SetCookie("includePhone", "");//包含手机
    SetCookie("FormSource", "");//认证来源
}
//设置搜索值
function SetSearchValue(val)
{
    SetCookie("currentSearchVal", val);//搜索值
}
//验证码校验
function yzmValidate() {
    var yzm = getCookie("yzm");
    if ($("#yzm").val() == yzm) {
        return true;
    }
    else {
        return false;
    }
}

//获取url参数
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    if (reg != null && reg != "") {
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return "";
    }
    else
        return "";
}




//弹出提示窗口(JS操作兼容所有浏览器)
function ShowTipsBox(tipsInfo) {
    //创建背景
    var oBgDiv = document.createElement("div");
    oBgDiv.id = "bgCover";
    document.body.appendChild(oBgDiv);
    document.getElementById("bgCover").className = "bgCover";

    //创建内容
    var oContentDiv = document.createElement("div");
    oContentDiv.id = "prompt_box_wrap";
    var tipsHtml = "\
    <div id='prompt_box' class='popBox'>\
	    <h1><span>提示</span><i> </i><a href='javascript:void(0);' onclick='ClosePopBox()'>&nbsp;</a></h1>\
    	     <table cellpadding='0' align='center' id='login_a' cellspacing='0' width='90%' height='30%'>\
                    <tr>\
                   <td colspan='2' align='center'>"+ tipsInfo + "</td>\
                    <tr>\
                   <td align='center'><button class='btn'  onclick='ClosePopBox()'>确 定</button></td>\
                    <td></td>\
                <tr>\
            </table>\
        </div></div>";
    oContentDiv.innerHTML = tipsHtml;
    document.body.appendChild(oContentDiv);
    document.getElementById("prompt_box_wrap").className = "prompt_box_wrap";
    var winWidth;
    var winHeight;

    if (window.innerWidth)
        winWidth = window.innerWidth;
    else if ((document.body) && (document.body.clientWidth)) {
        winWidth = document.body.clientWidth;
    }
    if (window.innerHeight)

        winHeight = window.innerHeight;

    else if ((document.body) && (document.body.clientHeight)) {
        winHeight = document.body.clientHeight;
    }

    if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth) {

        winHeight = document.documentElement.clientHeight;
        winWidth = document.documentElement.clientWidth;

    }

    document.getElementById("prompt_box_wrap").style.top = ((winHeight - document.getElementById("prompt_box_wrap").clientHeight) / 2).toString() + "px";
    document.getElementById("prompt_box_wrap").style.left = ((winWidth - document.getElementById("prompt_box_wrap").clientWidth) / 2).toString() + "px";
}




//弹出层并在层上显示传入的html，内容中的关闭事件需调用ClosePopBox
function ShowPopBoxWithHtml(htmlContent) {
    //创建背景
    var oBgDiv = document.createElement("div");
    oBgDiv.id = "bgCover";
    document.body.appendChild(oBgDiv);
    document.getElementById("bgCover").className = "bgCover";


    //创建内容
    var oContentDiv = document.createElement("div");
    oContentDiv.id = "prompt_html_box_wrap";
    oContentDiv.innerHTML = htmlContent;
    document.body.appendChild(oContentDiv);
    document.getElementById("prompt_html_box_wrap").className = "prompt_html_box_wrap";

    var winWidth;
    var winHeight;

    if (window.innerWidth)
        winWidth = window.innerWidth;
    else if ((document.body) && (document.body.clientWidth)) {
        winWidth = document.body.clientWidth;
    }
    if (window.innerHeight)

        winHeight = window.innerHeight;

    else if ((document.body) && (document.body.clientHeight)) {
        winHeight = document.body.clientHeight;
    }

    if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth) {

        winHeight = document.documentElement.clientHeight;
        winWidth = document.documentElement.clientWidth;

    }
   
    document.getElementById("prompt_html_box_wrap").style.top = ((winHeight - document.getElementById("prompt_html_box_wrap").clientHeight) / 2).toString() + "px";
    document.getElementById("prompt_html_box_wrap").style.left = ((winWidth - document.getElementById("prompt_html_box_wrap").clientWidth) / 2).toString() + "px";
}

//弹出确认、取消提示窗口新(JS操作兼容所有浏览器)
function ShowConfirmTipsBox(tipsInfo, FuncName) {
    //创建背景
    var oBgDiv = document.createElement("div");
    oBgDiv.id = "bgCover";
    document.body.appendChild(oBgDiv);
    document.getElementById("bgCover").className = "bgCover";

    var tipsHtml = "\
        <div id='prompt_box' class='popBox'>\
	    <h1><span>提示</span><i> </i><a href='javascript:void(0);' onclick='ClosePopBox()'>&nbsp;</a></h1>\
    	     <table cellpadding='0' align='center' id='login_a' cellspacing='0' width='90%' height='30%'>\
                    <tr>\
                        <td colspan='2' align='center'>"+ tipsInfo + "</td>\
                    </tr>\
                    <tr align='center'>\
                        <td colspan='2'>\
                            <button class='btn' style='margin-right:20px' onclick=\"ClosePopBox();" + FuncName + "\">确 定</button>\
                            <button class='btn' onclick='ClosePopBox()'>取 消</button>\
                        </td>\
                    </tr>\
            </table>\
        </div>\
    </div>";
    //创建内容
    var oContentDiv = document.createElement("div");
    oContentDiv.id = "prompt_box_wrap";
    oContentDiv.innerHTML = tipsHtml;
    document.body.appendChild(oContentDiv);
    document.getElementById("prompt_box_wrap").className = "prompt_box_wrap";
    var winWidth;
    var winHeight;

    if (window.innerWidth)
        winWidth = window.innerWidth;
    else if ((document.body) && (document.body.clientWidth)) {
        winWidth = document.body.clientWidth;
    }
    if (window.innerHeight)

        winHeight = window.innerHeight;

    else if ((document.body) && (document.body.clientHeight)) {
        winHeight = document.body.clientHeight;
    }

    if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth) {

        winHeight = document.documentElement.clientHeight;
        winWidth = document.documentElement.clientWidth;

    }
    if (window.location.href.indexOf("results") != -1) //针对伪静态
    {
        document.getElementById("prompt_box_wrap").style.top = "201px";
    }
    else {
        document.getElementById("prompt_box_wrap").style.top = ((winHeight - document.getElementById("prompt_box_wrap").clientHeight) / 2).toString() + "px";
    }
    document.getElementById("prompt_box_wrap").style.left = ((winWidth - document.getElementById("prompt_box_wrap").clientWidth) / 2).toString() + "px";
}

//关闭提示窗 (JS操作兼容所有浏览器)
function ClosePopBox() {
    if (document.getElementById("bgCover") != undefined && document.getElementById("bgCover") != null) {
        document.getElementById("bgCover").style.display = "none";
    }
    if (document.getElementById("prompt_box_wrap") != undefined && document.getElementById("prompt_box_wrap") != null) {
        document.getElementById("prompt_box_wrap").style.display = "none";
    }
    if (document.getElementById("bgCover") != undefined && document.getElementById("bgCover") != null) {
        document.body.removeChild(document.getElementById("bgCover"));
    }
    if (document.getElementById("prompt_box_wrap") != undefined && document.getElementById("prompt_box_wrap") != null) {
        document.body.removeChild(document.getElementById("prompt_box_wrap"));
    }
}

//显示登陆窗口
//function ShowSuggestion(Complete) {
//    var loginHtml = "\
//        <div id='loginPopBox' class='popBox' style='width:400px'>\
//	    <h1><span></span><i> </i><a href='javascript:void(0);' onclick='NewCloseLoginPopBox()'>&nbsp;</a></h1>\
//    	     <table cellpadding='0' align='center' id='login_a' cellspacing='0' width='80%'>\
//                    <tr>\
//                        <td style='font-size:12px; width:67px;'>反馈内容：</td>\
//                        <td><input id='sug_content' type='text' style=\'height:100px;width:244px;\' maxlength='400' onkeydown=\"if (event.keyCode == 13) { document.getElementById('sug_phone').focus(); }\" /></td>\
//                        <td>&nbsp;</td>\
//                    </tr>\
//                    <tr>\
//                        <td style='font-size:12px;'>电话：</td>\
//                        <td><input  id='sug_phone' type='text' maxlength='25' onkeydown=\"if (event.keyCode == 13) { document.getElementById('email').focus(); }\" /></td>\
//                        <td>&nbsp;</td>\
//                    </tr>\
//                    <tr>\
//                        <td style='font-size:12px;'>邮箱：</td>\
//                        <td><input  id='email' type='password' maxlength='45' onkeydown=\"if (event.keyCode == 13) { document.getElementById('yzm').focus(); }\" /></td>\
//                        <td>&nbsp;</td>\
//                    </tr>\
//                    <tr>\
//                        <td style='font-size:12px;'>验证码：</td>\
//                        <td>\
//                            <div class='yzm'>\
//                                <input id='loginyzm' type='text'  style='width:60px;' maxlength='4' onkeydown=\"if (event.keyCode == 13) { document.getElementById('login').click(); }\" />\
//                                <img src='VerifyCode.ashx' name='Pic' style='cursor: pointer' alt='加载中...' onclick=\"this.src = this.src + '?'\" /><span class='choimg'>看不清?<a href='javascript:void(0)' onclick=\"Pic.src = Pic.src + '?'\">换一张</a></span>\
//                            </div>\
//                        </td>\
//                        <td>&nbsp;</td>\
//                    </tr>\
//                    <tr>\
//                        <td></td>\
//                        <td><button onclick=\"commitSuggestion()\" class='btn' id='login'>提交</button>&nbsp;&nbsp;<span id='status' style='color:red'></span></td>\
//                        <td>&nbsp;</td>\
//                    </tr>\
//                </table>\
//        </div>\
//    </div>";
//    ShowPopBoxWithHtml(loginHtml);
//}

function ShowSuggestion(Complete) {
    var loginHtml = "\
        <div id='loginPopBox' class='popBox' style='width:400px'>\
	    <h1><span></span><i> </i><a href='javascript:void(0);' onclick='NewCloseLoginPopBox()'>&nbsp;</a></h1>\
    	     <table cellpadding='0' align='center' id='login_a' cellspacing='0' width='80%'>\
                    <tr>\
                        <td style='height:30px; line-height:30px;font-size:12px; width:67px;'>对搜索结果不满意吗？请告诉我们</td>\
                    </tr>\
                    <tr>\
                        <td style='height:30px; line-height:30px;font-size:12px; width:67px;'>反馈内容：</td>\
                    </tr>\
                    <tr>\
                        <td style='line-height:0px;'><textarea id='sug_content' type='text' style=\'height:67px;width:304px;\' maxlength='400' onkeydown=\"if (event.keyCode == 13) { document.getElementById('sug_phone').focus(); }\"></textarea></td>\
                    </tr>\
                    <tr>\
                        <td style='height:30px; line-height:30px;font-size:12px;'>电话：</td>\
                    </tr>\
                    <tr>\
                        <td style='height:30px; line-height:30px;font-size:12px;'><input  id='sug_phone' type='text' style=\'width:304px;\' maxlength='25' onkeydown=\"if (event.keyCode == 13) { document.getElementById('email').focus(); }\" /></td>\
                    </tr>\
                    <tr>\
                        <td style='height:30px; line-height:30px;font-size:12px;'>邮箱：</td>\
                    </tr>\
                    <tr>\
                        <td style='height:30px; line-height:30px;'><input  id='email' type='text' maxlength='45' style=\'width:304px;\'  onkeydown=\"if (event.keyCode == 13) { document.getElementById('yzm').focus(); }\" /></td>\
                    </tr>\
                    <tr>\
                        <td style='height:30px; line-height:30px;font-size:12px;'>验证码：</td>\
                    </tr>\
                    <tr>\
                        <td>\
                            <div class='yzm'>\
                                <input id='loginyzm' type='text'  style='width:60px;' maxlength='4' onkeydown=\"if (event.keyCode == 13) { document.getElementById('login').click(); }\" />\
                                <img src='VerifyCode.ashx' name='Pic' style='cursor: pointer' alt='加载中...' onclick=\"this.src = this.src + '?'\" /><span class='choimg'>看不清?<a href='javascript:void(0)' onclick=\"Pic.src = Pic.src + '?'\">换一张</a></span>\
                            </div>\
                        </td>\
                        <td>&nbsp;</td>\
                    </tr>\
                    <tr>\
                        <td><button onclick=\"commitSuggestion()\" class='btn' id='login'>提交</button>&nbsp;&nbsp;<span id='status' style='color:red'></span></td>\
                    </tr>\
                </table>\
        </div>\
    </div>";
    ShowPopBoxWithHtml(loginHtml);
}
//提交反馈
function commitSuggestion()
{
    var sug_content = $("#sug_content").val().replaceAll("|","");
    var sug_phone = $("#sug_phone").val().replaceAll("|", "");
    var sug_email = $("#sug_phone").val().replaceAll("|", "");
    if (sug_content.length == 0) {
        $("#status").html("请输入反馈内容！");
        $("#sug_content").focus();
        return;
    }
    if (sug_phone.length == 0) {
        $("#status").html("请输入您的电话！");
        $("#sug_phone").focus();
        return;
    }
    if (LoginYzmValidate() == false) {
        $("#status").html("验证码错误！");
        $("#loginyzm").focus();
        return;
    }
    $("#login").attr("disabled", 'true');
    $("#status").html("正在提交中...");
    $.ajax({
        url: 'ZhuoHi.ashx',
        type: 'POST',
        //dataType: 'json',
        data: { meth: 'addSuggestion', body: sug_content + "|" + sug_phone + "|" + sug_email },
        //timeout: 60000,
        async: true,
        error: function (XMLHttpRequest, textStatus, errorThrown) {//请求错误 时执行的方法 
            ShowTipsBox("网络异常");
            $("#divWait").hide();
            $("#btnPost").attr("disabled", "");
        },
        success: function (data, txtSataus) {//请求成功时执行的方法 
            NewCloseLoginPopBox();
            ShowTipsBox(data);
        }
    })
}

//显示登陆窗口
function ShowLoginPopBox(Complete) {
    var loginHtml = "\
        <div id='loginPopBox' class='popBox' style='width:400px'>\
	    <h1><span></span><i> </i><a href='javascript:void(0);' onclick='NewCloseLoginPopBox()'>&nbsp;</a></h1>\
    	     <table cellpadding='0' align='center' id='login_a' cellspacing='0' width='80%'>\
                    <tr>\
                        <td style='font-size:12px; width:57px;'>账号：</td>\
                        <td><input id='user' type='text' maxlength='25' onkeydown=\"if (event.keyCode == 13) { document.getElementById('password').focus(); }\" /></td>\
                        <td>&nbsp;</td>\
                    </tr>\
                    <tr>\
                        <td style='font-size:12px;'>密码：</td>\
                        <td><input  id='password' type='password' maxlength='25' onkeydown=\"if (event.keyCode == 13) { document.getElementById('yzm').focus(); }\" /></td>\
                        <td>&nbsp;</td>\
                    </tr>\
                    <tr>\
                        <td style='font-size:12px;'>验证码：</td>\
                        <td>\
                            <div class='yzm'>\
                                <input id='loginyzm' type='text'  style='width:60px;' maxlength='4' onkeydown=\"if (event.keyCode == 13) { document.getElementById('login').click(); }\" />\
                                <img src='VerifyCode.ashx' name='Pic' style='cursor: pointer' alt='加载中...' onclick=\"this.src = this.src + '?'\" /><span class='choimg'>看不清?<a href='javascript:void(0)' onclick=\"Pic.src = Pic.src + '?'\">换一张</a></span>\
                            </div>\
                        </td>\
                        <td>&nbsp;</td>\
                    </tr>\
                    <tr>\
                        <td></td>\
                        <td><button onclick=\"PopBoxLoginIn("+ Complete + ")\" class='btn' id='login'>登录</button>&nbsp;&nbsp;<span id='status' style='color:red'></span></td>\
                        <td>&nbsp;</td>\
                    </tr>\
                    <tr>\
                        <td></td>\
                        <td><a href='regist.html'>还没有账号？立即去注册</a></td>\
                    </tr>\
                </table>\
        </div>\
    </div>";
    //GetLoginYZM();
    //$.blockUI({
    //    message: loginHtml,
    //    css: {
    //        width: '420px',
    //        height: '295px',
    //        left: ($(window).width() - 420) / 2 + 'px',
    //        top: ($(window).height() - 295) / 2 + 'px',
    //        border: '1px solid #01a7fd'
    //    }
    //});
    ShowPopBoxWithHtml(loginHtml);
}
//获取用户级别数据
function getUserLevel(userName)
{
    $.ajax({
        url: '../ZhuoHi.ashx',
        type: 'POST',
        data: { meth: 'getUserAuthority', body: userName },
        dataType: 'text',
        async: false,
        error: function (XMLHttpRequest, textStatus, errorThrown) {//请求错误 时执行的方法 
            ShowTipsBoxalert("请求用户级别错误!");
        },
        success: function (return_data) {
            addCookie("userLevel", return_data, 0);
            if (eval("(" + return_data + ")").查看页数 != undefined && eval("(" + return_data + ")").查看页数!=null)
                addCookie("pageDisplay", eval("(" + return_data + ")").查看页数, 0);
            else
                addCookie("pageDisplay", "10", 0); //未登录最多查看前50页
        }
    });
}
//获取用户级别数据
function getUserLevelWithPath(userName,Path) {
    $.ajax({
        url:Path,
        type: 'POST',
        data: { meth: 'getUserAuthority', body: userName },
        dataType: 'text',
        async: false,
        error: function (XMLHttpRequest, textStatus, errorThrown) {//请求错误 时执行的方法 
            ShowTipsBoxalert("请求用户级别错误!");
        },
        success: function (return_data) {
            addCookie("userLevel", return_data, 0);
            if (eval("(" + return_data + ")").查看页数 != undefined && eval("(" + return_data + ")").查看页数 != null)
                addCookie("pageDisplay", eval("(" + return_data + ")").查看页数, 0);
            else
                addCookie("pageDisplay", "10", 0); //未登录最多查看前50页
        }
    });
}

//获取当前用户VIP名称eval("("+return_data+")");
function getUserLevelName() {
    if (getCookie("userLevel") != null)
        return eval("(" + getCookie("userLevel") + ")").LevelName;
    else
        return "未登录用户";
}
//获取当前用户是否能操作认证来源
function getVerifySource() {
    if (getCookie("userLevel") != null) {
        if (eval("(" + getCookie("userLevel") + ")").认证来源 != undefined && eval("(" + getCookie("userLevel") + ")").认证来源 != null)
            return eval("(" + getCookie("userLevel") + ")").认证来源;
        else
            return false;
    }
    else
        return false;
}
//获取当前用户最大分页数
function getPageDisplayNum()
{
    if (getCookie("userLevel") != null)
        return eval("(" + getCookie("userLevel") + ")").查看页数;
    else
        return "10";
}
//当前用户点击页数超过了能获取的最大页数
function isOverPageDisplayNum(num)
{
    if (num > parseInt(getPageDisplayNum())) {
        ShowTipsBox("您当前的用户级别为" + getUserLevelName() + "，最多只能查看前" + getPageDisplayNum() + "页数据");
        return false;
    }
    else
        return true;
}
//获取当前用户是否可以选择复合条件
function getConditions() {
    if (getCookie("userLevel") != null)
        if (eval("(" + getCookie("userLevel") + ")").多条件 == "false")
            return false;
        else
            return true;
    else
        return true;
}
//判断当前用户是否可选择复合条件
//function isGetConditions()
//{
//    if (Boolean(getConditions()) == true)
//        return true;
//    else
//        return false;
//}
//获取当前用户最大可收藏数
function getCollectAmount() {
    if (getCookie("userLevel") != null)
        return eval("(" + getCookie("userLevel") + ")").收藏;
    else
        return "0";
}
//当前用户收藏是否超过了最大收藏数
function isOverMaxCollectAmount()
{
    var result = false;
    $.ajax({
        url: 'ZhuoHi.ashx',
        type: 'POST',
        data: { meth: 'getColloctAmount', body: getCookie("username") },
        dataType: 'text',
        async: false,
        error: function (XMLHttpRequest, textStatus, errorThrown) {//请求错误 时执行的方法 
            ShowTipsBoxalert("获取用户收藏记录数失败!");
        },
        success: function (return_data) {
            if (return_data > parseInt(getCollectAmount()))
            {
                result = true;
            }
        }
    });
    return result;
}

//弹出登陆窗口的登陆事件
function PopBoxLoginIn(Complete) {
    var UserName = $("#user").val();
    var PassWord = $("#password").val();
    if (UserName.length == 0) {
        $("#status").html("请输入您的用户名！");
        $("#user").focus();
        return;
    }
    if (PassWord.length == 0) {
        $("#status").html("请输入您的密码！");
        $("#password").focus();
        return;
    }
    if (LoginYzmValidate() == false) {
        $("#status").html("验证码错误！");
        $("#loginyzm").focus();
        return;
    }
    $("#login").attr("disabled", 'true');
    $("#status").html("正在登录中...");
    var PassWord = hex_md5(PassWord).toUpperCase();
    var url = "http://user.zhuoxun.cc/usercenter/AjaxValidator.aspx?ValidatorType=0706&SoftCode=SFT00003&MacCode=" + "&PassWord=" + PassWord + "&callback=?";
    var data = { UserName: UserName };
    $.ajax({
        url: url,
        type: 'get',
        data: data,
        dataType: 'json',
        error: function (XMLHttpRequest, textStatus, errorThrown) {//请求错误 时执行的方法 
            ShowTipsBox("请求登录接口错误!");
        },
        success: function (backdata) {
            if (backdata.IsSuccess == '1') {
                addCookie("username", UserName, 0);
                addCookie("uresrpwd", backdata.AgentInfoVer, 0);
                AddUserInfoToCookie(Complete);
                addCookie("loginTime", getNowFormatDate(), 0);
            }
            else {
                $("#status").html("帐号或密码错误，请重试！");
                //GetLoginYZM();
                $("#login").removeAttr("disabled");
            }
        },
        complete: function ()
        {
            getUserLevel(UserName);
        }
    });
}
//获取登陆验证码
function GetLoginYZM() {
    try {
        $.ajax({
            type: "POST",
            url: "../ZhuoHi.ashx",
            data:
                {
                    meth: "yzm",
                    body: "4"
                },
            cach: false,
            async: true,
            error: function () {
                //alert("获取验证码出错，请刷新页面重新获取！");
            },
            success: function () {
                $("#loginyzmimg").attr("src", "../images/yzm.jpg?" + Math.random());
            }
        });
    } catch (e) {
        return;
    }

}
//离开焦点验证登陆验证码
function CheckLoginYZM() {
    if ($("#loginyzm").val() != "") {
        if (LoginYzmValidate() == false) {
            $("#status").html("验证码错误！");
        }
        else {
            $("#status").html("");
        }
    }
}
//验证登陆验证码
function LoginYzmValidate() {
    var yzm = getCookie("yzm");
    if ($("#loginyzm").val() == yzm) {
        return true;
    }
    else {
        return false;
    }
}
//输入框刷新验证码
function RefLoginYZM() {
    if ($("#loginyzm").val() == "") {
        GetLoginYZM();
    }
}
//将用户信息添加到Cookie
function AddUserInfoToCookie(Complete) {
    var username = getCookie("username");
    var uresrpwd = getCookie("uresrpwd");
    var url = "http://user.zhuoxun.cc/usercenter/AjaxValidator.aspx?ValidatorType=0702&callback=?";
    var data = { UserName: username,PassWord:uresrpwd };

    $.ajax({
        url: url,
        type: 'get',
        data: data,
        dataType: 'json',
        error: function (XMLHttpRequest, textStatus, errorThrown) {//请求错误 时执行的方法 
            ShowTipsBoxalert("请求登录接口错误!");
        },
        success: function (backdata) {
            addCookie("province", backdata.Province, 0);
            addCookie("city", backdata.City, 0);
            addCookie("address", backdata.Address, 0);
            addCookie("fax", backdata.Fax, 0);
            addCookie("telephone", backdata.Telephone, 0);
            addCookie("phone", backdata.Phone, 0);
            addCookie("qq", backdata.QQ, 0);
            addCookie("email", backdata.Email, 0);
            addCookie("regDateTime", backdata.RegDateTime, 0);
            addCookie("downloadCount", backdata.downloadCount, 0);
            addCookie("ID", backdata.ID, 0);
            addCookie("sex", backdata.MorF, 0);
            addCookie("AliasName", backdata.AliasName);
            SetHeadAndBottomMenu()
            NewCloseLoginPopBox();
            if (Complete != null && Complete != undefined && Complete != "") {
                if (typeof (Complete) == "function") {
                    var func = eval(Complete);
                    new func();
                }
                if (typeof (Complete) == "string") {
                    eval(Complete);
                }
                //Complete + ";"
            }

            //var goto = decodeURI(getQueryString("goto"));
            //if (goto != null && goto != "" && goto != undefined) {
            //    if (goto == "publish") {
            //        window.location.href = "uc_publish.html";
            //    }
            //    else {
            //        window.location.href = "uc_general.html";
            //    }
            //}
            //else if (document.referrer == undefined || document.referrer == "" || document.referrer == null) {
            //    window.location.href = "uc_general.html";
            //}
            //else {
            //    if (document.referrer.indexOf("regist.html") > 0) {
            //        window.location.href = "uc_general.html";
            //    }
            //    else {
            //        window.location.href = document.referrer;
            //    }
            //}
        }
    });
}
//关闭登陆弹窗
function CloseLoginPopBox() {
    $.unblockUI();
    $('.blockUI').fadeOut('slow');
}
//新关闭登陆弹窗
function NewCloseLoginPopBox() {
    if (document.getElementById("bgCover") != undefined && document.getElementById("bgCover") != null) {
        document.getElementById("bgCover").style.display = "none";
    }
    if (document.getElementById("prompt_html_box_wrap") != undefined && document.getElementById("prompt_html_box_wrap") != null) {
        document.getElementById("prompt_html_box_wrap").style.display = "none";
    }
    if (document.getElementById("bgCover") != undefined && document.getElementById("bgCover") != null) {
        document.body.removeChild(document.getElementById("bgCover"));
    }
    if (document.getElementById("prompt_html_box_wrap") != undefined && document.getElementById("prompt_html_box_wrap") != null) {
        document.body.removeChild(document.getElementById("prompt_html_box_wrap"));
    }
}


//弹出提示窗口采用blockui不兼容IE6-8
function ShowTipsBoxOld(tipsInfo) {
    var tipsHtml = "\
        <div id='prompt_box' class='popBox'>\
	    <h1><span>提示</span><i> </i><a href='javascript:void(0);' onclick='CloseLoginPopBox()'>&nbsp;</a></h1>\
    	     <table cellpadding='0' align='center' id='login_a' cellspacing='0' width='90%' height='30%'>\
                    <tr>\
                   <td colspan='2' align='center'>"+ tipsInfo + "</td>\
                    <tr>\
                   <td align='center'><input type='button' value='确 定' onclick='CloseLoginPopBox()'></td>\
                    <td></td>\
                <tr>\
            </table>\
        </div>\
    </div>";
    $.blockUI({
        message: tipsHtml,
        css: {
            width: '320px',
            height: '157px',
            left: ($(window).width() - 420) / 2 + 'px',
            top: ($(window).height() - 295) / 2 + 'px',
            border: '1px solid #01a7fd'
        }
    });
}

//弹出确认、取消提示窗口blockui不兼容IE6-8
function ShowConfirmTipsBoxOld(tipsInfo, FuncName) {
    var tipsHtml = "\
        <div id='prompt_box' class='popBox'>\
	    <h1><span>提示</span><i> </i><a href='javascript:void(0);' onclick='CloseLoginPopBox()'>&nbsp;</a></h1>\
    	     <table cellpadding='0' align='center' id='login_a' cellspacing='0' width='90%' height='30%'>\
                    <tr>\
                   <td colspan='2' align='center'>"+ tipsInfo + "</td>\
                    <tr>\
                   <td align='center'><input type='button' value='确 定' onclick=\"" + FuncName + ";CloseLoginPopBox()\">\
                   <input type='button' value='取 消' onclick='CloseLoginPopBox()'>\
                   </td>\
                    <td></td>\
                <tr>\
            </table>\
        </div>\
    </div>";
    $.blockUI({
        message: tipsHtml,
        css: {
            width: '320px',
            height: '157px',
            left: ($(window).width() - 420) / 2 + 'px',
            top: ($(window).height() - 295) / 2 + 'px',
            border: '1px solid #01a7fd'
        }
    });
}

//添加用户行为
function AddUserBehavior(functionCode, argValue) {
    $.ajax({
        url: 'ZhuoHi.ashx',
        type: 'POST',
        data: { meth: 'addUserBehavior', functionCode: functionCode, argValue: argValue },
        async: false,
        error: function (XMLHttpRequest, textStatus, errorThrown) {//请求错误 时执行的方法 
        },
        beforeSend: function () {
        },
        success: function (data, txtSataus) {//请求成功时执行的方法 
        }
    });
}

//添加用户行为
function AddUserBehaviorComplex(functionCode, argValueFirst, argValueSecond) {
    $.ajax({
        url: 'ZhuoHi.ashx',
        type: 'POST',
        data: { meth: 'addUserBehavior', functionCode: functionCode, argValueFirst: argValueFirst, argValueSecond: argValueSecond },
        async: false,
        error: function (XMLHttpRequest, textStatus, errorThrown) {//请求错误 时执行的方法 
        },
        beforeSend: function () {
        },
        success: function (data, txtSataus) {//请求成功时执行的方法 
        }
    });
}

//获取服务器上的卓嗨豆
function GetZHdian() {
    //var url = "http://user.zhuoxun.cc/usercenter/AjaxValidator.aspx?ValidatorType=0707&SoftCode=SFT00001&callback=?";
    //var data = {
    //    UserName: getCookie("username"),
    //    PassWord: getCookie("uresrpwd")
    //};

    //$.ajax({
    //    url: url,
    //    type: 'get',
    //    data: data,
    //    dataType: 'json',
    //    async: false,
    //    error: function (XMLHttpRequest, textStatus, errorThrown) {//请求错误 时执行的方法 
    //        alert(textStatus + errorThrown);
    //        ShowTipsBox("请求获取卓嗨豆接口错误!");
    //    },
    //    success: function (backdata) {
    //        if (backdata.IsSuccess == "1") {
    //            SetCookie("downloadCount", backdata.DownloadCount);
    //            $("#zhdContainer").html(backdata.DownloadCount);
    //        }
    //        else {
    //            ShowTipsBox("刷新卓嗨点失败，请重试!");
    //        }
    //    }
    //});
    var url = "http://user.zhuoxun.cc/usercenter/AjaxValidator.aspx?ValidatorType=0707&SoftCode=SFT00001&callback=?";
    var data = {
        UserName: getCookie("username"),
        PassWord: getCookie("uresrpwd")
    };
    $.getJSON(url, data, function (backdata) {
        if (backdata.IsSuccess == "1") {
            SetCookie("downloadCount", backdata.DownloadCount);
            $("#zhdContainer").html(backdata.DownloadCount);
        }
        else {
            ShowTipsBox("刷新卓嗨点失败，请重试!");
        }
    });
    //$.ajax({
    //    url: url,
    //    type: 'get',
    //    data: data,
    //    dataType: 'json',
    //    async: false,
    //    error: function (XMLHttpRequest, textStatus, errorThrown) {//请求错误 时执行的方法 
    //        alert(textStatus + errorThrown);
    //        ShowTipsBox("请求获取卓嗨豆接口错误!");
    //    },
    //    success: function (backdata) {
    //        if (backdata.IsSuccess == "1") {
    //            SetCookie("downloadCount", backdata.DownloadCount);
    //            $("#zhdContainer").html(backdata.DownloadCount);
    //        }
    //        else {
    //            ShowTipsBox("刷新卓嗨点失败，请重试!");
    //        }
    //    }
    //});
}
String.prototype.replaceAll = function (reallyDo, replaceWith, ignoreCase) {
    if (!RegExp.prototype.isPrototypeOf(reallyDo)) {
        return this.replace(new RegExp(reallyDo, (ignoreCase ? "gi" : "g")), replaceWith);
    } else {
        return this.replace(reallyDo, replaceWith);
    }
}