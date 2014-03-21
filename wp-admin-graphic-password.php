<?php
/*
Plugin Name: WP Admin Graphic Password (by SiteGuarding.com)
Plugin URI: http://www.siteguarding.com/en/website-extensions
Description: Adds Graphic Password field for admin login page and adds a higher level of security to your website.
Version: 1.1
Author: SiteGuarding.com (SafetyBis Ltd.)
Author URI: http://www.siteguarding.com
License: GPLv2
TextDomain: plgwpagp
*/


DEFINE( 'plgwpagp_PLUGIN_URL', trailingslashit( WP_PLUGIN_URL ) . basename( dirname( __FILE__ ) ) );



error_reporting(0);

if( !is_admin() ) {

	function plgwpagp_login_form_add_field()
	{
		global $wpdb, $_SERVER;
		
		$domain = get_site_url();
        
		        $params = wpagp_GetExtraParams(1);
        if (strlen(trim($params['sg_code'])) > 0)
        {
	        unset($params['sg_code']);
	        	        ?>
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
		        SG_PrintCells($params);
		        
		        ?>
		        <div style="clear: both;height:20px;"></div>
	        </div>
	        <?php
        }
	}
	add_action( 'login_form', 'plgwpagp_login_form_add_field' );
	
	function plgwpagp_login_head_add_field()
	{
		?>
		<?php  ?>
		<?php
	}
	add_action( 'login_head', 'plgwpagp_login_head_add_field' );


	function plgwpagp_authenticate( $raw_user, $username )
	{
                
        if ($raw_user->roles[0] == 'administrator')
        {
        	$params = wpagp_GetExtraParams(1);
			if ( trim($params['sg_code']) != trim($_POST['sg_code']) )	
			{
    			add_action( 'login_head', 'wp_shake_js', 12 );
    			return new WP_Error( 'authentication_failed', __( '<strong>ERROR</strong>: Graphic Password is invalid.', 'plgwpagp' ) );
			}
        }

        return $raw_user;
	}
	add_filter( 'authenticate', 'plgwpagp_authenticate', 999, 2 );
    

    
}   





