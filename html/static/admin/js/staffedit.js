layui.use(['element', 'form', 'laydate', 'upload', 'layer'], function() {
    var element = layui.element(), form = layui.form(), $ = layui.jquery;
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
    $('input[name=hiredate],input[name=birthday]').click(function() {
        layui.laydate({elem: this, festival: true, istime: true, format:'YYYY-MM-DD'});
    });
    //上传图片
    layui.upload({
        url: '/admin/index/upload'
        ,title: '上传'
        ,ext: 'jpg|jpeg|png|gif'
        ,success: function(res) {
            if(res.code ==1) {
                pic_upload.src = res.url;
                photo.value = res.url;
            }
        }
    });
    //重新选定后台获取的民族并更新
    selected = $('select[name=volk]').data('value');
    selected && $('select[name=volk]>option[value='+selected+']').attr('selected', '');
    form.render('select');
    //提交表单前对部门选择进行检查
    $('form').submit(function() {
        var dp_list_obj = $('#depart_list ul li');
        if(dp_list_obj.length < 1) {
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
                    delete parent.window.branchSelectReturn;
                } else {
                    //layer.msg('点击的是关闭');
                }
            }
        });
    });
});