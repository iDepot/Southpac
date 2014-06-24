<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Southpac_Services
 * @since Southpac Services 1.0
 */
get_header(); ?>

<?php if ( is_front_page()):?>
             <div id="first-front-page-widget-area">
                    <?php  {dynamic_sidebar( 'First Front Page Widget Area' );}  ?>
              </div>
    <div class="content">
        <div class="container_12 p_bot">
    <?php else:?>
        <div class="content">
            <div class="container_12">
<?php endif;?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
    <?php else: ?>

    <h6 class="center">Not Found</h6>
    <p class="center">Sorry, but you are looking for something that isn't here.</p>

    <?php // include (TEMPLATEPATH . "/searchform.php"); ?>
<?php endif; ?>


            </div>
        </div>


    </div><!--  #main.content -->
</div><!--  #main.container -->

<?php get_footer(); ?>