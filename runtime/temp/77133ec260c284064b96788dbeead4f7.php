<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"/home/lion/Web/html/../application/admin/view/node/add.html";i:1492158608;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加节点</title>
    <link rel="stylesheet" href="__STATIC__/public/layui/css/layui.css">
    <script src="__STATIC__/public/layui/layui.js"></script>
</head>
<body>
    <form action="" class="layui-form" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo $type; ?>名称</label>
            <div class="layui-input-block">
                <input class="layui-input" type="text" name="name" value="" palceholder="请输入<?php echo $type; ?>名称" required  lay-verify="required" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo $type; ?>描述</label>
            <div class="layui-input-block">
                <input class="layui-input" type="text" name="title" value="" palceholder="请输入<?php echo $type; ?>描述" required  lay-verify="required" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="开启" checked>
                <input type="radio" name="status" value="0" title="关闭">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">顺序</label>
            <div class="layui-input-block">
                <input class="layui-input" type="text" name="sort" value="0" palceholder="请输入顺序" required  lay-verify="required" >
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                <input type="hidden" name="level" value="<?php echo $level; ?>">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            </div>
        </div>
    </form>
</body>
<script>
    layui.use(['element', 'form'], function() {
        var element = layui.element(), form = layui.form();
    });
</script>
</html>