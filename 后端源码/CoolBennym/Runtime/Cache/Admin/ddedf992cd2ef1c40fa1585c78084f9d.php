<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title><?php echo ($CONFIG["site"]["sitename"]); ?>管理后台</title>
        <meta name="description" content="<?php echo ($CONFIG["site"]["sitename"]); ?>管理后台"/>
        <meta name="keywords" content="<?php echo ($CONFIG["site"]["sitename"]); ?>管理后台"/>
        <link href="__TMPL__statics/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="__PUBLIC__/js/jquery-ui.css" rel="stylesheet" type="text/css"/>
        
        
        <script> 
			var TU_PUBLIC = '__PUBLIC__'; 
			var TU_ROOT = '__ROOT__'; 
        </script>
        <script src="__PUBLIC__/js/jquery.js"></script>
        <script src="__PUBLIC__/js/jquery-ui.min.js"></script>
        <script src="__PUBLIC__/js/my97/WdatePicker.js"></script>
        <script src="/Public/js/layer/layer.js"></script>
        <script src="__PUBLIC__/js/admin.js"></script>
        <script src="__PUBLIC__/js/echarts-all-3.js"></script>
        
        <link rel="stylesheet" type="text/css" href="/static/default/webuploader/webuploader.css">
		<script src="/static/default/webuploader/webuploader.min.js"></script>
    </head>
    
    
    </head>
<style type="text/css">
#ie9-warning{ background:#F00; height:38px; line-height:38px; padding:10px;
position:absolute;top:0;left:0;font-size:12px;color:#fff;width:97%;text-align:left; z-index:9999999;}
#ie6-warning a {text-decoration:none; color:#fff !important;}
</style>

<!--[if lte IE 9]>
<div id="ie9-warning">您正在使用 Internet Explorer 9以下的版本，请用谷歌浏览器访问后台、部分浏览器可以开启极速模式访问！不懂点击这里！" target="_blank">查看为什么？</a>
</div>
<script type="text/javascript">
function position_fixed(el, eltop, elleft){  
       // check if this is IE6  
       if(!window.XMLHttpRequest)  
              window.onscroll = function(){  
                     el.style.top = (document.documentElement.scrollTop + eltop)+"px";  
                     el.style.left = (document.documentElement.scrollLeft + elleft)+"px";  
       }  
       else el.style.position = "fixed";  
}
       position_fixed(document.getElementById("ie9-warning"),0, 0);
</script>
<![endif]-->


    <body>
         <iframe id="x-frame" name="x-frame" style="display:none;"></iframe>
   <div class="main">
<div class="tu-main-top-btn">
    <ul>
        <li class="li1">当前位置</li>
        <li class="li2">贴吧管理</li>
        <li class="li2 li3">打赏列表</li>

    </ul>
</div>
<div class="main-tu-js main-sc">
    <p class="attention"><span>注意：</span> 这里显示的是贴吧打赏列表，当前筛选数据共计打赏¥ <?php echo round($sum/100,2);?>元</p>
    <div class="tudou-js-nr">
        <div class="tu-select-nr" style="margin-top: 0px; border-top:none;">
            <div class="left">
                <?php echo BA('thread/create','','添加贴吧');?>
            </div>
            <div class="right">
                <form class="" method="post"  action="<?php echo U('thread/donate');?>"> 
                    <div class="seleHidden" id="seleHidden">
                        <div class="seleK">
                   
                            <label>
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo (($user_id)?($user_id):''); ?>" />
                                <input type="text" name="nickname" id="nickname"  value="<?php echo ($nickname); ?>"   class="text" />
                                <a mini="select"  w="800" h="600" href="<?php echo U('user/select');?>" class="sumit">选择用户</a>
                            </label>
                            
                             <label>
                                <input type="hidden" id="school_id" name="school_id" value="<?php echo (($school_id)?($school_id):''); ?>"/>
                                <input type="text" name="Name" id="Nme"  value="<?php echo ($Name); ?>"  class="text"/>
                                <a mini="select"  w="800" h="600" href="<?php echo U('running/schoolselect');?>" class="sumit">选择学校</a>
                            </label>
                        
                                <input type="submit" class="inpt-button-tudou" value="   搜索" />
                            </label>
                        </div>
                    </div>
                </form>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <form  target="x-frame" method="post">
            <div class="tu-table-box">
                <table bordercolor="#e1e6eb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;"  >
                    <tr>
                        <td class="w50"><input type="checkbox" class="checkAll" rel="donate_id" /></td>
                        <td class="w50">ID</td>
                        <td>学校ID</td>
                        <td>打赏贴吧ID</td>
                        <td>打赏会员</td>
                        <td>打赏金额</td>
                        <td>打赏时间</td>
                        <td>打赏IP</td>
                    <?php if(is_array($list)): foreach($list as $key=>$var): ?><tr>
                            <td><input class="child_donate_id" type="checkbox" name="donate_id[]" value="<?php echo ($var["article_id"]); ?>" /> </td>
                            <td><?php echo ($var["donate_id"]); ?></td>
                            <td><?php echo ($var["school_id"]); ?></td>
                            <td><?php echo ($var["post_id"]); ?></td>
                            <td><?php echo ($users[$var['user_id']]['nickname']); ?></td>
                            <td> ¥ <?php echo ($var['money']); ?>元</td>
                            <td><?php echo (date('Y-m-d H:i:s',$var["create_time"])); ?></td>
                            <td><?php echo ($var["create_ip"]); ?></td>
                        </tr><?php endforeach; endif; ?>
                </table>
                <?php echo ($page); ?>
            </div>
            <div class="tu-select-nr" style="margin-bottom: 0px; border-bottom: none;">
                <div class="left">
                </div>
            </div>
        </form>
    </div>
</div>
  		</div>
	</body>
</html>