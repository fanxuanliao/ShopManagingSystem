<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');
?>
 
<?php
if(isset($_GET['id'])){
    $sth = $dbh->prepare('SELECT * from employee WHERE ID=? AND user=?');
    $sth->execute(array($_GET['id'],$_SESSION['account']));
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $tpl = new template('employee_edit.tpl');
    $tpl->set('php', basename($_SERVER['PHP_SELF']));
    $tpl->set('name', $row['name']);
    $tpl->set('position', $row['position']);
    $tpl->set('birthday', $row['birthday']);
    $tpl->set('phonenum', $row['phonenum']);
    $tpl->set('address', $row['address']);
    $tpl->set('hours', $row['hours']);    
    echo $tpl->render();
}

if(isset($_POST['position'])&& isset($_POST['phonenum']) && isset($_POST['address']) && isset($_POST['hours'])){
    $sth = $dbh->prepare('SELECT ID from employee WHERE name=? AND birthday=? AND user=?');
    $sth->execute(array($_POST['name'],$_POST['birth'],$_SESSION['account']));
    $id = $sth->fetch(PDO::FETCH_ASSOC);
    $sth = $dbh->prepare('UPDATE employee SET position=?,phonenum=?,address=?,hours=? WHERE ID=?');
    $sth->execute(array(
        $_POST['position'],
        $_POST['phonenum'],
        $_POST['address'],
        $_POST['hours'],
        $id['ID']
    ));
    echo '<script>alert("編輯成功")</script>';
    echo '<meta http-equiv=REFRESH CONTENT=0;url=employee.php>';
}