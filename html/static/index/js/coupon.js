$(document).ready(function() {

	function init() {
		//移除指定的css样式、隐藏核销按钮、清空表格内容
		$("td").css({'text-decoration':'', 'color':''});
		$('#hxBtn').hide();
		$('th:contains(券号)').next().html("");
		$('th:contains(金额)').next().html("");
		$('th:contains(状态)').next().html("");
		$('th:contains(有效期)').next().html("");
	}
	
	$("#queryBtn").click(function() {
		init();
		var couponCode = $("#coupon_code").val();
		if(couponCode != '') {
			$.get('/index/Coupon/getcouponInfo/code/' + couponCode, function(data) {

				if(data.code == 1) {					
					var statusStr='';
					$('th:contains(券号)').next().html(data.data.code);
					$('th:contains(金额)').next().html(data.data.money+"元");
					var validPeriod = data.data.start_time + '至' + data.data.end_time;				
					
					if(data.data.status==0 && data.data.expired == 0) {
						//未使用、未过期，显示核销按钮
						statusStr='未使用';
						$('th:contains(状态)').next().css('color','rgb(83, 210, 93)');
						$('#hxBtn').css('display','block');
						$('#hxBtn').show();

					} else if(data.data.status == 1) {
						//已使用
						$('th:contains(状态)').next().css('color',"#f00");
						statusStr = '已于' + data.data.use_time + '使用(' + data.data.name + ')';
						$('#hxBtn').hide();

					} else if(data.data.expired ==1) {
						//不在有效期内
						$('th:contains(券号)').next().css({'color':"#aaa", 'text-decoration':'line-through'});
						$('th:contains(状态)').next().css('color',"#aaa");
						statusStr = '不在有效期内';
						$('th:contains(金额)').next().css('text-decoration','line-through').css('color','#aaa');
						$('th:contains(有效期)').next().css('color','#aaa');
						validPeriod += '(不在有效期内)';
						$('#hxBtn').hide();

					}
					
					$('th:contains(状态)').next().html(statusStr);
					$('th:contains(有效期)').next().html(validPeriod);
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
				content: '我也是醉了，不输入券码怎么查呢？求大神指点！！'
			});
		}
	});
	
	$("#hxBtn").click(function() {
		var couponCode = $("#coupon_code").val();
		$("#queryBtn").click();
		var money = $('th:contains(金额)').next().html();
		$.get("/index/Coupon/validCoupon/code/" + couponCode, function(data) {
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
