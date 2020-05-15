<?php 
session_start();
include("pdoInc.php");
date_default_timezone_set('Asia/Taipei');
header("content-type:application/json");

$data = array();

$sth = $dbh->prepare('SELECT * from commodity Where user=? AND category=?');
$sth->execute(array($_SESSION['account'],'食品'));

$food_total = 0;
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $money = (int)($row['price'])-(int)($row['cost']);
    $vol = $dbh->prepare('SELECT COUNT(serial_num) AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=1 and sold_time=CURRENT_DATE()');
    $vol->execute(array(
        $_SESSION['account'],
        $row['name'],
        $row['factory']
    ));
    $result = $vol->fetch(PDO::FETCH_ASSOC);
    $num = $result['vol'];
    $food_total += (int)($money)*(int)($num);
}
$data[0]=$food_total;
$food_total = 0;

$sth = $dbh->prepare('SELECT * from commodity Where user=? AND category=?');
$sth->execute(array($_SESSION['account'],'家電'));
$HA_total=0;
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $money = ($row['price'])-($row['cost']);
    $vol = $dbh->prepare('SELECT COUNT(serial_num) AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=1 and sold_time=CURRENT_DATE()');
    $vol->execute(array(
        $_SESSION['account'],
        $row['name'],
        $row['factory']
    ));
    $result = $vol->fetch(PDO::FETCH_ASSOC);
    $num = $result['vol'];
    $HA_total += (int)($money)*(int)($num);
}
$data[1]=$HA_total;
$HA_total = 0;

$sth = $dbh->prepare('SELECT * from commodity Where user=? AND category=?');
$sth->execute(array($_SESSION['account'],'生活雜物'));
$grocery_total=0;
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $money = ($row['price'])-($row['cost']);
    $vol = $dbh->prepare('SELECT COUNT(serial_num) AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=1 and sold_time=CURRENT_DATE()');
$vol->execute(array(
        $_SESSION['account'],
        $row['name'],
        $row['factory']
    ));
    $result = $vol->fetch(PDO::FETCH_ASSOC);
    $num = $result['vol'];
    $grocery_total += (int)($money)*(int)($num);
}
$data[2]=$grocery_total;
$grocery_total = 0;

echo json_encode($data);

?>