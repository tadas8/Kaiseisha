<?php get_header(); ?>
      
      <div class="main-content">
        <div class="row">
          <div id="slideshow" class="col-sm-12 clearfix">
            <div id="slideshow-menu">
              <div class="slideshow-menu-button new"><a href="<?php echo esc_url( home_url( '/' ) ); ?>new-titles/picture/">
                <div class="up-button"></div>
                New Titles</a></div>
              <div class="slideshow-menu-button back"><a href="<?php echo esc_url( home_url( '/' ) ); ?>backlist/picture/">
                <div class="up-button"></div>
                Backlist</a></div>
              <div class="slideshow-menu-button overseas"><a href="<?php echo esc_url( home_url( '/' ) ); ?>overseas/picture/">
                <div class="up-button"></div>
                Overseas</a></div>
            </div>

            <?php if( have_rows('slideshow') ): ?>
            <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
              <div class="carousel-inner">

			  <?php while( have_rows('slideshow') ): the_row(); ?>
                <div class="item">
                <?php if( get_sub_field('page_link') ): ?>
                <a href="<?php the_sub_field('page_link'); ?>"><img class="slide-image" src="<?php the_sub_field('image'); ?>" alt=""></a>
                <?php else: ?>
                <img class="slide-image" src="<?php the_sub_field('image'); ?>" alt="" />
                <?php endif; ?>
                </div>
                <?php endwhile; ?>

              </div>
            </div>
            <?php endif; ?>

          </div>
        </div>
        <div class="row">
          <?php while ( have_posts() ) : the_post(); ?>
          <div class="col-sm-6">
            <div class="row">
              <div class="news-top col-sm-12">
                <div class="row">
                  <h2 class="col-sm-3"><a href="<?php echo esc_url( get_category_link( 4 ) ); ?>">News</a></h2>
                  <div class="col-sm-9">
                    <p>	| <a href="<?php echo esc_url( get_category_link( 10 ) ); ?>">Latest</a> 
                    	| <a href="<?php echo esc_url( get_category_link( 11 ) ); ?>">Archive</a> 
                        | <span class="red"><?php echo $post->post_content; ?></span> |</p>
                  </div>
                </div>
                <div class="line-news"></div>
              </div>
              <div class="col-sm-12">
                <ul class="news-headlines">
                
				<?php
					$posts = get_posts('numberposts=3&category=10&order=ASC');
					foreach($posts as $post) :
				?>
					<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
          <?php endwhile; // end of the loop. ?>
          <div class="col-sm-6">
            <div class="row">
              <div class="news-top about-us col-sm-12">
                <div class="row">
                  <h2 class="col-sm-4"><a href="<?php echo get_permalink( 52 ); ?>">About Us</a></h2>
                  <div class="col-sm-8">
                    <p>	| <a href="<?php echo get_permalink( 68 ); ?>">History</a> 
                    	| <a href="<?php echo get_permalink( 70 ); ?>">Foreign Titles</a> 
                        | <a href="<?php echo get_permalink( 72 ); ?>">Awards</a> |</p>
                  </div>
                </div>
                <div class="line-news"></div>
              </div>
              <div class="col-sm-12">
                <?php
					$page = get_page( '68' );
					$content = apply_filters('the_content', limit_text( $page->post_content, 40 ) ); 
					$link = get_permalink( $page );
					echo $content;
					echo "<a href='$link'>Read more</a>";
				?>
              </div>
            </div>
          </div>
        </div>
        <!-- close .row --> 
      </div>
      <!-- close .main-content -->


<?php
$CT1 = array(
        'post_type' => 'creator',
        'posts_per_page' => -1,
        'paged' => get_query_var( 'paged' ),
        'meta_query' => array(
                          array(  'key'=>'creator_types',
                                  'value'=>'CT1',
                                  'compare'=>'LIKE'
                                )
                              ),
);
query_posts( $CT1 );
$arrCT1=array();
while ( have_posts() ) : the_post();
  array_push($arrCT1, array("id"=>get_the_ID(), "name"=>get_the_title()));
// End the loop.
endwhile;

$CT2 = array(
        'post_type' => 'creator',
        'posts_per_page' => -1,
        'paged' => get_query_var( 'paged' ),
        'meta_query' => array(
                          array(  'key'=>'creator_types',
                                  'value'=>'CT2',
                                  'compare'=>'LIKE'
                                )
                              ),
);
query_posts( $CT2 );
$arrCT2=array();
while ( have_posts() ) : the_post();
  array_push($arrCT2, array("id"=>get_the_ID(), "name"=>get_the_title()));
