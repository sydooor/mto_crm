(function(win){
win.UBox = {
	/**
	 * 显示消息盒子
	 */
	show : function(message, status, finishCallBack, closeTimeOut, onDestoryCallBack){		
		if($.inArray(status, [-1, 1, 2]) == -1){
			status = 0;
		}
		
		if(!closeTimeOut){
			closeTimeOut = 2500;
		}else{
			closeTimeOut = Math.abs(closeTimeOut) * 1000;
		}
		
		self.$oLastBox && self.$oLastBox.remove();	//删除上一个消息盒子
		
		//判断采用哪算提示样式
		var statuClass = ['Notice', 'Error', 'Success'][status + 1];
		
		var $oBox = $('<div class="wrapUBox">\n\
			<div class="uBoxshadow">\n\
				<div id="wrapUBoxLeft" class="wrapUBoxLeft uBox' + statuClass + 'Icon"></div>\n\
				<div id="wrapUBoxMiddle" class="wrapUBoxMiddle uBox' + statuClass + 'Message">' + message + '</div>\n\
				<div id="wrapUBoxRightSpace" class="wrapUBoxRightSpace uBox' + statuClass + 'RightSpace"></div>\n\
			</div>\n\
		</div>').appendTo('body');
		$oBox.css('left', ($(win).width() / 2 - $oBox.width() / 2) + 'px');
		
		//注册单击消失
		$oBox.click(function(){
			$(this).remove();
			if(typeof(onDestoryCallBack) == 'function'){
				onDestoryCallBack();
			}else if(typeof(finishCallBack) == 'string' && finishCallBack.length){
				if(finishCallBack == 'reload'){
					location.reload();
					return;
				}

				var regUrl = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
				var regUrl2 = /[0-9a-zA-Z\/?]*[-A-Z0-9+&@#\/%=~_|]/ig;
				if(regUrl.test(finishCallBack) || regUrl2.test(finishCallBack)){
					location.href = finishCallBack;
				}
			}else if(typeof(finishCallBack) == 'function'){
				finishCallBack();
			}
			
			self.$oLastBox = null;
		});
		
		self.$oLastBox = $oBox;

		//注册自动消失
		setTimeout(function(){
			$oBox.trigger('click');
		}, closeTimeOut);

		return $oBox;
	},

	/**
	 * 弹出确认消息框
	 * @param {type} message 确认消息
	 * @param {type} yesCallBack 确定按钮回调
	 * @param {type} noCallBack 否定按钮架设
	 * @param {type} aMoreOption 更多设置项
	 * @returns 确认框的jQuery的fn对象
	 */
	confirm : function(message, yesCallBack, noCallBack, aMoreOption){
		
		if(!yesCallBack){
			yesCallBack = $.noop;
		}
		
		if(!noCallBack){
			noCallBack = $.noop;
		}
		
		self.$oLastBox && self.$oLastBox.remove();	//删除上一个消息盒子
		
		var aOption = $.extend({
			hideYesBtn : false
			,hideNoBtn : false
			,btnYesText : '确定'
			,btnNoText : '取消'
		}, aMoreOption);
		
		var buttonsHtml = '';
		if(!aOption.hideYesBtn){
			buttonsHtml += '<a xid="uBoxButtonYes" accessKey="y">' + aOption.btnYesText + '</a>';
		}
		if(!aOption.hideNoBtn){
			buttonsHtml += '<a xid="uBoxButtonNo" accessKey="n" >' + aOption.btnNoText + '</a>';
		}
		
		var $oBox = $('<div class="wrapMask">\n\
			<div xid="uBoxWrapConfirm" class="uBoxWrapConfirm">\
				<div class="uBoxTitle">操作确认<a xid="uBoxClose" class="uBoxClose"></a></div>\
				<div class="wrapTip"><div class="confirmIcon"></div><div class="tip">' + message + '</div></div>\
				<div class="wrapControl">' + buttonsHtml + '</div>\
			</div>\
			<div xid="uBoxMask" class="uBoxMask"></div>\
		</div>').appendTo('body');
		
		$oBox.find('div[xid="uBoxMask"]').height($('body').height());
		
		var oConfirmBox = $oBox.find('div[xid="uBoxWrapConfirm"]');
		oConfirmBox.css({
			top : ($(win).height() / 2 - oConfirmBox.height() / 2) + 'px',
			left : ($(win).width() / 2 - oConfirmBox.width() / 2) + 'px'
		});
		
		$oBox.find('a[xid="uBoxButtonYes"]').click(function(){
			if(yesCallBack() != false){
				$oBox.remove();
			}
		});
		
		$oBox.find('a[xid="uBoxButtonNo"],a[xid="uBoxClose"]').click(function(){
			var isClose = $(this).attr('xid') == 'uBoxClose';
			if(typeof(noCallBack) == 'function' && !isClose){
				noCallBack();
			}
			$oBox.remove();
		});
		
		return $oBox;
	},
	////////////////////////
	/**
	 * 加载LOADING SHOW
	 */
	LoadingShow : function(message, status){		
		if($.inArray(status, [-1, 1, 2]) == -1){
			status = 0;
		}
		self.$oLastBox && self.LoadingHhow();	//删除上一个消息盒子
		
		//判断采用哪算提示样式
		var statuClass = ['Notice', 'Error', 'Success'][status + 1];
		
		var vBox = '<div class="wrapUBox" >\n\
			<div class="uBoxshadow">\n\
				<div id="wrapUBoxLeft" class="wrapUBoxLeft uBox' + statuClass + 'Icon"></div>\n\
				<div id="wrapUBoxMiddle" class="wrapUBoxMiddle uBox' + statuClass + 'Message">' + message + '</div>\n\
				<div id="wrapUBoxRightSpace" class="wrapUBoxRightSpace uBox' + statuClass + 'RightSpace"></div>\n\
			</div>\n\
		</div>';
		vBox = '<div class="UBoxLoading" style="position:fixed; top:0px; left:0px;height:300%;width:100%; background:rgba(0,0,0,0.5); z-index:9999999999;">'+vBox+'</div>';
		var $oBox = $(vBox).appendTo('body');
		var BoxObj = $('.UBoxLoading .wrapUBox');
		BoxObj.css('left', ($(win).width() / 2 - BoxObj.width() / 2) + 'px');
		

		self.$oLastBox = $oBox;


		return $oBox;
 	},
	////////////////////////
	/**
	 * 加载LOADING HIDE
	 */
	LoadingHide : function (){	
	 	self.$oLastBox.remove();
	}
};

var self = win.UBox;
})(window);