<?php
/**
 * _tk functions and definitions
 *
 * @package _tk
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_tk_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _tk_setup() {
	global $cap, $content_width;

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	add_theme_support( 'custom-background', apply_filters( '_tk_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _tk, use a find and replace
	 * to change '_tk' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_tk', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header bottom menu', '_tk' ),
		'top-menu'  => __( 'Top menu', '_tk' ),
		'about-us-menu'  => __( 'About Us menu', '_tk' ),
		'news-menu'  => __( 'News menu', '_tk' ),
		'backlist-menu'  => __( 'Backlist menu', '_tk' ),
		'newtitles-menu'  => __( 'New Titles menu', '_tk' ),
		'overseas-menu'  => __( 'Overseas menu', '_tk' ),
		'creators-menu'  => __( 'Creators menu', '_tk' ),
	) );

}
endif; // _tk_setup
add_action( 'after_setup_theme', '_tk_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _tk_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_tk' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_tk_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function _tk_scripts() {

	// Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( '_tk-bootstrap-wp', get_template_directory_uri() . '/includes/css/bootstrap-wp.css' );

	// load bootstrap css
	wp_enqueue_style( '_tk-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	wp_enqueue_style( '_tk-font-awesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.1.0' );

	// load _tk styles
	wp_enqueue_style( '_tk-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('_tk-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( '_tk-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( '_tk-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_tk-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_tk_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';




/* Added functions */

/* Disable WordPress Admin Bar for all users but admins. */
  show_admin_bar(false);


/* Text limit */
function limit_text($text, $limit) {
    if (strlen($text) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}


/* Add class to wp_get_archives */
function my_archives_link($link_html){
	$link_html = preg_replace('@<li>@i', '<li class="news-archive"><div class="inner">', $link_html);
	$link_html = preg_replace('@</li>@i', '</div></li>', $link_html);
	return $link_html;
}
add_filter('get_archives_link', 'my_archives_link');


/* Force sub-categories to use the parent category template */
function new_subcategory_hierarchy() {  
    $category = get_queried_object();
 
    $parent_id = $category->category_parent;
 
    $templates = array();
     
    if ( $parent_id == 0 ) {
        // Use default values from get_category_template()
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
        $templates[] = 'category.php';      
    } else {
        // Create replacement $templates array
        $parent = get_category( $parent_id );
 
        // Current first
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
 
        // Parent second
        $templates[] = "category-{$parent->slug}.php";
        $templates[] = "category-{$parent->term_id}.php";
        $templates[] = 'category.php';  
    }
    return locate_template( $templates );
}
 
add_filter( 'category_template', 'new_subcategory_hierarchy' );







class tadaFunctions{
	function getSearch($metas){
		$arrMeta = array();
		$countMeta = 0;
		if($metas["categories"]){
			array_push($arrMeta, array("key"=>"categories", "value"=>$metas["categories"], "compare"=>"="));
			$countMeta++;
		}
		if($metas["age_groups"]){
			array_push($arrMeta, array("key"=>"age_groups", "value"=>$metas["age_groups"], "compare"=>"="));
			$countMeta++;
		}
		if($metas["publication_year"]){
			array_push($arrMeta, array("key"=>"publication_year", "value"=>array($metas["publication_year"].'-01-01',$metas["publication_year"].'-12-31'), "compare"=>"BETWEEN",'type'=>'DATE'));
			$countMeta++;
		}
		if($metas["author_1"]){
			array_push($arrMeta, array("key"=>"author_1_0_name","value"=>$metas["author_1"], "compare" => "LIKE"));
			$countMeta++;
		}
		if($metas["illustrator"]){
			array_push($arrMeta, array("key"=>"illustrator","value"=>$metas["illustrator"], "compare" => "LIKE"));
			$countMeta++;
		}
		if($metas["photographer"]){
			array_push($arrMeta, array("key"=>"photographer","value"=>$metas["photographer"], "compare" => "LIKE"));
			$countMeta++;
		}				
		if($metas["arrAuthorMatch"]){
			$arrSubQuery = array();
			foreach ($metas["arrAuthorMatch"] as $key => $value) {
				array_push($arrSubQuery, array("key"=>"author_1_0_name","value"=>$value, "compare" => "LIKE"));
			}
			$arrSubQuery["relation"] = 'OR';
			array_push($arrMeta, $arrSubQuery);
			$countMeta++;
		}		
		if($metas["inc_or_exc"]==1 && $metas["countries_published_in"]){
			array_push($arrMeta, array("key"=>"countries_published_in", "value"=>$metas["countries_published_in"], "compare"=>"LIKE"));
			$countMeta++;
		}elseif($metas["inc_or_exc"]==0 && $metas["countries_published_in"]){
			array_push($arrMeta, array("key"=>"countries_published_in", "value"=>$metas["countries_published_in"], "compare"=>"NOT LIKE"));
			$countMeta++;
		}
		if($countMeta>1){$arrMeta["relation"] = 'AND';}
		return $arrMeta;
	}




	// function pagination($pages = '', $range = 4) {

	// 	$showitems = ($range * 2)+1;
	// 	global $paged;
	// 	if(empty($paged)) $paged = 1;
	// 	if($pages == ''){
	// 		global $wp_query;
	// 		$pages = $wp_query->max_num_pages;
	// 		if(!$pages){
	// 			$pages = 1;
	// 		}
	// 	}

	// 	if(1 != $pages){
	// 		echo "<div style=\"display: inline-block;\" class=\"pagenavi\">";
	// 		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>« First</a>";
	// 		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>‹ Previous</a>";
	// 		for ($i=1; $i <= $pages; $i++){
	// 			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
	// 				echo ($paged == $i)? "<span class=\"current page\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"page larger\">".$i."</a>";
	// 			}
	// 		}
	// 		if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next ›</a>";
	// 		if ($paged < $pages-1 &&
	// 		$paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last »</a>";
	// 		echo "</div>\n";
	// 	}
	// }



	function getPagination(){
		global $wp_rewrite;
		global $wp_query; 
		$paged = $_GET["paged"];
		//var_dump($wp_rewrite);
	    $paginate_base = get_pagenum_link(1);
	    if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
	        $paginate_format = '';
	        $paginate_base = add_query_arg('paged','%#%');
	    }else{
	        $paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
	        user_trailingslashit('?paged=%#%','paged');
	        $paginate_base .= '%_%';
	    }

	    $paginate_format = substr($paginate_format, 0, -1);
	    echo paginate_links(array(
	        'base' => $paginate_base,
	        'format' => $paginate_format,
	        'total' => $wp_query->max_num_pages,
	        'mid_size' => 4,
	        'current' => ($paged ? $paged : 1),
	        'prev_text' => '« Previous',
	        'next_text' => 'Next »',
	    )); 
	}

}

add_filter('redirect_canonical','my_disable_redirect_canonical');

function my_disable_redirect_canonical( $redirect_url ) {

	if ( is_single() ){
		$subject = $redirect_url;
		$pattern = '/\/page\//'; // URLに「/page/」があるかチェック
		preg_match($pattern, $subject, $matches);

		if ($matches){
		//リクエストURLに「/page/」があれば、リダイレクトしない。
		$redirect_url = false;
		return $redirect_url;
		}
	}

}

