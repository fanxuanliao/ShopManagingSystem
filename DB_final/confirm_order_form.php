<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_GET['id'])){
    $sth = $dbh->prepare('UPDATE customer_order SET status = REPLACE (status, 0, 1) WHERE order_number=? AND user_ID=?');
    $sth->execute(array($_GET['id'],$_SESSION['account']));
    echo '<script>alert("出貨完成")</script>';
    echo '<meta http-equiv=REFRESH CONTENT=0;url=order_form.php>';
}