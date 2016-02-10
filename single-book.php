<?php get_header();
$getTadaFunc = new tadaFunctions;
?>

<div class="main-content books<?php if (get_field('new') == true): ?> new-titles<?php else: ?> backlist<?php endif; ?>">
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

      <?php if (get_field('new') == true): ?>
      <div id="top-title">
        <h1 class="page-title">New Titles</h1>
        <div id="top-image"><img src="
			<?php 
			if (is_page('fiction')) {
				echo get_bloginfo('template_directory') . '/images/top/nt_fiction.jpg'; }
			elseif (is_page('non-fiction')) {
				echo get_bloginfo('template_directory') . '/images/top/nt_non-fics.jpg'; }
			elseif (is_page('science')) {
				echo get_bloginfo('template_directory') . '/images/top/nt_science.jpg'; }
			else {
				echo get_bloginfo('template_directory') . '/images/top/nt_picture.jpg'; }
			;?>" alt=""></div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-image-menu">Menu</button>
          <?php wp_nav_menu(
						array(
							'theme_location' 	=> 'newtitles-menu',
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
      <?php else: ?>
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
      <?php endif; ?>
    </header>
  </div>

  


<?php get_template_part( 'content', 'search-panel' ); ?>
        
<div id="main" class="row">
    <?php while ( have_posts() ) : the_post(); ?>
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

        <div class="entry-content book-single clearfix">

            	<div class="inner clearfix">
                	<div class="coverimage clearfix">
            	<?php if (has_post_thumbnail()): ?>
							<?php the_post_thumbnail(); ?>
				<?php elseif (get_field('joomla_image_url')): ?>
							<img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )); ?><?php $getTadaFunc->getCountryCode(get_field('joomla_image_url'), $_GET["country"]); ?>" />
				<?php endif ?>
					</div>

                	<div class="details clearfix">
                        
            <?php
				$field = get_field_object('series');
				$value = get_field('series');
				$label = $field['choices'][ $value ];
				if ($value == ('SR0')) { echo '';}
				else { echo $label; }
			?>
			<h2><?php the_title(); ?></h2>
            <?php if( have_rows('author_1') ): ?><?php while ( have_rows('author_1') ) : the_row(); ?>
			<h4>
            <?php
				$field = get_sub_field_object('author_types');
				$value = get_sub_field('author_types');
				$label = $field['choices'][ $value ];
				if (!$value == ('AT0')) { echo $label; }
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
			</h4>
            <?php endwhile; ?><?php endif; ?>

            <?php if( have_rows('author_2') ): ?><?php while ( have_rows('author_2') ) : the_row(); ?>
			<h4>
            <?php
				$field = get_sub_field_object('author_types');
				$value = get_sub_field('author_types');
				$label = $field['choices'][ $value ];
				if (!$value == ('AT0')) { echo $label; }
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
			</h4>
            <?php endwhile; ?><?php endif; ?>

            <?php if( have_rows('author_3') ): ?><?php while ( have_rows('author_3') ) : the_row(); ?>
			<h4>
            <?php
				$field = get_sub_field_object('author_types');
				$value = get_sub_field('author_types');
				$label = $field['choices'][ $value ];
				if (!$value == ('AT0')) { echo $label; }
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
			</h4>
            <?php endwhile; ?><?php endif; ?>

            <?php if( have_rows('author_4') ): ?><?php while ( have_rows('author_4') ) : the_row(); ?>
			<h4>
            <?php
				$field = get_sub_field_object('author_types');
				$value = get_sub_field('author_types');
				$label = $field['choices'][ $value ];
				if (!$value == ('AT0')) { echo $label; }
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
			</h4>
            <?php endwhile; ?><?php endif; ?>

            <?php if( have_rows('author_5') ): ?><?php while ( have_rows('author_5') ) : the_row(); ?>
			<h4>
            <?php
				$field = get_sub_field_object('author_types');
				$value = get_sub_field('author_types');
				$label = $field['choices'][ $value ];
				if (!$value == ('AT0')) { echo $label; }
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
			</h4>
            <?php endwhile; ?><?php endif; ?>

            <?php if( have_rows('author_6') ): ?><?php while ( have_rows('author_6') ) : the_row(); ?>
			<h4>
            <?php
				$field = get_sub_field_object('author_types');
				$value = get_sub_field('author_types');
				$label = $field['choices'][ $value ];
				if (!$value == ('AT0')) { echo $label; }
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
            
			<?php the_content(); ?>
            
            <p><?php if (get_field('book_size')): ?><?php (the_field('book_size')); ?><?php endif; ?> cm, 
            <?php if (get_field('pages')): ?><?php (the_field('pages')); ?><?php endif; ?> pages,
            <?php
				$field = get_field_object('book_colours');
				$value = get_field('book_colours');
				$label = $field['choices'][ $value ];
				echo $label;
			?><br />
           First published 
                    </div>
				</div>




		<div class="inner clearfix" style="margin-top:20px;">
                
			<div class="creator-image clearfix">
                	<ul class="related-creators clearfix">
            <?php if( have_rows('author_1') ): ?><?php while ( have_rows('author_1') ) : the_row(); ?>
                <?php 
					$posts = get_sub_field('name');
					if( $posts ): ?>
					<?php foreach( $posts as $post): ?>
					<?php setup_postdata($post); ?>
                    	<li>
	        	    	<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail(); ?>
						<?php elseif (get_field('joomla_image_url')): ?><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php the_field('joomla_image_url') ?>" />
						<?php else: ?><img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
						<?php endif ?>
                        </a>
           		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        </li>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
             <?php endwhile; ?><?php endif; ?>
            <?php if( have_rows('author_2') ): ?><?php while ( have_rows('author_2') ) : the_row(); ?>
                <?php 
					$posts = get_sub_field('name');
					if( $posts ): ?>
					<?php foreach( $posts as $post): ?>
					<?php setup_postdata($post); ?>
                    	<li>
	        	    	<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail(); ?>
						<?php elseif (get_field('joomla_image_url')): ?><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php the_field('joomla_image_url') ?>" />
						<?php else: ?><img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
						<?php endif ?>
                        </a>
           		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    	</li>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
             <?php endwhile; ?><?php endif; ?>
            <?php if( have_rows('author_3') ): ?><?php while ( have_rows('author_3') ) : the_row(); ?>
                <?php 
					$posts = get_sub_field('name');
					if( $posts ): ?>
					<?php foreach( $posts as $post): ?>
					<?php setup_postdata($post); ?>
                    	<li>
	        	    	<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail(); ?>
						<?php elseif (get_field('joomla_image_url')): ?><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php the_field('joomla_image_url') ?>" />
						<?php else: ?><img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
						<?php endif ?>
                        </a>
           		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    	</li>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
             <?php endwhile; ?><?php endif; ?>
            <?php if( have_rows('author_4') ): ?><?php while ( have_rows('author_4') ) : the_row(); ?>
                <?php 
					$posts = get_sub_field('name');
					if( $posts ): ?>
					<?php foreach( $posts as $post): ?>
					<?php setup_postdata($post); ?>
                    	<li>
	        	    	<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail(); ?>
						<?php elseif (get_field('joomla_image_url')): ?><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php the_field('joomla_image_url') ?>" />
						<?php else: ?><img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
						<?php endif ?>
                        </a>
           		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    	</li>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
             <?php endwhile; ?><?php endif; ?>
            <?php if( have_rows('author_5') ): ?><?php while ( have_rows('author_5') ) : the_row(); ?>
                <?php 
					$posts = get_sub_field('name');
					if( $posts ): ?>
					<?php foreach( $posts as $post): ?>
					<?php setup_postdata($post); ?>
                    	<li>
	        	    	<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail(); ?>
						<?php elseif (get_field('joomla_image_url')): ?><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php the_field('joomla_image_url') ?>" />
						<?php else: ?><img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
						<?php endif ?>
                        </a>
           		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    	</li>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
             <?php endwhile; ?><?php endif; ?>
            <?php if( have_rows('author_6') ): ?><?php while ( have_rows('author_6') ) : the_row(); ?>
                <?php 
					$posts = get_sub_field('name');
					if( $posts ): ?>
					<?php foreach( $posts as $post): ?>
					<?php setup_postdata($post); ?>
                    	<li>
	        	    	<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail(); ?>
						<?php elseif (get_field('joomla_image_url')): ?><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php the_field('joomla_image_url') ?>" />
						<?php else: ?><img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
						<?php endif ?>
                        </a>
           		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    	</li>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
             <?php endwhile; ?><?php endif; ?>
			<?php 
			$posts = get_field('illustrator');
			if( $posts ): ?>
					<?php foreach( $posts as $post): ?>
					<?php setup_postdata($post); ?>
                    	<li>
	        	    	<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail(); ?>
						<?php elseif (get_field('joomla_image_url')): ?><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php the_field('joomla_image_url') ?>" />
						<?php else: ?><img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
						<?php endif ?>
                        </a>
           		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    	</li>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			<?php 
			$posts = get_field('photographer');
			if( $posts ): ?>
					<?php foreach( $posts as $post): ?>
					<?php setup_postdata($post); ?>
                    	<li>
	        	    	<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()): ?><?php the_post_thumbnail(); ?>
						<?php elseif (get_field('joomla_image_url')): ?><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php the_field('joomla_image_url') ?>" />
						<?php else: ?><img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
						<?php endif ?>
                        </a>
           		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    	</li>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
			<?php endif; ?>
            		</ul>
			</div>
            
			<div class="creator-works clearfix
           		<?php if (get_field ('author_1') || 
							get_field ('author_2') || 
							get_field ('author_3') || 
							get_field ('author_4') || 
							get_field ('author_5') || 
							get_field ('author_6') || 
							get_field ('illustrator') || 
							get_field ('photographer') ) 
						{ echo 'auther-books'; } 
				?>
            ">

            <?php if( have_rows('author_1') ): ?>
				<?php while ( have_rows('author_1') ) : the_row(); ?>
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
						<?php elseif (get_field('joomla_image_url')): ?><img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )) ?><?php $getTadaFunc->getCountryCode(get_field('joomla_image_url'), $_GET["country"]); ?>" />
						<?php else: ?><img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
						<?php endif ?>
                        </a>
           		    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					</li>
					<?php endforeach; ?>
					</ul>
						<?php endif; ?>
             	<?php endwhile; ?>
			<?php endif; ?>




		    <?php
			$authorID = get_field("author_1");
			$authorID = $authorID[0]["name"][0]->ID;
			$book = array(
					    'post_type' => 'book',
					    'posts_per_page' => -1,
						'meta_query' => $getTadaFunc->getSearch(
							array(
								"author_1"=>$authorID,
							)),
			);
			array_push($book["meta_query"], array("key"=>"series", "value"=>"SR0", "compare"=>"="));

			$book2 = array(
					    'post_type' => 'book',
					    'posts_per_page' => -1,
						'meta_query' => $getTadaFunc->getSearch(
							array(
								"author_1"=>$authorID,
							)),
			);
			array_push($book2["meta_query"], array("key"=>"series", "value"=>"SR0", "compare"=>"!="));

			/* The 2nd Query (without global var) */
			$bookList = new WP_Query( $book );
			$bookList2 = new WP_Query( $book2 );
			$arrSeries = array();
			while ( $bookList2->have_posts() ) {
				$bookList2->the_post();
				array_push($arrSeries, get_field("series",$bookList2->post->ID));
			}
			$arrSeries = array_unique($arrSeries);
			?>    


            
            <h3 class="title-series auther-works-title">His/her other work(s)</h3>
                	<ul class="related-books auther-books clearfix">
                		<?php 
                		
						while ( $bookList->have_posts() ) {
							$bookList->the_post();
							echo '<li>';
							$url = wp_get_attachment_url( get_post_thumbnail_id($bookList->post->ID) );
							if(get_field('joomla_image_url',$bookList->post->ID)){ ?>
								<img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )); ?><?php $getTadaFunc->getCountryCode(get_field('joomla_image_url',$bookList->post->ID), $_GET["country"]); ?>">
							<?php }elseif($url){ ?>
								<img src="<?php echo $url; ?>">
							<?php }else{ ?>
								<img src="<?php echo get_bloginfo('template_directory').'/images/no_image.jpg'; ?>">
							<?php
							}
							echo '<h4>' . get_the_title( $bookList->post->ID ) . '</h4></li>';
						
							
						}

						// Restore original Post Data
						wp_reset_postdata();?>
					</ul>


			
    	        <?php
					$field = get_field_object('series');
					$value = get_field('series');
					$label = $field['choices'][ $value ];

    		foreach ($arrSeries as $value) {
    			$book3 = array(
					    'post_type' => 'book',
					    'posts_per_page' => -1,
						'meta_query' => $getTadaFunc->getSearch(
							array(
								"author_1"=>$authorID,
							)),
						);
				array_push($book3["meta_query"], array("key"=>"series", "value"=>$value, "compare"=>"="));
				$bookList3 = new WP_Query( $book3 ); ?>

    			<h3 class="title-series"><?php echo $field['choices'][ $value ]; ?></h3>
				<ul class="related-books clearfix">
				<?php while ( $bookList3->have_posts() ) {
					$bookList3->the_post();
					echo '<li>';
					$url = wp_get_attachment_url( get_post_thumbnail_id($bookList3->post->ID) );
					if(get_field('joomla_image_url',$bookList3->post->ID)){
						echo '<img src="'.esc_url( home_url( '/wp-content/uploads/' )).get_field('joomla_image_url',$bookList3->post->ID).'">';
					}elseif($url){
						echo '<img src="'.$url.'">';
					}else{
						echo '<img src="'.get_bloginfo('template_directory').'/images/no_image.jpg" />';
					}
					echo '<h4>' . get_the_title( $bookList3->post->ID ) . '</h4></li>';
				
				}
				echo "</ul>";
				wp_reset_postdata();
    		}
    		?>
			

            
            
            
            </div>
                           
                
                	
                
                                
                
                
                </div>
















        </div>
        <!-- .entry-content -->
      </article>
      <!-- #post-## --> 
    </div>
    <?php endwhile; // end of the loop. ?>


  </div>
  <!-- close .row --> 
</div>
<!-- close .main-content -->

<?php get_footer(); ?>
