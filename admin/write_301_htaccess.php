<?PHP
require("../includes/lib/common.php");
$topCode="
#RewriteOptions inherit

ErrorDocument 404 /404_error.php

RewriteEngine On 

";


	//include("../includes/database.php");
$aaa=file_get_contents("../.htaccess");
$aab=explode("#[[**]]", $aaa);


// get page 301's
$query3 = "select * from c_contents where set301>'' ";
$result3 = tep_db_query($query3);

while ($row3 = tep_db_fetch_array($result3, MYSQLI_BOTH)) {
    
    $rowHold=$row3['url_key'];
    
   //$rowHold=($rowHold==$row3['url_key'])? 
    
    $r301s=explode("\r\n",$row3['set301']);
    
    foreach($r301s as $value){
        
        $value=str_replace("http://www.yesplanfinancial.ca/", "", $value);
        
        //$hta.="RewriteRule \"".$value."$\" \"/".$rowHold."\"  [R=301,L]
       // ";
        $hta.="RewriteRule ^".$value."$ https://yesplanfinancial.ca/".$rowHold."  [R=301,L]
        ";
    }

     }
      
$hta.="

#[[**]] ";

$hta=$topCode.$hta.$aab['1'];



     echo $hta;
     
     file_put_contents("../.htaccess", $hta);
    

?>