<?php if (!defined('THINK_PATH')) exit();?><div class="listBox clfx">
    <div class="menuManage">
        <form target="x-frame" action="<?php echo U('user/edit',array('user_id'=>$detail['user_id']));?>" method="post">
            <div class="main-tudou-sc-add">
                <div class="tu-table-box">
                    <table  bordercolor="#dbdbdb" cellspacing="0" width="100%" border="1px"  style=" border-collapse: collapse; margin:0px; vertical-align:middle; background-color:#FFF;" >
                        <tr>
                            <td class="tu-left-td">账户：</td>
                            <td class="tu-right-td"><input type="text" name="data[account]" value="<?php echo (($detail["account"])?($detail["account"]):''); ?>" class="tudou-sc-add-text-name w200" />
                                <code>账号只允许手机或邮件</code>
                            </td>
                        </tr>
                        <tr>
                            <td class="tu-left-td">密码：</td>
                            <td class="tu-right-td"><input type="password" name="data[password]" value="******" class="tudou-sc-add-text-name w200" />
                            <code>建议6位以上的密码</code>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="tu-left-td">昵称：</td>
                            <td class="tu-right-td"><input type="text" name="data[nickname]" value="<?php echo (($detail["nickname"])?($detail["nickname"]):''); ?>" class="tudou-sc-add-text-name w200" />
                            </td>
                        </tr>

                        <tr>
                            <td class="tu-left-td">用户手机号：</td>
                            <td class="tu-right-td"><input type="text" name="data[mobile]" value="<?php echo (($detail["mobile"])?($detail["mobile"]):''); ?>" class="tudou-sc-add-text-name w200" />
							<code>除非特殊情况，一般不要去修改！</code>
                            </td>
                        </tr>
                        <tr>
                            <td class="tu-left-td">用户邮箱：</td>
                            <td class="tu-right-td"><input type="text" name="data[email]" value="<?php echo (($detail["email"])?($detail["email"]):''); ?>" class="tudou-sc-add-text-name w200" />
							<code>除非特殊情况，一般不要去修改</code>
                            </td>
                        </tr>

                        <tr>
                            <td class="tu-left-td">用户等级：</td>
                            <td class="tu-right-td">
                                <select name="data[rank_id]" class="seleFl w200">
                                <option value="0">请选择等级</option>
                                    <?php if(is_array($ranks)): foreach($ranks as $key=>$item): ?><option <?php if(($item["rank_id"]) == $detail["rank_id"]): ?>selected="selected"<?php endif; ?>  value="<?php echo ($item["rank_id"]); ?>"><?php echo ($item["rank_name"]); ?></option><?php endforeach; endif; ?>
                                </select>
                                <code>这里可修改会员等级，不过一般不建议修改</code>
                            </td>
                        </tr>
                        
                        


                       <tr>
                    <td class="tu-left-td">头像：</td>
                 <td class="tu-right-td">
                    <div style="width: 300px;height: 100px; float: left;">
                        <input type="hidden" name="data[face]" value="<?php echo ($detail["face"]); ?>" id="data_face" />
                        <div id="fileToUpload" >上传头像</div>
                    </div>
                    <div style="width: 300px;height: 100px; float: left;">
                        <img id="face_img" width="120" height="80"  src="<?php echo config_img($detail['face']);?>" />
                        <a href="<?php echo U('setting/attachs');?>">头像设置</a>
                        建议尺寸<?php echo ($CONFIG["attachs"]["user"]["thumb"]); ?>
                    </div>
                    <script>                                            
						var width_user = '<?php echo thumbSize($CONFIG[attachs][user][thumb],0);?>';                         
						var height_user = '<?php echo thumbSize($CONFIG[attachs][user][thumb],1);?>';                         
						var uploader = WebUploader.create({                             
						auto: true,                             
						swf: '/static/default/webuploader/Uploader.swf',                             
						server: '<?php echo U("app/upload/uploadify",array("model"=>"user"));?>',                             
						pick: '#fileToUpload',                             
						resize: true,  
						compress : {width: width_user,height: height_user,quality: 80,allowMagnify: false,crop: true}                       
					});                                                 
					uploader.on( 'uploadSuccess', function( file,resporse) {                             
						$("#data_face").val(resporse.url);                             
						$("#face_img").attr('src',resporse.url).show();                         
					});                                                
					uploader.on( 'uploadError', function( file ) {                             
						alert('上传出错');                         
					});                     
                    </script>
                </td>
            </tr>

                    </table>
                </div>
                <div class="sm-qr-tu"><input type="submit" value="确定编辑" class="sm-tudou-btn-input" /></div>
            </div>
        </form>
    </div>
</div>