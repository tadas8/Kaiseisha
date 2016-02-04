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

	var_dump($arrAuthorMatch);
}

	//var_dump($inc_or_exc);


		if(!$paged){
			$paged = 1;
		}
		$searchQuery = new tadaFunctions;
		if(!$categories && !$age_groups && !$publication_year && !$countries_published_in && !$arrAuthorMatch){
			$published = array(
					    'post_type' => 'book',
					    'posts_per_page' => 10,
					    's' => $title,
					  	'paged' => $paged,
			);			
		}else{
			$published = array(
					    'post_type' => 'book',
					    's' => $title,
					    //'post__in' => 
					    'posts_per_page' => 10,
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



		echo "<pre>";var_dump($published);echo "</pre>";

		?>
		
       	<?php query_posts( $published ); 
		global $wp_query; 
		echo "<pre>";var_dump($wp_query->found_posts);echo "</pre>";

		if($wp_query->found_posts < 60){
			// Start the loop.
			while ( have_posts() ) : the_post();


				the_ID(); echo "<br>";
				//the_title(); echo "<br>";



				


			// End the loop.
			endwhile;
			

global $wp_rewrite;
    $paginate_base = get_pagenum_link(1);
    if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
        $paginate_format = '';
        $paginate_base = add_query_arg('paged','%#%');
    }
    else{
        $paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
        user_trailingslashit('page/%#%/','paged');;
        $paginate_base .= '%_%';
    }
    echo paginate_links(array(
        'base' => $paginate_base,
        'format' => $paginate_format,
        'total' => $wp_query->max_num_pages,
        'mid_size' => 4,
        'current' => ($paged ? $paged : 1),
        'prev_text' => '« 前へ',
        'next_text' => '次へ »',
    )); 			


		}else{
			var_dump("OVER 100");
		}



get_footer(); ?>
