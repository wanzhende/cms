<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"/home/lion/Web/html/../application/admin/view/staff/staffedit.html";i:1491973443;}*/ ?>
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
    <form class="layui-form" action="" method="post">
        <input type="hidden" name="id" value="<?php echo $staff['id']; ?>">
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
                        <input class="layui-input" type="text" name="alias" value="<?php echo $staff['alias']; ?>" placeholder="请输入别名">
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
                            <ul>
                                <?php if(is_array($staff['staffDepart']) || $staff['staffDepart'] instanceof \think\Collection || $staff['staffDepart'] instanceof \think\Paginator): $i = 0; $__LIST__ = $staff['staffDepart'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <li><i class="layui-icon">&#xe621;</i><cite><?php echo $vo['depart']['name']; ?></cite><input type="hidden" name="depart[]" value="<?php echo $vo['depart']['id']; ?>" required=""></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>            
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">入职日期</label>
                        <div class="layui-input-inline" style="width: calc(100% - 150px);">
                            <input id="hello" class="layui-input" type="text" name="hiredate" value="<?php echo $staff['hiredate']; ?>">
                        </div>
                    </div>
                </div>
                <div class="layui-tab-item">
                    <div class="layui-form-item">
                        <label class="layui-form-label">照片</label>
                        <div class="layui-input-block">
                            <img id="pic_upload" src="<?php echo (isset($staff['staffProfile']['photo']) && ($staff['staffProfile']['photo'] !== '')?$staff['staffProfile']['photo']:'/uploads/timg.jpg'); ?>" style="width: 120px; height: 160px;">
                            <input type="file" name="pic_upload" class="layui-upload-file">
                            <input id="photo" type="hidden" name="photo" value="">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">身高</label>
                            <div class="layui-input-inline" style="width: 100px;">
                                <input class="layui-input" type="text" name="stature" value="<?php echo $staff['staffProfile']['stature']; ?>" placeholder="厘米">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">体重</label>
                            <div class="layui-input-inline" style="width: 100px;">
                                <input type="text" class="layui-input" name="weight" value="<?php echo $staff['staffProfile']['weight']; ?>" placeholder="公斤">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">视力</label>
                            <div class="layui-input-inline" style="width: 160px;">
                                <select name="vision" lay-verify="required">
                                        <option value="0" <?php if($staff['staffProfile']['vision'] == '0'): ?>selected<?php endif; ?>>正常</option>
                                        <option value="1" <?php if($staff['staffProfile']['vision'] == '1'): ?>selected<?php endif; ?>>近视</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="layui-form-item">                            
                        <div class="layui-inline">
                            <label class="layui-form-label">民族</label>
                            <div class="layui-input-inline" style="width: 100px;">
                                <!--<input class="layui-input" type="text" name="volk" value="<?php echo $staff['staffProfile']['volk']; ?>" placeholder="请输入民族">-->
                                <select name="volk" lay-verify="required" lay-search data-value="<?php echo $staff['staffProfile']['volk']; ?>">
                                    <option value="1">汉族</option>
                                    <option value="2">蒙古族</option>
                                    <option value="3">回族</option>
                                    <option value="4">藏族</option>
                                    <option value="5">维吾尔族</option>
                                    <option value="6">苗族</option>
                                    <option value="7">彝族</option>
                                    <option value="8">壮族</option>
                                    <option value="9">布依族</option>
                                    <option value="10">朝鲜族</option>
                                    <option value="11">满族</option>
                                    <option value="12">侗族</option>
                                    <option value="13">瑶族</option>
                                    <option value="14">白族</option>
                                    <option value="15">土家族</option>
                                    <option value="16">哈尼族</option>
                                    <option value="17">哈萨克族</option>
                                    <option value="18">傣族</option>
                                    <option value="19">黎族</option>
                                    <option value="20">僳僳族</option>
                                    <option value="21">佤族</option>
                                    <option value="22">畲族</option>
                                    <option value="23">高山族</option>
                                    <option value="24">拉祜族</option>
                                    <option value="25">水族</option>
                                    <option value="26">东乡族</option>
                                    <option value="27">纳西族</option>
                                    <option value="28">景颇族</option>
                                    <option value="29">柯尔克孜族</option>
                                    <option value="30">土族</option>
                                    <option value="31">达斡尔族</option>
                                    <option value="32">仫佬族</option>
                                    <option value="33">羌族</option>
                                    <option value="34">布朗族</option>
                                    <option value="35">撒拉族</option>
                                    <option value="36">毛南族</option>
                                    <option value="37">仡佬族</option>
                                    <option value="38">锡伯族</option>
                                    <option value="39">阿昌族</option>
                                    <option value="40">普米族</option>
                                    <option value="41">塔吉克族</option>
                                    <option value="42">怒族</option>
                                    <option value="43">乌孜别克族</option>
                                    <option value="44">俄罗斯族</option>
                                    <option value="45">鄂温克族</option>
                                    <option value="46">德昂族</option>
                                    <option value="47">保安族</option>
                                    <option value="48">裕固族</option>
                                    <option value="49">京族</option>
                                    <option value="50">塔塔尔族</option>
                                    <option value="51">独龙族</option>
                                    <option value="52">鄂伦春族</option>
                                    <option value="53">赫哲族</option>
                                    <option value="54">门巴族</option>
                                    <option value="55">珞巴族</option>
                                    <option value="56">基诺族</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">婚姻</label>
                            <div class="layui-input-inline" style="width: 100px;">
                                <select name="wedlock" lay-verify="required">
                                    <option value="0" <?php if($staff['staffProfile']['wedlock'] == '0'): ?>selected<?php endif; ?>>未婚</option>
                                    <option value="1" <?php if($staff['staffProfile']['wedlock'] == '1'): ?>selected<?php endif; ?>>已婚</option>
                                    <option value="2" <?php if($staff['staffProfile']['wedlock'] == '2'): ?>selected<?php endif; ?>>离异</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">学历</label>
                            <div class="layui-input-inline" style="width: 160px;">
                                <select name="degree" lay-verify="required">
                                    <option value="0" <?php if($staff['staffProfile']['degree'] == '0'): ?>selected<?php endif; ?>>未选择</option>
                                    <optgroup label="初等教育">
                                        <option value="1" <?php if($staff['staffProfile']['degree'] == '1'): ?>selected<?php endif; ?>>小学</option>
                                    </optgroup>
                                    <optgroup label="中等教育">
                                        <option value="2" <?php if($staff['staffProfile']['degree'] == '2'): ?>selected<?php endif; ?>>初中</option>
                                        <option value="3" <?php if($staff['staffProfile']['degree'] == '3'): ?>selected<?php endif; ?>>高中</option>
                                    </optgroup>
                                    <optgroup label="高等教育">
                                        <option value="4" <?php if($staff['staffProfile']['degree'] == '4'): ?>selected<?php endif; ?>>大专</option>
                                        <option value="5" <?php if($staff['staffProfile']['degree'] == '5'): ?>selected<?php endif; ?>>本科</option>
                                        <option value="6" <?php if($staff['staffProfile']['degree'] == '6'): ?>selected<?php endif; ?>>硕士</option>
                                        <option value="7" <?php if($staff['staffProfile']['degree'] == '7'): ?>selected<?php endif; ?>>博士</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">出生日期</label>
                        <div class="layui-input-inline" style="width: calc(100% - 150px);">
                            <input class="layui-input" type="text" name="birthday" value="<?php echo $staff['staffProfile']['birthday']; ?>" placeholder="">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">身份证号</label>
                        <div class="layui-input-inline" style="width: calc(100% - 150px);">
                            <input class="layui-input" type="text" name="identity_card" value="<?php echo $staff['staffProfile']['identity_card']; ?>" placeholder="请输入身份证号">
                        </div>
                        <div class="layui-form-mid" style="cursor: pointer;"><i class="layui-icon">&#xe64a;</i></div>
                    </div>
                </div>
                <hr>
                <div class="layui-form-item">
                        <div class="layui-input-block">
                        <button class="layui-btn" type="submit" lay-submit lay-filter="*">保存</button>
                        </div>
                </div>
            </div>
        </div>
    </form>
</body>
<script src="__STATIC__/<?php echo \think\Request::instance()->module(); ?>/js/staffedit.js?v=<?php echo time(); ?>"></script>
</html>
        