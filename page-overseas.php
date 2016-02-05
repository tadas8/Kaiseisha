<?php
/*
Template Name: Overseas
*/
get_header(); 
$getTadaFunc = new tadaFunctions;

?>

<div class="main-content books overseas clearfix">
  <div class="row">
    <header id="page-top" class="col-sm-12 clearfix">
      <div id="page-top-menu" class="clearfix">
        <div class="page-top-menu-button new"><a href="<?php echo esc_url( home_url( '/' ) ); ?>new-titles/picture/">
          <div class="up-button"></div>
          New Titles</a></div>
        <div class="page-top-menu-button back"><a href="<?php echo esc_url( home_url( '/' ) ); ?>backlist/picture/">
          <div class="up-button"></div>
          Backlist</a></div>
        <div class="page-top-menu-button overseas"><a href="<?php echo esc_url( home_url( '/' ) ); ?>overseas/picture/">
          <div class="up-button"></div>
          Overseas</a></div>
      </div>
      <div id="top-title">
        <h1 class="page-title">Oversea</h1>
        <div id="top-image"><img src="
			<?php 
			if (is_page('fiction')) {
				echo get_bloginfo('template_directory') . '/images/top/os_fiction.jpg'; }
			elseif (is_page('non-fiction')) {
				echo get_bloginfo('template_directory') . '/images/top/os_non-fics.jpg'; }
			elseif (is_page('science')) {
				echo get_bloginfo('template_directory') . '/images/top/os_science.jpg'; }
			else {
				echo get_bloginfo('template_directory') . '/images/top/os_picture.jpg'; }
			;?>" alt=""></div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-image-menu">Menu</button>
          
          <!-- The WordPress Menu goes here -->

        </div>
      </div>
    </header>
  </div>


  <div class="row">
    <div class="col-sm-12">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        	<div class="navbar navbar-kaiseisha">          
          	<!-- The WordPress Menu goes here -->
          	
    	    </div>

        <div class="entry-content">
        

<?php
$field_key = "field_5693a32a65711";
$field = get_field_object($field_key);
if( in_array( 'CNT7', $field ) )
{
		foreach( $field['choices'] as $k => $v )
		{
					echo '<a href="?country=' . $k . '">' . $v . '</a><br>';
		}
}
?>

            <?php
				$field = get_field_object('countries_published_in');
				$value = get_field('countries_published_in');
				$label = $field['choices'][ $value ];
			?>
			<?php 
			$posts = get_sub_field('name');
			if( $posts ): ?>
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>



					<?php 
						$args = array(
							'post_type' => 'book',
							'meta_query' => array(
								array(
									'key' => 'author_1_%_name', // name of custom field
									'value' => '"' . get_the_ID() . '"',
									'compare' => 'LIKE'
								)
							)
						);
					$posts = get_posts( $args ); ?>
                    
                    
						<?php if( $posts ): ?>
                	<ul class="related-books clearfix">
					<?php foreach( $posts as $post): ?>
                    <li>
					<?php setup_postdata($post); ?>
	        	    	<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail(); ?>
						<?php elseif (get_field('joomla_image_url')): ?><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php the_field('joomla_image_url'); ?>" />
						<?php else: ?><img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
						<?php endif ?>
                        </a>
           		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					</li>
					<?php endforeach; ?>
					</ul>
						<?php endif; ?>






          <?php 
					
					if (is_page ( 4097 )) {
						$posts = array(
						'orderby' => array( 'meta_value' => 'ASC', 'ID' => 'ASC','date' => 'DESC', 'title' => 'ASC' ),
						'meta_query'	=> array(
							'relation'		=> 'AND',
							array(
								'key'		=> 'countries_published_in',
								'value'		=> 'CAT1',
								'compare'	=> 'IN'
							),
							array(
								'key'		=> 'new',
								'value'		=> true,
								'compare'	=> '='
							)
						)
						);
					}
					elseif (is_page ( 4098 )) {
						$posts = array(
						'paged' => $paged,
						'posts_per_page' => '20',
						'post_type' => 'book',
						'orderby' => array( 'meta_value' => 'ASC', 'ID' => 'ASC','date' => 'DESC', 'title' => 'ASC' ),
						'meta_query'	=> array(
							'relation'		=> 'AND',
							array(
								'key'		=> 'categories',
								'value'		=> 'CAT2',
								'compare'	=> 'IN'
							),
							array(
								'key'		=> 'new',
								'value'		=> true,
								'compare'	=> '='
							)
						)
						);
					}
					elseif (is_page ( 4099 )) {
						$posts = array(
						'paged' => $paged,
						'posts_per_page' => '20',
						'post_type' => 'book',
						'orderby' => array( 'meta_value' => 'ASC', 'ID' => 'ASC','date' => 'DESC', 'title' => 'ASC' ),
						'meta_query'	=> array(
							'relation'		=> 'AND',
							array(
								'key'		=> 'categories',
								'value'		=> 'CAT3',
								'compare'	=> 'IN'
							),
							array(
								'key'		=> 'new',
								'value'		=> true,
								'compare'	=> '='
							)
						)
						);
					}
					elseif (is_page ( 4100 )) {
						$posts = array(
						'paged' => $paged,
						'posts_per_page' => '20',
						'post_type' => 'book',
						'orderby' => array( 'meta_value' => 'ASC', 'ID' => 'ASC','date' => 'DESC', 'title' => 'ASC' ),
						'meta_query'	=> array(
							'relation'		=> 'AND',
							array(
								'key'		=> 'categories',
								'value'		=> 'CAT4',
								'compare'	=> 'IN'
							),
							array(
								'key'		=> 'new',
								'value'		=> true,
								'compare'	=> '='
							)
						)
						);
					}
					if($_GET["country"]){
						array_push($posts["meta_query"], array("key"=>"countries_published_in", "value"=>$_GET["country"], "compare"=>"LIKE"));
						$posts["meta_query"]["relation"] = 'AND';
					}
					query_posts($posts);
					if (have_posts()): ?>

          <ul class="booklist clearfix">

          <?php while (have_posts()) : the_post();?>
          
          
          
          	<li>
            	<div class="inner clearfix">
                	<div class="bookcover clearfix">
            	<?php if (has_post_thumbnail()): ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php elseif (get_field('joomla_image_url')): ?>
							<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )); ?><?php $getTadaFunc->getCountryCode(get_field('joomla_image_url'), $_GET["country"]); ?>" /></a>
				<?php endif ?>
					</div>

                	<div class="bookdetails clearfix">
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

        <?php endwhile; ?>

		</ul>
		<?php echo $getTadaFunc->getPagination();	?>

          <?php else: ?>



          <p>There are no new titles for the current period.</p>



          <?php endif; ?>



        </div>
        <!-- .entry-content --> 
      </article>
      <!-- #post-## --> 
    </div>
  </div>
  <!-- close .row --> 
</div>
<!-- close .main-content -->

<?php get_footer(); ?>
