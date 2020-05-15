<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');
?>
 
<?php
$sth = $dbh->prepare('SELECT * from commodity WHERE user=? AND category=?');
        $sth->execute(array($_SESSION['account'],'食品'));
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
$vol = $dbh->prepare('SELECT COUNT(serial_num) AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=0');
            $vol->execute(array(
                $_SESSION['account'],
                $row['name'],
                $row['factory']
            ));
$result = $vol->fetch(PDO::FETCH_ASSOC);
}

if(isset($_GET['name']) && isset($_GET['factory'])){
    $sth = $dbh->prepare('SELECT * from commodity WHERE name=? AND factory=? AND user=?');
    $sth->execute(array($_GET['name'],$_GET['factory'],$_SESSION['account']));
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $tpl = new template('goods_edit.tpl');
    $tpl->set('php', basename($_SERVER['PHP_SELF']));
    $tpl->set('name', $row['name']);
    $tpl->set('cost', $row['cost']);
    $tpl->set('price', $row['price']);
    $tpl->set('storage', $result['vol']);
    $tpl->set('factory', $row['factory']);
    echo $tpl->render();
}

if(isset($_POST['cost']) && isset($_POST['price']) && isset($_POST['name']) && isset($_POST['factory'])){
    $sth = $dbh->prepare('UPDATE commodity SET cost=?,price=? WHERE name=? AND factory=? AND user=?');
    $sth->execute(array(
        $_POST['cost'],
        $_POST['price'],
        $_POST['name'],
        $_POST['factory'],
        $_SESSION['account']
    ));
    echo '<script>alert("編輯成功")</script>';
    echo '<meta http-equiv=REFRESH CONTENT=0;url=goods.php>';
}