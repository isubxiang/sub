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
        <li class="li1">跑腿系统</li>
        <li class="li2">学校管理</li>
        <li class="li2 li3">学校列表</li>
    </ul>
</div>

<style>
.tu-left-td{width: 220px;}
.profit{ text-align:center; color:#000; font-weight:bold; background:#ECECEC;}
</style>


<div class="main-tu-js">
    <div class="tudou-js-nr">
        <div class="tu-select-nr" style="margin:10px 20px;">
            <div class="left">
                <?php echo BA('running/schoolPublish',array('school_id'=>$list['school_id'],'date'=>$date),'刷新本页','','',600,360);?>
            </div>
        </div>
 </div>       
        
<form target="x-frame" action="<?php echo U('running/schoolPublish',array('school_id'=>$detail['school_id']));?>" method="post">
    <div class="main-tudou-sc-add" style="margin-top:10px;">
        <div class="tu-table-box">
            <table  bordercolor="#dbdbdb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;" >
            
            	<input type="hidden" name="data[school_id]" value="<?php echo (($detail["school_id"])?($detail["school_id"]):''); ?>" class="tudou-manageInput"/>
            	
               
                
               <tr>
                <td class="tu-left-td">所在区域：</td>
                <td class="tu-right-td">
                    <select name="data[city_id]" id="city_id" style="float: left;" class="seleFl w210"></select>
                    <select name="data[area_id]" id="area_id" style="float: left;"  class="seleFl w210"></select>
                    <select name="data[business_id]" id="business_id" style="float: left;" class="seleFl w210"></select>
                </td>
                </tr>
                <script src="<?php echo U('app/datas/onecity',array('name'=>'cityareas'));?>"></script> 
                <script>
				var city_id = <?php echo (int)$detail['city_id'];?>;
				var area_id = <?php echo (int)$detail['area_id'];?>;
				var business_id = <?php echo (int)$detail['business_id'];?>;
				$(document).ready(function (){
					var city_str = ' <option value="0">请选择...</option>';
					for(a in cityareas.city){
						if(city_id == cityareas.city[a].city_id){
							city_str += '<option selected="selected" value="' + cityareas.city[a].city_id + '">' + cityareas.city[a].name + '</option>';
						}else{
							city_str += '<option value="' + cityareas.city[a].city_id + '">' + cityareas.city[a].name + '</option>';
						}
					}
					$("#city_id").html(city_str);
					$("#city_id").change(function(){
						if ($("#city_id").val() > 0){
							city_id = $("#city_id").val();
							   $.ajax({
									  type: 'POST',
									  url: "<?php echo U('app/datas/twoarea');?>",
									  data:{cid:city_id},
									  dataType: 'json',
									  success: function(result){
										 var area_str = ' <option value="0">请选择...</option>';
										for (a in result) {
										  area_str += '<option value="' + result[a].area_id + '">' + result[a].area_name + '</option>';                                                        }
									   $("#area_id").html(area_str);
										$("#business_id").html('<option value="0">请选择...</option>');
									  }
								});
							$("#area_id").html(area_str);
							$("#business_id").html('<option value="0">请选择...</option>');
						} else {
							$("#area_id").html('<option value="0">请选择...</option>');
							$("#business_id").html('<option value="0">请选择...</option>');
						}
					});
					if(city_id > 0){
						var area_str = ' <option value="0">请选择...</option>';
						$.ajax({
						  type: 'POST',
						  url: "<?php echo U('app/datas/twoarea');?>",
						  data:{cid:city_id},
						  dataType: 'json',
						  success: function(result){
							 for(a in result){
								if(area_id == result[a].area_id){
									area_str += '<option selected="selected" value="' + result[a].area_id + '">' + result[a].area_name + '</option>';
								}else{
									area_str += '<option value="' + result[a].area_id + '">' + result[a].area_name + '</option>';
								}
							  }
							 $("#area_id").html(area_str);
							}
						});
					}
					$("#area_id").change(function(){
						if($("#area_id").val() > 0){
							area_id = $("#area_id").val();
								$.ajax({
									  type: 'POST',
									  url: "<?php echo U('app/datas/tbusiness');?>",
									  data:{bid:area_id},
									  dataType: 'json',
									  success: function(result){
										 var business_str = ' <option value="0">请选择...</option>';
										 for(a in result){
												business_str += '<option value="' + result[a].business_id + '">' + result[a].business_name + '</option>';
										 }
										$("#business_id").html(business_str);
									 }
								   });
						}else{
							$("#business_id").html('<option value="0">请选择...</option>');
						}
					});
					if(area_id > 0){                                    
					   $.ajax({
						  type: 'POST',
						  url: "<?php echo U('app/datas/tbusiness');?>",
						  data:{bid:area_id},
						  dataType: 'json',
						  success: function(result){
							var business_str = ' <option value="0">请选择...</option>';
							for(a in result){
									if(business_id == result[a].business_id){
										business_str += '<option selected="selected" value="' + result[a].business_id + '">' + result[a].business_name + '</option>';
									}else{
									  business_str += '<option value="' + result[a].business_id + '">' + result[a].business_name + '</option>';
									}
							}
							 $("#business_id").html(business_str);
						  }
					   });
					}
					$("#business_id").change(function(){
						business_id = $(this).val();
					});
				});
                </script> 




                <tr>
                    <td class="tu-left-td">学校名称：</td>
                    <td class="tu-right-td"><input type="text" name="data[Name]" value="<?php echo (($detail["Name"])?($detail["Name"]):''); ?>" class="tudou-manageInput" />
					<code>学校名称</code>
                    </td>
                </tr>
                <tr>
                    <td class="tu-left-td">学校区域：</td>
                    <td class="tu-right-td"><input type="text" name="data[Region]" value="<?php echo (($detail["Region"])?($detail["Region"]):''); ?>" class="tudou-manageInput" />
					<code>学校区域</code>
                    </td>
                </tr>
                
                <tr>
                <td class="tu-left-td">经纬度：</td>
                <td class="tu-right-td">
                    <div class="lt">
                        经度<input type="text" name="data[lng]" id="data_lng" value="<?php echo (($detail["lng"])?($detail["lng"]):''); ?>" class="tudou-sc-add-text-name w210 w100" />
                        纬度<input type="text" name="data[lat]" id="data_lat" value="<?php echo (($detail["lat"])?($detail["lat"]):''); ?>" class="tudou-sc-add-text-name w210 w100" />
                    </div>
                    <a style="margin-left: 10px;" mini="select"  w="600" h="600" href="<?php echo U('public/maps',array('lat'=>$detail['lat'],'lng'=>$detail['lng']));?>" class="seleSj">百度地图</a>
                </tr>
                
                <tr>
                    <td class="tu-left-td">运费说明：</td>
                    <td class="tu-right-td"><input type="text" name="data[FreightMoneyCaption]" value="<?php echo (($detail["FreightMoneyCaption"])?($detail["FreightMoneyCaption"]):''); ?>" class="tudou-manageInput" />
					<code>当前学校的跑腿费说明4字汉字之内</code>
                    </td>
                </tr>
                
                <tr>
                    <td class="tu-left-td">最小运费：</td>
                    <td class="tu-right-td"><input type="text" name="data[MinFreightMoney]" value="<?php echo (($detail["MinFreightMoney"])?($detail["MinFreightMoney"]):'0.1'); ?>" class="tudou-manageInput" />
					<code>当前学校的最小运费0.1-10元之间</code>
                    </td>
                </tr>
                
                
                 <tr>
                     <td class="tu-left-td">是否开启会员提现：</td>
                     <td class="tu-right-td">
                     <label><input type="radio" name="data[is_cash]" <?php if(($detail["is_cash"]) == "1"): ?>checked="checked"<?php endif; ?> value="1"/>开启</label>
                     <label><input type="radio" name="data[is_cash]" <?php if(($detail["is_cash"]) == "0"): ?>checked="checked"<?php endif; ?>  value="0"/>关闭</label>
                        <code>当前学校提现是否开启，默认关闭，可在这里配置开启，如果这里不开启则下面失效，这里开启后下面不配置按照系统设置里面的提现设置为标准</code>
                      </td>
			    </tr>
                
                
                    
                <tr>
                    <td class="tu-left-td">普通会员提现设置：</td>
                    <td class="tu-right-td">
                        <input type="text" name="data[user]" value="<?php echo ($detail["user"]); ?>" class="tudou-sc-add-text-name w80"/>
						<code>←会员单笔提现最低</code>
                        <input type="text" name="data[user_big]" value="<?php echo ($detail["user_big"]); ?>" class="tudou-sc-add-text-name w80"/>
                        <code>←会员单笔提现最高</code>
                        <input type="text" name="data[user_cash_commission]" value="<?php echo ($detail["user_cash_commission"]); ?>" class="tudou-sc-add-text-name w80"/>%
                        <code>当前学校单笔提现手续费，设置3%，100元扣除3元，实际到账97元，留空不扣除手续费</code>
                    </td>
                </tr>
                 

                <tr>
                    <td class="tu-left-td">学校商户提现设置：</td>
                    <td class="tu-right-td">
                        <input type="text" name="data[shop]" value="<?php echo ($detail["shop"]); ?>" class="tudou-sc-add-text-name w80"/>
						<code>←商家单笔提现最低</code>
                        <input type="text" name="data[shop_big]" value="<?php echo ($detail["shop_big"]); ?>" class="tudou-sc-add-text-name w80"/>
						<code>←商家单笔提现最高</code>
                        <input type="text" name="data[shop_cash_commission]" value="<?php echo ($detail["shop_cash_commission"]); ?>" class="tudou-sc-add-text-name w80"/>%
                        <code>当前学校如果此会员已开通商户，按照这里配置走，单笔提现手续费，设置3%，100元扣除3元，实际到账97元，留空不扣除手续费</code>
                    </td>
                </tr>


                
                <tr> 
                    <td class="tu-left-td">每日申请提现次数：</td>
                    <td class="tu-right-td">
                        <input type="text" name="data[user_cash_second]" value="<?php echo ($detail["user_cash_second"]); ?>" class="tudou-sc-add-text-name w80"/>
						<code>当前学校会员每日最多申请多少次提现</code>
                        <input type="text" name="data[shop_cash_second]" value="<?php echo ($detail["shop_cash_second"]); ?>" class="tudou-sc-add-text-name w80"/>
						<code>当前学校商家每日最多申请多少次提现</code>
                    </td>
                </tr>
                
                
                
                <tr>
                  <td class="tu-right-td profit" colspan="2"> 平台跟站长佣金计算模式</td>
                </tr>
                
                
                 <tr>
                    <td class="tu-left-td">站长会员ID：</td>
                    <td class="tu-right-td">
                        <div class="lt">
                            <input type="hidden" id="user_id" name="data[user_id]" value="<?php echo (($detail["user_id"])?($detail["user_id"]):''); ?>" />
                            <input class="tudou-sc-add-text-name w210 sj" type="text" name="nickname" id="nickname"  value="<?php echo ($user["nickname"]); ?>" />
                        </div>
                        <a mini="select"  w="800" h="600" href="<?php echo U('user/select');?>" class="seleSj">选择用户</a>
                        <code>学校绑定的站长会员ID，预留字段可不填写，用于下面抽成，这里的站长会员绑定的ID要跟管理员里面绑定的ID一致才能登录分站后台</code>
                    </td>
                </tr>   
                
                <tr>
                    <td class="tu-left-td">平台佣金比例：</td>
                    <td class="tu-right-td">
                        <input type="text" name="data[admin_yongjin_rate]" value="<?php echo ($detail["admin_yongjin_rate"]); ?>" class="tudou-sc-add-text-name w80"/>%
						<code>平台佣金比例，建议填写10以下的数字，不能大于100，留空或者0为不抽成</code>
                    </td>
                </tr>
                 <tr>
                    <td class="tu-left-td">站长佣金比例：</td>
                    <td class="tu-right-td">
                        <input type="text" name="data[city_yongjin_rate]" value="<?php echo ($detail["city_yongjin_rate"]); ?>" class="tudou-sc-add-text-name w80"/>%
						<code>站长佣金比例，建议填写10以下的数字，不能大于100，留空或者0为不抽成</code>
                    </td>
                </tr>
                
 				<tr>
                  <td class="tu-right-td profit" colspan="2"> 学校排序设置 </td>
                </tr>
                
                <tr>
                    <td class="tu-left-td">排序：</td>
                    <td class="tu-right-td"><input type="text" name="data[orderby]" value="<?php echo (($detail["orderby"])?($detail["orderby"]):'500'); ?>" class="tudou-manageInput"/>
					<code>学校排序</code>
                    </td>
                </tr>
                

            </table>
        </div>
        <div class="sm-qr-tu"><input type="submit" value="确认操作" class="sm-tudou-btn-input" /></div>
    </div>
</form>
  		</div>
	</body>
</html>