if( is_admin() ) {
    
    
	add_action('admin_menu', 'register_plgwpagp_settings_page');

	function register_plgwpagp_settings_page() {
		add_submenu_page( 'options-general.php', 'Graphic Password', 'Graphic Password', 'manage_options', 'lgwpagp_settings_page', 'plgwpagp_settings_page_callback' ); 
	}

	function plgwpagp_settings_page_callback() 
	{
		$domain = get_site_url();
		$image_url = plugins_url('images/', __FILE__);
				
		if ($_POST['action'] == 'update')
		{
			$params = array(
				'image_num' => $_POST['image_num'],
				'sg_code' => $_POST['sg_code']
			);
			wpagp_SetExtraParams(1, $params);
			echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';

		}
		else $params = wpagp_GetExtraParams(1);
				
		
		echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
			echo '<h2>Admin Graphic Password Settings</h2>';
			?>

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
			<th scope="row" style="padding-left:10px"><?php _e( 'Select Image', 'plgwpap' )?></th>
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
				
				for ($i = 1; $i <= 8; $i++)
				{
					?>
					<img onclick="SelectImg(<?php echo $i; ?>)" class="img_thumb" id="password_img_<?php echo $i; ?>" src="<?php echo $image_url.'image'.$i.'.jpg'; ?>"/>
					<?php
				}
				?>
	            <input type="hidden" name="image_num" id="image_num" value="<?php echo $params['image_num']; ?>">
			</td>
			</tr>
			
			<tr class="line_4">
			<th scope="row" style="padding-left:10px"></th>
			<td>



			<p>Click the cells to select new graphic password</p>

			<?php SG_PrintCells($params); ?>


			</td>
			</tr>
			<?php ?>
			</table>
			
<p class="submit">
  <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
</p>

<input type="hidden" name="page" value="lgwpagp_settings_page"/>
<input type="hidden" name="action" value="update"/>
</form>
			<?php
			
		echo '</div>';
	
	}

 
 
    
	function plgwpagp_activation()
	{
		global $wpdb, $current_user;
		$table_name = $wpdb->prefix . 'plgwpagp_config';
		if( $wpdb->get_var( 'SHOW TABLES LIKE "' . $table_name .'"' ) != $table_name ) {
			$sql = 'CREATE TABLE IF NOT EXISTS '. $table_name . ' (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `var_name` char(255) CHARACTER SET utf8 NOT NULL,
                `var_value` char(255) CHARACTER SET utf8 NOT NULL,
                PRIMARY KEY (`id`),
                KEY `user_id` (`user_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;';
            

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );             
            		}
	}
	register_activation_hook( __FILE__, 'plgwpagp_activation' );
    
    
	function plgwpagp_uninstall()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'plgwpagp_config';
		$wpdb->query( 'DROP TABLE ' . $table_name );
	}
	register_uninstall_hook( __FILE__, 'plgwpagp_uninstall' );
	

}





function SG_PrintCells($params)
{
	$domain = get_site_url();
	$image_url = plugins_url('images/', __FILE__);
	
	?>
	<style>
	#sg_password_area{width:500px;height:300px; background-image: url('<?php if (intval($params['image_num'])>0) echo $image_url.'image'.$params['image_num'].'.jpg'; ?>');position: relative;border: 1px solid #000;}
	#sg_canvas{position: absolute; top:0; left:0; z-index: 1;}
	.sg_cell{width:99px;height:99px;border-right: 1px dashed #fff;border-bottom: 1px dashed #fff;position: absolute;z-index: 2;}
	</style>
	<div id="sg_password_area">
	<canvas id="sg_canvas" width="500" height="300"></canvas>
	<?php
		$cell_h = 100;
		$cell_w = 100;
		$max_w = 500;
		$start_x = 0;
		$start_y = 0;
		for ($i = 1; $i<=15; $i++)
		{
			echo '<div id="sg_cell_'.$i.'" class="sg_cell" style="top:'.$start_y.'px; left:'.$start_x.'px" onclick="SG_DrawLine(this, '.$i.');"></div>';
			$start_x += $cell_w;
			if ($start_x >= $max_w)
			{
				$start_x = 0;
				$start_y += $cell_h;	
			}	
		}
	?>
	</div>
	
	<script>
	var sg_cell_h = <?php echo $cell_h; ?>;
	var sg_cell_w = <?php echo $cell_w; ?>;
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
	<input type="hidden" value="<?php echo $params['sg_code']; ?>" name="sg_code" id="sg_code"/>
	
	<?php
}





function wpagp_GetExtraParams($user_id = 1)
{
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'plgwpagp_config';
    
    $rows = $wpdb->get_results( 
    	"
    	SELECT *
    	FROM ".$table_name."
    	WHERE user_id = '".$user_id."' 
    	"
    );
    
    $a = array();
    if (count($rows))
    {
        foreach ( $rows as $row ) 
        {
        	$a[trim($row->var_name)] = trim($row->var_value);
        }
    }
        
    return $a;
}


function wpagp_SetExtraParams($user_id = 1, $data = array())
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'plgwpagp_config';

    if (count($data) == 0) return;   
    
    foreach ($data as $k => $v)
    {
                $tmp = $wpdb->get_var( $wpdb->prepare( 'SELECT COUNT(*) FROM ' . $table_name . ' WHERE user_id = %d AND var_name = %s LIMIT 1;', $user_id, $k ) );
        
        if ($tmp == 0)
        {
                        $wpdb->insert( $table_name, array( 'user_id' => $user_id, 'var_name' => $k, 'var_value' => $v ) ); 
        }
        else {
                        $data = array('var_value'=>$v);
            $where = array('user_id' => $user_id, 'var_name' => $k);
            $wpdb->update( $table_name, $data, $where );
        }
    } 
}





?>