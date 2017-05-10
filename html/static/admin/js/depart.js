layui.use(['element', 'tree', 'layer'], function() {
    var $ = layui.jquery;
    var element = layui.element();    
    var index = layer.load();
    layui.link('/static/admin/css/tree.css');
    $.get('/admin/depart/getDepart', function(data) {
        layui.tree({
            elem: '#demo1' //指定元素
            ,target: '_blank' //是否新选项卡打开（比如节点返回href才有效）
            ,click: function(item) { //点击节点回调
                var index1 = layer.load();                
                $.get('/admin/depart/departInfoSync/id/' + item.id, function(data) {
                    $('.layui-breadcrumb').text('');
                    var str = '';
                    for(var i = 0; i <= data.breadCrumb.length-1; i++) {
                        str += i < data.breadCrumb.length-1 ? '<a href="javascript:;">' + data.breadCrumb[i].name + '</a>' : '<a href="javascript:;"><cite>' + data.breadCrumb[i].name + '</cite></a>';
                    }
                    $('.layui-breadcrumb').append(str);
                    $('.layui-table tbody').html('');
                    str = '';
                    for(var i = 0; i <= data.children.length-1; i++) {
                        str += '<tr><td>' + (i+1) + '</td><td>' + data.children[i].name + '</td><td>' + data.children[i].sort + '</td><td><button class="layui-btn layui-btn-warm layui-btn-mini btn-edit" data-id="' + data.children[i].id + '">编辑</button><button class="layui-btn layui-btn-danger layui-btn-mini btn-del" data-id="' + data.children[i].id + '">删除</button></td></tr>';
                    }
                    $('.layui-table tbody').html(str);
                    element.init();
                    $('.layui-field-box h3').html(item.name);
                    $('.layui-field-box input[type=hidden]').val(item.id);
                    layer.close(index1);
                }, 'json');                
            }
            ,nodes: data
        });
        
    }, 'json');
    layer.close(index);
    $('#departAdd').click(function() {
        var id = $('input[name=id]').val();
        if(id == '' || id == 0) {
            layer.msg("请先选择部门！");
        } else {
            layer.open({
                type: 2,
                title: '添加部门',
                content: '/admin/depart/departAdd/pid/' + id,
                area:['500px', '340px'],
                id: "0"
            });
        }        
    });

    $('#departEdit').click(function() {
        var id = $('input[name=id]').val();
        if(id == '' || id == 0) {
            layer.msg("请先选择部门！");
        } else {
            layer.open({
                type: 2,
                title: '编辑部门',
                content: '/admin/depart/departEdit/id/' + id,
                area:['500px', '340px'],
                id: "0"
            });
        }
    });

    $('.layui-table tbody').on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        if(id == '' || id == 0) {
            layer.msg("请先选择部门！");
        } else {
            layer.open({
                type: 2,
                title: '编辑部门',
                content: '/admin/depart/departEdit/id/' + id,
                area:['500px', '340px'],
                id: "0"
            });
        }
    });
    $('.layui-table tbody').on('click', '.btn-del', function() {
        //询问是否删除
        layer.confirm('真的确定要删除吗？', 
            function(index, layero) { //确定回调
                //判定是否有子部门，若有则禁止删除，否则进行删除
                layer.close(index);
                layer.msg('该部门有子部门，禁止删除！');
            }, 
            function(index, layero) { //取消回调
                layer.msg('吓死了，差点以为要撤掉整个部门，该部门的员工向一定会很感激您的！');
            }
        );        
    });

});
