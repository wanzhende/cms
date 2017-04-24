<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"/home/lion/Web/html/../application/admin/view/index/branchedit.html";i:1486806662;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="__STATIC__/public/layui/css/layui.css">
    <script src="__STATIC__/public/layui/layui.js"></script>
    <style>
    form button.layui-btn {
        padding:0px 30px;
    }
    </style>
</head>
<body>
    <div class="layui-box" style="position: relative; right: 20px; top: 20px;">
        <form class="layui-form" method="post" action="">
            <input type="hidden" name="id" value="<?php echo $dpInfo['id']; ?>">
            <input type="hidden" name="pid" value="<?php echo $dpInfo['pid']; ?>">
            <div class="layui-form-item">
                <label class="layui-form-label">上级部门</label>
                <div class="layui-input-block">
                    <p style="border: 1px solid #e2e2e2; padding: 6px 10px; border-radius: 2px;">
                        <span class="layui-breadcrumb"><a><cite>无</cite></a></span>
                    </p>
                </div>            
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">部门名称</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="name" placeholder="请输入部门名称" value="<?php echo $dpInfo['name']; ?>" required lay-verify="required">
                </div>            
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">显示顺序</label>
                <div class="layui-input-block">
                    <input type="number" class="layui-input" name="sort" placeholder="显示顺序" value="<?php echo $dpInfo['sort']; ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="1" title="启用" <?php if($dpInfo['status'] == '1'): ?>checked<?php endif; ?>>
                    <input type="radio" name="status" value="0" title="禁用" <?php if($dpInfo['status'] == '0'): ?>checked<?php endif; ?>>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="*">修改</button>
                    <button id="branchDelete" type="button" class="layui-btn layui-btn-danger">删除</button>
                </div>
            </div>    
        </form>
    </div>
</body>
<script src="__STATIC__/public/js/branchedit.js?v=<?php echo time(); ?>"></script>
</html>