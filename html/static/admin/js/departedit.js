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
                str += i < data.breadCrumb.length-1 ? '<a href="javascript:;">' + data.breadCrumb[i].name + '</a>' : '<a href="javascript:;"><cite>' + data.breadCrumb[i].name + '</cite></a>';
            }
        }
        $('.layui-breadcrumb').append(str);
        element.init();
    }, 'json');
    //表单提交
    form.on('submit(*)', function(data){     
        $.post('/admin/index/branchEdit/', data.field, function(result) {
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
                ,end : function() {
                    //重新刷新页面
                    parent.location.reload();
                }
            });
        });
        return false;
    });
    //删除部门
    $('#branchDelete').click(function() {
        var id = $('input[name=id]').val();
        layer.confirm('删除后不能恢复，真的确认要删除吗？', {
                btn: ['是', '否']
            }, function(index, layero) {
                $.get('/admin/index/branchDelete/id/' + id, function(data) {
                    layer.msg(JSON.stringify(data));
                    layer.close(index);
                    parent.location.reload();
                });
            }, function(index){
                //按钮【按钮二】的回调
        });

    });
});