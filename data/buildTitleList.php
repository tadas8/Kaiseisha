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
$sql = "SELECT * FROM jos_publications_titles";
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
		<title>'.$row["title"].'</title>
		<link>http://tsutomuishida.co.uk/kaiseisha/book/'.getSlug($row["title"]).'/</link>
		<pubDate>Fri, 06 Nov 2015 20:42:03 +0000</pubDate>
		<dc:creator><![CDATA[admin]]></dc:creator>
		<guid isPermaLink="false"></guid>
		<description></description>
		<content:encoded><![CDATA['.$row["synopsis"].']]></content:encoded>
		<excerpt:encoded><![CDATA[]]></excerpt:encoded>
		<wp:post_id></wp:post_id>
		<wp:post_date>2015-11-06 20:42:03</wp:post_date>
		<wp:post_date_gmt>2015-11-06 20:42:03</wp:post_date_gmt>
		<wp:comment_status>closed</wp:comment_status>
		<wp:ping_status>closed</wp:ping_status>
		<wp:post_name>'.getSlug($row["title"]).'</wp:post_name>
		<wp:status>publish</wp:status>
		<wp:post_parent>0</wp:post_parent>
		<wp:menu_order>0</wp:menu_order>
		<wp:post_type>book</wp:post_type>
		<wp:post_password></wp:post_password>
		<wp:is_sticky>0</wp:is_sticky>
		<wp:postmeta>
			<wp:meta_key>_edit_last</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>age_groups</wp:meta_key>
			<wp:meta_value><![CDATA[AG'.$row["age_group_id"].']]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_age_groups</wp:meta_key>
			<wp:meta_value><![CDATA[field_56937dd0eaf87]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_1_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[a:1:{i:0;s:3:"802";}]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_1_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[field_56937fab9b869]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_1_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[AT3]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_1_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[field_569382bc9b86a]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_1</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_1</wp:meta_key>
			<wp:meta_value><![CDATA[field_56937ecd9b868]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_2_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[a:1:{i:0;s:3:"857";}]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_2_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff2570623]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_2_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[AT6]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_2_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff2570624]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_2</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_2</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff2570622]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_3_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[a:1:{i:0;s:3:"776";}]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_3_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff3370626]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_3_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[null]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_3_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff3370627]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_3</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_3</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff3370625]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_4_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[a:1:{i:0;s:3:"872";}]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_4_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff3870629]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_4_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[AT4]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_4_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff387062a]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_4</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_4</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff3870628]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_5_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[a:1:{i:0;s:3:"802";}]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_5_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff3d7062c]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_5_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[AT16]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_5_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff3d7062d]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_5</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_5</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff3d7062b]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_6_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[a:1:{i:0;s:3:"776";}]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_6_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff417062f]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_6_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[AT7]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_6_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff4170630]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_6</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_6</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff417062e]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>author_extra</wp:meta_key>
			<wp:meta_value><![CDATA[Author extraAuthor extraAuthor extra]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_author_extra</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ff62c88d3]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>illustrator_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[a:1:{i:0;s:3:"776";}]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_illustrator_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ffb891889]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>illustrator_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[AT2]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_illustrator_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ffb89188a]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>illustrator</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_illustrator</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ffb891888]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>photographer_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[a:1:{i:0;s:3:"740";}]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_photographer_0_name</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ffde9188c]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>photographer_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[AT15]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_photographer_0_author_types</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ffde9188d]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>photographer</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_photographer</wp:meta_key>
			<wp:meta_value><![CDATA[field_5694ffde9188b]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>country_extra_note</wp:meta_key>
			<wp:meta_value><![CDATA[Country extra noteCountry extra noteCountry extra note]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_country_extra_note</wp:meta_key>
			<wp:meta_value><![CDATA[field_5695356a9fd3f]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>book_colours</wp:meta_key>
			<wp:meta_value><![CDATA[BC1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_book_colours</wp:meta_key>
			<wp:meta_value><![CDATA[field_569398cc9b989]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>categories</wp:meta_key>
			<wp:meta_value><![CDATA[CAT1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_categories</wp:meta_key>
			<wp:meta_value><![CDATA[field_56939e989a86b]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>countries_published_in</wp:meta_key>
			<wp:meta_value><![CDATA[a:2:{i:0;s:4:"CNT2";i:1;s:4:"CNT3";}]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_countries_published_in</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a32a65711]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>series</wp:meta_key>
			<wp:meta_value><![CDATA[SR6]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_series</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a44e799e5]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>publication_year</wp:meta_key>
			<wp:meta_value><![CDATA[2016-01-28]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_publication_year</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a51fcaa81]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>book_size</wp:meta_key>
			<wp:meta_value><![CDATA[21x21]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_book_size</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a5e79bc42]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>pages</wp:meta_key>
			<wp:meta_value><![CDATA[200]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_pages</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a5fb26616]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>sub_1_0_title</wp:meta_key>
			<wp:meta_value><![CDATA[sub1 title]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_sub_1_0_title</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a66f26618]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>sub_1_0_text</wp:meta_key>
			<wp:meta_value><![CDATA[sub1 text]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_sub_1_0_text</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a68026619]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>sub_1</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_sub_1</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a64c26617]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>sub_2_0_title</wp:meta_key>
			<wp:meta_value><![CDATA[sub2 title]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_sub_2_0_title</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a69b2661b]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>sub_2_0_text</wp:meta_key>
			<wp:meta_value><![CDATA[sub2 text]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_sub_2_0_text</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a69b2661c]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>sub_2</wp:meta_key>
			<wp:meta_value><![CDATA[1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key>_sub_2</wp:meta_key>
			<wp:meta_value><![CDATA[field_5693a69b2661a]]></wp:meta_value>
		</wp:postmeta>
		';
		if(!empty($row["imageurl"])){
		$xml .= '<wp:postmeta>
						<wp:meta_key>joomla_image_url</wp:meta_key>
						<wp:meta_value><![CDATA[path/to/img]]></wp:meta_value>
					</wp:postmeta>
					<wp:postmeta>
						<wp:meta_key>_joomla_image_url</wp:meta_key>
						<wp:meta_value><![CDATA[field_56944ebf963fc]]></wp:meta_value>
					</wp:postmeta>		
		';
		}
		$xml .= '</item>
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



function getSlug($str)
{
	$str = str_replace(' ', '_', $str);
	return strtolower($str);
}
?>