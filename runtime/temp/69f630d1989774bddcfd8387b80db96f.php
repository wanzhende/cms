<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"/home/lion/Web/html/../application/index/view/common/login.html";i:1486369732;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
	<meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>登陆－爱邻餐饮</title>
	
    <link rel="stylesheet" href="__STATIC__/index/css/base.css">
    <link rel="stylesheet" href="__STATIC__/index/css/style.css">
    <script src="__STATIC__/index/js/jquery-1.7.2.min.js"></script>
    <style>
    @media screen and (max-width: 700px) {
    	.lrForm .formRow{margin-left: 0px;}
    	.w1000 .imageList{display: none;}
    	div.footer{display: none;}
    	body{background-color:#f9f9f9;}
    	div.header{background-color:#f9f9f9;}
    	div.logo{margin-left: 20px;}
    }
    </style>
</head>
<body>
<div class="headerWrap" style="height: 100px;">
    <div class="header">
        
        <div class="subTop mb20">
            <div class="w1000 clearfix">
                <div class="nav fr">
                    
                </div>
                <div class="logo fl">
                    <a href="#">
                        <img src="__STATIC__/index/img/thumb_55404e52b9713.png" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 头部信息end -->

<div class="main">
    <div class="row lrForm">
        <div class="w1000">
            <div class="fl imageList mt50" style="height: 400px;">
                <div class="row">
                    <img class="l0" src="__STATIC__/index/img/l0.png" alt="l0">
                    <img class="l1" src="__STATIC__/index/img/l1.png" alt="l1">
                    <img class="l2" src="__STATIC__/index/img/l2.png" alt="l2">
                    <img class="l3" src="__STATIC__/index/img/l3.png" alt="l3">
                    <img class="l3-1" src="__STATIC__/index/img/l3.png" alt="l3">
                    <img class="l3-2" src="__STATIC__/index/img/l3.png" alt="l3">
                    <img class="l3-3" src="__STATIC__/index/img/l3.png" alt="l3">
                    <img class="l4" src="__STATIC__/index/img/l4.png" alt="l4">
                    <img class="l5" src="__STATIC__/index/img/l5.png" alt="l5">
                    <img class="l6" src="__STATIC__/index/img/l6.png" alt="l6">
                    <img class="l6-1" src="__STATIC__/index/img/l6.png" alt="l6">
                    <img class="l7" src="__STATIC__/index/img/l7.png" alt="l7">
                    <img class="l8" src="__STATIC__/index/img/l8.png" alt="l8">
                    
                </div>
            </div>
            <form action="" method="post" class="login">
                <div class="formRow fl">
                    <div class="row">
                        <label>用户名</label>
                        <span>
                            <input type="text" name="username" placeholder="请输入用户名">
                        </span>
                    </div>
                    <div class="row">
                        <label>密码</label>
                        <span>
                            <input type="password" name="password" placeholder="请输入密码">
                        </span>
                    </div>
					<div class="row">
                        <label></label>
                        <span style="border:none;">
                            <label style="width:100%;"><input type="checkbox" name="auto_login" checked="checked" value="1" >一周内免登录</label>
                        </span>
                    </div>
                    <div class="row">
                        <label></label>
                        <span class="noborder lrBtn">
                            <button class="loginBtn" type="submit">登　录</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    //处理注册登录页面底部兼容效果
    $(function(){
        ftPosition();
        $(window).resize(function(){
            ftPosition();
        });
        function ftPosition(){
            if($(window).height()>790){
                $(".footer").css({
                    "position":"absolute","bottom":"0"
                })
            }else{
                $(".footer").css({
                    "position":"static"
                })
            }
        }       
    });
    function refreshImg2(){
       //document.getElementById("txtCheckCode2").src="/index.php?g=Home&m=Index&a=verifyLogin&s="+Math.random();
    }
</script>
<script src="http://g.alicdn.com/dingding/open-develop/1.0.0/dingtalk.js"></script>
<script>
    dd.config({
        agentId: '35115342', // 必填，微应用ID
        corpId: 'dingf07faf331bd604a8',//必填，企业ID
        timeStamp: <?php echo $ddjs['timestamp']; ?>, // 必填，生成签名的时间戳
        nonceStr: '<?php echo $ddjs['noncestr']; ?>', // 必填，生成签名的随机串
        signature: '<?php echo $ddjs['signature']; ?>', // 必填，签名
        type:0,   //选填。0表示微应用的jsapi,1表示服务窗的jsapi。不填默认为0。该参数从dingtalk.js的0.8.3版本开始支持
        jsApiList : [ 'runtime.info', 'biz.contact.choose',
            'device.notification.confirm', 'device.notification.alert',
            'device.notification.prompt', 'biz.ding.post',
            'biz.util.openLink' ]
        // 必填，需要使用的jsapi列表，注意：不要带dd。
    });
    dd.ready(function() {
        dd.runtime.permission.requestAuthCode({
            corpId: "dingf07faf331bd604a8",
            onSuccess: function(result) {
            /*{
                code: 'hYLK98jkf0m' //string authCode
            }*/
                //alert(result.code);
                $.get('<?php echo url('Common/getDDUserinfo'); ?>', {code:result.code}, function(data) {
                    alert('设备id:' +data.deviceId+' 用户id:'+data.userid + ' 级别：'+ data.sys_level);
                },'json');
            },
            onFail : function(err) {

            }            
        });
    });
</script>

<!-- foorter信息start -->
<div class="footer" style="position: absolute; bottom: 0px;">
    <div class="w1000">
        <p>©&nbsp;<a href="http://www.miitbeian.gov.cn/" style="color: #5c5c5c;" target="_blank">豫ICP备15010785号</a></p>
        <div class="ftImg">
            <a href="#">
                <img src="__STATIC__/index/img/ftimg.png" alt="ft">
            </a>
        </div>
    </div>
</div>
<script src="__STATIC__/index/js/common.js"></script>
<div style="display:none"></div>
</body>
</html>
