<?php
session_start();
include("pdoInc.php");
?>

<?php
if(isset($_POST['acc']) && isset($_POST['pwd'])){
    $acc = preg_replace("/[^A-Za-z0-9]/", "", $_POST['acc']);
    $pwd = preg_replace("/[^A-Za-z0-9]/", "", $_POST['pwd']);
    if($acc != NULL && $pwd != NULL){
        $sth = $dbh->prepare('SELECT account, pwd, storename FROM user where account = ?');
        $sth->execute(array($acc));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        // 比對密碼
        if($row['pwd'] == md5($pwd)){
            $_SESSION['account'] = $row['account'];
            $_SESSION['storename'] = $row['storename'];
            echo '<meta http-equiv=REFRESH CONTENT=0;url=main.php>';
        }else{
            echo '<script>alert("帳號密碼有誤")</script>';
            echo '<meta http-equiv=REFRESH CONTENT=0;url=login.html>';
        }
    }else{
        echo '<meta http-equiv=REFRESH CONTENT=0;url=login.html>';
    }
}
?>