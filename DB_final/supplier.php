<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');

if(!isset($_SESSION['account'])){
    echo '<meta http-equiv=REFRESH CONTENT=0;url="login.html">';
}

$sth = $dbh->prepare('SELECT * from factory,cooperate where factory_tax_id = factory_ID and user_ID = ?');
$sth->execute(array($_SESSION['account']));
while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $msgTpl = new template('supplier_singletd.tpl');
    $msgTpl->set('name', $row['factory_name']);
    $msgTpl->set('contact_name', $row['contact_name']);
    $msgTpl->set('phonenum', $row['contact_phone']);
    $msgTpl->set('address', $row['address']);
    $msgTpl->set('delete', $row['factory_tax_id']);
    $msgTpl->set('view', $row['factory_tax_id']);
    $msgs[] = $msgTpl->render();
}
 
$tpl = new template('supplier_td.tpl');
$tpl->set('php', basename($_SERVER['PHP_SELF']));
$tpl->set('messages', join("\n", $msgs));
echo $tpl->render();
?>