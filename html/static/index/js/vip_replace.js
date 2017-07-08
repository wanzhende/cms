$(document).ready(function() {

	function init() {
		//移除指定的css样式、隐藏核销按钮、清空表格内容
		$("td").css({'text-decoration':'', 'color':''});
		$('#dhBtn').hide();
		$('th:contains(券号)').next().html("");
		$('th:contains(金额)').next().html("");
		$('th:contains(状态)').next().html("");
		$('th:contains(有效期)').next().html("");
	}
	
	$("#queryBtn").click(function() {
		init();
		var cardno = $("#cardno").val();
		if(cardno!= '') {
			$.get('/index/Member/getcardInfo/cardno/' + cardno, function(data) {

				if(data.code == 1) {					
					var statusStr='';
					$('th:contains(卡号)').next().html(data.data.cardno);
					$('th:contains(金额)').next().html(data.data.balance+"元");
		
					if(data.data.status==0) {
						//未兑换，显示核销按钮
						statusStr='未兑换';
						$('th:contains(状态)').next().css('color','rgb(83, 210, 93)');
						$('#dhBtn').css('display','block');
						$('#dhBtn').show();

					} else {
						//已兑换
						$('th:contains(状态)').next().css('color',"#f00");
						statusStr = '已于' + data.data.r_time + '兑换(新卡号：' + data.data.new_cardno + ')';
						$('#dhBtn').hide();
					}
					$('th:contains(状态)').next().html(statusStr);
				} else {
					layer.open({
						title: '错误',
						icon: 2,
						content: data.msg
					});
				}
			});
		} else {	
			layer.open({
				title: '错误',
				icon: 2,
				content: '我也是醉了，不输入卡号怎么查呢？求大神指点！！'
			});
		}
	});
	
	$("#dhBtn").click(function() {
		var couponCode = $("#coupon_code").val();
		$("#queryBtn").click();
		var money = $('th:contains(金额)').next().html();
		$.get("http://vip.cnailin.com/index/Coupon/validCoupon/code/" + couponCode, function(data) {
			if(data.code) {
				$("#queryBtn").click();
			}
			layer.open({
				title: '提示',
				icon: 1,
				content: data.msg
			});
		});
	});
});
