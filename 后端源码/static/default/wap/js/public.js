var niulock = 1;
var niunum = 1;
var map;
var geoc;


//GET请求执行结果，带load
$(function () {
	$('body').on('click','#www-hatudou-com-url-btn',function (){
		showLoader();
        var $url = this.href;
        $.get($url, function (data){
            if (data.code==1) {
				hideLoader();
                layer.msg(data.msg, function(){
					location.href = data.url;
				});
            }else{
				hideLoader();
                layer.msg(data.msg);
				setTimeout(function (){
					lock = 0;
				},3000);
            }
        }, "json");
        return false;
    });
});


function isIOS(){
	var Na=window.navigator.userAgent.toLowerCase(),q={},Hd;
	q.isChrome=function(){return-1<Na.indexOf('chrome')||-1<Na.indexOf('CrMo')};
	q.isDesktopSafari=function(){return!q.isIOS()&&-1!==Na.search('safari')};
	var lb;-1<Na.indexOf('iphone')?
	lb='iphone':-1<Na.indexOf('ipad')?lb='ipad':-1<Na.indexOf('android')&&q.isChrome()?lb='chromeandroid':-1<Na.indexOf('android')||-1<Na.indexOf('htc_evo3d')?lb='android':-1<Na.indexOf('playbook')?lb='playbook':-1<Na.indexOf('ipod')?lb='ipod':-1<navigator.platform.indexOf('Win')&&(lb='windows',(Hd=/msapphost\/(\d+\.\d+)/i.exec(Na))&&(Hd=parseFloat(Hd[1])));lb||(lb='unknown');
	q.type=lb;
	return'iphone'===q.type||'ipad'===q.type||'ipod'===q.type;
}



function showWindows(width,hight,url,title){
	var pageii = layer.open({
  		type: 1,
		title: false,
		closeBtn: 0, //不显示关闭按钮
		area: ['100%', '100%'],
		content: "<iframe src="+url+" id='iframepage' name='iframepage' frameBorder=0 scrolling=no width='100%' onLoad='iFrameHeight()'></iframe>",
		anim: 'up',style: 'position:fixed; left:0; top:0; width:100%; height:100%; border: none; -webkit-animation-duration: .5s; animation-duration: .5s;'
	});
}

function iFrameHeight(){  
  var ifm = document.getElementById("iframepage");  
  var subWeb = document.documentElement.clientHeight;  
  if(ifm != null && subWeb != null){  
   	ifm.height = subWeb;  
  }  
} 
 
 
//哈土豆添加弹窗编辑,傻逼来抄袭
function showWindow(width,hight,url,title){
	layer.open({
	  type: 2,
	  title:title,
	  area:[width,hight],
	  fixed: false, 
	  maxmin: true,
	  content: url
	});
}

//图片弹窗
function popUpPic(id){
	layer.photos({
		photos: '#layer-photos-demo-'+id,
		shift: 5 //0-6鐨勯€夋嫨锛屾寚瀹氬脊鍑哄浘鐗囧姩鐢荤被鍨嬶紝榛樿闅忔満
	}); 
}


// 哈土豆添加ajaxForm
$(function () {
    $('#ajaxForm').ajaxForm({
        success: complete, // 这是提交后的方法
        dataType: 'json'
    });
});

//哈土豆添加ajaxForm失败不跳转
function complete(data) {
    if (data.code == 1) {
		layer.msg(data.msg, function(){
			location.href = data.url;
		});
    } else {
		layer.msg(data.msg);
		setTimeout(function () {
			lock = 0;
		},3000);
    }
}

function getLocation(){
	navigator.geolocation.getCurrentPosition(Local);
}


function dingwei(page, lat, lng) {
    page = page.replace('llaatt', lat);
    page = page.replace('llnngg', lng);
    $.get(page, function (data) {
    }, 'html');
}


function Local(position) {
	var lng = position.coords.longitude;
	var lat = position.coords.latitude;
	var page =  "/wap/near/dingwei/lat/"+lat+"/lng/"+lng+".html";
	$.get(page, function (data) {
		if(data == '1'){
			$("#local").html("附近");
		}
	}, 'html');
};




function showLoader(msg) {
	layer.load(2);
}

function hideLoader(){
    $("#loader").hide();
	layer.closeAll('loading');
}


function ajaxLogin(){
	window.location.href = "/wap/passport/login.html"; 
}

