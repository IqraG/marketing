<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Marketing
 */

get_header();
get_sidebar(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php 
				// Displays only one sticky post
				$args = array(
					'posts_per_page' => 1, // Shows only 1 post
					'post__in'  => get_option( 'sticky_posts' ), // Displays only sticky posts
					'ignore_sticky_posts' => 1 // Ignores all other sticky posts
				);
				$query = new WP_Query( $args );

			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
				<article id="post-<?php the_ID(); ?>"<?php post_class(); ?>>
					<h2 class="post-title"><?php the_title(); ?></h2>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php body_font(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## --><?php
			endwhile; endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div class="flexslider">
	  <ul class="slides">
	   <?php
    		$flexslider_query = new WP_Query(array( 
    			'posts_per_page' => 5,
    			'orderby' => 'date',
    			'ignore_sticky_posts' => 1
    			) );
    		if ($flexslider_query->have_posts()): while ($flexslider_query->have_posts()): $flexslider_query->the_post(); ?>
    			<li>
	    			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	        			<?php the_post_thumbnail(); ?>
	    			</a>
    			</li>
		<?php 
		endwhile; 
		wp_reset_postdata();
		endif;
		?>
	  </ul>
</div>

<?php
get_footer();
