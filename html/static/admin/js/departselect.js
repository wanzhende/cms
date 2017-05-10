layui.use(['element', 'tree', 'layer'], function() {
    var $ = layui.jquery, element = layui.element(), layer = layui.layer;
    function buildDepartList(departList) {
        var str = '';
        if(departList.length>0) {
            for(x in departList) {
                str += '<li data-id="' + departList[x].id + '"><i class="layui-icon">&#xe621;</i><cite> ' + departList[x].name + '</cite><i class="layui-icon layui-icon-close">&#x1006;</i></li>';
            }
        }
        return str;
    }
    
    layui.link('/static/admin/css/tree.css');
    //加载所有部门
    $.get('/admin/depart/getDepart', function(data) {
        layui.tree({
            elem: '#demo1' //指定元素
            ,target: '_blank' //是否新选项卡打开（比如节点返回href才有效）
            ,nodes: data
            ,click: function(elem, elemObj) {
                $(elemObj).attr('data-id', elem.id);
            }
        });
    });
    //添加部门
    $('#addDepart').click(function() {
        var data_id = $('.depart_tree .layui-this>a>cite').parent().attr('data-id');
        var departName = $('.depart_tree .layui-this>a>cite').text();
        var has = false;
        if(typeof data_id == 'undefined' || departName =='') {
            layer.msg('请先选择部门！');
        } else {                
            //待添加判断id是否已经添加的代码
            $('.depart_list>ul>li').each(function(index, element) {
                if($(this).data('id') == data_id) {
                    has = true;
                    return false;
                }
            });
            if(has) {
                layer.msg('指定部门已添加过，请不要重复选择！');                    
            } else {
                $(".depart_list ul").append(buildDepartList([{id: data_id, name: departName}])); //添加data-id
            }
        }
    });
    //清空部门
    $('#cleanDepart').click(function() {
        $('.depart_list ul').html('');
    });
    //确认返回
    $('#confirm').click(function() {
        var index = parent.layer.getFrameIndex(window.name);
        parent.window.branchConfirm = true;
        parent.window.branchSelectReturn = [];
        $('.depart_list ul li').each(function(index, element){
            var departObj = {id:parseInt($(element).data('id')), name:$(element).find('cite').text()};
            parent.window.branchSelectReturn.push(departObj);
        });
        parent.layer.close(index);
    });
    //部门列表删除
    $('.depart_list').on('click', '.layui-icon-close', function() {
        $(this).parent().remove();
    });
    //加载传过来的部门列表
    $(".depart_list ul").append(buildDepartList(parent.window.branchSelectReturn));
});