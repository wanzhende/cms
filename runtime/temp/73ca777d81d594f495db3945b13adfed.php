<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"/home/lion/Web/html/../application/admin/view/index/branchselect.html";i:1489738081;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="__STATIC__/public/layui/css/layui.css">
    <script src="__STATIC__/public/layui/layui.js"></script>
    <style>
    .depart_tree{
        position:absolute;
        width:260px;
        height:400px;
        overflow-y:auto;
        border-right:1px solid #eee;
        /*border-radius:6px;*/
    }
    .depart_tree>ul {
        margin: 6px;
    }
    .depart_list{
        position:absolute;
        left:360px;
        width:260px;
        height:400px;
        overflow: auto;
        border-left:1px solid #eee;
        /*border-radius:6px;*/
    }
    .depart_list>ul {padding:6px;}
    .depart_list>ul>li {padding:4px;}
    .depart_list>ul>li:hover {background:#eee;}
    .depart_list>ul>li>cite {font-style:normal;}
    .layui-icon-close {cursor:pointer;float: right; color:#ddd;}
    .layui-btn {width:80px;}
    </style>
</head>
<body>
    <div class="">
        <div class="depart_tree">
            <ul id="demo1"></ul>
        </div>
        <div style="width:80px; position:absolute; min-height:200px; left:270px;padding: 10px 0px;">
            <div class="layui-form-item">
                <button id="addBranch" class="layui-btn layui-btn-primary layui-btn-mini">添加<i class="layui-icon">&#xe623;</i></button>
            </div>
            <div class="layui-form-item">
                <button id="cleanBranch" class="layui-btn layui-btn-primary layui-btn-mini">清空<i class="layui-icon">&#x1007;</i></button> 
            </div>
            <div class="layui-form-item">
                <button id="confirm" class="layui-btn layui-btn-mini">确认<i class="layui-icon">&#xe616;</i></button> 
            </div>
        </div>
        <div class="depart_list">
            <ul>                
            </ul>
        </div>
    </div>    
</body>
<script src="__STATIC__/public/js/branchselect.js?v=<?php echo time(); ?>"></script>