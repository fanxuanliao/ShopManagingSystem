<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_POST['name']) && isset($_POST['contact_name']) && isset($_POST['phonenum']) && isset($_POST['address']) ){
        $sth = $dbh->prepare('INSERT INTO factory (name,primary_contact,phonenum,address,user) VALUES (?, ?, ?, ?, ?)');
        $sth->execute(array(
            $_POST['name'],
            $_POST['contact_name'],
            $_POST['phonenum'],
            $_POST['address'],
            $_SESSION['account']
        ));
        echo '<script>alert("新增成功")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=supplier.php>';
}
?>