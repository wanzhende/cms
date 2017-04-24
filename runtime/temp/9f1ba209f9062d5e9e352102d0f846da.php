<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"/home/lion/Web/html/../application/admin/view/role/edit.html";i:1492072327;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加角色</title>
    <link rel="stylesheet" href="__STATIC__/public/layui/css/layui.css">
    <script src="__STATIC__/public/layui/layui.js"></script>
</head>
<body>
    <div class="layui-box" style="position: relative; right: 20px; top: 20px;">
        <form class="layui-form" action="" method="post">
            <input type="hidden" name="id" value="{role.id}">
            <div class="layui-form-item">
                <label class="layui-form-label">角色名称</label>
                <div class="layui-input-block">
                <input type="text" name="name" class="layui-input" value="<?php echo $role['name']; ?>" placeholder="请输入名称" required lay-verify="required" >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">角色描述</label>
                <div class="layui-input-block">
                <input type="text" name="remark" class="layui-input" value="<?php echo $role['remark']; ?>" placeholder="请输入描述" required lay-verify="required" >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">角色状态</label>
                <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="开启" <?php if($role['status'] == '1'): ?>checked<?php endif; ?>>
                <input type="radio" name="status" value="0" title="关闭" <?php if($role['status'] == '0'): ?>checked<?php endif; ?>>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">提交</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    layui.use(['element', 'form', 'layer'], function() {
        var element = layui.element(), form = layui.form(), layer = layui.layer;
    });
</script>
</html>