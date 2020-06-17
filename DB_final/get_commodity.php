<?php
session_start();
include("pdoInc.php");

$sth = $dbh->prepare('Select * from commodity where user_ID='.$_SESSION['account']. ' and factory_tax_id = '. $_POST['id'] .';');
$sth->execute();
$factory = $sth->fetchAll();

echo json_encode($factory);
?>