// End the loop.
endwhile;

$CT3 = array(
        'post_type' => 'creator',
        'posts_per_page' => -1,
        'paged' => get_query_var( 'paged' ),
        'meta_query' => array(
                          array(  'key'=>'creator_types',
                                  'value'=>'CT3',
                                  'compare'=>'LIKE'
                                )
                              ),
);
query_posts( $CT3 );
$arrCT3=array();
while ( have_posts() ) : the_post();
  array_push($arrCT3, array("id"=>get_the_ID(), "name"=>get_the_title()));
// End the loop.
endwhile;


?>
<form action="<?php echo site_url(); ?>/search" method="get">
<input type="text" name="title">
<input type="text" name="creator_by_name">
<select name="categories"><option value="">- Select -</option><option value="CAT1">Picture Book</option><option value="CAT2">Fiction</option><option value="CAT3">Non-Fiction</option><option value="CAT4">Science Books</option></select>
<select name="age_groups"><option value="">- Select -</option><option value="AG1">Ages 0 UP</option><option value="AG2">Ages 1 UP</option><option value="AG3">Ages 2 UP</option><option value="AG4">Ages 3 UP</option><option value="AG5">Ages 4 UP</option><option value="AG6">Ages 5 UP</option><option value="AG7">Ages 6 UP</option><option value="AG8">Ages 7 UP</option><option value="AG9">Ages 8 UP</option><option value="AG10">Ages 9 UP</option><option value="AG11">Ages 10 UP</option><option value="AG12">Ages 11 UP</option><option value="AG13">Ages 12 UP</option><option value="AG14">Young Adult</option><option value="AG15">All Ages</option></select>

<select name="publication_year">
<option value="">-select</option>
  <?php
  $thisYear = date("Y");
  for ($year=$thisYear; $year > 1950 ; $year--) { 
    echo '<option value="'.$year.'">'.$year.'</option>';
  }
  ?>
</select>

<select name="author_1">
<option value="">-select</option>
  <?php
  foreach ($arrCT1 as $key => $value) {
    echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
  }
  ?>
</select>

<select name="illustrator">
<option value="">-select</option>
  <?php
  foreach ($arrCT2 as $key => $value) {
    echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
  }
  ?>
</select>
<select name="photographer">
<option value="">-select</option>

  <?php
  foreach ($arrCT3 as $key => $value) {
    echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
  }
  ?>
</select>

<br>
<input type="radio" name="inc_or_exc" value="0" checked>exclude<br>
<input type="radio" name="inc_or_exc" value="1" checked>include<br>


<select name="countries_published_in">
<option value="">- select</option>
<option value="CNT1">Finland</option>
<option value="CNT2">France</option>
<option value="CNT3">Germany</option>
<option value="CNT4">Norway</option>
<option value="CNT5">Spain</option>
<option value="CNT6">Sweden</option>
<option value="CNT7">UK</option>
<option value="CNT8">China</option>
<option value="CNT9">India</option>
<option value="CNT10">Korea</option>
<option value="CNT11">Taiwan</option>
<option value="CNT12">Canada</option>
<option value="CNT13">US</option>
<option value="CNT14">Thailand</option>
<option value="CNT15">Italy</option>
<option value="CNT16">Netherland</option>
<option value="CNT17">Hungary</option>
<option value="CNT18">Belgium</option>
<option value="CNT19">Bulgaria</option>
<option value="CNT20">Hong Kong</option>
<option value="CNT21">Australia</option>
<option value="CNT22">Brazil</option>
<option value="CNT23">Indonesia</option>
<option value="CNT24">Argentina</option>
<option value="CNT25">Mexico</option>
<option value="CNT26">New Zealand</option>
<option value="CNT29">Russia</option>
<option value="CNT28">Portugual</option>
<option value="CNT30">Catalan</option>
<option value="CNT31">Basque</option>
<option value="CNT32">Vietnam</option>
<option value="CNT33">Poland</option>
<option value="CNT34">Iran</option>
<option value="CNT35">Japan</option>
<option value="CNT36">Venezuela</option>
</select>

  <input type="submit" value="Submit">


</form>


<?php get_footer(); ?>
