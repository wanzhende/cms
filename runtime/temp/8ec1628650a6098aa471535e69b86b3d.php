<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"/home/lion/Web/html/../application/admin/view/index/index.html";i:1492134236;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>后台管理</title>
    <link rel="stylesheet" href="__STATIC__/public/layui/css/layui.css">
    <script src="__STATIC__/public/layui/layui.js"></script>
    <style>
    .layui-tab .layui-tab-content iframe {
        border: none;
        width: 100%;
    }
    .layui-tab ul.layui-tab-title li:nth-child(1) i{
        display:none;
    }
    .layui-nav-item .layui-icon { width: 24px; height: 24px; display: inline-block;}
    div.layui-footer p{font-size:11px;text-align:right;margin:10px 0px; padding: 0 6px; font-weight: 300; color: #333;}
    </style>
</head>
<body>
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header" style="background:#393D49">
            <div class="layui-main">
                <div class="layui-top-nav">                    
                    <ul class="layui-nav">
                    </ul>
                </div>
            </div>
        </div>
        <div class="layui-side layui-bg-black">
            <!-- 侧边导航-->
            <ul class="layui-nav layui-nav-tree" lay-filter="test">                
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon">&#xe631;</i> 网站设置</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="<?php echo url('index/coupon/coupon'); ?>">系统设置</a></dd>
                        <dd><a href="javascript:;" data-url="<?php echo url('node/index'); ?>">节点管理</a></dd>
                        <dd><a href="javascript:;" data-url="<?php echo url('role/index'); ?>">角色管理</a></dd>
                        <dd><a href="javascript:;" data-url="<?php echo url('user/index'); ?>">用户管理</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon">&#xe613;</i> 人力资源</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="<?php echo url('depart/index'); ?>">机构和部门</a></dd>
                        <dd><a href="javascript:;" data-url="<?php echo url('staff/index'); ?>">员工管理</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon">&#xe60a;</i> 内容管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">分类管理</a></dd>
                        <dd><a href="javascript:;">内容管理</a></dd>
                    </dl>
                </li>                    
            </ul>
        </div>
        <div class="layui-body">
            <div class="layui-tab" lay-filter="docDemoTabBrief" lay-allowClose="true">
                <ul class="layui-tab-title" >
                    <li class="layui-this"><span>首页</span></li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show"></div>
                </div>
            </div>
        </div>
        <div class="layui-footer">
            <p>商丘爱邻餐饮管理有限公司 © 2017 cnailin.com</p>
        </div>
    </div>    
</body>
<script src="__STATIC__/<?php echo \think\Request::instance()->module(); ?>/js/index.js?v=<?php echo time(); ?>"></script>
</html>