<!-- Name: Yuzhe Wang, Yan He, Yibo Yan
 db final project -->
<?php

$dbhost = '127.0.0.1'; // localhost
$dbuname = 'root';
$dbpass = 'root';
$dbname = 'H_info';

//$dbo = new PDO('mysql:host=abc.com;port=8889;dbname=$dbname, $dbuname, $dbpass);

$dbo = new PDO('mysql:host=' . $dbhost . ';port=3306;dbname=' . $dbname, $dbuname, $dbpass);

?>
