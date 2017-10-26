<?php

// variables
$ruta=substr(getcwd(),0,1).':\xampp\mysql\bin\mysqldump';
$dbhost = "localhost";
$dbname = "db_cid_inv";
$dbuser = "root";
$dbpass = "";
 
$backup_file = "Bkdb_".$dbname."_".date("Ymd").".sql";

// comandos a ejecutar
$command="$ruta -u $dbuser --password=$dbpass -h $dbhost $dbname > ../../CID_BKDB/$backup_file";

system($command,$output);

?>


