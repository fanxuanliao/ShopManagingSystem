<?php
include("pdoInc.php");
?>
 
<?php
if(isset($_POST['acc']) && isset($_POST['pwd']) && isset($_POST['stname'])){
    $acc = $dbh->prepare('SELECT tax_id FROM user WHERE tax_id=?');
    $acc->execute(array($_POST['acc']));
    if($acc->rowcount() > 0){
        echo '<script>alert("帳號已被註冊")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=register.html>';
    } else {
        $sth = $dbh->prepare('INSERT INTO user (tax_id, password, shop_name) VALUES (?, ?, ?)');
        $sth->execute(array(
            $_POST['acc'],
            md5($_POST['pwd']),
            $_POST['stname']
        ));
        echo '<script>alert("註冊成功")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=login.html>';
    }
}
?>