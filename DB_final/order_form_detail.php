<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');

if (!isset($_SESSION['account'])) {
    echo '<meta http-equiv=REFRESH CONTENT=0;url="login.html">';
}
if(isset($_GET['id'])){
    $sth = $dbh->prepare('SELECT * from commodity left join factory on commodity.factory_tax_id = factory.factory_tax_id left join order_include on commodity.User_ID=order_include.user_ID and commodity.commodity_name=com_name WHERE order_include.user_ID=? and order_number=?');
    $sth->execute(array($_SESSION['account'],$_GET['id']));
    while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
        $msgTpl = new template('order_form_detail_singletd.tpl');
        $msgTpl->set('category', $row['category']);
        $msgTpl->set('name', $row['commodity_name']);
        $msgTpl->set('cost', $row['cost']);
        $msgTpl->set('price', $row['sell_price']);
        $msgTpl->set('factory', $row['factory_name']);
        $msgTpl->set('vol', $row['amount']);
        $msgTpl->set('delete1', $row['commodity_name']);
        $msgTpl->set('delete2', $row['factory_name']);
        $msgTpl->set('edit1', $row['commodity_name']);
        $msgTpl->set('edit2', $row['factory_name']);
        $msgTpl->set('order1', $row['commodity_name']);
        $msgTpl->set('order2', $row['factory_name']);
        $msgs[] = $msgTpl->render();
    }
}
$tpl = new template('order_form_detail_td.tpl');
$tpl->set('php', basename($_SERVER['PHP_SELF']));
$tpl->set('messages', join("\n", $msgs));
echo $tpl->render();
?>
