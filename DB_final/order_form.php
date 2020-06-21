<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');

if(!isset($_SESSION['account'])){
    echo '<meta http-equiv=REFRESH CONTENT=0;url="login.html">';
}

$sth = $dbh->prepare('SELECT * from customer_order Where user_ID=?');
$sth->execute(array($_SESSION['account']));
while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $msgTpl = new template('order_form_singletd.tpl');
    $msgTpl->set('order_number', $row['order_number']);
    $msgTpl->set('customer_name', $row['customer_name']);
    $msgTpl->set('customer_phone', $row['customer_phone']);
    $msgTpl->set('customer_address', $row['customer_address']);
    $msgTpl->set('accept_date', $row['accept_date']);
    //$msgTpl->set('status', $row['status']);
    if($row['status']==0){
        $msgTpl->set('status', '未完成');
    }
    else{
        $msgTpl->set('status', '已完成');
    }
    $msgTpl->set('view', $row['order_number']);
    $msgTpl->set('delete', $row['order_number']);
    $msgTpl->set('confirm', $row['order_number']);
    $msgs[] = $msgTpl->render();
}   
 
$tpl = new template('order_form_td.tpl');
$tpl->set('php', basename($_SERVER['PHP_SELF']));
$tpl->set('messages', join("\n", $msgs));
echo $tpl->render();
?>