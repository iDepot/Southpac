<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Southpac_Services
 * @since Southpac Services 1.0
 */

get_header(); ?>

<div class="container_12">
    <div id="grid_12">

			<article id="post-0" class="post error404 no-results not-found">

				<h3 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?'); ?></h3>

				<div>
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>