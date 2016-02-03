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

if($author_1){
  array_push($arrAuthorMatch, $author_1);
}

if($illustrator){
	array_push($arrAuthorMatch, $illustrator);
}
if($photographer){
	array_push($arrAuthorMatch, $photographer);
}
	var_dump($inc_or_exc);

?>



		<?php
		$searchQuery = new tadaFunctions;
		if(!$categories && !$age_groups && !$publication_year && !$countries_published_in){
			$published = array(
					    'post_type' => 'book',
					    'posts_per_page' => 500,
					    's' => $title,
					  	'paged' => get_query_var( 'paged' ),
			);			
		}else{
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
								"inc_or_exc"=>$inc_or_exc,
								"countries_published_in"=>$countries_published_in,
							)),
			);				
		}
		
		


		echo "<pre>";var_dump($published);echo "</pre>";

		?>
		
       	<?php query_posts( $published ); 


		// Start the loop.
		while ( have_posts() ) : the_post();
			$tmp=get_field("author_1");
			if(empty($tmp[0]["name"][0]->ID) || empty($arrAuthorMatch)){
				$cond1 = true;
			}elseif(in_array($tmp[0]["name"][0]->ID, $arrAuthorMatch)){
				$cond1 = true;
			}else{
				$cond1 = false;
			}

			$tmp2=get_field("illustrator");
			//var_dump($tmp2);
			if(empty($tmp2[0]->ID) || empty($arrAuthorMatch)){
				$cond2 = true;
			}elseif(in_array($tmp2[0]->ID, $arrAuthorMatch)){
				$cond2 = true;
			}else{
				$cond2 = false;
			}

			$tmp3=get_field("photographer");
			if(empty($tmp3[0]->ID) || empty($arrAuthorMatch)){
				$cond3 = true;
			}elseif(in_array($tmp3[0]->ID, $arrAuthorMatch)){
				$cond3 = true;
			}else{
				$cond3 = false;
			}


			if($cond1 && $cond2 && $cond3){
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