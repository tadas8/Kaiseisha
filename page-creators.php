<?php
/*
Template Name: Creators
*/

get_header(); 
$getTadaFunc = new tadaFunctions;

?>

<div class="main-content books creators clearfix">

<?php get_template_part( 'content', 'page-top' ); ?>

<?php get_template_part( 'content', 'search-panel' ); ?>
        
<div id="main" class="row">
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




          <?php 		  
					if (is_page ( 'authors' )) {
						$posts = array(
						'paged' => $paged,
						'posts_per_page' => '1000',
						'post_type' => 'creator',
						'orderby' => array ('title => ASC'),
						'meta_query'	=> array(
							'relation'		=> 'AND',
							array(
								'key'		=> 'creator_types',
								'value'		=> 'CT1',
								'compare'	=> 'LIKE'
								)
							)
						);
					}
					elseif (is_page ( 'illustrators' )) {
						$posts = array(
						'paged' => $paged,
						'posts_per_page' => '1000',
						'post_type' => 'creator',
						'orderby' => array ('title => ASC'),
						'meta_query'	=> array(
							'relation'		=> 'AND',
							array(
								'key'		=> 'creator_types',
								'value'		=> 'CT2',
								'compare'	=> 'LIKE'
								)
							)
						);
					}
					elseif (is_page ( 'photographers' )) {
						$posts = array(
						'paged' => $paged,
						'posts_per_page' => '1000',
						'post_type' => 'creator',
						'orderby' => array ('title => ASC'),
						'meta_query'	=> array(
							'relation'		=> 'AND',
							array(
								'key'		=> 'creator_types',
								'value'		=> 'CT3',
								'compare'	=> 'LIKE'
								)
							)
						);
					}

					
					query_posts($posts);
					if (have_posts()): ?>

        <?php
        $arrNames = array();
        while (have_posts()) : the_post();
        array_push($arrNames, array("title"=>get_the_title(),"id"=>get_the_ID()));
        endwhile;
        $resSortedNames = $getTadaFunc->getSortedNames($arrNames);
        for($i=0; $i<26; $i++){
		    $alphabet = chr(ord('a')+$i);
		    echo '<h2>'.$alphabet.'</h2>';
		    foreach ($resSortedNames as $key => $value) {
		    	if(strtoupper($value["I"]) == strtoupper($alphabet)){
		    		echo '<a href="'.get_permalink($value["id"]).'">'.$value["F"].' '.$value["L"].'</a><br>';
		    	}
		    }
		}

        ?>
         

        <ul class="creatorlist clearfix">

		</ul>

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
