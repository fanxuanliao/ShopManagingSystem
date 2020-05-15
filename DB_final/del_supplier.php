<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_GET['name'])){
    $sth = $dbh->prepare('DELETE FROM factory WHERE name=? AND user=?');
    $sth->execute(array($_GET['name'],$_SESSION['account']));
    echo '<script>alert("刪除成功")</script>';
    echo '<meta http-equiv=REFRESH CONTENT=0;url=supplier.php>';
}