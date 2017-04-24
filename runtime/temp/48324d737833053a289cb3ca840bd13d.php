<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"/home/lion/Web/html/../application/admin/view/role/index.html";i:1492146320;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>角色管理</title>
    <link rel="stylesheet" href="__STATIC__/public/layui/css/layui.css">
    <script src="__STATIC__/public/layui/layui.js"></script>
    <style>
        .layui-form-checkbox[lay-skin="primary"] {
            margin-top: 0px;
        }
        .layui-icon-status {
             font-size: 20px;
             position: relative;
             top: 2px;
        }
    </style>
</head>
<body>
    <h3 style="display: inline-block; font-size:28px;vertical-align: middle;">角色管理</h3>
    <button id="roleAdd" class="layui-btn layui-btn-small">添加角色</button>
    <div class="layui-form">
        <table class="layui-table" lay-skin="line">
            <colgroup>
            <col width="60">
            <col width="120">
            <col width="200">
            <col width="60">
            <col>
            </colgroup>
            <thead>
            <tr>
                <th>行号</th>
                <th>角色名称</th>            
                <th>备注</th>
                <th>状态</th>
                <th>操作</th>
            </tr> 
            </thead>
            <tbody>
                <?php if(is_array($role) || $role instanceof \think\Collection || $role instanceof \think\Paginator): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $vo['name']; ?></td>
                    <td><?php echo $vo['remark']; ?></td>
                    <td>
                        <?php if($vo['status'] == '1'): ?><i class="layui-icon layui-icon-status" style="color: #5FB878;">&#xe616;</i><?php else: ?><i class="layui-icon layui-icon-status" style="color: #8e8e8e;">&#x1007;</i><?php endif; ?>
                    </td>
                    <td>
                        <button class="layui-btn layui-btn-mini editRole" data-id="<?php echo $vo['id']; ?>">编辑</button>
                        <button class="layui-btn layui-btn-danger layui-btn-mini delRole" data-id="<?php echo $vo['id']; ?>">删除</button>
                        <button class="layui-btn layui-btn-primary layui-btn-mini grantRole" data-id="<?php echo $vo['id']; ?>">权限</button>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    

</body>
<script>
    layui.use(['element', 'form', 'layer'], function() {
        var element = layui.element(), form = layui.form(), layer = layui.layer, $ = layui.jquery;
        $('#roleAdd').click(function() {
            layer.open({
                type:2
                ,title: '添加角色'
                ,content: '/admin/role/add/'
                ,area:['450px', '284px']
            });
        });
        $('.editRole').click(function() {
            var id = $(this).data('id');
            layer.open({
                type:2
                ,title: '编辑角色'
                ,content: '/admin/role/edit/id/' + id
                ,area: ['450px', '284px']
            });
        });
        
    });
</script>
</html>