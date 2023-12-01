<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MadeInShoreditch
 */
//6iSL!FWiy1Jf#b8J
//iiu782mmpj65kjMK
get_header(); ?>

	<!--<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">-->

		<?php if ( have_posts() ) : ?>
			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php if( $wp_query->current_post == 2 ): ?>
					<div id="primary" class="content-area">
							<main id="main" class="site-main" role="main">
				<?php endif ?>
				<?php
					
				// get the add
				if ( $wp_query->current_post == 7 ) {
					echo ' <div class="clear"></div>';
					if( function_exists('the_ad') )the_ad_placement('ingrid');
				}
				?>
				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>
			

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
		<?php 
			$catid =34;
			$related_num = 4;
			$args=array(
				'cat' => $catid,
				'post__not_in' => array($post->ID),
				'posts_per_page'=>$related_num, // Number of related posts to display.
				'ignore_sticky_posts'=>1
			);
			$my_query_video = new WP_Query( $args);
			
			if( $my_query_video->have_posts() ) {
				echo '<div class="content-videos">';
					while ($my_query_video->have_posts()) {
						$my_query_video->the_post();
						//echo $my_query_video->current_post;
						if ( $my_query_video->current_post == 1 ){
							echo '<div class="video-cols">';
						}
						include (TEMPLATEPATH . '/template-parts/content-video.php');
					}
					wp_reset_query();
					echo '</div>';// close video-col
				echo '</div>';
			}
		?>	
		
		<div class="load-more">
			<?php echo do_shortcode('[ajax_load_more offset="10"]');?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
