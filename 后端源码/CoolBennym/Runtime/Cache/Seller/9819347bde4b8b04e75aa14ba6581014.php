<?php if (!defined('THINK_PATH')) exit();?><title><?php echo ($CONFIG["site"]["sitename"]); ?> - 商家管理V1.0中心</title>

<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8">
		<title>商家管理中心-<?php echo ($CONFIG["site"]["sitename"]); ?></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
		<link rel="stylesheet" href="/static/default/wap/css/base.css">
        <link rel="stylesheet" href="<?php echo ($CONFIG['config']['iocnfont']); ?>">
		<link rel="stylesheet" href="/static/default/wap/css/<?php echo ($ctl); ?>.css"/>
        <link rel="stylesheet" href="/static/default/wap/css/seller2.css">
		<script src="/static/default/wap/js/jquery.js"></script>
		<script src="/static/default/wap/js/base.js"></script>
		<script src="/static/default/wap/other/layer.js"></script>
        <script src="/static/default/wap/js/jquery.form.js"></script>
		<script src="/static/default/wap/other/roll.js"></script>
		<script src="/static/default/wap/js/public.js"></script>
        <script src="/static/default/wap/js/dingwei.js"></script>
      
        <style>
			.foot-fixed .active{color:<?php echo ($color); ?>!important}
			.top-fixed {background: <?php echo ($color); ?>!important;}
		</style>
	</head>
	<body>  
<script>
	var TU_PUBLIC = '__PUBLIC__';
	var TU_ROOT = '__ROOT__';
</script>
<style>
.fr1{ text-align:center;}
.login-open a {color: #333 !important;}
</style>

<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8">
		<title>商家管理中心-<?php echo ($CONFIG["site"]["sitename"]); ?></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
		<link rel="stylesheet" href="/static/default/wap/css/base.css">
        <link rel="stylesheet" href="<?php echo ($CONFIG['config']['iocnfont']); ?>">
		<link rel="stylesheet" href="/static/default/wap/css/<?php echo ($ctl); ?>.css"/>
        <link rel="stylesheet" href="/static/default/wap/css/seller2.css">
		<script src="/static/default/wap/js/jquery.js"></script>
		<script src="/static/default/wap/js/base.js"></script>
		<script src="/static/default/wap/other/layer.js"></script>
        <script src="/static/default/wap/js/jquery.form.js"></script>
		<script src="/static/default/wap/other/roll.js"></script>
		<script src="/static/default/wap/js/public.js"></script>
        <script src="/static/default/wap/js/dingwei.js"></script>
      
        <style>
			.foot-fixed .active{color:<?php echo ($color); ?>!important}
			.top-fixed {background: <?php echo ($color); ?>!important;}
		</style>
	</head>
	<body>
	<header class="top-fixed bg-yellow bg-inverse">
		<div class="top-back">
		</div>
		<div class="top-title">校园跑腿商家管理V1.0中心</div>
		<div class="top-share">
		</div>
	</header>
   <div class="line">
        <div class="login-form">
        <div class="blank-10"></div>
            <div class="form-group">
            <div class="field field-icon">
             <span class="iconfont icon-iconuser"></span>
            <input class="input account" type="text" value="" name="account" placeholder="请输入商家平台账号">
            </div>
            </div>

         <div class="blank-10"></div>
            <div class="form-group">
				<div class="field field-icon">
                <span class="iconfont icon-iconfontlock"></span>
           			<input class="input password" type="password" value="" name=" 、password" placeholder="请输入商家平台密码">
             </div>
            </div>  

            <div class="blank-10"></div>   
       

            <div class="container">
			<div class="form-button">
                 <input id="btn" class="btn button button-block button-big bg-dot" type="button" value="商家登录">
                </div>
			</div>         
      </div>  
    </div>


<div class="blank-30"></div>
    <div class="container">
        <div class="form-button">
        	<a style="text-align: center;" href="<?php echo U('passport/register');?>" class="button button-block button-big border-blue">点击注册</a>
        </div>
    </div> 
    <div class="blank-10"></div>   
    <div class="container">
        <div class="form-button">
        	<a style="text-align: center;" href="<?php echo U('passport/apply');?>" class="button button-block button-big border-yellow">申请入驻</a>
        </div>
    </div> 
    
    <div class="blank-10"></div>   
    <div class="container login-open">
    <h5 style="text-align:center">申请入驻联系电话：<a href="tel:<?php echo ($CONFIG["site"]["tel"]); ?>"><?php echo ($CONFIG["site"]["tel"]); ?></a></h5>
    <h5 style="text-align:center"><a href="<?php echo U('passport/forget');?>">忘记登录密码？输入手机号可找回！</a></h5>
</div>   



<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		var time = "<?php echo time(); ?>";
		$('.yzm_code').click(function(){
			var l = "__ROOT__/index.php?g=app&m=verify&a=index&mt=";
			time = time + 1;
			$('#tu_img_code').attr('src',l+time);
		})
		$('.btn').click(function(){
			var account = $('.account').val();
			var password = $('.password').val();
			var yzm = $('.yzm').val();
			$.post('<?php echo U("passport/login");?>',{account:account,password:password,yzm:yzm},function(result){
				if(result.status == 'success'){
					layer.msg(result.message);
					setTimeout(function(){
						window.location.href=result.backurl;
					},2000);
				}else{
					layer.msg(result.message);
					if(result.backurl){
						setTimeout(function(){
							location.reload();
						},2000);
					}
				}
			},'json');
		})
	})
</script>
</body>
</html>