<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

		<div class="container_12">
            <div class="grid_12">

                <?php southpac_customize_breadcrumb() ;?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

                <?php if ( ! post_password_required() && ! is_attachment() ) :
                    the_post_thumbnail();
                endif; ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

            </div>
		</div><!-- #content -->


<?php get_sidebar(); ?>
<?php get_footer(); ?>