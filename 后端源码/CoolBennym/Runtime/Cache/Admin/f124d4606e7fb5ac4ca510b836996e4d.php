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
        <li class="li1">拼团</li>
        <li class="li2">拼团分类</li>
        <li class="li2 li3">分类列表</li>
    </ul>
</div>
<div class="main-tu-js main-sc">
    <div class="tudou-js-nr">
        <div class="tu-select-nr" style="border-top: none; margin-top: 0px;">
            <div class="left">
                <?php echo BA('group/typePublish','','添加分类');?>  
            </div>
            <div class="right">
                <form method="post" action="<?php echo U('group/type');?>">
                    <div class="seleHidden" id="seleHidden">
                        <div class="seleK">
                        
                        	 <label>
                                <input type="hidden" id="school_id" name="school_id" value="<?php echo (($school_id)?($school_id):''); ?>" />
                                <input type="text" name="Name" id="Nme"  value="<?php echo ($Name); ?>"   class="text "/>
                                    <a mini="select"  w="800" h="600" href="<?php echo U('running/schoolselect');?>" class="sumit">选择学校</a>
                                </label>
                             <label> 
                         
                         
                            <label>
                                <span>  关键字：</span>   
                               <input type="text" name="keyword" value="<?php echo (($keyword)?($keyword):''); ?>" class="tu-inpt-text"/>
                                <input type="submit" class="inpt-button-tudou" value="   搜索" />
                           </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        
        <form  target="x-frame" method="post">
            <div class="tu-table-box">
                <table bordercolor="#dbdbdb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;"  >
                    <tr>
                        <td class="w50"><input type="checkbox" class="checkAll" rel="id" /></td>
                        <td class="w50">ID</td>
                        <td>学校ID</td>
                        <td>图片</td>
                        <td>名称</td>
                        <td>排序</td>
                        <td>操作</td>
                    </tr>
                    <?php if(is_array($list)): foreach($list as $key=>$var): ?><tr>
                            <td><input class="child_id" type="checkbox" name="id[]" value="<?php echo ($var["id"]); ?>" /></td>
                            <td><?php echo ($var["id"]); ?></td>
                            <td><?php echo ($var["school_id"]); ?></td>
                            <td><a href="<?php echo config_weixin_img($var['img']);?>" class="tooltip"><img src="<?php echo config_img($var['img']);?>" class="w80"></a></td>
                            <td><?php echo ($var["name"]); ?></td>
                            <td><?php echo ($var["num"]); ?></td>
                           
                            <td>
                            	
                                <?php echo BA('group/typePublish',array("id"=>$var["id"]),'编辑','','tu-dou-btn');?>
                                <?php echo BA('group/typeDelete',array("id"=>$var["id"]),'删除','act','tu-dou-btn');?>
                        	</td>
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