<?php
/*
Template Name: Backlist
*/

get_header(); 
$getTadaFunc = new tadaFunctions;
?>



<div class="main-content books backlist clearfix">
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
        <h1 class="page-title">Backlist</h1>
        <div id="top-image"><img src="
			<?php 
			if (is_page('fiction')) {
				echo get_bloginfo('template_directory') . '/images/top/bl_fiction.jpg'; }
			elseif (is_page('non-fiction')) {
				echo get_bloginfo('template_directory') . '/images/top/bl_non-fics.jpg'; }
			elseif (is_page('science')) {
				echo get_bloginfo('template_directory') . '/images/top/bl_science.jpg'; }
			else {
				echo get_bloginfo('template_directory') . '/images/top/bl_picture.jpg'; }
			;?>" alt=""></div>


        
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-image-menu">Menu</button>

          <!-- The WordPress Menu goes here -->
          <?php wp_nav_menu(
						array(
							'theme_location' 	=> 'backlist-menu',
							'depth'             => 1,
							'container'         => 'div',
							'menu_class' 		=> 'collapse navbar-collapse',
							'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
							'menu_id'			=> 'top-image-menu',
							'walker' 			=> new wp_bootstrap_navwalker()
						)
					); ?>
        </div>



      </div>
    </header>
  </div>

<?php get_template_part( 'content', 'search-panel' ); ?>
  
          <?php 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					
					if (is_page ( 4077 )) {
						$posts = array(
						'paged' => $paged,
						'posts_per_page' => '20',
						'post_type' => 'book',
						'order'     => 'ASC',
						'orderby' => 'meta_value',
						'meta_key' => 'age_groups',
						'orderby' => array( 'meta_value' => 'ASC', 'ID' => 'ASC','date' => 'DESC', 'title' => 'ASC' ),
						'meta_query'	=> array(
							array(
								'key'		=> 'categories',
								'value'		=> 'CAT1',
								'compare'	=> 'IN'
							)
						)
						);
					}
					elseif (is_page ( 4079 )) {
						$posts = array(
						'paged' => $paged,
						'posts_per_page' => '20',
						'post_type' => 'book',
						'order'     => 'ASC',
						'orderby' => 'meta_value',
						'meta_key' => 'age_groups',
						'orderby' => array( 'meta_value' => 'ASC', 'ID' => 'ASC','date' => 'DESC', 'title' => 'ASC' ),
						'meta_query'	=> array(
							array(
								'key'		=> 'categories',
								'value'		=> 'CAT2',
								'compare'	=> 'IN'
							)
						)
						);
					}
					elseif (is_page ( 4081 )) {
						$posts = array(
						'paged' => $paged,
						'posts_per_page' => '20',
						'post_type' => 'book',
						'order'     => 'ASC',
						'orderby' => 'meta_value',
						'meta_key' => 'age_groups',
						'orderby' => array( 'meta_value' => 'ASC', 'ID' => 'ASC','date' => 'DESC', 'title' => 'ASC' ),
						'meta_query'	=> array(
							array(
								'key'		=> 'categories',
								'value'		=> 'CAT3',
								'compare'	=> 'IN'
							)
						)
						);
					}
					elseif (is_page ( 4083 )) {
						$posts = array(
						'paged' => $paged,
						'posts_per_page' => '20',
						'post_type' => 'book',
						'order'     => 'ASC',
						'orderby' => 'meta_value',
						'meta_key' => 'age_groups',
						'orderby' => array( 'meta_value' => 'ASC', 'ID' => 'ASC','date' => 'DESC', 'title' => 'ASC' ),
						'meta_query'	=> array(
							array(
								'key'		=> 'categories',
								'value'		=> 'CAT4',
								'compare'	=> 'IN'
							)
						)
						);
					}
					if($_GET["age_groups"]){
						array_push($posts["meta_query"], array("key"=>"age_groups", "value"=>$_GET["age_groups"], "compare"=>"="));
						$posts["meta_query"]["relation"] = 'AND';
					}
					
					query_posts($posts);
					if (have_posts()): ?>






