<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Southpac_Services
 * @since Southpac Services 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <div class="featured-post">
            <?php _e( 'Featured post' ); ?>
        </div>
    <?php endif; ?>

    <?php if ( is_single() ) : ?>
        <strong><?php the_title(); ?></strong>
    <?php else : ?>
            <a class="btn" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
    <?php endif; // is_single() ?>

    <?php if ( is_search() ) : // Only display Excerpts for Search ?>
        <div>
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
     <?php endif; ?>

</article><!-- #post -->

<br class="clear"/
