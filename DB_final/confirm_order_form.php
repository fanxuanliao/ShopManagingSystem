<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_GET['id'])){
	$sth = $dbh->prepare('SELECT * FROM customer_order WHERE order_number = ?');
    $sth->execute(array($_GET['id']));
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    	if($row['status']==0){
    		$sth2 = $dbh->prepare('UPDATE customer_order SET status = REPLACE (status, 0, 1) WHERE order_number=? AND user_ID=?');
    		$sth2->execute(array($_GET['id'],$_SESSION['account']));
    		echo '<script>alert("訂單狀態已改為「已完成」")</script>';
   		}
   		else{
   			$sth2 = $dbh->prepare('UPDATE customer_order SET status = REPLACE (status, 1, 0) WHERE order_number=? AND user_ID=?');
    		$sth2->execute(array($_GET['id'],$_SESSION['account']));
    		echo '<script>alert("訂單狀態已改為「未完成」")</script>';
   		}
   	}
   	
    echo '<meta http-equiv=REFRESH CONTENT=0;url=order_form.php>';
}