<?php
session_start();
include("pdoInc.php");

if(isset($_GET['name']) && isset($_GET['factory']) && isset($_GET['id'])){
    
    $sth = $dbh->prepare('SELECT * FROM inventory WHERE serial_num=? AND user=? AND sold=?');
    $sth->execute(array($_GET['id'],$_SESSION['account'],1));
    
    if ($row = $sth->fetch(PDO::FETCH_ASSOC)){
    
        echo '<script>alert("不能再次販售已出售商品！")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=order.php?name='.$_GET['name'].'&factory='.$_GET['factory'].'>';
    
    } else {
    
        $datetime = date ("Y-m-d",mktime(date('m'), date('d'), date('Y'))) ;
        //echo $datetime;
        $sth = $dbh->prepare('UPDATE inventory SET sold=?,sold_time=? WHERE serial_num=? AND user=?');
        $sth->execute(array(
            1,
            $datetime,
            $_GET['id'],
            $_SESSION['account']
        ));

        echo '<script>alert("已出售")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=order.php?name='.$_GET['name'].'&factory='.$_GET['factory'].'>';
    } 
}
?>