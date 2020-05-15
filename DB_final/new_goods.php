<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_POST['category']) && isset($_POST['name']) && isset($_POST['cost']) && isset($_POST['price']) && isset($_POST['supplier'])){
        $sth = $dbh->prepare('SELECT name FROM factory where name =? AND user=?');
        $sth->execute(array($_POST['supplier'],$_SESSION['account']));
        $chk = $sth->fetch(PDO::FETCH_ASSOC);
        if($chk['name']!=NULL){
            $sth = $dbh->prepare('INSERT INTO commodity (name,category,cost,price,factory,user) VALUES (?, ?, ?, ?, ?, ?)');
            $sth->execute(array(
                $_POST['name'],
                $_POST['category'],
                $_POST['cost'],
                $_POST['price'],
                $_POST['supplier'],
                $_SESSION['account']
            ));
            echo '<script>alert("新增成功")</script>';
        }
        else
            echo '<script>alert("查無廠商，無法新增")</script>';
        
        echo '<meta http-equiv=REFRESH CONTENT=0;url=goods.php>';
}
?>