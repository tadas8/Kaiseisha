<?php
/**
* Template Name: search
 */

get_header();

$title = $_POST["title"];
$creator_by_name = $_POST["creator_by_name"];
$categories = $_POST["categories"];
$age_groups = $_POST["age_groups"];
$publication_year = $_POST["publication_year"];
$author_1 = $_POST["author_1"];
$illustrator = $_POST["illustrator"];
$photographer = $_POST["photographer"];
$inc_or_exc = $_POST["inc_or_exc"];
$countries_published_in = $_POST["countries_published_in"];

$creator_by_name="saeko";
if($creator_by_name){
	$authorMatch = array(
        'post_type' => 'creator',
        's'=> $creator_by_name,
        'posts_per_page' => -1,
	);
	query_posts( $authorMatch );
	$arrAuthorMatch=array();
	while ( have_posts() ) : the_post();
	  array_push($arrAuthorMatch, get_the_ID());
	endwhile;
	if($author_1){
	  array_push($arrAuthorMatch, $author_1);
	}
	//var_dump($arrAuthorMatch);
}

?>



		<?php
		$searchQuery = new tadaFunctions;
		$published = array(
				    'post_type' => 'book',
				    's' => $title,
				    //'post__in' => 
				    'posts_per_page' => -1,
				  	'paged' => get_query_var( 'paged' ),
					'meta_query' => $searchQuery->getSearch(
						array(
							"categories"=>$categories,
							"age_groups"=>$age_groups,
							"publication_year"=>$publication_year,
							//"author_1"=>$author_1,
							"illustrator"=>$illustrator,
							"photographer"=>$photographer,
							//"creator_by_name"=>"",
							"inc_or_exc"=>$inc_or_exc,
							"countries_published_in"=>$countries_published_in,
						)),
		);
		echo "<pre>";var_dump($published);echo "</pre>";

		?>
		
       	<?php query_posts( $published ); 


		// Start the loop.
		while ( have_posts() ) : the_post();
			$tmp=get_field("author_1");
			if(in_array($tmp[0]["name"][0]->ID, $arrAuthorMatch)){
				the_ID(); echo "<br>";
				the_title(); echo "<br>";
			}else{
				echo "no<br>";
				the_ID(); echo "<br>";
			}

			


		// End the loop.
		endwhile;
		?>




<?php get_footer(); ?>