//信息,跳转地址,时间
function boxmsg(msg, url, timeout, callback){ 
	showLoader();
    layer.msg(msg);
	hideLoader();
    if(url){
        setTimeout(function(){
            window.location.href = url;
        }, timeout ? timeout : 3000);
    }else if (url === 0){
        setTimeout(function () {
            location.reload(true);
        }, timeout ? timeout : 3000);
    }else{
        eval(callback);
    }

}




function loaddata(page, obj, sc) {
	
    var link = page.replace('0000', niunum);

    showLoader('正在加载中....');
	var html = '<div class="blank-10"></div><div class="container" style="text-align: center;"><a class="text-center">没有更多内容</a></div>';
    $.get(link, function (data) {
        if (data != 0) {
            obj.append(data);
        }else{
			obj.append(html);
			niulock = 0;
        	hideLoader();
			return;
		}
        niulock = 0;
        hideLoader();
    }, 'html');
    if (sc === true) {
        $(window).scroll(function () {
			var wh = $(window).scrollTop();
			var xh = $(document).height() - $(window).height() - 70;
            if (!niulock && wh >= xh ) {
			
                niulock = 1;
                niunum++;
			
                var link = page.replace('0000', niunum);
         
                showLoader('正在加载中....');
				var timeout = setTimeout(function(){
					niulock = 0;
					hideLoader();
				},5000);
                $.get(link, function (data) {
                    if (data != 0) {
						if(timeout){ //清除定时器
							clearTimeout(timeout);
							timeout = null;
						}
                        obj.append(data);
                    }
                    niulock = 0;
                    hideLoader();
                }, 'html');
            }
        });
    }
}

var input_array = Array();
$(document).ready(function (){
    $("input").each(function () {
        if (!$(this).val()) {
            $(this).val($(this).attr('placeholder'));
        }
        if ($(this).attr('type') == 'password') {
            input_array.push($(this).attr('name'));
            $(this).attr('type', 'text');
        }
    });
    $("input").focus(function () {
        if ($(this).val() == $(this).attr('placeholder')) {
            $(this).val('');
        }
        if (input_array.indexOf($(this).attr('name')) >= 0) {
            $(this).attr('type', 'password');
        }

    }).blur(function () {
        if ($(this).val() == '') {
            $(this).val($(this).attr('placeholder'));
        }
        if ($(this).attr('type') == 'password' && $(this).val() == $(this).attr('placeholder')) {
            input_array.push($(this).attr('name'));
            $(this).attr('type', 'text');
        }
    });
	
	hideLoader();
});

function check_user_mobile(url1,url2){
	layer.open({
		type: 1,
		title:'<h4>请绑定手机后操作</h4>',
		skin: 'layui-layer-molv', //加上边框
		area: ['90%', '300px'], //宽高
		shift:6,
		content: '<div class="form-auto form-x"><div class="form-group"><div class="label"><label>手机号</label></div><div class="field form-inline"><input class="input input-auto" name="mobile" id="mobile" value="" placeholder="填写手机号码" size="20" type="text"> <button class="button margin-top bg-yellow" id="jq_send">获取验证码</button></div></div><div class="form-group"><div class="label" ><label>验证码</label></div><div class="field"><input class="input input-auto" name="yzm" id="yzm" value="" size="10" placeholder="填写验证码" type="text"></div></div><div class="form-button"><button id="go_mobile" class="button bg-yellow edit_post" type="submit">立刻认证</button></div></div>'
	});
	//获取验证码
	var mobile_timeout;
	var mobile_count = 100;
	var mobile_lock = 0;
	$(function () {
		$("#jq_send").click(function () {

			if (mobile_lock == 0) {
				mobile_lock = 1;
				$.ajax({
					url: url1,
					data: 'mobile=' + $("#mobile").val(),
					type: 'post',
					success: function (data) {
						if (data.status == 'success') {
							mobile_count = 60;
							layer.msg(data.msg,{icon:1});
							BtnCount();
						} else {
							mobile_lock = 0;
							layer.msg(data.msg,{icon:2});
						}
					}
				});
			}

		});
	});
	BtnCount = function () {
		if (mobile_count == 0) {
			$('#jq_send').html("重新发送");
			mobile_lock = 0;
			clearTimeout(mobile_timeout);
		}
		else {
			mobile_count--;
			$('#jq_send').html("重新发送(" + mobile_count.toString() + ")秒");
			mobile_timeout = setTimeout(BtnCount, 1000);
		}
	};
	//提交
	$('#go_mobile').click(function(){
		var ml = $('#mobile').val();
		var y = $('#yzm').val();
		$.post(url2,{mobile:ml,yzm:y},function(result){										
			if(result.status == 'success'){
				layer.msg(result.msg);
				setTimeout(function(){
					location.reload(true);
				},3000);
			}else{
				layer.msg(result.msg,{icon:2});
			}														
		},'json');
	})
	
	$('.layui-layer-content').css('padding','15px');
	
}


