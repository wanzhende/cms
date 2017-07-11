$(document).ready(function() {

	function init() {
		//移除指定的css样式、隐藏核销按钮、清空表格内容
		$("td").css({'text-decoration':'', 'color':''});
		$('th:contains(券号)').next().html("");
		$('th:contains(余额)').next().html("");
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
					$('th:contains(余额)').next().html(data.data.balance + "元");
		
					if(data.data.status==0) {
						//未兑换，显示核销按钮
						statusStr='未兑换';
						$('th:contains(状态)').next().css('color','rgb(83, 210, 93)');
						layer.open({
							type: 2,
							title: '请输入新卡号',
							content: '/index/Member/newcard',
							area: ['400px', '240px'],
							btn: ['确认'],
							yes: function(index, layero) {
								var new_card = layer.getChildFrame('#new_card', index);
								var new_cardno = new_card.val();
								if(new_cardno != "") {
									$.get('/index/Member/replaceCard/cardno/' + cardno + '/new_cardno/' + new_cardno, function(data){
										console.log(data);
										if(data.code == 1) {
											layer.close(index);
											$("#queryBtn").click();
											layer.alert('兑换成功，请做好登记后在收银系统中为对应卡充值！',{icon: 1});
										} else {
											layer.close(index);
											$("#queryBtn").click();
											layer.alert('兑换失败，请重新查询！',{icon: 2});
										}										
									});
								} else {
									layer.msg('新卡号不能为空!');
								}								
							},
							closeBtn: 0
						});

					} else {
						//已兑换
						$('th:contains(状态)').next().css('color',"#f00");
						statusStr = '已于' + data.data.r_time + '兑换(新卡号：' + data.data.new_cardno + ')';
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

	$('#dhRecord').click(function() {
		var index = layer.open({
			type:2,
			maxmin: true,
			content:'/index/Member/replaceList',
		});
		layer.full(index);
	});
});