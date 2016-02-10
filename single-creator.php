<?php get_header(); 
$getTadaFunc = new tadaFunctions;
?>

<div class="main-content">
<?php get_template_part( 'content', 'page-top' ); ?>

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
<div class="entry-content creator-single clearfix">
<div class="inner clearfix">
<div class="coverimage clearfix">
  <?php if (has_post_thumbnail()): ?>
  <?php the_post_thumbnail(); ?>
  <?php elseif (get_field('joomla_image_url')): ?>
  <img src="<?php echo esc_url( home_url( '/wp-content/uploads/' )); ?><?php the_field('joomla_image_url'); ?>" />
  <?php else: ?>
  <img src="<?php echo get_bloginfo('template_directory');?>/images/no_image.jpg" />
  <?php endif ?>
</div>
<div class="details clearfix">
<h2>
  <?php the_title(); ?>
</h2>
<?php if($post->post_content=="") { echo '<p>Coming soon.</p>'; } 
					else { echo the_content(); } ?>
<?php if (have_rows('home_page')): ?>
<ul class="creator-url">
<?php while (have_rows('home_page')) : the_row(); ?>
<li>
  <?php if (get_sub_field('url')): ?>
  <?php $str = (get_sub_field('url'));
								$str = str_replace(array('http://','https://'), '', $str);
								echo '<h4><a href="http://'.$str.'">'.$str.'</a></h4>';?>
  <? endif; ?>
  <?php if (get_sub_field('note')) { echo '<p>'.(get_sub_field('note')).'</p>'; } ?>
</li>
<?php endwhile; ?>
<?php endif; ?>
</div>
</div>
<div class="inner clearfix" style="margin-top:20px;">
			<div class="creator-works creators clearfix auther-books">




        <?php
      $authorID = get_the_ID();
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
              echo '<li><a href="'.get_permalink($bookList->post->ID).'">';
              $url = wp_get_attachment_url( get_post_thumbnail_id($bookList->post->ID) );
              if(get_field('joomla_image_url',$bookList->post->ID)){
                echo '<img src="'.esc_url( home_url( '/wp-content/uploads/' )).get_field('joomla_image_url',$bookList->post->ID).'">';
              }elseif($url){
                echo '<img src="'.$url.'">';
              }else{
                echo '<img src="'.get_bloginfo('template_directory').'/images/no_image.jpg" />';
              }
              echo '</a><h4><a href="'.get_permalink($bookList->post->ID).'">' . get_the_title( $bookList->post->ID ) . '</a></h4></li>';
            
              
            }

            // Restore original Post Data
            wp_reset_postdata();?>
          </ul>


      
              <?php
          $field = get_field_object('field_5693a44e799e5');
          $value = get_field('series');
          //$label = $field['choices'][ $value ];
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
          echo '<li><a href="'.get_permalink($bookList3->post->ID).'">';
          $url = wp_get_attachment_url( get_post_thumbnail_id($bookList3->post->ID) );
          if(get_field('joomla_image_url',$bookList3->post->ID)){
            echo '<img src="'.esc_url( home_url( '/wp-content/uploads/' )).get_field('joomla_image_url',$bookList3->post->ID).'">';
          }elseif($url){
            echo '<img src="'.$url.'">';
          }else{
            echo '<img src="'.get_bloginfo('template_directory').'/images/no_image.jpg" />';
          }
          echo '</a><h4><a href="'.get_permalink($bookList3->post->ID).'">' . get_the_title( $bookList3->post->ID ) . '</a></h4></li>';
        
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
