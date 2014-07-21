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

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-migrate-1.1.1.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/superfish.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.ui.totop.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.equalheights.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.mobilemenu.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/sForm.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
<![endif]-->

<!--[if (gt IE 9)|!(IE)]><!-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mobile.customized.min.js"></script>
<!--<![endif]-->


<!--==============================footer=================================-->

<footer>
    <div class="container_12">
        <div class="grid_3 fright">
            <h3><?php _e("Permanent")?></h3>
            <ul class="list">
                <li><a href="../immigration"><?php _e("Investment Immigration")?></a></li>
                <li><a href="../immigration"><?php _e("Skilled Immigration")?></a></li>
                <li><a href="../immigration"><?php _e("Family Reunion")?></a></li>
                <li><a href="../immigration"><?php _e("State Sponsor")?></a></li>
            </ul>
        </div>
        <div class="grid_3 fright">
            <h3><?php _e("Temporary")?></h3>
            <ul class="list">
                <li><a href="../visa"><?php _e("Temporary Resident")?></a></li>
                <li><a href="../visa"><?php _e("Student Visa")?></a></li>
                <li><a href="../visa"><?php _e("Visitor Visa")?></a></li>
                <li><a href="../visa"><?php _e("Work Visa")?></a></li>
            </ul>
        </div>
        <div class="grid_3 fright">
            <h3><?php _e("Tribunal")?></h3>
            <ul class="list">
                <li><a href="../tribunal"><?php _e("MRT Appeal")?></a></li>
                <li><a href="../tribunal"><?php _e("RRT Appeal")?></a></li>
            </ul>
        </div>
        <div class="grid_3">

            <a class="f_logo" href="./">
                <img alt="" src="<?php echo get_template_directory_uri(); ?>/images/f_logo.png" />
                <p>
                    <span class="row1"><?php _e("Southpac")?></span>
                    <span class="row2"><?php _e("Services")?></span>
                </p>
            </a>
            <div class="clear"></div>
            <div class="copy">

                © <span id="copyright-year"></span> | <a href="./privacy"><?php _e("Privacy")?></a> <!--{%FOOTER_LINK} -->
                <div></div>
            </div>
        </div>
    </div>
</footer>

<div id="toTop" style="margin-right: -630px; right: 50%;"><span id="toTopHover"></span></div>

<?php wp_footer(); ?>


</body>
</html>