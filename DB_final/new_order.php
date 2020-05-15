<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');
if(isset($_GET['name']) && isset($_GET['factory']) && isset($_POST['id']) && isset($_POST['due_date'])){
    $sth = $dbh->prepare('INSERT INTO inventory (serial_num,EXP,sold,factory,name,sold_time,user) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $sth->execute(array(
            $_POST['id'],
            $_POST['due_date'],
            0,
            $_GET['factory'],
            $_GET['name'],
            NULL,
            $_SESSION['account']
        ));
        echo '<script>alert("新增成功")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=order.php?name='.$_GET['name'].'&factory='.$_GET['factory'].'>';
}
else if(isset($_GET['name']) && isset($_GET['factory'])){
    $tpl = new template('new_order.tpl');
    $tpl->set('php', basename($_SERVER['PHP_SELF']));
    $tpl->set('new1', $_GET['name']);
    $tpl->set('new2', $_GET['factory']);
    echo $tpl->render();
}
?>