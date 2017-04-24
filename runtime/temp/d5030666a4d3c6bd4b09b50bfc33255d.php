<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"/home/lion/Web/html/../application/admin/view/node/index.html";i:1492253336;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="__STATIC__/public/layui/css/layui.css">
    <link rel="stylesheet" href="__STATIC__/<?php echo \think\Request::instance()->module(); ?>/css/node.css?v=<?php echo time(); ?>">
    <script src="__STATIC__/public/layui/layui.js"></script>
</head>
<body>
    <h3 style="display: inline-block; font-size:28px;vertical-align: middle;">节点管理</h3>
    <button class="layui-btn layui-btn-small layui-btn-primary roleAdd" data-pid="0" data-level="1">添加应用</button>
    <div id="wrap">
        <?php if(is_array($node) || $node instanceof \think\Collection || $node instanceof \think\Paginator): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$app): $mod = ($i % 2 );++$i;?>
            <div class="app">
                <div>
                    <strong><?php echo $app['title']; ?></strong>
                    <div class="layui-btn-group">
                        <button class="layui-btn layui-btn-mini layui-btn-warm roleAdd" data-pid="1" data-level="2">
                            <i class="layui-icon">&#xe654;</i>
                        </button>
                        <button class="layui-btn layui-btn-mini layui-btn-warm roleAdd" data-pid="1" data-level="2">
                            <i class="layui-icon">&#xe642;</i>
                        </button>
                        <button class="layui-btn layui-btn-mini layui-btn-warm roleAdd" data-pid="1" data-level="2">
                            <i class="layui-icon">&#xe640;</i>
                        </button>
                    </div>                                       
                </div>
                <?php if(is_array($app['child']) || $app['child'] instanceof \think\Collection || $app['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $app['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?>
                    <dl>
                        <dt>
                            <strong><?php echo $action['title']; ?></strong>
                            <div class="layui-btn-group">
                                <button class="layui-btn layui-btn-mini layui-btn-normal roleAdd" data-pid="<?php echo $action['id']; ?>" data-level="3">
                                    <i class="layui-icon">&#xe654;</i>
                                </button>
                                <button class="layui-btn layui-btn-mini layui-btn-normal layui-btn-small">
                                    <i class="layui-icon">&#xe642;</i>
                                </button>
                                <button class="layui-btn layui-btn-normal layui-btn-mini">
                                    <i class="layui-icon">&#xe640;</i>
                                </button>
                            </div>
                        </dt>
                        <?php if(is_array($action['child']) || $action['child'] instanceof \think\Collection || $action['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $action['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i;?>
                            <dd>
                                <span><?php echo $method['title']; ?></span>
                                <div class="layui-btn-group">
                                    <button class="layui-btn layui-btn-primary layui-btn-mini">
                                        <i class="layui-icon">&#xe642;</i>
                                    </button>
                                    <button class="layui-btn layui-btn-primary layui-btn-mini">
                                        <i class="layui-icon">&#xe640;</i>
                                    </button>
                                </div>
                            </dd>                            
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

</body>
<script>
    layui.use(['element', 'form', 'layer'], function() {
        var element = layui.element(), form = layui.form(), layer = layui.layer, $ = layui.jquery;
        $('.roleAdd').click(function() {
            var pid = $(this).data('pid') ? $(this).data('pid') : 0, level = $(this).data('level') ? $(this).data('level') : 1;
            layer.open({
                type:2
                ,title: '添加节点'
                ,content: '/admin/node/add/pid/' + pid + '/level/' + level
                ,area:['450px', '300px']
                ,end : function() {
                    location.reload();
                }
            });
        });
        $('.editRole').click(function() {
            var id = $(this).data('id');
            layer.open({
                type:2
                ,title: '编辑节点'
                ,content: '/admin/node/edit/id/' + id
                ,area: ['450px', '300px']
            });
        });
        
    });
</script>
</html>