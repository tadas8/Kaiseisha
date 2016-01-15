<?php
/**
* Template Name: id match
 */

get_header();

?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>

		<?php
		$arrTable = array();
		$now_date = date('Ymd');
		$published = array(
				    'post_type' => 'creator', 
				    'posts_per_page' => -1,

		); ?>
			

			<ul class="green" style="font-size: 0"><pre>
	       	<?php query_posts( $published ); ?>
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				
				<?php
				$joomla_creator_id = get_field("joomla_creator_id");
				$arrTable["$joomla_creator_id"] = get_the_ID();

				?>


	       	<?php endwhile; // end of the loop.
	       	ksort($arrTable);
	       	var_dump($arrTable);
	       	?>
			<?php wp_reset_query(); ?>
			</pre></ul>



<?php endwhile; endif; ?>
<?php //get_footer(); ?>