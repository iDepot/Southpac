<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package Southpac
 * @subpackage
 * @since
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
	</footer><!-- #colophon -->
</div><!-- #page -->

<script type="text/javascript" async src="http://www.google-analytics.com/ga.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-migrate-1.1.1.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/superfish.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.ui.totop.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.equalheights.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mobilemenu.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/sForm.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
<!--[if (gt IE 9)|!(IE)]><!-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mobile.customized.min.js"></script>
<!--<![endif]-->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->
<script>
<!---->
//    $(document).ready(function(){
//        jQuery('#camera_wrap').camera({
//            loader: false,
//            pagination: false ,
//            minHeight: '250',
//            thumbnails: false,
//            height: '37.55208333333333%',
//            caption: true,
//            navigation: true,
//            fx: 'mosaic'
//        });
//        /*Back to Top*/
//        $().UItoTop({ easingType: 'easeOutQuart' });
//
//    });
</script>

<!--==============================footer=================================-->

<footer>
    <div class="container_12">
        <div class="grid_3 fright">
            <h3>永久移民</h3>
            <ul class="list">
                <li><a href="#">投资移民</a></li>
                <li><a href="#">技术移民</a></li>
                <li><a href="#">家庭团聚</a></li>
                <li><a href="#">州政府担保</a></li>
            </ul>
        </div>
        <div class="grid_3 fright">
            <h3>临时居留</h3>
            <ul class="list">
                <li><a href="#">临时居民</a></li>
                <li><a href="#">澳洲留学</a></li>
                <li><a href="#">旅游签证</a></li>
                <li><a href="#">父母移民</a></li>
            </ul>
        </div>
        <div class="grid_3 fright">
            <h3>移民申诉</h3>
            <ul class="list">
                <li><a href="#">MRT申诉</a></li>
                <li><a href="#">RRT申诉</a></li>
            </ul>
        </div>
        <div class="grid_3">

            <a class="f_logo" href="./">
                <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/f_logo.png" />
            </a>
            <div class="clear"></div>
            <div class="copy">

                © <span id="copyright-year">2014</span> | <a href="./privacy">隐私策略</a> <!--{%FOOTER_LINK} -->
                <div></div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>