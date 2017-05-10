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
                $.get('/admin/staff/staffInfoSync/did/' + item.id, function(data) {
                    $('.layui-breadcrumb').text('');
                    var str = '';
                    //构造面包屑并添加
                    for(var i = 0; i <= data.breadCrumb.length-1; i++) {
                        if(i < data.breadCrumb.length-1) {
                            str += '<a href="javascript:;">' + data.breadCrumb[i].name + '</a>';                            
                        } else {
                            str += '<a href="javascript:;"><cite>' + data.breadCrumb[i].name + '</cite></a>';
                        }
                    }
                    $('.layui-breadcrumb').append(str);
                    $('.layui-table tbody').html('');
                    //获取指定分类员工信息
                    str = '';
                    for(var i = 0; i <= data.children.length-1; i++) {
                        data.children[i].alias = data.children[i].alias != '' ? '(' + data.children[i].alias + ')' : '';
                        str += '<tr>\
                            <td>' + (i+1) + '</td>\
                            <td>' + data.children[i].name + data.children[i].alias +  '</td>\
                            <td>' + (data.children[i].sex ? '男':'女') + '</td>\
                            <td>' + data.children[i].telphone + '</td>\
                            <td>' + (data.children[i].hiredate || '') + '</td>\
                            <td>' + data.children[i].seniority_text + '</td>\
                            <td>' + data.children[i].status + '</td>\
                            <td><button data-id="' + data.children[i].id + '" class="layui-btn layui-btn-warm layui-btn-mini btn-edit">编辑</button><button data-id="' + data.children[i].id + '" class="layui-btn layui-btn-danger layui-btn-mini btn-del">删除</button></td>\
                        </tr>';
                    }
                    if(str == '') {
                        str = '<tr><td colspan="7" align="center">没有数据</td></tr>';
                    }
                    $('.layui-table tbody').html(str);
                    $('.layui-field-box h3').html(item.name);
                    $('.layui-field-box input[type=hidden]').val(item.id);
                    element.init();                    
                    layer.close(index1);
                }, 'json');
            }
            ,nodes: data
        });
        
    }, 'json');
    layer.close(index);
    //添加员工按钮
    $('#staffAdd').click(function() {
        layer.open({
            type: 2
            ,title: '添加员工'
            ,content: '/admin/staff/add'
            ,offset: 'r'
            ,area:['400px', '99%']
            ,anim: 4
            ,id: "0"
        });
    });
    $('table.layui-table tbody').on('click', '.btn-edit', function() {
        parent.layer.open({
            type: 2
            , title: '员工编辑'
            , content: '/admin/staff/edit/id/' + $(this).data('id')
            , area: ['800px', '600px']
            , maxmin: true
        });
    });
    $('table.layui-table tbody').on('click', '.btn-del', function() {
        layer.msg('删除,id:' + $(this).data('id'));
    });
});