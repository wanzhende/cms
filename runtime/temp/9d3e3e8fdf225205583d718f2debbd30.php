<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"/home/lion/Web/html/../application/admin/view/depart/index.html";i:1490949043;}*/ ?>
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
    #demo1.layui-tree li {
        text-overflow: unset;
    }
    #demo1.layui-tree li a {
        width: 100%;
    }
    </style>
</head>
<body>
    <div style="border: 1px solid #e2e2e2; border-radius: 4px;">
        <div style="display: inline-block; vertical-align: top; width: 240px; min-height: 400px; padding: 10px; border-right: 1px solid #ddd; overflow: auto;">
            <ul id="demo1"></ul>
        </div>
        <div style="display: inline-block; vertical-align: top; background: #fff; width: calc(100% - 280px);">
            <fieldset class="layui-elem-field" style="min-height:400px; border: none; border-top: 1px solid #e2e2e2">
                <legend><i class="layui-icon">&#xe613;</i>部门列表</legend>
                <div class="layui-field-box">
                    <div style="">
                        <input type="hidden" name="id" value="">
                        <h3 style="display: inline-block; font-size:28px; vertical-align: middle; padding-right: 10px; bottom: 2px; position: relative;"></h3>
                        <button id="departEdit" class="layui-btn layui-btn-primary layui-btn-small">编辑部门</button>
                        <button id="departAdd" class="layui-btn layui-btn-small">添加子部门</button>
                    </div>
                    <hr>
                    <p>
                        <span class="layui-breadcrumb" style="visibility: visible;">
                        </span>
                    </p>
                    <table class="layui-table" lay-skin="line">
                        <colgroup>
                            <col width="60">
                            <col width="200">
                            <col width="60">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>行号</th>
                                <th>名称</th>
                                <th>顺序</th>
                                <th>操作</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" align="center">没有数据</td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </fieldset>
                 
        </div>
    </div>
</body>
<script src="__STATIC__/<?php echo \think\Request::instance()->module(); ?>/js/depart.js?v=<?php echo time(); ?>"></script></html>