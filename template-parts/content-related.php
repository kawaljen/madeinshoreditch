<?php
global $post;
$orig_post = $post;
$ForceByCategorie = false;
$ClassName  = 'three-col';

$tags = wp_get_post_tags($post->ID);

	if ($tags) {
		//$related_num = get_theme_option('related_count');
		$related_num = isset($related_num) ? $related_num : 6;
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>$related_num, // Number of related posts to display.
			'ignore_sticky_posts'=>1
		);

		$my_query = new wp_query( $args );
		echo '<div class="relatedposts"> <h2> Related Posts /tags</h2>';
		if( $my_query->have_posts() ) {
			echo '<div class="relatedposts"> <h2> Related Posts /tags</h2>';
			while( $my_query->have_posts() ) {
			$my_query->the_post();
				// get article
				include (TEMPLATEPATH . '/template-parts/content.php');
			}
		  
			$post = $orig_post;
			wp_reset_query();
			echo '</div>';
		}
		else {
					$ForceByCategorie = true;
				}
				//u786sjkdfHHT!cd5

} 

if(!$tags || $ForceByCategorie) {
	$categories = get_the_category(get_the_ID());
	if($categories){
		foreach($categories as $category) {
				$catid =  $category ->cat_ID ;	
				}
	}
	$related_num = isset($related_num) ? $related_num : 6;
	$args=array(
		'cat' => $catid,
		'post__not_in' => array($post->ID),
		'posts_per_page'=>$related_num, // Number of related posts to display.
		'ignore_sticky_posts'=>1
	);
	$my_query = new WP_Query( $args);

	
	if( $my_query->have_posts() ) {
		echo '<div class="relatedposts"><h2> Related Posts /categorie</h2>';
		while ($my_query->have_posts()) {
			$my_query->the_post();
			// get article
			include (TEMPLATEPATH . '/template-parts/content.php');
		}
	  wp_reset_query();
	echo '</div>';
	}
}

?>
