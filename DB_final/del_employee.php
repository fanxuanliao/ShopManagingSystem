<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_GET['id'])){
    $sth = $dbh->prepare('DELETE FROM employee WHERE employee_id=? AND user_ID=?');
    $sth->execute(array($_GET['id'],$_SESSION['account']));
    echo '<script>alert("刪除成功")</script>';
    echo '<meta http-equiv=REFRESH CONTENT=0;url=employee.php>';
}
?>