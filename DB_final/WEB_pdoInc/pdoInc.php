<?php
$db_server = "localhost";
$db_user = "id13671224_db20_final";
$db_passwd = "+e}P82/s9m<N5-l)";
$db_name = "id13671224_db_final";
 
try {
    $dsn = "mysql:host=$db_server;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_passwd);
}
catch (Exception $e){
    die('無法對資料庫連線');
}

$dbh->exec("SET NAMES utf8");
?>