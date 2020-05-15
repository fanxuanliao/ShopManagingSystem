<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');

if(!isset($_SESSION['account'])){
    echo '<meta http-equiv=REFRESH CONTENT=0;url="login.html">';
}

$sth = $dbh->prepare('SELECT * from factory Where user=?');
$sth->execute(array($_SESSION['account']));
while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $msgTpl = new template('supplier_singletd.tpl');
    $msgTpl->set('name', $row['name']);
    $msgTpl->set('contact_name', $row['primary_contact']);
    $msgTpl->set('phonenum', $row['phonenum']);
    $msgTpl->set('address', $row['address']);
    $msgTpl->set('delete', $row['name']);
    $msgs[] = $msgTpl->render();
}
 
$tpl = new template('supplier_td.tpl');
$tpl->set('php', basename($_SERVER['PHP_SELF']));
$tpl->set('messages', join("\n", $msgs));
echo $tpl->render();
?>