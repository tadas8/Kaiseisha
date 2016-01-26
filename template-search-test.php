<?php
/**
* Template Name: search
 */

get_header(); ?>



		<?php
		$searchQuery = new tadaFunctions;
		$published = array(
				    'post_type' => 'test-custom-post', 
				    'posts_per_page' => -1,
				  	'paged' => get_query_var( 'paged' ),
					'meta_query' => $searchQuery->getSearch(null,null,"london"),
		);
		?>
		
       	<?php query_posts( $published ); 



		// Start the loop.
		while ( have_posts() ) : the_post();
			the_ID(); echo "<br>";
			the_title(); echo "<br>";
			echo get_field('dropdown',get_the_id()); echo "<br>";
			echo get_field('coupon_amount',get_the_id()); echo "<br>";


		// End the loop.
		endwhile;
		?>



<form action="/search" method="post" class="search_form">
	<input id="" type="text" name="">
</form>

<?php get_footer(); ?>