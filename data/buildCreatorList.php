<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "kaiseisha";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM jos_publications_creators";
$result = $conn->query($sql);

$xml ='
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0"
	xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:wp="http://wordpress.org/export/1.2/"
>

<channel>
	<title>Kaiseisha</title>
	<link>http://tsutomuishida.co.uk/kaiseisha</link>
	<description>Just another WordPress site</description>
	<pubDate>Mon, 11 Jan 2016 21:40:56 +0000</pubDate>
	<language>en-GB</language>
	<wp:wxr_version>1.2</wp:wxr_version>
	<wp:base_site_url>http://tsutomuishida.co.uk/kaiseisha</wp:base_site_url>
	<wp:base_blog_url>http://tsutomuishida.co.uk/kaiseisha</wp:base_blog_url>

	<wp:author><wp:author_id>1</wp:author_id><wp:author_login>admin</wp:author_login><wp:author_email>tsutomuishida@mac.com</wp:author_email><wp:author_display_name><![CDATA[admin]]></wp:author_display_name><wp:author_first_name><![CDATA[]]></wp:author_first_name><wp:author_last_name><![CDATA[]]></wp:author_last_name></wp:author>
	<generator>http://wordpress.org/?v=4.3.2</generator>
	';


//echo "<pre>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$rtnCreatorType = getCreatorType($row["creator_type"]);



$xml .=	'<item>
		<title>'.$row["firstname"].' '.$row["lastname"].'</title>
		<link>http://tsutomuishida.co.uk/kaiseisha/creator/'.strtolower($row["firstname"]).'_'.strtolower($row["lastname"]).'</link>
		<pubDate>Mon, 11 Jan 2016 18:26:36 +0000</pubDate>
		<dc:creator><![CDATA[admin]]></dc:creator>
		<guid isPermaLink="false"></guid>
		<description></description>
		<content:encoded><![CDATA['.$row["description"].']]></content:encoded>
		<excerpt:encoded><![CDATA[]]></excerpt:encoded>
		<wp:post_id></wp:post_id>
		<wp:post_date>2016-01-11 18:26:36</wp:post_date>
		<wp:post_date_gmt>2016-01-11 18:26:36</wp:post_date_gmt>
		<wp:comment_status>closed</wp:comment_status>
		<wp:ping_status>closed</wp:ping_status>
		<wp:post_name>'.strtolower($row["firstname"]).'_'.strtolower($row["lastname"]).'</wp:post_name>
		<wp:status>publish</wp:status>
		<wp:post_parent>0</wp:post_parent>
		<wp:menu_order>0</wp:menu_order>
		<wp:post_type>creator</wp:post_type>
		<wp:post_password></wp:post_password>
		<wp:is_sticky>0</wp:is_sticky>
		<wp:postmeta>
			<wp:meta_key>_edit_last</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>creator_types</wp:meta_key>
			<wp:meta_value><![CDATA['.$rtnCreatorType.']]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_creator_types</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693dbc50b8aa]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>home_page_0_url</wp:meta_key>
			<wp:meta_value><![CDATA['.$row["homepage_url"].']]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_home_page_0_url</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693dd3c0b8ac]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>home_page_0_note</wp:meta_key>
			<wp:meta_value><![CDATA['.$row["homepage_url_note"].']]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_home_page_0_note</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693dd430b8ad]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>home_page</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_home_page</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693dc580b8ab]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>joomla_creator_id</wp:meta_key>
			<wp:meta_value><![CDATA['.$row["id"].']]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_joomla_creator_id</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693f98d7aa52]]></wp:meta_value>
		</wp:postmeta>
		';
		if(!empty($row["imageurl"])){
			$xml .= '<wp:postmeta>
				<wp:meta_key>joomla_image_url</wp:meta_key>
				<wp:meta_value><![CDATA[creators/'.$row["imageurl"].']]></wp:meta_value>
			</wp:postmeta>
			';
		}
			
		$xml .= '<wp:postmeta>
			<wp:meta_key>_joomla_image_url</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693fa0799a1c]]></wp:meta_value>
		</wp:postmeta>
	</item>
	';




    }
} else {
    echo "0 results";
}


$xml .= '</channel>
</rss>';

//echo "</pre>";


$conn->close();


file_put_contents("myxmlfile.xml", $xml);



function getCreatorType($str){
	$arrTmp = array();
	$myArray = explode(',', $str);
	foreach ($myArray as $key => $value) {
		$tmp = 'CT'.$value;
		array_push($arrTmp, $tmp);
	}
	
	return serialize($arrTmp);
}



?>