<?php
/**
* Template Name: search
 */

get_header();

$title = $_GET["title"];
$creator_by_name = $_GET["creator_by_name"];
$categories = $_GET["categories"];
$age_groups = $_GET["age_groups"];
$publication_year = $_GET["publication_year"];
$author_1 = $_GET["author_1"];
$illustrator = $_GET["illustrator"];
$photographer = $_GET["photographer"];
$inc_or_exc = $_GET["inc_or_exc"];
$countries_published_in = $_GET["countries_published_in"];
$paged = $_GET["paged"];

//$creator_by_name="saeko";
$arrAuthorMatch=array();
if($creator_by_name){
	$authorMatch = array(
        'post_type' => 'creator',
        's'=> $creator_by_name,
        'posts_per_page' => -1,
	);
	query_posts( $authorMatch );
	while ( have_posts() ) : the_post();
	  array_push($arrAuthorMatch, get_the_ID());
	endwhile;

	//var_dump($arrAuthorMatch);
}

	//var_dump($inc_or_exc);


		if(!$paged){
			$paged = 1;
		}
		$searchQuery = new tadaFunctions;
		if(!$categories && !$age_groups && !$publication_year && !$countries_published_in && !$arrAuthorMatch && !$author_1 && !$illustrator && !$photographer){
			$published = array(
					    'post_type' => 'book',
					    'posts_per_page' => 20,
					    's' => $title,
					  	'paged' => $paged,
			);			
		}else{
			$published = array(
					    'post_type' => 'book',
					    's' => $title,
					    //'post__in' => 
					    'posts_per_page' => 20,
					  	'paged' => $paged,
						'meta_query' => $searchQuery->getSearch(
							array(
								"categories"=>$categories,
								"age_groups"=>$age_groups,
								"publication_year"=>$publication_year,
								"author_1"=>$author_1,
								"illustrator"=>$illustrator,
								"photographer"=>$photographer,
								"inc_or_exc"=>$inc_or_exc,
								"countries_published_in"=>$countries_published_in,
								"arrAuthorMatch"=>$arrAuthorMatch,
							)),
			);				
		}
		
		
			// $published = array(
			// 		    'post_type' => 'book',
			// 		    'posts_per_page' => 500,
			// 		    's' => $title,
			// 		  	'paged' => get_query_var( 'paged' ),
			// 		  	'meta_query' => array(
			// 		  		array("key"=>"author_1_0_name","value"=>"633", "compare" => "LIKE"),
			// 		  	)
			// );	



		//echo "<pre>";var_dump($published);echo "</pre>";

		?>

			<div class="navbar navbar-kaiseisha">          
          	<!-- The WordPress Menu goes here -->
          	<?php wp_nav_menu(
						array(
							'theme_location' 	=> 'creators-menu',
							'depth'             => 1,
							'menu_class'   => 'clearfix',
							'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
							'menu_id'			=> 'creators-menu',
							'walker' 			=> new wp_bootstrap_navwalker()
						)
						); ?>
    	    </div>

		<div class="entry-content">
          <ul class="booklist clearfix">

	       	<?php query_posts( $published ); 
			global $wp_query; 
			//echo "<pre>";var_dump($wp_query->found_posts);echo "</pre>";

			if($wp_query->found_posts < 500){
				// Start the loop.
				while ( have_posts() ) : the_post(); ?>


          	<li>
            	<div class="inner clearfix">
                	<div class="coverimage clearfix">
            	<?php if (has_post_thumbnail()): ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php elseif (get_field('joomla_image_url')): ?>
							<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php the_field('joomla_image_url') ?>" /></a>
				<?php endif ?>
					</div>

                	<div class="details clearfix">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <?php if( have_rows('author_1') ): ?><?php while ( have_rows('author_1') ) : the_row(); ?>
			<h4>
			<?php if (get_sub_field('author_types') == "AT1"): ?>by
			<?php elseif (get_sub_field('author_types') == "AT2"): ?>retold by
			<?php elseif (get_sub_field('author_types') == "AT3"): ?>text by
			<?php elseif (get_sub_field('author_types') == "AT4"): ?>translated by
			<?php elseif (get_sub_field('author_types') == "AT5"): ?>translated and adappted by
			<?php elseif (get_sub_field('author_types') == "AT6"): ?>original story by
			<?php elseif (get_sub_field('author_types') == "AT7"): ?>concept by
			<?php elseif (get_sub_field('author_types') == "AT8"): ?>text and illus. by
			<?php elseif (get_sub_field('author_types') == "AT9"): ?>edited by
			<?php elseif (get_sub_field('author_types') == "AT10"): ?>words by
			<?php elseif (get_sub_field('author_types') == "AT11"): ?>supervision by
			<?php elseif (get_sub_field('author_types') == "AT12"): ?>text &amp; photo by
			<?php elseif (get_sub_field('author_types') == "AT14"): ?>adapted by
			<?php elseif (get_sub_field('author_types') == "AT15"): ?>poetry by
			<?php elseif (get_sub_field('author_types') == "AT16"): ?>copperplate engravings by
			<?php elseif (get_sub_field('author_types') == "AT17"): ?>and
            <?php endif; ?>
			<?php 
			$posts = get_sub_field('name');
			if( $posts ): ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>
			</h4>
            <?php endwhile; ?><?php endif; ?>

            <?php if( have_rows('author_2') ): ?><?php while ( have_rows('author_2') ) : the_row(); ?>
			<h4>
			<?php if (get_sub_field('author_types') == "AT1"): ?>by
			<?php elseif (get_sub_field('author_types') == "AT2"): ?>retold by
			<?php elseif (get_sub_field('author_types') == "AT3"): ?>text by
			<?php elseif (get_sub_field('author_types') == "AT4"): ?>translated by
			<?php elseif (get_sub_field('author_types') == "AT5"): ?>translated and adappted by
			<?php elseif (get_sub_field('author_types') == "AT6"): ?>original story by
			<?php elseif (get_sub_field('author_types') == "AT7"): ?>concept by
			<?php elseif (get_sub_field('author_types') == "AT8"): ?>text and illus. by
			<?php elseif (get_sub_field('author_types') == "AT9"): ?>edited by
			<?php elseif (get_sub_field('author_types') == "AT10"): ?>words by
			<?php elseif (get_sub_field('author_types') == "AT11"): ?>supervision by
			<?php elseif (get_sub_field('author_types') == "AT12"): ?>text &amp; photo by
			<?php elseif (get_sub_field('author_types') == "AT14"): ?>adapted by
			<?php elseif (get_sub_field('author_types') == "AT15"): ?>poetry by
			<?php elseif (get_sub_field('author_types') == "AT16"): ?>copperplate engravings by
			<?php elseif (get_sub_field('author_types') == "AT17"): ?>and
            <?php endif; ?>
			<?php 
			$posts = get_sub_field('name');
			if( $posts ): ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>
			</h4>
            <?php endwhile; ?><?php endif; ?>

            <?php if( have_rows('author_3') ): ?><?php while ( have_rows('author_3') ) : the_row(); ?>
			<h4>
			<?php if (get_sub_field('author_types') == "AT1"): ?>by
			<?php elseif (get_sub_field('author_types') == "AT2"): ?>retold by
			<?php elseif (get_sub_field('author_types') == "AT3"): ?>text by
			<?php elseif (get_sub_field('author_types') == "AT4"): ?>translated by
			<?php elseif (get_sub_field('author_types') == "AT5"): ?>translated and adappted by
			<?php elseif (get_sub_field('author_types') == "AT6"): ?>original story by
			<?php elseif (get_sub_field('author_types') == "AT7"): ?>concept by
			<?php elseif (get_sub_field('author_types') == "AT8"): ?>text and illus. by
			<?php elseif (get_sub_field('author_types') == "AT9"): ?>edited by
			<?php elseif (get_sub_field('author_types') == "AT10"): ?>words by
			<?php elseif (get_sub_field('author_types') == "AT11"): ?>supervision by
			<?php elseif (get_sub_field('author_types') == "AT12"): ?>text &amp; photo by
			<?php elseif (get_sub_field('author_types') == "AT14"): ?>adapted by
			<?php elseif (get_sub_field('author_types') == "AT15"): ?>poetry by
			<?php elseif (get_sub_field('author_types') == "AT16"): ?>copperplate engravings by
			<?php elseif (get_sub_field('author_types') == "AT17"): ?>and
            <?php endif; ?>
			<?php 
			$posts = get_sub_field('name');
			if( $posts ): ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>
			</h4>
            <?php endwhile; ?><?php endif; ?>

            <?php if( have_rows('author_4') ): ?><?php while ( have_rows('author_4') ) : the_row(); ?>
			<h4>
			<?php if (get_sub_field('author_types') == "AT1"): ?>by
			<?php elseif (get_sub_field('author_types') == "AT2"): ?>retold by
			<?php elseif (get_sub_field('author_types') == "AT3"): ?>text by
			<?php elseif (get_sub_field('author_types') == "AT4"): ?>translated by
			<?php elseif (get_sub_field('author_types') == "AT5"): ?>translated and adappted by
			<?php elseif (get_sub_field('author_types') == "AT6"): ?>original story by
			<?php elseif (get_sub_field('author_types') == "AT7"): ?>concept by
			<?php elseif (get_sub_field('author_types') == "AT8"): ?>text and illus. by
			<?php elseif (get_sub_field('author_types') == "AT9"): ?>edited by
			<?php elseif (get_sub_field('author_types') == "AT10"): ?>words by
			<?php elseif (get_sub_field('author_types') == "AT11"): ?>supervision by
			<?php elseif (get_sub_field('author_types') == "AT12"): ?>text &amp; photo by
			<?php elseif (get_sub_field('author_types') == "AT14"): ?>adapted by
			<?php elseif (get_sub_field('author_types') == "AT15"): ?>poetry by
			<?php elseif (get_sub_field('author_types') == "AT16"): ?>copperplate engravings by
			<?php elseif (get_sub_field('author_types') == "AT17"): ?>and
            <?php endif; ?>
			<?php 
			$posts = get_sub_field('name');
			if( $posts ): ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>
			</h4>
            <?php endwhile; ?><?php endif; ?>

            <?php if( have_rows('author_5') ): ?><?php while ( have_rows('author_5') ) : the_row(); ?>
			<h4>
			<?php if (get_sub_field('author_types') == "AT1"): ?>by
			<?php elseif (get_sub_field('author_types') == "AT2"): ?>retold by
			<?php elseif (get_sub_field('author_types') == "AT3"): ?>text by
			<?php elseif (get_sub_field('author_types') == "AT4"): ?>translated by
			<?php elseif (get_sub_field('author_types') == "AT5"): ?>translated and adappted by
			<?php elseif (get_sub_field('author_types') == "AT6"): ?>original story by
			<?php elseif (get_sub_field('author_types') == "AT7"): ?>concept by
			<?php elseif (get_sub_field('author_types') == "AT8"): ?>text and illus. by
			<?php elseif (get_sub_field('author_types') == "AT9"): ?>edited by
			<?php elseif (get_sub_field('author_types') == "AT10"): ?>words by
			<?php elseif (get_sub_field('author_types') == "AT11"): ?>supervision by
			<?php elseif (get_sub_field('author_types') == "AT12"): ?>text &amp; photo by
			<?php elseif (get_sub_field('author_types') == "AT14"): ?>adapted by
			<?php elseif (get_sub_field('author_types') == "AT15"): ?>poetry by
			<?php elseif (get_sub_field('author_types') == "AT16"): ?>copperplate engravings by
			<?php elseif (get_sub_field('author_types') == "AT17"): ?>and
            <?php endif; ?>
			<?php 
			$posts = get_sub_field('name');
			if( $posts ): ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>
			</h4>
            <?php endwhile; ?><?php endif; ?>

            <?php if( have_rows('author_6') ): ?><?php while ( have_rows('author_6') ) : the_row(); ?>
			<h4>
			<?php if (get_sub_field('author_types') == "AT1"): ?>by
			<?php elseif (get_sub_field('author_types') == "AT2"): ?>retold by
			<?php elseif (get_sub_field('author_types') == "AT3"): ?>text by
			<?php elseif (get_sub_field('author_types') == "AT4"): ?>translated by
			<?php elseif (get_sub_field('author_types') == "AT5"): ?>translated and adappted by
			<?php elseif (get_sub_field('author_types') == "AT6"): ?>original story by
			<?php elseif (get_sub_field('author_types') == "AT7"): ?>concept by
			<?php elseif (get_sub_field('author_types') == "AT8"): ?>text and illus. by
			<?php elseif (get_sub_field('author_types') == "AT9"): ?>edited by
			<?php elseif (get_sub_field('author_types') == "AT10"): ?>words by
			<?php elseif (get_sub_field('author_types') == "AT11"): ?>supervision by
			<?php elseif (get_sub_field('author_types') == "AT12"): ?>text &amp; photo by
			<?php elseif (get_sub_field('author_types') == "AT14"): ?>adapted by
			<?php elseif (get_sub_field('author_types') == "AT15"): ?>poetry by
			<?php elseif (get_sub_field('author_types') == "AT16"): ?>copperplate engravings by
			<?php elseif (get_sub_field('author_types') == "AT17"): ?>and
            <?php endif; ?>
			<?php 
			$posts = get_sub_field('name');
			if( $posts ): ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>
			</h4>
            <?php endwhile; ?><?php endif; ?>

			<?php 
			$posts = get_field('illustrator');
			if( $posts ): ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
                <h4>illus. by <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>
			
			<?php 
			$posts = get_field('photographer');
			if( $posts ): ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
                <h4>photo by <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>
			


            <?php if (get_field('age_groups')): ?>
            	<?php if (get_field('age_groups') == "AG1"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/0.gif" />
            	<?php elseif (get_field('age_groups') == "AG2"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/1.gif" />
            	<?php elseif (get_field('age_groups') == "AG3"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/2.gif" />
            	<?php elseif (get_field('age_groups') == "AG4"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/3.gif" />
            	<?php elseif (get_field('age_groups') == "AG5"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/4.gif" />
            	<?php elseif (get_field('age_groups') == "AG6"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/5.gif" />
            	<?php elseif (get_field('age_groups') == "AG7"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/6.gif" />
            	<?php elseif (get_field('age_groups') == "AG8"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/7.gif" />
            	<?php elseif (get_field('age_groups') == "AG9"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/8.gif" />
            	<?php elseif (get_field('age_groups') == "AG10"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/9.gif" />
            	<?php elseif (get_field('age_groups') == "AG11"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/10.gif" />
            	<?php elseif (get_field('age_groups') == "AG12"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/11.gif" />
            	<?php elseif (get_field('age_groups') == "AG13"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/12.gif" />
            	<?php elseif (get_field('age_groups') == "AG14"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/young_adult.gif" />
            	<?php elseif (get_field('age_groups') == "AG15"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/newtitles/all.gif" />
                <?php endif; ?>
			<?php endif; ?>
			<?php
					$content = get_the_content();
					$link = get_permalink();
					$trimmed_content = wp_trim_words( $content, 22, '...' );
					echo '<p>'.$trimmed_content.'<a href="'.$link.'"><strong>view details</strong></a>'.'</p>';
			?>
         			
                    </div>
				</div>
			</li>
					

				<?
				// End the loop.
				endwhile;
				
				echo $searchQuery->getPagination();	
			?>

			</ul>
		</div>

		<?php
		}else{
			//var_dump("OVER 100");
			echo "Search result has more than 500, please try again.";
		}



get_footer(); ?>
