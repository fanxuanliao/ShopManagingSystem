<?php
session_start();
include("pdoInc.php");
?>

<?php
if(isset($_POST['acc']) && isset($_POST['pwd'])){
    $acc = preg_replace("/[^A-Za-z0-9]/", "", $_POST['acc']);
    $pwd = preg_replace("/[^A-Za-z0-9]/", "", $_POST['pwd']);
    if($acc != NULL && $pwd != NULL){
        $sth = $dbh->prepare('SELECT tax_id, password, shop_name FROM user where tax_id = ?');
        $sth->execute(array($acc));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        // 比對密碼
        
        if($row['password'] === md5($pwd)){
            $_SESSION['account'] = $row['tax_id'];
            $_SESSION['storename'] = $row['shop_name'];
            echo '<meta http-equiv=REFRESH CONTENT=0;url=main.php>';
        }else{
            echo '<script>alert("請輸入統編及密碼")</script>';
            echo '<meta http-equiv=REFRESH CONTENT=0;url=login.html>';
        }
    }else{
        echo '<meta http-equiv=REFRESH CONTENT=0;url=login.html>';
    }
}
?>