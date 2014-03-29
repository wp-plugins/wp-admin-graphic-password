<?php
/*
Plugin Name: WP Admin Graphic Password (by SiteGuarding.com)
Plugin URI: http://www.siteguarding.com/en/website-extensions
Description: Adds Graphic Password field for admin login page and adds a higher level of security to your website.
Version: 1.2
Author: SiteGuarding.com (SafetyBis Ltd.)
Author URI: http://www.siteguarding.com
License: GPLv2
TextDomain: plgwpagp
*/
if(!is_admin()){function plgwpagp_login_form_add_field(){global $wpdb;$domain=get_site_url();$params=wpagp_GetExtraParams(1);if(strlen(trim($params['sg_code']))>0){unset($params['sg_code']);?>
	        <style>.login_wide {width: 550px!important;}#loginform{position: relative!important;}</style>
	        <script>
	        var sg_a = 0;
			function SG_ShowImage()
			{
				var element_login = document.getElementById("login");
				var sg_password_block = document.getElementById("sg_password_block");
				
				if (sg_a == 0) {SG_addClass("login_wide", element_login); sg_password_block.style.display="inline";}
				if (sg_a == 1) {SG_removeClass("login_wide", element_login);  sg_password_block.style.display="none";}
				sg_a = 1 - sg_a;
			}
			
			function SG_addClass( classname, element ) {
			    var cn = element.className;
			    //test for existance
			    if( cn.indexOf( classname ) != -1 ) {
			    	return;
			    }
			    //add a space if the element already has class
			    if( cn != '' ) {
			    	classname = ' '+classname;
			    }
			    element.className = cn+classname;
			}
			
			function SG_removeClass( classname, element ) {
			    var cn = element.className;
			    var rxp = new RegExp( "\\s?\\b"+classname+"\\b", "g" );
			    cn = cn.replace( rxp, '' );
			    element.className = cn;
			}
	
			</script>
			<a style="top: 2px; position: absolute; right: 2px;" href="javascript:;" onclick="SG_ShowImage()"><img width="32" height="32" src="data:image/png;base64,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"/></a>
	        <div id="sg_password_block" style="display:none;">
		        <?php
 SG_PrintCells($params);?>
		        <div style="clear: both;height:20px;"></div>
	        </div>
	        <?php
}}add_action('login_form','plgwpagp_login_form_add_field');function plgwpagp_authenticate($raw_user,$username){if(isset($raw_user->roles)&&$raw_user->roles[0]=='administrator'){$params=wpagp_GetExtraParams(1);if(trim($params['sg_code'])!=trim($_POST['sg_code'])){$message='<span style="color:#D54E21">Someone has tried to login as <b>administrator</b> to '.get_site_url().' with the correct username and password, but wrong graphic password.</span><br><br>If it\'s not you, please change your password.';wpagp_NotifyAdmin($message,'Failed login');add_action('login_head','wp_shake_js',12);return new WP_Error('authentication_failed',__('<strong>ERROR</strong>: Graphic Password is invalid.','plgwpagp'));}$message='Administrator successfully has logged to '.get_site_url().'<br><br>If you didn\'t login, please change your password.';wpagp_NotifyAdmin($message,'Successful login');}return $raw_user;}add_filter('authenticate','plgwpagp_authenticate',999,2);}if(is_admin()){add_action('admin_menu','register_plgwpagp_settings_page');function register_plgwpagp_settings_page(){add_submenu_page('options-general.php','Graphic Password','Graphic Password','manage_options','lgwpagp_settings_page','plgwpagp_settings_page_callback');}function plgwpagp_settings_page_callback(){$domain=get_site_url();$image_url=plugins_url('images/',__FILE__);if(isset($_POST['action'])&&$_POST['action']=='update'&&check_admin_referer('name_254f4bd3ea8d')){if(isset($_POST['notify_developer']))$notify_developer=intval($_POST['notify_developer']);else $notify_developer=0;$notify_developer_sent=intval($_POST['notify_developer_sent']);if($notify_developer&&$notify_developer_sent==0){$notify_developer_sent=1;wpagp_NotityDeveloper();}$params=array('image_num'=>$_POST['image_num'],'notify_developer'=>$notify_developer,'notify_developer_sent'=>$notify_developer_sent,'sg_code'=>$_POST['sg_code']);wpagp_SetExtraParams(1,$params);echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';}else $params=wpagp_GetExtraParams(1);echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';echo '<h2>Admin Graphic Password Settings</h2>';?>

<script>
function SG_CheckForm(form)
{
	var v_el=document.getElementById("sg_code");
	if (v_el.value == '') {
		alert('Graphic password is not set.');	
		return false;
	} else return true;
}
</script>
<form method="post" action="options-general.php?page=lgwpagp_settings_page" onsubmit="return SG_CheckForm(this);">

			<style>
			.img_thumb {height:60px; width: 100px; float:left; margin:0 10px 10px 0;}
			.img_selected {border:5px solid #af1b1b;padding:2px}
			</style>
			<table>
			<tr class="line_4">
			<th scope="row" style="padding-left:10px"><?php _e('Select Image','plgwpap')?></th>
			<td>
				<script>
				function SelectImg(id)
				{
					var image_el=document.getElementById("image_num");
					image_el.value = id;
					jQuery(".img_thumb").removeClass('img_selected');
					jQuery("#password_img_"+id).addClass('img_selected');
					
					jQuery("#sg_password_area").attr("style", "background-image:url('<?php echo $image_url.'image';?>"+id+".jpg')");
				}
				</script>
				<?php
 for($i=1;$i<=8;$i++){?>
					<img onclick="SelectImg(<?php echo $i;?>)" class="img_thumb <?php if($params['image_num']==$i)echo 'img_selected';?>" id="password_img_<?php echo $i;?>" src="<?php echo $image_url.'image'.$i.'.jpg';?>"/>
					<?php
}?>
	            <input type="hidden" name="image_num" id="image_num" value="<?php echo esc_attr($params['image_num']);?>">
			</td>
			</tr>
			
			<tr class="line_4">
			<th scope="row" style="padding-left:10px"></th>
			<td>



			<p>Click the cells to select new graphic password</p>

			<?php SG_PrintCells($params);?>
			
			</td>
			</tr>
			
			<?php
 if(!isset($params['notify_developer']))$params['notify_developer']=0;?>
			<?php ?>
			</tr>
			<tr class="line_4">
			<th scope="row" style="padding-left:10px"><?php _e('Notify developers','plgwpap')?></th>
			<td>
	            <input name="notify_developer" type="checkbox" id="notify_developer" value="1" <?php if(intval($params['notify_developer'])==1)echo 'checked="checked"';?>> I agree to notify developers about this installation.
	            <input name="notify_developer_sent" type="hidden" value="<?php echo intval($params['notify_developer_sent']);?>">
			</td>
			</tr>
			
			<?php ?>
			</table>

<?php
wp_nonce_field('name_254f4bd3ea8d');?>			
<p class="submit">
  <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
</p>

<input type="hidden" name="page" value="lgwpagp_settings_page"/>
<input type="hidden" name="action" value="update"/>
</form>
			<?php
 echo '</div>';}function plgwpagp_activation(){global $wpdb;$table_name=$wpdb->prefix.'plgwpagp_config';if($wpdb->get_var('SHOW TABLES LIKE "'.$table_name.'"')!=$table_name){$sql='CREATE TABLE IF NOT EXISTS '.$table_name.' (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `var_name` char(255) CHARACTER SET utf8 NOT NULL,
                `var_value` char(255) CHARACTER SET utf8 NOT NULL,
                PRIMARY KEY (`id`),
                KEY `user_id` (`user_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';require_once(ABSPATH.'wp-admin/includes/upgrade.php');dbDelta($sql);}}register_activation_hook(__FILE__,'plgwpagp_activation');function plgwpagp_uninstall(){global $wpdb;$table_name=$wpdb->prefix.'plgwpagp_config';$wpdb->query('DROP TABLE '.$table_name);}register_uninstall_hook(__FILE__,'plgwpagp_uninstall');}function SG_PrintCells($params){$domain=get_site_url();$image_url=plugins_url('images/',__FILE__);?>
	<style>
	#sg_password_area{width:500px;height:300px; background-image: url('<?php if(intval($params['image_num'])>0)echo $image_url.'image'.$params['image_num'].'.jpg';?>');position: relative;border: 1px solid #000;}
	#sg_canvas{position: absolute; top:0; left:0; z-index: 1;}
	.sg_cell{width:99px;height:99px;border-right: 1px dashed #fff;border-bottom: 1px dashed #fff;position: absolute;z-index: 2;}
	</style>
	<div id="sg_password_area">
	<canvas id="sg_canvas" width="500" height="300"></canvas>
	<?php
 $cell_h=100;$cell_w=100;$max_w=500;$start_x=0;$start_y=0;for($i=1;$i<=15;$i++){echo '<div id="sg_cell_'.$i.'" class="sg_cell" style="top:'.$start_y.'px; left:'.$start_x.'px" onclick="SG_DrawLine(this, '.$i.');"></div>';$start_x+=$cell_w;if($start_x>=$max_w){$start_x=0;$start_y+=$cell_h;}}?>
	</div>
	
	<script>
	var sg_cell_h = <?php echo $cell_h;?>;
	var sg_cell_w = <?php echo $cell_w;?>;
	var sg_lineWidth = 40;
	var sg_line_color = '#cc0000';
	
	var start_x = 0;
	var start_y = 0;
	var step_h = sg_cell_h / 2;
	var step_w = sg_cell_w / 2;
	var last_num = 0;
	
	function SG_DrawLine(el, num)
	{
		var v_el=document.getElementById("sg_code");
		if (last_num == num) return;
		
		var c=document.getElementById("sg_canvas");
		var ctx=c.getContext("2d");
	
		var x = el.offsetLeft;
		var y = el.offsetTop;
	
		ctx.beginPath();
		ctx.arc(x+step_w,y+step_h,sg_lineWidth/2,0,2*Math.PI, false);
		ctx.fillStyle = sg_line_color;
		ctx.fill();
		ctx.lineWidth = 1;
		ctx.strokeStyle=sg_line_color;
		ctx.stroke();
		
		//alert(x+'='+y);
		if (start_x > 0 || start_y > 0)
		{
			ctx.lineWidth = sg_lineWidth;
			ctx.strokeStyle=sg_line_color;
			ctx.beginPath();
			ctx.moveTo(start_x, start_y);
			ctx.lineTo(x+step_w,y+step_h);
			ctx.stroke();
		}
		else v_el.value = '';
		
		start_x = x+step_w;
		start_y = y+step_h;
		
		v_el.value = v_el.value + num + "-";
		last_num = num;
	}
	
	function SG_Refresh()
	{
		var v_el=document.getElementById("sg_code");
		var c=document.getElementById("sg_canvas");
		var ctx=c.getContext("2d");
		ctx.clearRect(0, 0, c.width, c.height);	
		start_x = start_y = last_num = 0;
		v_el.value = '';
	}
	
	</script>
	<p><a style="margin-top:5px" class="button" href="javascript:;" onclick="SG_Refresh()">Clear</a></p>
	<input type="hidden" value="<?php echo esc_attr($params['sg_code']);?>" name="sg_code" id="sg_code"/>
	
	<?php
}function wpagp_NotityDeveloper(){$link='http://www.siteguarding.com/_advert.php?action=inform&type=json&text=';$domain=get_site_url();$email=get_option('admin_email');$data=array('domain'=>$domain,'email_1'=>$email,'product'=>'WP Admin Graphic Password');$link.=base64_encode(json_encode($data));$msg=file_get_contents($link);}function wpagp_GetExtraParams($user_id=1){global $wpdb;$table_name=$wpdb->prefix.'plgwpagp_config';$rows=$wpdb->get_results("
    	SELECT *
    	FROM ".$table_name."
    	WHERE user_id = '".$user_id."' 
    	");$a=array();if(count($rows)){foreach($rows as $row){$a[trim($row->var_name)]=trim($row->var_value);}}return $a;}function wpagp_SetExtraParams($user_id=1,$data=array()){global $wpdb;$table_name=$wpdb->prefix.'plgwpagp_config';if(count($data)==0)return;foreach($data as $k=>$v){$tmp=$wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM '.$table_name.' WHERE user_id = %d AND var_name = %s LIMIT 1;',$user_id,$k));if($tmp==0){$wpdb->insert($table_name,array('user_id'=>$user_id,'var_name'=>$k,'var_value'=>$v));}else{$data=array('var_value'=>$v);$where=array('user_id'=>$user_id,'var_name'=>$k);$wpdb->update($table_name,$data,$where);}}}function wpagp_NotifyAdmin($message='',$subject='',$data=array()){$domain=get_site_url();$body_message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SiteGuarding - Professional Web Security Services!</title>
</head>
<body bgcolor="#ECECEC">
<table cellpadding="0" cellspacing="0" width="100%" align="center" border="0">
  <tr>
    <td width="100%" align="center" bgcolor="#ECECEC" style="padding: 5px 30px 20px 30px;">
      <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#fff" style="background-color: #fff;">
        <tr>
          <td width="750" bgcolor="#fff"><table width="750" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" style="background-color: #fff;">
            <tr>
              <td width="350" height="60" bgcolor="#fff" style="padding: 5px; background-color: #fff;"><a href="http://www.siteguarding.com/" target="_blank"><img src="data:image/gif;base64,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" alt="SiteGuarding - Protect your website from unathorized access, malware and other threat" height="60" border="0" style="display:block" /></a></td>
              <td width="400" height="60" align="right" bgcolor="#fff" style="background-color: #fff;">
              <table border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" style="background-color: #fff;">
                <tr>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><a href="http://www.siteguarding.com/en/login" target="_blank" style="color:#656565; text-decoration: none;">Login</a></td>
                  <td width="15"></td>
                  <td width="1" bgcolor="#656565"></td>
                  <td width="15"></td>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><a href="http://www.siteguarding.com/en/prices" target="_blank" style="color:#656565; text-decoration: none;">Services</a></td>
                  <td width="15"></td>
                  <td width="1" bgcolor="#656565"></td>
                  <td width="15"></td>
                  <td style="font-family:Arial, Helvetica, sans-serif; font-size:11px;"><a href="http://www.siteguarding.com/en/what-to-do-if-your-website-has-been-hacked" target="_blank" style="color:#656565; text-decoration: none;">Security Tips</a></td>            
                  <td width="15"></td>
                  <td width="1" bgcolor="#656565"></td>
                  <td width="15"></td>
                  <td style="font-family:Arial, Helvetica, sans-serif;  font-size:11px;"><a href="http://www.siteguarding.com/en/contacts" target="_blank" style="color:#656565; text-decoration: none;">Contacts</a></td>
                  <td width="30"></td>
                </tr>
              </table>
              </td>
            </tr>
          </table></td>
        </tr>

        <tr>
          <td width="750" height="2" bgcolor="#D9D9D9"></td>
        </tr>
        <tr>
          <td width="750" bgcolor="#fff" ><table width="750" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" style="background-color:#fff;">
            <tr>
              <td width="750" height="30"></td>
            </tr>
            <tr>
              <td width="750">
                <table width="750" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" style="background-color:#fff;">
                <tr>
                  <td width="30"></td>
                  <td width="690" bgcolor="#fff" align="left" style="background-color:#fff; font-family:Arial, Helvetica, sans-serif; color:#000000; font-size:12px;">
                    <br />
                    {MESSAGE_CONTENT}
                  </td>
                  <td width="30"></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td width="750" height="15"></td>
            </tr>
            <tr>
              <td width="750" height="15"></td>
            </tr>
            <tr>
              <td width="750"><table width="750" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="30"></td>
                  <td width="690" align="left" style="font-family:Arial, Helvetica, sans-serif; color:#000000; font-size:12px;"><strong>How can we help?</strong><br />
                    If you have any questions please dont hesitate to contact us. Our support team will be happy to answer your questions 24 hours a day, 7 days a week. You can contact us at <a href="mailto:support@siteguarding.com" style="color:#2C8D2C;"><strong>support@siteguarding.com</strong></a>.<br />
                    <br />
                    Thanks again for choosing SiteGuarding as your security partner!<br />
                    <br />
                    <span style="color:#2C8D2C;"><strong>SiteGuarding Team</strong></span><br />
                    <span style="font-family:Arial, Helvetica, sans-serif; color:#000; font-size:11px;"><strong>We will help you to protect your website from unauthorized access, malware and other threats.</strong></span></td>
                  <td width="30"></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td width="750" height="30"></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td width="750" height="2" bgcolor="#D9D9D9"></td>
        </tr>
      </table>
      <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="750" height="10"></td>
        </tr>
        <tr>
          <td width="750" align="center"><table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td style="font-family:Arial, Helvetica, sans-serif; color:#ffffff; font-size:10px;"><a href="http://www.siteguarding.com/en/website-daily-scanning-and-analysis" target="_blank" style="color:#656565; text-decoration: none;">Website Daily Scanning</a></td>
              <td width="15"></td>
              <td width="1" bgcolor="#656565"></td>
              <td width="15"></td>
              <td style="font-family:Arial, Helvetica, sans-serif; color:#ffffff; font-size:10px;"><a href="http://www.siteguarding.com/en/malware-backdoor-removal" target="_blank" style="color:#656565; text-decoration: none;">Malware & Backdoor Removal</a></td>
              <td width="15"></td>
              <td width="1" bgcolor="#656565"></td>
              <td width="15"></td>
              <td style="font-family:Arial, Helvetica, sans-serif; color:#ffffff; font-size:10px;"><a href="http://www.siteguarding.com/en/update-scripts-on-your-website" target="_blank" style="color:#656565; text-decoration: none;">Security Analyze & Update</a></td>
              <td width="15"></td>
              <td width="1" bgcolor="#656565"></td>
              <td width="15"></td>
              <td style="font-family:Arial, Helvetica, sans-serif; color:#ffffff; font-size:10px;"><a href="http://www.siteguarding.com/en/website-development-and-promotion" target="_blank" style="color:#656565; text-decoration: none;">Website Development</a></td>
            </tr>
          </table></td>
        </tr>

        <tr>
          <td width="750" height="10"></td>
        </tr>
        <tr>
          <td width="750" align="center" style="font-family: Arial,Helvetica,sans-serif; font-size: 10px; color: #656565;">Add <a href="mailto:support@siteguarding.com" style="color:#656565">support@siteguarding.com</a> to the trusted senders list.</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>';$admin_email=get_option('admin_email');$message.="<br><br><b>User Information</b></br>";$message.='Date: <span style="color:#D54E21">{DATE}</span>'."<br>";$message.="IP Address: {IP}<br>";$message.="Browser: {BROWSER}<br>";$txt=$message;$a=array("{IP}","{DATE}","{BROWSER}");$b=array($_SERVER['REMOTE_ADDR'],date("Y-m-d H:i:s"),$_SERVER['HTTP_USER_AGEN/tableT']);$txt=str_replace($a,$b,$txt);$body_message=str_replace("{MESSAGE_CONTENT}",$txt,$body_message);$subject=$subject.' to '.get_site_url().' (protected by SiteGuarding.com)';$headers='content-type: text/html';@wp_mail($admin_email,$subject,$body_message,$headers);}?>