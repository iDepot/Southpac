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



<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
    <?php else: ?>

    <h6 class="center">Not Found</h6>
    <p class="center">Sorry, but you are looking for something that isn't here.</p>

    <?php // include (TEMPLATEPATH . "/searchform.php"); ?>
<?php endif; ?>

<?php get_footer(); ?>