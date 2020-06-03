<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_GET['name']) && isset($_GET['factory'])){
    $sth = $dbh->prepare('DELETE commodity FROM commodity LEFT JOIN factory on commodity.factory_tax_id = factory.factory_tax_id WHERE commodity_name=? AND factory_name=? AND user_ID=?');
    $sth->execute(array($_GET['name'],$_GET['factory'],$_SESSION['account']));
    $count = $sth->rowCount();
    if ($count === 0)
        echo '<script>alert("刪除失敗")</script>';
    else
        echo '<script>alert("刪除成功")</script>';

    echo '<meta http-equiv=REFRESH CONTENT=0;url=goods.php>';
}
?>