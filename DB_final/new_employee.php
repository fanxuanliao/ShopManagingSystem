<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_POST['name']) && isset($_POST['position']) && isset($_POST['birth']) && isset($_POST['phonenum']) && isset($_POST['address']) && isset($_POST['hours'])){
        $sth = $dbh->prepare('INSERT INTO employee (name,position,birthday,phonenum,address,hours,user) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $sth->execute(array(
            $_POST['name'],
            $_POST['position'],
            $_POST['birth'],
            $_POST['phonenum'],
            $_POST['address'],
            $_POST['hours'],
            $_SESSION['account']
        ));
        echo '<script>alert("新增成功")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=employee.php>';
}
?>