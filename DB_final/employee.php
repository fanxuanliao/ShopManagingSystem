<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');

if(!isset($_SESSION['account'])){
    echo '<meta http-equiv=REFRESH CONTENT=0;url="login.html">';
}

$sth = $dbh->prepare('SELECT * from employee WHERE user_ID=?');
$sth->execute(array($_SESSION['account']));
while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $msgTpl = new template('employee_singletd.tpl');
    $msgTpl->set('id', $row['employee_id']);
    $msgTpl->set('name', $row['name']);
    $msgTpl->set('position', $row['position']);
    $msgTpl->set('birthday', $row['birthdate']);
    $msgTpl->set('phonenum', $row['phone_number']);
    $msgTpl->set('address', $row['address']);
    $msgTpl->set('delete', $row['employee_id']);
    $msgTpl->set('edit', $row['employee_id']);
    $msgs[] = $msgTpl->render();
}
 
$tpl = new template('employee_td.tpl');
$tpl->set('php', basename($_SERVER['PHP_SELF']));
$tpl->set('messages', join("\n", $msgs));
echo $tpl->render();
?>