<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['factory'])){
    $sth = $dbh->prepare('DELETE FROM inventory WHERE serial_num=? AND user=?');
    $sth->execute(array($_GET['id'],$_SESSION['account']));
    echo '<script>alert("刪除成功")</script>';
    echo '<meta http-equiv=REFRESH CONTENT=0;url=order.php?name='.$_GET['name'].'&factory='.$_GET['factory'].'>';
}