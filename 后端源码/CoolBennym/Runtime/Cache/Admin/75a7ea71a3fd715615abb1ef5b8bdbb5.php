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
        <li class="li1">设置</li>
        <li class="li2">大鱼模板管理</li>
        <li class="li2 li3">大鱼模板</li>
    </ul>
</div>
<div class="main-tu-js">
    <p class="attention"><span>注意：</span>当模板ID与大鱼平台一致时才能正常发送短信！</p>
    <div class="tudou-js-nr">
        <div class="tu-select-nr" style="margin: 10px 20px;">
            <div class="left">
                <?php echo BA('dayu/create','','添加内容');?>
                <?php echo BA('dayusms/index','','大鱼短信发送记录');?>
            </div>
        </div>
        <form target="x-frame" method="post">
            <div class="tu-table-box">
                <table bordercolor="#e1e6eb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;"  >
                    <tr>
                        <td class="w50"><input type="checkbox" class="checkAll" rel="dayu_id" /></td>
                        <td class="w50">ID</td>
                        <td>模板名</td>
                        <td>本地调用</td>
                        <td>模板ID</td>
                        <td>说明</td>
                        <td class="w120">操作</td>
                    </tr>
                    <?php if(is_array($tag)): foreach($tag as $key=>$var): ?><tr>
                            <td><input class="child_dayu_id" type="checkbox" name="dayu_id[]" value="<?php echo ($var["dayu_id"]); ?>" /></td>
                            <td><?php echo ($var["dayu_id"]); ?></td>
                            <td><?php echo ($var["dayu_name"]); ?></td>
                            <td><?php echo ($var["dayu_local"]); ?></td>
                            <td><?php echo ($var["dayu_tag"]); ?></td>
                            <td><?php echo ($var["dayu_note"]); ?></td>
                            <td>
                                <?php echo BA('dayu/edit',array("dayu_id"=>$var["dayu_id"]),'编辑','','tu-dou-btn');?>
                                <?php if(($var["is_open"]) == "0"): echo BA('dayu/audit',array("dayu_id"=>$var["dayu_id"]),'开启','act','tu-dou-btn');?> 
                                <?php else: ?>
                                <?php echo BA('dayu/delete',array("dayu_id"=>$var["dayu_id"]),'关闭','act','tu-dou-btn'); endif; ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </table>
                <?php echo ($page); ?>
            </div>
            <div class="tu-select-nr">
                <div class="left">
                    <?php echo BA('dayu/delete','','批量关闭','list','a2');?>
                    <?php echo BA('dayu/audit','','批量开启','list','tu-dou-btn');?>
                </div>
            </div>
        </form>

    </div>
</div>
  		</div>
	</body>
</html>