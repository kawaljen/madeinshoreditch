<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MadeInShoreditch
 */

get_header(); ?>

	<div id="primary" class="content-area single">
		<main id="main" class="site-main" role="main">


		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>
		
		<?php
		// get related posts
		//$get_related = get_theme_option('related_on'); if($get_related == 'Enable'):
		get_template_part( 'template-parts/content-related' );
		//endif
		?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