function change_user_mobile(url1,url2){
	layer.open({
		type: 1,
		title:'更换手机号',
		skin: 'layer-ext-demo', //加上边框
		area: ['90%', '300px'], //宽高
		content: '<div class="padding-big">手机号<br /><input name="mobile" id="mobile" type="text" size="13" class="input input-auto" /><button class="button margin-top bg-yellow" type="button" id="jq_send">获取验证码</button><br /><div class="blank-10"></div>验证码<br /><input  class="input input-auto" size="10"  name="yzm" id="yzm" type="text" /> 输入验证码<br><div class="blank-20"></div><input type="submit" value="立刻认证" class="button bg-yellow"  id="go_mobile" /></div>'
	});
	//获取验证码
	var mobile_timeout;
	var mobile_count = 100;
	var mobile_lock = 0;
	$(function () {
		$("#jq_send").click(function () {
			if (mobile_lock == 0) {
				mobile_lock = 1;
				$.ajax({
					url: url1,
					data: 'mobile=' + $("#mobile").val(),
					type: 'post',
					success: function (data) {
						if (data.status == 'success') {
							mobile_count = 60;
							layer.msg(data.msg,{icon:1});
							BtnCount();
						} else {
							mobile_lock = 0;
							layer.msg(data.msg,{icon:2});
						}
					}
				});
			}

		});
	});
	BtnCount = function () {
		if (mobile_count == 0) {
			$('#jq_send').html("重新发送");
			mobile_lock = 0;
			clearTimeout(mobile_timeout);
		}else {
			mobile_count--;
			$('#jq_send').html("重新发送(" + mobile_count.toString() + ")秒");
			mobile_timeout = setTimeout(BtnCount, 1000);
		}
	};
	//提交
	$('#go_mobile').click(function(){
		var ml = $('#mobile').val();
		var y = $('#yzm').val();
		$.post(url2,{mobile:ml,yzm:y},function(result){										
			if(result.status == 'success'){
				layer.msg(result.msg,{icon:1});
				setTimeout(function(){
					location.reload(true);
				},3000);
			}else{
				layer.msg(result.msg,{icon:2});
			}														
		},'json');
	})	
	
	
	$('.layui-layer-title').css('color','#ffffff').css('background','#2fbdaa');
	
}

//获取城市、地区、商圈的下拉菜单
//获取城市、地区、商圈的下拉菜单
function get_option(){

		var city_id = 0;
		var area_id = 0;
		var business_id = 0;
	
		var city_str = '<option value="0">请选择...</option>';
		for (a in cityareas.city) {
			if (city_id == cityareas.city[a].city_id) {
				city_str += '<option selected="selected" value="' + cityareas.city[a].city_id + '">' + cityareas.city[a].name + '</option>';
			} else {
				city_str += '<option value="' + cityareas.city[a].city_id + '">' + cityareas.city[a].name + '</option>';
			}
		}

		$("#city_id").html(city_str);
		$("#city_id").change(function () {
			if ($("#city_id").val() > 0) {
			   var city_id = $("#city_id").val();
					$.ajax({
						  type: 'POST',
						  url: window.CITYURL,
						  data:{cid:city_id},
						  dataType: 'json',
						  success: function(result)
						  {
							 var area_str = ' <option value="0">请选择...</option>';
							for (a in result) {
							  area_str += '<option value="' + result[a].area_id + '">' + result[a].area_name + '</option>';                              
							}
						   $("#area_id").html(area_str);
							$("#business_id").html('<option value="0">请选择...</option>');									
						  }
					});
			} else {
				$("#area_id").html('<option value="0">请选择...</option>');
				$("#business_id").html('<option value="0">请选择...</option>');
			}
		});



		$("#area_id").change(function () {

			if ($("#area_id").val() > 0) {
				area_id = $("#area_id").val();
					$.ajax({
						  type: 'POST',
						  url: window.BUSURL,
						  data:{bid:area_id},
						  dataType: 'json',
						  success: function(result)
						  {
							 var business_str = ' <option value="0">请选择...</option>';
							 for (a in result) {
									business_str += '<option value="' + result[a].business_id + '">' + result[a].business_name + '</option>';
							 }
							$("#business_id").html(business_str);
						 }
					   });
			} else {
				$("#business_id").html('<option value="0">请选择...</option>');
			}
		});


		$("#business_id").change(function () {
			business_id = $(this).val();
		});

}




