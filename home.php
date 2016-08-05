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

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main"> 
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				/*
				if (is_home()) { //referenced from Codex
					$args = array(
						'posts_per_page' => 1,
						'post__in'  => get_option( 'sticky_posts' ),
						'ignore_sticky_posts' => 1
					);
					$query = new WP_Query( $args );
				} 
				?>
				<?php */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
