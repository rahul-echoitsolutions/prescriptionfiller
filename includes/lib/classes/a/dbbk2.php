<?php
$DBUSER=($_GET['DBUSER'])? $_GET['DBUSER'] : "gomo_data1";
$DBPASSWD=($_GET['DBPASSWD'])? $_GET['DBPASSWD'] : "Go&Mo%887";
$DATABASE=($_GET['DATABASE'])? $_GET['DATABASE'] : "gomo_data";
$filename=($_GET['filename'])? $_GET['filename']:"backup-";
$filename.=date("d-m-Y");
$filename.=($_GET['extension'])? $_GET['extension'] : ".sql.gz";
//$filename = "backup-" . date("d-m-Y") . ".sql.gz";
$mime =($_GET['mime'])? $_GET['mime'] : "application/x-gzip";
header( "Content-Type: " . $mime );
header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
$cmd =($_GET['CMD'])? $_GET['CMD'] : "mysqldump -u $DBUSER --password='$DBPASSWD' $DATABASE | gzip --best";
mail("birwin@suddensales.com", "Error Message ", "At line ".__LINE__." in ".__FILE__." cmd is $cmd");
passthru( $cmd );
exit(0);