<div id="main" class="row">
  
	<div class="content-navi col-sm-12 clearfix">

    	<div class="right">
        	<div class="page-jump">
        	View other age groups
		<form method="GET" action="">
          		<?php 
					$field_key = "field_56937dd0eaf87";
					$field = get_field_object($field_key);

					if( $field )
					{
						echo '<select name="' . $field['name'] . '" id="age_group_top" class="Pulldown" size="1"">';
							foreach( $field['choices'] as $k => $v )
							{
								echo '<option value="' . $k . '">' . $v . '</option>';
							}
						echo '</select>';
					}
				?>
			<button class="PulldownGo" type="submit">GO</button>
		</form>
			</div>
    	</div>

    	<div class="left">
        	<div class="pagination-title"></div>
			<div class="pagination-numbers"><?php echo $getTadaFunc->getPagination();	?></div>
    	</div>

    </div>

    <div class="col-sm-12">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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

          <?php while (have_posts()) : the_post();?>
          
          
          
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
            	<?php if (get_field('age_groups') == "AG1"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/0.gif" />
            	<?php elseif (get_field('age_groups') == "AG2"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/1.gif" />
            	<?php elseif (get_field('age_groups') == "AG3"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/2.gif" />
            	<?php elseif (get_field('age_groups') == "AG4"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/3.gif" />
            	<?php elseif (get_field('age_groups') == "AG5"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/4.gif" />
            	<?php elseif (get_field('age_groups') == "AG6"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/5.gif" />
            	<?php elseif (get_field('age_groups') == "AG7"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/6.gif" />
            	<?php elseif (get_field('age_groups') == "AG8"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/7.gif" />
            	<?php elseif (get_field('age_groups') == "AG9"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/8.gif" />
            	<?php elseif (get_field('age_groups') == "AG10"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/9.gif" />
            	<?php elseif (get_field('age_groups') == "AG11"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/10.gif" />
            	<?php elseif (get_field('age_groups') == "AG12"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/11.gif" />
            	<?php elseif (get_field('age_groups') == "AG13"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/12.gif" />
            	<?php elseif (get_field('age_groups') == "AG14"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/young_adult.gif" />
            	<?php elseif (get_field('age_groups') == "AG15"): ?><img src="<?php echo get_bloginfo('template_directory');?>/images/backlist/all.gif" />
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


          <?php else: ?>



<div id="main" class="row">

	<div class="content-navi col-sm-12 clearfix">

    	<div class="right">
        	<div class="page-jump">
        	View other age groups
				<form method="GET" action="">
          			<?php 
						$field_key = "field_56937dd0eaf87";
						$field = get_field_object($field_key);

						if( $field )
						{
							echo '<select name="' . $field['name'] . '" id="age_group_top" class="Pulldown" size="1"">';
								foreach( $field['choices'] as $k => $v )
								{
									echo '<option value="' . $k . '">' . $v . '</option>';
								}
							echo '</select>';
						}
					?>
					<button class="PulldownGo" type="submit">GO</button>
				</form>
			</div>
    	</div>

    	<div class="left">
        	<div class="pagination-title"></div>
			<div class="pagination-numbers"><?php echo $getTadaFunc->getPagination();	?></div>
    	</div>

    </div>
	
    <div class="col-sm-12">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
          <p>There are no new titles for the current period.</p>



     <?php endif; ?>















        </div>
        <!-- .entry-content -->
      </article>
      <!-- #post-## --> 
    </div>


	<div class="content-navi bottom col-sm-12 clearfix">

    	<div class="left">
        	<div class="pagination-title">
            	<?php if (isset($_POST['AG3'])) {echo 'Age 2';} ?>
            </div>
			<div class="pagination-numbers"><?php echo $getTadaFunc->getPagination();	?></div>
    	</div>

    	<div class="right">
        	<div class="page-jump">
        	View other age groups
				<form method="GET" action="">
          			<?php 
						$field_key = "field_56937dd0eaf87";
						$field = get_field_object($field_key);

						if( $field )
						{
							echo '<select name="' . $field['name'] . '" id="age_group_top" class="Pulldown" size="1"">';
								foreach( $field['choices'] as $k => $v )
								{
									echo '<option value="' . $k . '">' . $v . '</option>';
								}
							echo '</select>';
						}
					?>
					<button class="PulldownGo" type="submit">GO</button>
				</form>
			</div>
    	</div>

    </div>


  </div>
  <!-- close .row --> 
</div>
<!-- close .main-content -->

<?php get_footer(); ?>
