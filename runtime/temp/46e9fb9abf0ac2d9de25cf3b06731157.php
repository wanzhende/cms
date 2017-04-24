<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"/home/lion/Web/html/../application/admin/view/user/index.html";i:1492061309;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户管理</title>
    <link rel="stylesheet" href="__STATIC__/public/layui/css/layui.css">
    <script src="__STATIC__/public/layui/layui.js"></script>
</head>
<body>
    <table class="layui-table" lay-even lay-skin="line">
        <colgroup>
        <col width="60">
        <col width="120">
        <col width="60">
        <col width="300">
        <col>
        </colgroup>
        <thead>
        <tr>
            <th>行号</th>
            <th>角色名称</th>
            <th>状态</th>
            <th>备注</th>
            <th>操作</th>
        </tr> 
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>管理员</td>
            <td> <input type="checkbox" name="" lay-skin="primary" checked> </td>
            <td>管理员</td>
            <td>
                <a class="layui-btn layui-btn-mini">编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
                <a class="layui-btn layui-btn-primary layui-btn-mini">权限</a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>编辑</td>
            <td>正常</td>
            <td>网站编辑</td>
            <td>
                <a class="layui-btn layui-btn-mini">编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
                <a class="layui-btn layui-btn-primary layui-btn-mini">权限</a>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>人事</td>
            <td>正常</td>
            <td>人力资源管理</td>
            <td>
                <a class="layui-btn layui-btn-mini">编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
                <a class="layui-btn layui-btn-primary layui-btn-mini">权限</a>
            </td>
        </tr>
        </tbody>
    </table>
</body>
</html>