function changeCAB(c,a,b){
	$("#city_ids").unbind('change');
	$("#area_ids").unbind('change');
	var city_ids = c;
	var area_ids = a;
	var business_ids = b;
	var city_str = ' <option value="0">请选择...</option>';
	for (b in cityareas.city) {
		if (city_ids == cityareas.city[b].city_id) {
			city_str += '<option selected="selected" value="' + cityareas.city[b].city_id + '">' + cityareas.city[b].name + '</option>';
		} else {
			city_str += '<option value="' + cityareas.city[b].city_id + '">' + cityareas.city[b].name + '</option>';
		}
	}
	$("#city_ids").html(city_str);

	$("#city_ids").change(function () {
		if ($("#city_ids").val() > 0) {
			city_id = $("#city_ids").val();
			   $.ajax({
					  type: 'POST',
					  url: window.CITYURL,
					  data:{cid:city_id},
					  dataType: 'json',
					  success: function(result)
					  {
						 var area_str = ' <option value="0">请选择...</option>';
						for (a in result) {
						  area_str += '<option value="' + result[a].area_id + '">' + result[a].area_name + '</option>';                              
						}
					   $("#area_ids").html(area_str);
						$("#business_ids").html('<option value="0">请选择...</option>');										
					  }
				});
			$("#area_ids").html(area_str);
			$("#business_ids").html('<option value="0">请选择...</option>');
		} else {
			$("#area_ids").html('<option value="0">请选择...</option>');
			$("#business_ids").html('<option value="0">请选择...</option>');
		}
	});

	 if (city_ids > 0) {  //编辑加载选中数据     
		var area_str = ' <option value="0">请选择...</option>';
		$.ajax({
		  type: 'POST',
		  url: window.CITYURL,
		  data:{cid:city_ids},
		  dataType: 'json',
		  success: function(result)
		  {
			 for (a in result) {
				if (area_ids == result[a].area_id) {
					area_str += '<option selected="selected" value="' + result[a].area_id + '">' + result[a].area_name + '</option>';
				} else {
					area_str += '<option value="' + result[a].area_id + '">' + result[a].area_name + '</option>';
				}
			  }
			 $("#area_ids").html(area_str);
			}
		});
	}


	$("#area_ids").change(function () {
		if ($("#area_ids").val() > 0) {
			area_id = $("#area_ids").val();
				$.ajax({
					  type: 'POST',
					  url: window.BUSURL,
					  data:{bid:area_id},
					  dataType: 'json',
					  success: function(result)
					  {
						 var business_str = ' <option value="0">请选择...</option>';
						 for (a in result) {
								business_str += '<option value="' + result[a].business_id + '">' + result[a].business_name + '</option>';
						 }
						$("#business_ids").html(business_str);
					 }

				   });
		} else {
			$("#business_ids").html('<option value="0">请选择...</option>');
		}
	});

	if (area_ids > 0) {  //编辑加载选中数据                                 
	   $.ajax({
		  type: 'POST',
		  url: window.BUSURL,
		  data:{bid:area_ids},
		  dataType: 'json',
		  success: function(result)
		  {
			var business_str = ' <option value="0">请选择...</option>';
			for (a in result) {
					if (business_ids == result[a].business_id) {
						business_str += '<option selected="selected" value="' + result[a].business_id + '">' + result[a].business_name + '</option>';
					} else {
					  business_str += '<option value="' + result[a].business_id + '">' + result[a].business_name + '</option>';
					}
			}
			 $("#business_ids").html(business_str);
		  }

	   });

	}


	$("#business_ids").change(function () {
		business_ids = $(this).val();
	});
}






function boxopen(msg, close, style) {
    layer.open({
        type: 1,
        skin: style, //样式类名
        closeBtn: close, //不显示关闭按钮
        shift: 2,
        shadeClose: true, //开启遮罩关闭
        content: msg
    });
}
//新增
function get_night(stime,ltime){
    var  aDate,  oDate1,  oDate2,  iDays  
    aDate  =  stime.split("-")  
	s1 = new Date(stime.replace(/-/g, "/"));
	s2 = new Date(ltime.replace(/-/g, "/"));
	var days = s2.getTime() - s1.getTime();
	var iDays = parseInt(days / (1000 * 60 * 60 * 24));
    return  iDays  
}