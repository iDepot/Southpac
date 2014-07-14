<?php
/*
Plugin Name: WP Newsletter
Plugin URI: http://www.georgijevic.info/wordpress-newsletter/
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9CY9DKMUGZB6Q
Description: Send Newsletters to all your WordPress commenter and registered users. Supports HTML, so a little more skilled users can send very decent newsletters.
Version: 0.1.3
Author: Radovan Georgijevic
Author URI: http://www.georgijevic.info/

*/

if(!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
}
define('WP_NEWSLETTER_URL', WP_CONTENT_URL.'/plugins/'.dirname(plugin_basename(__FILE__)));

function load_newsletter_textdomain(){
	load_plugin_textdomain('wp-newsletter', false, basename(dirname(__FILE__)).'/lang');
}

if(!function_exists('wpframe_add_editor_js')) { //Make sure multiple plugins can be created using WPFrame
/// Adds the JS code needed for the editor. Changes often. So made it centralized
	function wpframe_add_editor_js() {
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'jquery-color' );
		wp_print_scripts('editor');
		if (function_exists('add_thickbox')) add_thickbox();
		wp_print_scripts('media-upload');
		if (function_exists('wp_tiny_mce')) wp_tiny_mce();
		wp_admin_css();
		wp_enqueue_script('utils');
		do_action("admin_print_styles-post-php");
		do_action('admin_print_styles');
	}
}

if(is_admin() && $_GET['page'] == 'newsletter' && !isset($_POST['one_by_one'])) {
	add_action('init', 'load_newsletter_textdomain');
	wp_enqueue_style('wp-newsletter-style', WP_NEWSLETTER_URL.'/wp-newsletter.css');
	wp_enqueue_script('wp-newsletter-script', WP_NEWSLETTER_URL.'/wp-newsletter.js', array('jquery'), '');
	wp_enqueue_script('jquery');
} elseif($_GET['wpmm_unsubscribe']) {
	$email_address = $_GET['email'];
	$emailmd5 = substr($_GET['wpmm_unsubscribe'], 0, 32);
	$time = base64_decode(substr($_GET['wpmm_unsubscribe'], 32));
	$unsubscribe_list = get_option('WPNewsletter_unsubscribe_list');
	if(!$unsubscribe_list) $unsubscribe_list = array();
	if((time() - 15*24*60*60) < $time && md5($email_address) == $emailmd5) {
		$unsubscribe_list[] = $email_address;
		update_option('WPNewsletter_unsubscribe_list', $unsubscribe_list);
	}
}

add_action('admin_menu', 'WPNewsletter_admin_menu');

function WPNewsletter_admin_menu() {
	add_menu_page(__('WP Newsletter', 'wp-newsletter'), __('WP Newsletter', 'wp-newsletter'), 8, 'newsletter', 'newsletter_page');
}

