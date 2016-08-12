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
				$args = array(
					'posts_per_page' => 1,
					'post__in'  => get_option( 'sticky_posts' ),
					'ignore_sticky_posts' => 1
				);
				$query = new WP_Query( $args );

			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
				<article id="post-<?php the_ID(); ?>"<?php post_class(); ?>>
					<h2 class="post-title"><?php the_title(); ?></h2>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## --><?php
			endwhile; endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div class="flexslider">
  <ul class="slides">
    <li>
      <img src="<?php echo get_template_directory_uri() ?>/imgs/pic.png" />
    </li>
    <li>
      <img src="slide2.jpg" />
    </li>
    <li>
      <img src="slide3.jpg" />
    </li>
    <li>
      <img src="slide4.jpg" />
    </li>
  </ul>
</div>

<?php
get_footer();
