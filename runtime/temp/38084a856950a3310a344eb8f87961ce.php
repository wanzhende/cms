<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"/home/lion/Web/html/../application/admin/view/staff/staffadd.html";i:1491269423;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="__STATIC__/public/layui/css/layui.css">
    <script src="__STATIC__/public/layui/layui.js"></script>
    <style>
    #depart_list {
        border-radius: 2px;
        cursor: pointer;
        background: #fff;
        border: 1px solid #eee;
    }
    #depart_list>ul {padding: 6px;}
    #depart_list>ul>li {padding: 4px;}
    #depart_list>ul>li>cite {font-style: normal;}
    </style>
</head>
<body>
    <div class="layui-box" style="position: relative; right: 20px; top: 20px;">
        <form class="layui-form" method="post" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="name" title="员工的姓名" placeholder="真实姓名" value="" required>
                </div>            
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">别名</label>
                <div class="layui-input-block">
                    <input type="text" class="layui-input" name="alias" title="员工的别名" placeholder="别名" value="">
                </div>            
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">性别</label>
                <div class="layui-input-block">
                    <input type="radio" name="sex" value="1" title="男" checked>
                    <input type="radio" name="sex" value="0" title="女">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">部门</label>
                <div class="layui-input-block" id="depart_list" title="请选择部门">
                    <ul></ul>
                </div>            
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">手机号</label>
                <div class="layui-input-block">
                    <input type="tel" class="layui-input" name="telphone" title="手机号码" placeholder="请输入电话号码" value="" required pattern="^1[345678][0-9]{9}$">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-block">
                    <input type="email" class="layui-input" name="email" title="电子邮箱" placeholder="请输入邮箱" value="" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="*">保存</button>
                </div>
            </div>    
        </form>
    </div>
    
</body>
<script src="__STATIC__/<?php echo \think\Request::instance()->module(); ?>/js/staffadd.js?v=<?php echo time(); ?>"></script>
</html>