<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package MadeInShoreditch
 */

get_header(); ?>

<!--
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
-->

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'madeinshoreditch' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if( $wp_query->current_post == 2 ): ?>
					<div id="primary" class="content-area">
							<main id="main" class="site-main" role="main">
				<?php endif ?>
				<?php
					
				// get the add
				if ( $wp_query->current_post == 4 || $wp_query->current_post == 7 ) {
					echo ' <div class="clear">';
					if( function_exists('the_ad') )the_ad_placement('ingrid');
					echo ' </div>';
				}
				?>
				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
