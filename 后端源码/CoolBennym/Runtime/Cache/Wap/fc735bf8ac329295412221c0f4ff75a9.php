<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8">
		<title><?php echo ($CONFIG["site"]["sitename"]); ?></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
		<link rel="stylesheet" href="/static/default/wap/css/base.css">
        <link rel="stylesheet" href="<?php echo ($CONFIG['config']['iocnfont']); ?>">
        <link rel="stylesheet" href="<?php echo ($CONFIG['config']['iocnfont2']); ?>">
        <link rel="stylesheet" href="/static/default/wap/css/<?php echo ($ctl); ?>.css?v=<?php echo ($today); ?>"/>
        <script src="/static/default/wap/js/jquery.js?version=<?php echo ($version); ?>"></script>
		<script src="/static/default/wap/other/layer.js?version=<?php echo ($version); ?>"></script>
    </head>
<body>


        
      


	 



<link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
<style>
.feedback .fd-main-upImgs{position:relative;width:100%;height: auto;margin-bottom:.66666667em;background:#fff}
.feedback .fd-main-upImgs .img-tips{position:absolute;right:1.30769231em;bottom:.53846154em;color:#ccc;font-size:.86666667em}
.feedback .fd-main-upImgs .upImgs-content{padding:0 1.2em;width:100%;height:100%;box-sizing:border-box}
.feedback .fd-main-upImgs .upImgs-content dt{margin-bottom:.9em;width:100%;height:2.73333333em;line-height:2.73333333em;color:#323232;font-size:1em;border-bottom:1px solid #e6e6e6}
.feedback .fd-main-upImgs .upImgs-content dd{position:relative;margin-right:.33333333em;width:4.6em;height:4.6em;border-radius:.33333333em;border:1px solid #e6e6e6;float:left;overflow:hidden; margin-top: 10px;}
.feedback .fd-main-upImgs .upImgs-content dd img{width:90%;border:none;display:block;padding-left: 5px;}
.feedback .fd-main-upImgs .upImgs-content .upload{cursor:pointer}
.feedback .fd-main-upImgs .upImgs-content .upload-ctrl{width:100%;height:100%}
.feedback .fd-main-upImgs .upImgs-content .upload:before{position:absolute;top:2.33333333em;left:.66666667em;width:3.33333333em;height:2px;background:#e6e6e6;content:""}
.feedback .fd-main-upImgs .upImgs-content .upload:after{position:absolute;top:.66666667em;left:2.33333333em;width:2px;height:3.33333333em;background:#e6e6e6;content:""}
.feedback .fd-main-tips{width:100%;height:8.53333333em;margin-bottom:.66666667em;background:#fff}
.feedback .fd-main-tips .tips-content{position:relative;padding:1.86666667em 0 0 1.2em}
.feedback .fd-main-tips .tips-content .tips-info{margin-bottom:.5em;width:17.14285714em;height:1em;line-height:1em;font-size:.93333333em}
.feedback .fd-main-tips .tips-content .tips-info:nth-child(2){margin-bottom:1em}
.feedback .fd-main-tips .tips-content .tips-tell{padding:0 0 0 2.16666667em;width:8em;height:1.73333333em;border-radius:.26666667em;background:url(../imgs/icons/icon-fd-tell.png) .5em center no-repeat #ff961b;background-size:1.16666667em}
.feedback .fd-main-tips .tips-content .tips-tell a{position:relative;display:block;text-indent:.53571429em;height:1.85714286em;line-height:1.85714286em;font-size:.93333333em;color:#fff;text-decoration:none}
.dialog .close-box .close:hover,.invita-reg .reg-true{text-decoration:underline}
.feedback .fd-main-tips .tips-content .tips-tell a:before{position:absolute;top:.42857143em;left:0;content:'';width:1px;height:1em;background:#ffd5a4}
.feedback .fd-main-tips .tips-content .tips-qrcode{position:absolute;top:1.33333333em;right:.86666667em;width:6.16666667em;height:6.16666667em}
.feedback .fd-main-tips .tips-content .tips-qrcode img{display:block;width:100%;height:100%}
.feedback .fd-btn{display:block;margin:0 auto;width:23em;height:3.26666667em;line-height:3.26666667em;color:#fff;font-size:1em;border-radius:.2em;border:none;outline:0;background:#35a6ea}
.feedback .fd-btn[disabled=disabled]{background:#ddd}
.feedback .feedback-result{position:absolute;width:100%;height:100%;top:0;left:0;z-index:10;background:#f0f0f0;transition:-webkit-transform .5s ease-in-out;transition:transform .5s ease-in-out;transition:transform .5s ease-in-out,-webkit-transform .5s ease-in-out;transform:translate3d(100%,0,0)}
.feedback .feedback-result img{display:block;padding:3.93333333em 0 1.4em;margin:0 auto;width:5.33333333em;height:5.33333333em}
.feedback .feedback-result dl dt{margin-bottom:.55555556em;color:#35a6ea;font-size:1.2em;text-align:center}
.feedback .feedback-result dl dd{margin:0 auto 2.69230769em;width:21.84615385em;color:grey;line-height:1.46153846em;font-size:.86666667em;text-align:center}
.feedback .feedback-error.show,.feedback .feedback-success.show{-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}


body {
    padding:0;
}
.checkbox{ width:26px; height:26px}
</style>



<div id="loadingToast" style="display:none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">上传中...</p>
    </div>
</div>

<div class="weui-gallery" id="gallery">
    <span class="weui-gallery__img" id="galleryImg"></span>
    <div class="weui-gallery__opr">
        <a href="javascript:" class="weui-gallery__del">
            <i class="weui-icon-delete weui-icon_gallery-delete"></i>
        </a>
    </div>
</div>
            
<div id="J_feedback">
    <div class="personal-info feedback">
        <div class="weui-cells">
            <div class="weui-cell">
            <section class="fd-main-upImgs">
                <dl class="upImgs-content">
                    <dt>上传文件</dt>
                    <dd class="upload" id="feedBackItemImgCtrl" data-imgs="0">
                        <div class="upload-ctrl" id="feedBackItemImg"></div>
                    </dd>
                </dl>
                <p class="img-tips">0/6</p>
            </section>
        </div>
     </div>
    </div> 
</div> 

<a href="javascript:;" style="margin:10px;" onclick="navigateBack()" class="weui-btn weui-btn_primary">确认</a>


<script src="https://cdn.bootcss.com/plupload/2.1.9/moxie.min.js"></script>
<script src="https://cdn.bootcss.com/plupload/2.1.9/plupload.full.min.js"></script>
<script src="https://cdn.bootcss.com/plupload/2.1.9/i18n/zh_CN.js"></script>
<script src="https://cdn.bootcss.com/qiniu-js/1.0.17.1/qiniu.min.js"></script>

<script src="https://fenxiao.jintao365.com/static/travel/js/weui.min.js"></script>
<script src="/static/default/wap/other/layer.js"></script>             
<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>





 <script>   ;
            (function(obj) {
                $(function() {
                    obj.init();
                });
            }({
                init: function() {
                    this.feedbackNode = $('#J_feedback');
                    this.loadingNode = $('#loadingToast');
                    this.feedBackItemImgCtrl = $('#feedBackItemImgCtrl');
                    this.textarea();
                    this.uploadImgs();
                    this.detailImg();
                },
                textarea: function() {
                    var tipsNode = this.feedbackNode.find('.input-tips');
                    $(document).on('input propertychange', '.input-content', function(e) {
                        var str = $.trim($(e.target).val());
                        tipsNode.text(str.length + '/300');
                        if(!str){
                            tipsNode.removeClass('green').removeClass('red');
                        }else if(str.length<6 || str.length > 300){
                            tipsNode.removeClass('green').addClass('red');
                        } else {
                            tipsNode.removeClass('red').addClass('green');
                        }
                    });
                },
                detailImg: function() {
					//alert(22);
                    var delNode = '',
                        that = this;
                    var $gallery = $('#gallery'),
                        $galleryImg = $('#galleryImg'),
                        $gallerydel = $gallery.find('.weui-gallery__del');
                    this.feedbackNode.delegate('.item-img', 'click', function(e) {
						//console.log('feedbackNode.delegate');
                        delNode = $(e.target).parent();
                        $galleryImg.attr('style', 'background-image:url(' + e.target.getAttribute('src') + ')');
                        $gallery.fadeIn(100);
                    });
                    $galleryImg.on('click', function() {
                        $gallery.fadeOut(100);
                    });
                    $gallerydel.on('click', function() {
                        weui.confirm('你确定要删除当前照片吗', function() {
                            $gallery.fadeOut(100);
                            delNode.remove();
                            var imgLen = that.feedBackItemImgCtrl.attr('data-imgs');
                            that.feedbackNode.find('.img-tips').text((Number(imgLen) - 1) + '/10');
                            that.feedBackItemImgCtrl.attr('data-imgs', Number(imgLen) - 1).show();
                        });
                    });
                },
				
				
				//图片文字赋值
                showImg: function(src,origSize,types,name) {
		
					console.log('--showImg-src---',src);
					var url = src;
					if(src.substr(0,7).toLowerCase() == "http://" || src.substr(0,8).toLowerCase() == "https://"){
						src = src;
					}else{
						src = "https://" + src;
					}
					console.log('--showImg-src2---',src);

                    var imgLen = this.feedBackItemImgCtrl.attr('data-imgs');
                    if (imgLen >= 5) {
                        this.feedBackItemImgCtrl.hide();
                    }
                    this.feedbackNode.find('.img-tips').text((Number(imgLen) + 1) + '/6');
					
					
					var fileSuf = src.slice(src.lastIndexOf('.') + 1, src.length);
					console.log('文件类型：'+fileSuf);
					
					if(fileSuf == 'pptx'){
						srcImg = '//cdn.op110.com.cn/lib/imgs/op114_h5/ppt.png';
					}else if(fileSuf == 'doc'){
						srcImg = '//cdn.op110.com.cn/lib/imgs/op114_h5/word.png';
					}else if(fileSuf == 'docx'){
						srcImg = '//cdn.op110.com.cn/lib/imgs/op114_h5/word.png';
					}else if(fileSuf == 'pdf'){
						srcImg = '//cdn.op110.com.cn/lib/imgs/op114_h5/pdf.png';
					}else if(fileSuf == 'ppt'){
						srcImg = '//cdn.op110.com.cn/lib/imgs/op114_h5/ppt.png';
					}else{
						srcImg = src;
					}
					
										
					
					//给小程序传值
					wx.miniProgram.getEnv(function (res) { 
						if (res.miniprogram) { 
							//如果当前是小程序环境
							console.log('wx.miniProgram---'+src);
							wx.miniProgram.postMessage({ 
								data: { 
									file: src,
									types:fileSuf,
									origSize:origSize,
									name:name
								}
							})
						} 
					})

					
					
                    this.feedBackItemImgCtrl.attr('data-imgs', (Number(imgLen) + 1)).before('<dd><img class="item-img" src="' + srcImg + '"/><input  type="hidden" name="photo[]" data="' + origSize + '" value="' + src + '"/><input class="demo" type="hidden" name="origSize[]" data="' + origSize + '" value="' + origSize + '"/></dd>');
                },
		
                uploadImgs: function() {
                    var that = this;
                    $.ajax({
                        url: '/app/api/upkey',
                        type: "POST",
                        dataType: "json",
                        async: false,
                        success: function(res) {
                            if (res.executeStatus == 0) {
								console.log(res);
								
								
                                var token = res.values.token;
								var uptoken_url= '/uptoken';
                                var domain = res.values.dn;
                                //图像
                                var uploader = Qiniu.uploader({
                                    runtimes: 'html5,flash,html4',
                                    browse_button: 'feedBackItemImg',
                                    uptoken: token,
									uptoken_url: uptoken_url,
                                    domain: domain,
                                    get_new_uptoken: false,
                                    container: 'feedBackItemImgCtrl',
                                    multi_selection: false,
                                    max_file_size: '24mb',
                                    max_retries: 0,
									//chunk_size: '4mb',//暂时不设置
                                    mime_types: [
                                        {title : "Image files", extensions : "jpg,jpeg,gif,png"}, //限定jpg,gif,png后缀上传
                                    ],
								
                                    dragdrop: false,
                                    drop_element: 'feedBackItemImgCtrl',
                                    
                                    auto_start: true,
									
									resize: {
									  width: 3000,
									  height: 3000,
									  crop: true,
									  quality: 100,
									  preserve_headers: false
									},

                                    filters: {
                                        max_file_size: '12mb',
                                        prevent_duplicates: true
                                    },
									
									
									
									
									
                                    init: {
                                        'FilesAdded': function(up,files){
										var type = 	files[0].type;
									
										console.log(files[0]);
										console.log(up);
										
										var zhixing = 0;
										var demo = $('.demo');
										for( var i=0;i<demo.length;i++ ){
											
											if(files[0].origSize == demo.eq(i).val()){
												zhixing = 1;
												weui.alert('请不要重复上传');
												return false;
											}
											
										}
										if(zhixing == 1){
											console.log('阻止');
											return false;
										}


										
									
                                        if(that.loadingNode.css('display') != 'none') return;
                                            that.loadingNode.fadeIn(100);
                                        },
										
										
										
                                        'FileUploaded': function(up,file,info){
											var types = file.type;
											that.loadingNode.fadeOut(10);
											weui.toast("上传成功");
											var domain = up.getOption('domain');
											var res = JSON.parse(info);
											var sourceLink = domain + '/' + res.key;
											
											console.log(file.name);
											
											that.showImg(sourceLink,file.origSize,types,file.name);
											return false;
                                        },
										
										
                                        'Error': function(up, err, errTip) {
                                            that.loadingNode.fadeOut(10);
                                            weui.alert('图片上传失败！');
											return false;
                                        }
                                    }
                                });
                            }
                        }
                    });
                }
            }));
			
			
			   
			function loadingToast(){
				var $loadingToast = $('#loadingToast');
					$('#showLoadingToast').on('click', function(){
					if($loadingToast.css('display') != 'none') return;
					$loadingToast.fadeIn(100);
					setTimeout(function () {
						$loadingToast.fadeOut(100);
					}, 2000);
				});
			}	
			   
			//返回   
			function navigateBack(){
				console.log('--navigateBack--');
				wx.miniProgram.navigateBack({
				  delta:1
				})
			}
	
</script>