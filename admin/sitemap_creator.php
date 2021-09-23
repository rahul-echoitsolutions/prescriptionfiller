<?PHP
require("../includes/lib/common.php"); 
$this_domain=THIS_DOMAIN;
$SSL=1;
unlink("../sitemap.xml");
if (!$handle = fopen("../sitemap.xml", 'w')) die("FAILED TO CREATE SITEMAP.XML");

// write physical pages
$query3 = "select * from c_contents where sitemap='yes' ";
$result3 = tep_db_query($query3);

if (fwrite($handle, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n\n") === FALSE) die("FAILED TO CREATE SITEMAP.XML");

$start.="<url>
	<loc>http://".$this_domain."</loc>
	<lastmod>2019-08-20</lastmod>
	<changefreq>daily</changefreq>
	<priority>1</priority>
</url>

<url>
	<loc>https://".$this_domain."</loc>
	<lastmod>2019-08-20</lastmod>
	<changefreq>daily</changefreq>
	<priority>1</priority>
</url>

<url>\n";

while ($row3 = tep_db_fetch_array($result3, MYSQLI_BOTH)) {
    if(!$content){
        $content= $start;
    }else{
	$content = "<url>\n";
    }
	echo $row3['url_key']."<br />";
	$url = "http://".$this_domain."/";
	if ($SSL == 1) $url = "https://".$this_domain."/";
	$content .= "\t<loc>".$url.$row3['url_key']."</loc>\n";
	
	$content .= "\t<lastmod>".date("Y-m-d", strtotime($row3['lastupdate']))."</lastmod>\n";
	
	$changefrequency = "daily";
	if ($row3['changefrequency'] != NULL) $changefrequency = $row3['changefrequency'];
	$content .= "\t<changefreq>".$changefrequency."</changefreq>\n";
	
	
	   if(!$row3['priority']){ $row3['priority']=.85;}
		$content .= "\t<priority>".$row3['priority']."</priority>\n";

	
	$content .= "</url>\n\n";
	if (fwrite($handle, $content) === FALSE) die("FAILED TO CREATE SITEMAP.XML");
}

if (fwrite($handle, "</urlset>") === FALSE) die("FAILED TO CREATE SITEMAP.XML");

fclose($handle);

?>