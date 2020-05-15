<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');

function comparison_date($finaldate){

    $todate = date ("Y-m-d",mktime(date('m'), date('d'), date('Y'))) ;

    if(strtotime($todate)>strtotime($finaldate))
        return true;
    else
        return false;

}


if(isset($_GET['name']) && isset($_GET['factory'])){
    $sth = $dbh->prepare('SELECT * from inventory WHERE name=? AND factory=? AND user=?');
    $sth->execute(array($_GET['name'],$_GET['factory'],$_SESSION['account']));
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        $due = comparison_date($row['EXP']);

        $msgTpl = new template('order_singletd.tpl');
        $msgTpl->set('id', $row['serial_num']);
        $msgTpl->set('name', $row['name']);
        $msgTpl->set('factory', $row['factory']);
        if ($due)
            $msgTpl->set('due_date', '<font color="red">'.$row['EXP'].'</font>');
        else
            $msgTpl->set('due_date', $row['EXP']);
        
        if($row['sold']==1)
            $msgTpl->set('sold','是');
        else
            $msgTpl->set('sold','否');
        $msgTpl->set('soldtime', $row['sold_time']);
        $msgTpl->set('delete1', $row['name']);
        $msgTpl->set('delete2', $row['factory']);
        $msgTpl->set('id1', $row['serial_num']);
        $msgTpl->set('sold1', $row['name']);
        $msgTpl->set('sold2', $row['factory']);
        $msgTpl->set('id2', $row['serial_num']);
        $msgs[] = $msgTpl->render();
    }
}
 
$tpl = new template('order_td.tpl');
$tpl->set('php', basename($_SERVER['PHP_SELF']));
$tpl->set('new1', $_GET['name']);
$tpl->set('new2', $_GET['factory']);
$tpl->set('messages', join("\n", $msgs));
echo $tpl->render();
?>