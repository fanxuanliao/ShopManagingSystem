<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_GET['name']) && isset($_GET['factory']) && isset($_GET['vol'])){
    if($_GET['vol']!=0)
        echo '<script>alert("該品項還有庫存，無法刪除")</script>';
    else{
        $sth = $dbh->prepare('DELETE FROM commodity WHERE name=? AND factory=? AND user=?');
        $sth->execute(array($_GET['name'],$_GET['factory'],$_SESSION['account']));
        echo '<script>alert("刪除成功")</script>';
    }
    echo '<meta http-equiv=REFRESH CONTENT=0;url=goods.php>';
}
?>