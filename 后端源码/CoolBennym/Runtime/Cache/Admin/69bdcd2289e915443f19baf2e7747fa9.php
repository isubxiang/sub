<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title><?php echo ($CONFIG["site"]["title"]); ?>管理后台</title>
<meta name="description" content="<?php echo ($CONFIG["site"]["title"]); ?>管理后台"/>
<meta name="keywords" content="<?php echo ($CONFIG["site"]["title"]); ?>管理后台"/>
<meta name="author" content="DeathGhost"/>
<link rel="stylesheet" type="text/css" href="/Public/admin/css/style.css" tppabs="css/style.css"/>




<style>
	body{height:100%;background:#16a085;overflow:hidden;}
	canvas{z-index:-1;position:absolute;}
	.tu-admin-login dd .checkcode {background: none;}
	.tu-admin-login dd p { margin:0;}
	
	
	.tu-admin-login dd.fen {
    margin: 5px 0;
    height: 42px; line-height:42px;
    overflow: hidden;
    position: relative;
    width: 100%;text-align: center;
    background:#de4d67;
}


	.tu-admin-login dd .fen_submit_btn {
    width: 100%;
    height: 42px;
    border: none;
    font-size: 16px;
    background: #de4d67;
    color: #f8f8f8;
}

</style>




<iframe id="x-frame" name="x-frame" style="display:none;"></iframe>
<script src="/Public/js/jquery.js"></script>
<script src="/Public/admin/js/verificationNumbers.js" tppabs="js/verificationNumbers.js"></script>
<script src="/Public/admin/js/Particleground.js" tppabs="js/Particleground.js"></script>
<script src="/Public/js/layer/layer.js"></script>
<script src="/Public/js/admin.js"></script>

<script>
	var TU_PUBLIC = '__PUBLIC__';
	var TU_ROOT = '__ROOT__';
	$(document).ready(function(){
	  $('body').particleground({
		dotColor: '#5cbdaa',
		lineColor: '#5cbdaa'
	  });
	});
</script>


</head>
<body>
<dl class="tu-admin-login">
 <dt>
 
  <?php if(($type) == "2"): ?><strong><?php echo ($CONFIG["site"]["title"]); ?>分站后台登录</strong><?php endif; ?>
  <?php if(($type) == "1"): ?><strong><?php echo ($CONFIG["site"]["title"]); ?>总后台管理系统</strong><?php endif; ?>
  
  
  
  <em><?php echo ($CONFIG["site"]["host"]); ?></em>
 </dt>
 <form method="post" action="<?php echo U('login/loging',array('type'=>$type));?>" target="x-frame">
 	<input type="hidden" name="type" value="<?php echo ($type); ?>">
 <dd class="user_icon">
  <input type="text" placeholder="账号" name="username" class="tu-login-tsxtbx"/>
 </dd>
 <dd class="pwd_icon">
  <input type="password" placeholder="密码"  name="password"   class="tu-login-tsxtbx"/>
 </dd>
 <dd class="val_icon">
  <div class="checkcode">
    <input type="text"  placeholder="验证码"  name="yzm"  maxlength="4" class="tu-login-tsxtbx">
  </div>
  <span class="yzm_code" style="margin:2px 0 0px; display:block; cursor:pointer;"><img style="width:60px; height:30px;"  src="__ROOT__/index.php?g=app&m=verify&a=index&mt=<?php echo time();?>" /></span>
 </dd>
 
 <?php if(($type) == "2"): ?><dd><input type="submit" value="分站管理员登录" class="submit_btn"/></dd><?php endif; ?>
 <?php if(($type) == "1"): ?><dd><input type="submit" value="管理员登录" class="submit_btn"/></dd><?php endif; ?>
 
 </form> 
 <?php if(($type) == "1"): ?><dd class="fen">
      <a href="<?php echo U('login/index',array('type'=>2));?>" class="fen_submit_btn">分站管理员登录</a>
     </dd><?php endif; ?>
 <dd>
  <p>©2020 coolbennym  技术支持：<?php echo ($CONFIG["site"]["title"]); ?></p>
  <p>演示账户密码咨询qq：475888533<a target="_blank" href="tencent://message/?uin=475888533&Site=sc.chinaz.com&Menu=yes">在线客服</a></a></p>
 </dd>
</dl>
</body>
</html>