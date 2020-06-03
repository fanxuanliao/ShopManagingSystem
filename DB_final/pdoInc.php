<?php
// $db_server = "localhost";
// $db_user = "web_final";
// $db_passwd = "UMByXzFa4GDaCkVj";
// $db_name = "web_final";

$db_server = "localhost";
$db_user = "root";
$db_passwd = "374652ttt";
$db_name = "db_final";
//$db_name = "id13671224_db_final";

try {
    $dsn = "mysql:host=$db_server;dbname=$db_name";
    $dbh = new PDO($dsn, $db_user, $db_passwd);
}
catch (Exception $e){
    die('無法對資料庫連線');
}

$dbh->exec("SET NAMES utf8");
?>