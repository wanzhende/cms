<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"/home/lion/Web/html/../application/admin/view/index/staffedit.html";i:1490263306;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>员工编辑</title>
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
    <form class="layui-form" action="" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">基础资料</li>
                    <li>详细资料</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-form-item">
                            <label class="layui-form-label">姓名</label>
                            <div class="layui-input-block">
                            <input class="layui-input" type="text" name="name" value="<?php echo $staff['name']; ?>" placeholder="请输入姓名" required>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">别名</label>
                            <div class="layui-input-block">
                            <input class="layui-input" type="text" name="alias" value="<?php echo $staff['alias']; ?>" placeholder="请输入别名" required>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">性别</label>
                            <div class="layui-input-block">
                            <input type="radio" name="sex" value="1" title="男" <?php if($staff['sex'] == '1'): ?>checked<?php endif; ?>>
                            <input type="radio" name="sex" value="0" title="女" <?php if($staff['sex'] == '0'): ?>checked<?php endif; ?>>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">手机号</label>
                            <div class="layui-input-block">
                            <input class="layui-input" name="telphone" value="<?php echo $staff['telphone']; ?>" title="手机号" placeholder="请输入手机号" required>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">部门</label>
                            <div class="layui-input-block" id="depart_list" title="请选择部门">
                                <ul></ul>
                            </div>            
                        </div>
                    </div>
                    <div class="layui-tab-item">
                        <div class="layui-form-item">
                            <label class="layui-form-label">照片</label>
                            <div class="layui-input-block">
                                <img id="pic_upload" src="/uploads/timg.jpg" style="width: 120px; height: 160px;">
                                <input type="file" name="pic_upload" class="layui-upload-file">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">身高</label>
                                <div class="layui-input-inline" style="width: 100px;">
                                    <input class="layui-input" type="text" name="volk" value="" placeholder="厘米" required>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">体重</label>
                                <div class="layui-input-inline" style="width: 100px;">
                                    <input type="text" class="layui-input" name="weight" value="" placeholder="公斤" required>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">视力</label>
                                <div class="layui-input-inline" style="width: 160px;">
                                    <select name="degree" lay-verify="required">
                                            <option value="0">正常</option>
                                            <option value="1">近视</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="layui-form-item">                            
                            <div class="layui-inline">
                                <label class="layui-form-label">民族</label>
                                <div class="layui-input-inline" style="width: 100px;">
                                    <input class="layui-input" type="text" name="volk" value="" placeholder="请输入民族" required>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">婚姻</label>
                                <div class="layui-input-inline" style="width: 100px;">
                                    <select name="wedlock" lay-verify="required">
                                        <option value="0">未婚</option>
                                        <option value="1">已婚</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">学历</label>
                                <div class="layui-input-inline" style="width: 160px;">
                                    <select name="degree" lay-verify="required">
                                        <option value="0">未选择</option>
                                        <optgroup label="初等教育">
                                            <option value="1">小学</option>
                                        </optgroup>
                                        <optgroup label="中等教育">
                                            <option value="2">初中</option>
                                            <option value="3">高中</option>
                                        </optgroup>
                                        <optgroup label="高等教育">
                                            <option value="4">大专</option>
                                            <option value="5">本科</option>
                                            <option value="6">硕士</option>
                                            <option value="7">博士</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">出生日期</label>
                            <div class="layui-input-inline" style="width: calc(100% - 150px);">
                                <input class="layui-input" type="text" name="identity_card" value="" placeholder="" required>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">身份证号</label>
                            <div class="layui-input-inline" style="width: calc(100% - 150px);">
                                <input class="layui-input" type="text" name="identity_card" value="" placeholder="请输入身份证号" required>
                            </div>
                            <div class="layui-form-mid" style="cursor: pointer;"><i class="layui-icon">&#xe64a;</i></div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">银行卡号</label>
                            <div class="layui-input-inline" style="width: calc(100% - 150px);">
                                <input class="layui-input" type="text" name="identity_card" value="" placeholder="请输入银行卡号" required>
                            </div>
                            <div class="layui-form-mid" style="cursor: pointer;"><i class="layui-icon">&#xe64a;</i></div>
                        </div>
                    </div>
                    <hr>
                    <div class="layui-form-item">
                            <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>
                    </div>
                </div>
            </div>
        </form>
</body>
<script>
    layui.use(['element', 'form', 'upload'], function() {
        var element = layui.element(), form = layui.form();
        layui.upload({
            url: '/admin/index/upload'
            ,title: '上传'
            ,ext: 'jpg|jpeg|png|gif'
            ,success: function(res) {
                if(res.code ==1) {
                    pic_upload.src = res.url;
                }
            }
        }); 
    });
</script>
</html>
        