function newsletter_page() {
	if(isset($_POST['one_by_one'])) {
		$recipient_group = $_POST['recipient_group'];
		$subject = '=?'.get_option('blog_charset').'?B?'.base64_encode($_POST['subject']).'?=';
		$message = sprintf(__('%s<p><strong>This email sent by <a href="%s" target="_blank">%s</a> using the <a href="http://www.georgijevic.info/wordpress-newsletter/" target="_blank">WP Newsletter</a> plugin.<br />Please do not reply this email. Thank you!!!<br />If you do not want to receive such messages, please <a href="%s[wpmmunsubscribe]" title="Unsubscribe">unsubscribe</a>!</strong></p>'), stripslashes($_POST['message']), get_bloginfo('url'), get_bloginfo('name'), get_bloginfo('url'));
		//$attachments = array(WP_CONTENT_DIR . '/uploads/file_to_attach.zip');
		$no_reply = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
		$from = 'From: '.$blogname.' <'.$no_reply.'>';
		$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
		$email_list = explode('|', $_POST['email_list']);
		$start_email = $_POST['start_email'];
		$end_email = $_POST['end_email'];
		for($i=$start_email;$i<$end_email;$i++) {
			$email = base64_encode($email_list[$i]);
			$wpmm_unsubscribe = md5($email_list[$i]).base64_encode(time());
			$message = str_replace('[wpmmunsubscribe]', '?email='.$email_list[$i].'&wpmm_unsubscribe='.$wpmm_unsubscribe, $message);
			if($email_list[$i] != '') {
				wp_mail($email_list[$i], $subject, $message, $headers);//, $attachments);
			}
		}
		exit();
	} elseif(isset($_POST['WPNewsletter_send'])) {
		$per_time_send = $_POST['per_time_send'];
		$recipient_group = $_POST['recipient_group'];
		$subject = $_POST['subject'];
		$br_encode = array("\r\n", "\n");
		$message = str_replace($br_encode, '<br />', stripslashes($_POST['message']));
		$email_list = array();
		$email_queue = '';

		if($recipient_group != 'commenter_only' && $recipient_group != 'post_comments') {
			$blogusers = get_users_of_blog();
			if ($blogusers) {
				foreach ($blogusers as $bloguser) {
					$user_info = get_userdata($bloguser->user_id);
					$email_list[$user_info->user_email] = $user_info->display_name;
				}
			}
		}

		if($recipient_group != 'user_only') {
			if($recipient_group == 'post_comments') {
				$post_id = 'post_id='.$_POST['post_id'];
			} else {
				$post_id = '';
			}
			$comments = get_comments($post_id);
			foreach($comments as $comm) {
				$email_list[$comm->comment_author_email] = $comm->comment_author;
			}
		}

		$unsubscribe_list = get_option('WPNewsletter_unsubscribe_list');
		if($unsubscribe_list) {
			$email_list = array_diff($email_list, $unsubscribe_list);
		}

		$email_count = count($email_list);

		foreach($email_list as $address => $name ) {
			$email_queue .= $address.'|';
		}
?>
<script type="text/javascript">
var email_count = '<?php echo $email_count; ?>';
(function($) {
	$(document).ready(function() {
		wp_mass_send();
	});
})(jQuery);
</script>
<div class="wrap">
<div class="icon32" id="icon-themes"><br/></div>
<h2><?php _e('WP Newsletter', 'wp-newsletter'); ?></h2>
<div class="updated fade" id="sent_successfully" style="display:none;"><p><strong>All email sent successfully!</strong></p></div>
<div class="metabox-holder" id="poststuff">

<div class="stuffbox">
<h3><label for="link_url"><?php _e('Sending emails(Do not close your browser!)', 'wp-newsletter');?></label></h3>
<div class="inside">
<table width="100%" border="0" style="padding:10px;">
<tbody>
<tr>
	<td><div id="loading_bar_parent"><div id="loading_bar"></div><div id="loading_bar_text"><span class="sending"><?php _e('Sending......', 'wp-newsletter');?></span><span class="sended" style="display:none"><?php _e('Send completed', 'wp-newsletter');?></span><span id="newsletter_sending">(0/<?php echo $email_count; ?>)</span></div></div></td>
</tr>
</tbody>
</table>
<form method="post" id="mass_mail_send">
<input type="hidden" name="one_by_one" id="one_by_one" value="1" />
<input type="hidden" name="subject" id="subject" value="<?php echo $subject; ?>" />
<textarea rows="" cols="" type="textarea" style="width: 100%; height: 373px; display:none;" name="message" id="message" /><?php echo $message; ?></textarea>
<input type="hidden" name="email_list" id="email_list" value="<?php echo $email_queue; ?>" />
<input type="hidden" name="per_time_send" id="per_time_send" value="<?php echo $per_time_send; ?>" />
</form>
</div>
</div>
<?php
	} else {
?>
<div class="wrap">
<div class="icon32" id="icon-themes"><br/></div>
<h2><?php _e('WP Newsletter', 'wp-newsletter'); ?></h2>
<div class="metabox-holder" id="poststuff">
<?php wpframe_add_editor_js(); ?>
<div class="stuffbox">
<h3><label for="link_url"><?php _e('Write mail', 'wp-newsletter');?></label></h3>
<div class="inside">
<form method="post" id="wp_newsletter">
<table width="100%" border="0" style="padding: 10px;">
<tbody>
<colgroup class="mmcolgroup">
	<col style="width:139px;">
	<col>
</colgroup>
<tr>
	<th class="txtTlt"><?php _e('Recipient group', 'wp-newsletter'); ?></th>
	<td>
		<select name="recipient_group" id="recipient_group" style="width:100%;">
			<option value="commenter_only"><?php _e('All commenter', 'wp-newsletter'); ?></option>
			<option value="user_only"><?php _e('All registered user', 'wp-newsletter'); ?></option>
			<option value="all"><?php _e('All subscribers (All commenter and registered user)', 'wp-newsletter'); ?></option>
			<option value="post_comments"><?php _e('The specified post\'s comments', 'wp-newsletter'); ?></option>
		</select>
	</td>
</tr>
<tr id="specified_post" style="display:none;">
	<th class="txtTlt"><?php _e('Specified post', 'wp-newsletter'); ?></th>
	<td>
		<select name="post_id" id="post_id" style="width:100%;">
<?php
	global $post;
	$args = array(
		'post_type' => 'any',
		'numberposts' => -1,
	); 
	$myposts = get_posts($args);
	foreach($myposts as $post) {
		$post_id = $post->ID;
?>
			<option value="<?php echo $post_id; ?>">[<?php _e(ucfirst($post->post_type)); ?>][<?php echo $post_id; ?>] <?php the_title (); ?></option>
<?php
	}
?>
		</select>
	</td>
</tr>
<tr>
	<th class="txtTlt"><?php _e('Subject', 'wp-newsletter'); ?></th>
	<td><input type="text" tabindex="1" value="" name="subject" maxlength="100" id="subject"></td>
</tr>
<tr>
	<td colspan="2"><?php the_editor('', 'message'); ?></td>
</tr>
<tr>
	<td colspan="2"><?php _e('Can use HTML code.', 'wp-newsletter'); ?></td>
</tr>
</tbody>
</table>

<p class="submit">
<?php _e('Number of per time send', 'wp-newsletter'); ?>
<select name="per_time_send" id="per_time_send">
<option value="5">5</option>
<option value="10">10</option>
<option value="20">20</option>
<option value="30">30</option>
<option value="40">40</option>
<option value="50">50</option>
</select>
<input type="hidden" name="WPNewsletter_send" value="1" />
<input type="submit" tabindex="3" class="button-primary" value="<?php _e('Send', 'wp-newsletter'); ?>" />
</p>
</form>
</div>
</div>
<?php
	}
?>

<div class="stuffbox" style="float:left;" >
<h3><label for="link_url"><?php _e('Support the developer', 'wp-newsletter');?></label></h3>
<div class="inside"  >
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="GVPU3CLXQKAF8">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
</div>
<div class="stuffbox" style="width:15%; float:left;" >
<h3>WP Newsletter Templates</h3>
<div class="inside"  >
We are planing to create HTML templates for this Newsletter so you can easy style and your newsletter.
</div>
</div>
<div class="stuffbox" style=" float:left;" >
<h3>WP Newsletter Tutorial</h3>
<div class="inside"  >
<iframe width="420" height="315" src="//www.youtube.com/embed/lP5qvySDNws" frameborder="0" allowfullscreen></iframe>
</div>
</div>


</div>
</div>
<?php
}
?>