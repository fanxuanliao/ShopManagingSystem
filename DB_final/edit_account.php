<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_POST['oldpwd']) && isset($_POST['newpwd']) && isset($_POST['newpwd2'])){
    $acc = $dbh->prepare('SELECT * FROM user WHERE account=?');
    $acc->execute(array($_SESSION['account']));
    $chk = $acc->fetch(PDO::FETCH_ASSOC);
    $chk2 = $_POST['newpwd'];
    $chk3 = $_POST['newpwd2'];
    if( $chk['pwd'] != md5($_POST['oldpwd']) ){
        echo '<script>alert("舊密碼輸入錯誤")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=edit_account.html>';
    }else if($chk2!=$chk3){
        echo '<script>alert("密碼輸入不符")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=edit_account.html>';
    }else{
        $sth = $dbh->prepare('UPDATE user SET pwd=? WHERE account=?');
        $sth->execute(array(
            md5($_POST['newpwd']),
            $_SESSION['account']
        ));
        echo '<script>alert("修改成功")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=main.html>';
    }
}
?>