<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"/home/lion/Web/html/../application/admin/view/index/staff.html";i:1490241495;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="__STATIC__/public/layui/css/layui.css">
    <script src="__STATIC__/public/layui/layui.js"></script>
    <style>
    #demo1 .layui-active {
        background:#eee;
    }

    #demo1.layui-tree li a {
        width: 100%;
    }
    </style>
    
</head>
<body>
    <div style="display: inline-block; vertical-align: top; width: 240px; height: 400px; padding: 10px; border: 1px solid #ddd; overflow: auto;">
        <ul id="demo1"></ul>
    </div>
    <div style="display: inline-block; vertical-align: top; background: #fff; width: calc(100% - 280px);">
        <fieldset class="layui-elem-field" style="min-height:420px;">
            <legend><i class="layui-icon">&#xe613;</i>部门员工</legend>
            <div class="layui-field-box">

                <div style="">
                    <input type="hidden" name="id" value="">
                    <h3 style="display: inline-block; font-size:28px; vertical-align: middle; padding-right: 10px; bottom: 2px; position: relative;"></h3>
                    <button class="layui-btn" id="staffAdd">添加员工</button>
                </div>
                <hr>
                <p>
                    <span class="layui-breadcrumb" style="visibility: visible;">
                    </span>
                </p>                
                <table class="layui-table" lay-skin="line">
                    <colgroup>
                        <col width="60">
                        <col width="120">
                        <col width="60">
                        <col width="120">
                        <col width="120">
                        <col width="100">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>行号</th>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>手机号</th>
                            <th>入职日期</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr> 
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </fieldset>        
    </div>
</body>
<script src="__STATIC__/public/js/staff.js?v=<?php echo time(); ?>"></script>
</html>