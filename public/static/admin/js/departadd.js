layui.use(['element', 'jquery', 'form', 'layer'], function() {
    var $ = layui.jquery;
    var layer = layui.layer;
	var element = layui.element();
    var form = layui.form();
    var pid = $('input[name=pid]').val();
    //初始化上级部门面包屑
    $.get('/admin/depart/departInfoSync/id/' + pid, function(data) {
        var str = '';
        if(data.breadCrumb !== null) {
            $('.layui-breadcrumb').text('');
            for(var i = 0; i <= data.breadCrumb.length-1; i++) {
                if(i < data.breadCrumb.length-1) {
                    str += '<a href="javascript:;">' + data.breadCrumb[i].name + '</a>';                            
                } else {
                    str += '<a href="javascript:;"><cite>' + data.breadCrumb[i].name + '</cite></a>';
                }
            }
        }
        $('.layui-breadcrumb').append(str);
        element.init();
    }, 'json');
    form.on('submit(*)', function(data){     
        $.post('/admin/index/branchAdd/', data.field, function(result) {
            var icon = result.code ? 1 : 2;
            parent.layer.open({
                icon: icon
                ,title: '提示'
                ,content: result.msg
                ,end : function() {
                    //重新刷新页面
                    parent.location.reload();
                }
            });
            
        });
        return false;
    });
    //表单提交序列化
    $('#test').click(function() {
        var data = $('form').serialize();
        $.post('/admin/index/branchAdd1/', data.field, function(result) {
            var icon = 0;
            if(result.code) {
                icon = 1;
            } else {
                icon = 2;
            }
            parent.layer.open({
                icon: icon
                ,title: '提示'
                ,content: result.msg
            });
        });        
    });
});