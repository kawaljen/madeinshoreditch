<?php
// get the class name
if ( $wp_query->current_post == 4 || $wp_query->current_post == 7 ) {
	$ClassName = 'full-col';	
}

else 
	$ClassName = 'two-col';
?>

<?php
//---------------------------------------------------------- C A T E G O R I E -----------------------------------------------------------------------
// Get the category parent's name 
// $output is edited in the post thumb's div
$categories = get_the_category(get_the_ID());
if($categories){
	foreach($categories as $category) {
		$catparent= $category->parent;
		if(!empty($catparent)){
			$parent_name = get_category($catparent);
			$catid = $catparent;
			$categname =$parent_name->name;
		}
		else{
			$catid =  $category ->cat_ID ;
			$categname = $category->name;		
			}
			

	}	
}
?>

<article id="post-<?php the_ID(); ?>"  class="grid-article <?echo $ClassName; ?>" >
	<header class="entry-header grid-article-info">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<a href="<?php echo get_the_author_link();?>">by <?php echo get_the_author(); ?></a>

	</header><!-- .entry-header -->

	<div class="grid-article-info category"><?php echo $categname; ?></div>
	<div class="entry--content">
	
		<?php 
			if( ! wp_is_mobile()) { 
			    if ( has_post_thumbnail() ) { 
				$size = 'full';
			    } 
				else{$size = 'full';}
			} else { 
			if ( has_post_thumbnail() ) { 
				$size = 'thumbnail';  
			    } 
				else{$size = 'medium'; }
			}
			echo mis_get_featured_post_image('random',$size,get_the_title(),get_the_title(),true);
		?>
		
	</div><!-- .entry-content -->

</article><!-- #post-## -->
