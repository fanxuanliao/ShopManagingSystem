<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');

if(!isset($_SESSION['account'])){
    echo '<meta http-equiv=REFRESH CONTENT=0;url="login.html">';
}

if(isset($_GET['food']) && isset($_GET['HA']) && isset($_GET['grocery'])){
    $tpl = new template('goods_td.tpl');
    $tpl->set('php', basename($_SERVER['PHP_SELF']));
    $tpl->set('checked1', '');
    $tpl->set('checked2', '');
    $tpl->set('checked3', '');
    if($_GET['food']==1){
        $tpl->set('checked1', 'checked');
        $sth = $dbh->prepare('SELECT * from commodity WHERE user=? AND category=?');
        $sth->execute(array($_SESSION['account'],'食品'));
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            $msgTpl = new template('goods_singletd.tpl');
            $msgTpl->set('category', $row['category']);
            $msgTpl->set('name', $row['name']);
            $msgTpl->set('cost', $row['cost']);
            $msgTpl->set('price', $row['price']);
            $msgTpl->set('factory', $row['factory']);
            $vol = $dbh->prepare('SELECT COUNT(serial_num) AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=0');
            $vol->execute(array(
                $_SESSION['account'],
                $row['name'],
                $row['factory']
            ));
            $result = $vol->fetch(PDO::FETCH_ASSOC);
            $msgTpl->set('selling_vol', $result['vol']);
            $msgTpl->set('delete1', $row['name']);
            $msgTpl->set('delete2', $row['factory']);
            $msgTpl->set('num', $result['vol']);
            $msgTpl->set('edit1', $row['name']);
            $msgTpl->set('edit2', $row['factory']);
            $msgTpl->set('order1', $row['name']);
            $msgTpl->set('order2', $row['factory']);
            $msgs[] = $msgTpl->render();
        }
    }
    if($_GET['HA']==1){
        $tpl->set('checked2', 'checked');
        $sth = $dbh->prepare('SELECT * from commodity WHERE user=? AND category=?');
        $sth->execute(array($_SESSION['account'],'家電'));
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            $msgTpl = new template('goods_singletd.tpl');
            $msgTpl->set('category', $row['category']);
            $msgTpl->set('name', $row['name']);
            $msgTpl->set('cost', $row['cost']);
            $msgTpl->set('price', $row['price']);
            $msgTpl->set('factory', $row['factory']);
            $vol = $dbh->prepare('SELECT COUNT(serial_num) AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=0');
            $vol->execute(array(
                $_SESSION['account'],
                $row['name'],
                $row['factory']
            ));
            $result = $vol->fetch(PDO::FETCH_ASSOC);
            $msgTpl->set('selling_vol', $result['vol']);
            $msgTpl->set('delete1', $row['name']);
            $msgTpl->set('delete2', $row['factory']);
            $msgTpl->set('num', $result['vol']);
            $msgTpl->set('edit1', $row['name']);
            $msgTpl->set('edit2', $row['factory']);
            $msgTpl->set('order1', $row['name']);
            $msgTpl->set('order2', $row['factory']);
            $msgs[] = $msgTpl->render();
        }
    }
    if($_GET['grocery']==1){
        $tpl->set('checked3', 'checked');
        $sth = $dbh->prepare('SELECT * from commodity WHERE user=? AND category=?');
        $sth->execute(array($_SESSION['account'],'生活雜物'));
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            $msgTpl = new template('goods_singletd.tpl');
            $msgTpl->set('category', $row['category']);
            $msgTpl->set('name', $row['name']);
            $msgTpl->set('cost', $row['cost']);
            $msgTpl->set('price', $row['price']);
            $msgTpl->set('factory', $row['factory']);
            $vol = $dbh->prepare('SELECT COUNT(serial_num) AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=0');
            $vol->execute(array(
                $_SESSION['account'],
                $row['name'],
                $row['factory']
            ));
            $result = $vol->fetch(PDO::FETCH_ASSOC);
            $msgTpl->set('selling_vol', $result['vol']);
            $msgTpl->set('delete1', $row['name']);
            $msgTpl->set('delete2', $row['factory']);
            $msgTpl->set('num', $result['vol']);
            $msgTpl->set('edit1', $row['name']);
            $msgTpl->set('edit2', $row['factory']);
            $msgTpl->set('order1', $row['name']);
            $msgTpl->set('order2', $row['factory']);
            $msgs[] = $msgTpl->render();
        }
    }
    $tpl->set('messages', join("\n", $msgs));
    echo $tpl->render();
}

else{
    $sth = $dbh->prepare('SELECT * from commodity WHERE user=?');
    $sth->execute(array($_SESSION['account']));
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        $msgTpl = new template('goods_singletd.tpl');
        $msgTpl->set('category', $row['category']);
        $msgTpl->set('name', $row['name']);
        $msgTpl->set('cost', $row['cost']);
        $msgTpl->set('price', $row['price']);
        $msgTpl->set('factory', $row['factory']);
        $vol = $dbh->prepare('SELECT COUNT(serial_num) AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=0');
        $vol->execute(array(
            $_SESSION['account'],
            $row['name'],
            $row['factory']
        ));
        $result = $vol->fetch(PDO::FETCH_ASSOC);
        $msgTpl->set('selling_vol', $result['vol']);
        $msgTpl->set('delete1', $row['name']);
        $msgTpl->set('delete2', $row['factory']);
        $msgTpl->set('num', $result['vol']);
        $msgTpl->set('edit1', $row['name']);
        $msgTpl->set('edit2', $row['factory']);
        $msgTpl->set('order1', $row['name']);
        $msgTpl->set('order2', $row['factory']);
        $msgs[] = $msgTpl->render();
    }
     
    $tpl = new template('goods_td.tpl');
    $tpl->set('php', basename($_SERVER['PHP_SELF']));
    $tpl->set('checked1', 'checked');
    $tpl->set('checked2', 'checked');
    $tpl->set('checked3', 'checked');
    $tpl->set('messages', join("\n", $msgs));
    echo $tpl->render();
}

?>