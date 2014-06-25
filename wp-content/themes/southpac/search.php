<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div class="content">

	<div class="container_12">
		<div class="grid_12">
		<?php if ( have_posts() ) : ?>

		<h3><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h3>

			<?php southpac_content_nav( 'nav-above' ); ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'search'); ?>
			<?php endwhile; ?>

			<?php //southpac_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
					<h3><?php _e( 'Nothing Found' ); ?></h3>

				<div>
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #container_12 -->
	</div><!-- #grid_12 -->
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>