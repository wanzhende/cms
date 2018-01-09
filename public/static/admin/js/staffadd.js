layui.use(['element', 'layer', 'form'], function() {
    var element = layui.element(), layer = layui.layer, $ = layui.jquery, form = layui.form();
    //构建列表
    function buildDepartList(departList) {
        var str = '';
        if(departList.length>0) {
            for(x in departList) {
            str += '<li><i class="layui-icon">&#xe621;</i>\
                    <cite>' + departList[x].name + '</cite>\
                    <input type="hidden" name="depart[]" value="' + departList[x].id + '" required="">\
                </li>';
            }
        }
        return str;
    }
    //载入左侧树形菜单的选中部门
    $(document).ready(function() {
        var departName = parent.layui.jquery('.layui-field-box h3').text();
        var id = parent.layui.jquery('.layui-field-box input[type=hidden]').val();
        var str = [];
        //判定是否已选择部门
        if(departName !='' && id !='') str = buildDepartList([{id:id, name: departName}]);
        $('#depart_list ul').append(str);
    });
    //提交表单前对部门选择进行检查
    $('form').submit(function() {
        var dp_list_obj = $('#depart_list ul li');
        if(dp_list_obj.length <1) {
            layer.tips('部门还没有选择呢!','#depart_list',{tips:3});
            return false;
        }
    });
    //响应部门选择
    $('#depart_list').click(function() {
        parent.window.branchSelectReturn = [];
        $("#depart_list input[name='depart[]']").each(function(index, element) {
            var departObj = {id:parseInt($(element).val()), name:$(element).prev('cite').text()};
            parent.window.branchSelectReturn.push(departObj);
        });

        parent.layer.open({
            type: 2
            ,title: '部门选择'
            ,content: '/admin/depart/departselect'
            ,area:['622px', '445px']
            //,btn: ['确认']
            ,success: function() {
                parent.window.branchConfirm = false;
            }
            ,end: function(index, layero) {
                parent.layer.close(index);
                //选择部门后重置部门列表
                if(parent.window.branchConfirm) {
                    layer.msg('点击的是确认');
                    var str = buildDepartList(parent.window.branchSelectReturn);
                    $('#depart_list ul').html('').append(str);
                } else {
                    //layer.msg('点击的是关闭');
                }
            }
        });
    });
});
