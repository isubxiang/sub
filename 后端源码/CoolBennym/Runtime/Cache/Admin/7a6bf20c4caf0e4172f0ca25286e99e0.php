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
        <li class="li1">会员</li>
        <li class="li2">会员日志</li>
        <li class="li2 li3">积分日志</li>
    </ul>
</div>
<div class="main-tu-js main-sc">
<p class="attention"><span>注意：</span>这可以按照用户搜索积分状况  共搜索到<?php echo ($count); ?>条数据</p>
    <div class="tudou-js-nr">
        <div class="tu-select-nr" style="margin-top: 0px; border-top:none;">
            <div class="right">
                <form class="search_form" method="post" action="<?php echo U('userintegrallogs/index');?>">
                    <div class="seleHidden" id="seleHidden">
                    <div class="seleK">
                    
                    <label>
                            <span>开始时间</span>
                            <input type="text" name="bg_date" value="<?php echo (($bg_date)?($bg_date):''); ?>" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd'});"  class="text" />
                        </label>
                        <label>
                            <span>结束时间</span>
                            <input type="text" name="end_date" value="<?php echo (($end_date)?($end_date):''); ?>" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd'});"  class="text" />
                        </label>
                        
                        
                        <label>
                                <span>收入支出状态：</span>
                                <select class="select w120" name="types">
                                    <option <?php if(($types) == "999"): ?>selected="selected"<?php endif; ?> value="999">请选择</option>
                                    <option <?php if(($types) == "1"): ?>selected="selected"<?php endif; ?>  value="1">收入</option>
                                    <option <?php if(($types) == "2"): ?>selected="selected"<?php endif; ?>  value="2">支出</option>
                                </select>
                       </label>
                            
                        <label>
                         <span>积分排序：</span>
                         <select class="select w120" name="order">
                              <option value="999">请选择</option>
                              <option value="1">积分从高到低</option>
                              <option value="2">积分从低到高</option>
                         </select>
                     </label>    
                     
                        
                        
                    <label>
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo (($user_id)?($user_id):''); ?>" />
                                <input type="text" name="nickname" id="nickname"  value="<?php echo ($nickname); ?>"   class="text " />
                                <a mini="select"  w="800" h="600" href="<?php echo U('user/select');?>" class="sumit">选择用户</a>
                            </label>
                        <span>订单编号</span>
                        <input type="text" name="keyword" value="<?php echo ($keyword); ?>" class="tu-inpt-text" /><input type="submit" value="   搜索"  class="inpt-button-tudou" />
                        
                        
                       <a href="<?php echo U('userintegrallogs/export');?>" class="inpt-button-tudou">&nbsp;&nbsp;&nbsp;导 出</a></label>
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
                    <td class="w50"><input type="checkbox" class="checkAll" rel="log_id" /></td>
                    <td class="w50">ID</td>
                    <td>用户</td>
                    <td>积分</td>
                    <td>说明</td>
                    <td>使用时间</td>
                    <td>使用IP</td>    
                </tr>
                <?php if(is_array($list)): foreach($list as $key=>$var): ?><tr>
                        <td><input class="child_log_id" type="checkbox" name="log_id[]" value="<?php echo ($var["log_id"]); ?>" /></td>
                        <td><?php echo ($var["log_id"]); ?></td>
                        <td><?php echo ($users[$var['user_id']]['account']); ?></td>
                        <td><?php echo ($var["integral"]); ?></td>
                        <td><?php echo ($var["intro"]); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$var["create_time"])); ?></td>
                        <td><?php echo ($var["create_ip"]); ?></td>
                    </tr><?php endforeach; endif; ?>
            </table>
            <?php echo ($page); ?>
        </div>
    </form>
</div>
</div>
  		</div>
	</body>
</html>