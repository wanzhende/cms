layui.define(['element', 'jquery'], function(exports) {
	var element = layui.element(), $ = layui.jquery;
	var obj = {
		setBind: function(navFilter, tabFilter) {
			
			if(navFilter !== '' && tabFilter !== '' && navFilter !== undefined && tabFilter !== undefined) {
				//点击导航菜单时，对tab进行响应
				element.on('nav(' + navFilter + ')', function(elem) {
					var elem_a = elem.find("a");
					var count = 0;
					var url = elem_a.data('url') === undefined ? '': elem_a.data('url');
					count = $(".layui-tab[lay-filter='" + tabFilter + "'] .layui-tab-title>li[lay-id='" + url + "']").length;
					if(url != '') {
						if(count) {
							element.tabChange(tabFilter, url);						
						} else {					
							element.tabAdd(tabFilter, {
								title: '<span>' + elem_a.text() + '</span>',
								content: '<iframe src ="' + url + '"></iframe>',
								id:url
							});
							element.tabChange(tabFilter, url);
							var content = $('.layui-tab-content');
							content.find('iframe').each(function() {
								$(this).height(content.height());
							});
						}
					} else {
						return;
					}
					elem.addClass('layui-this');
				});
				//切换tab时移除nav的layui-this样式
				element.on('tab(' + tabFilter + ')', function(data) {
					$('ul[lay-filter=' + navFilter +'] .layui-this').removeClass('layui-this');
				});
			} else {
				console.error('nav和tab过滤器参数缺失');
			}
		}
	};
	exports('navtab', obj);
});