<?php 
session_start();
include("pdoInc.php");
date_default_timezone_set('Asia/Taipei');
header("content-type:application/json");

$data = array(
	array(),
	array(),
	array(),
);

//start 食品
$sth = $dbh->prepare('SELECT * from commodity Where user=? AND category=?');
$sth->execute(array($_SESSION['account'],'食品'));

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $money = (int)($row['price'])-(int)($row['cost']);
    $vol = $dbh->prepare('SELECT sold_time AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=1');
    $vol->execute(array(
        $_SESSION['account'],
        $row['name'],
        $row['factory']
    ));
    while ($result = $vol->fetch(PDO::FETCH_ASSOC)) {
    	$today = date ("Y-m-01",mktime(date('m'), date('Y')));
    	$Month = date("Y-m", strtotime("$today"));
    	for ($i=0; $i < 31; $i++) {
            if(!isset($data[0][$i])){
                $data[0][$i]=0;
            }
    		if($result['vol']==$today){
                $data[0][$i]+=($money);
    		}
    		$today = date("Y-m-d", strtotime("$today +1 day"));
    		$nowMonth = date("Y-m", strtotime("$today"));
    		if(strtotime($nowMonth)>strtotime($Month)){
    			break;
    		}
    	}
    }
}
//家電
$sth = $dbh->prepare('SELECT * from commodity Where user=? AND category=?');
$sth->execute(array($_SESSION['account'],'家電'));

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $money = (int)($row['price'])-(int)($row['cost']);
    $vol = $dbh->prepare('SELECT sold_time AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=1');
    $vol->execute(array(
        $_SESSION['account'],
        $row['name'],
        $row['factory']
    ));
    while ($result = $vol->fetch(PDO::FETCH_ASSOC)) {
    	$today = date ("Y-m-01",mktime(date('m'), date('Y')));
    	$Month = date("Y-m", strtotime("$today"));
    	for ($i=0; $i < 31; $i++) { 
            if(!isset($data[1][$i])){
                $data[1][$i]=0;
            }
            if($result['vol']==$today){
                $data[1][$i]+=($money);
            }
    		$today = date("Y-m-d", strtotime("$today +1 day"));
    		$nowMonth = date("Y-m", strtotime("$today"));
    		if(strtotime($nowMonth)>strtotime($Month)){
    			break;
    		}
    	}
    }
}
//生活
$sth = $dbh->prepare('SELECT * from commodity Where user=? AND category=?');
$sth->execute(array($_SESSION['account'],'生活雜物'));

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $money = (int)($row['price'])-(int)($row['cost']);
    $vol = $dbh->prepare('SELECT sold_time AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=1');
    $vol->execute(array(
        $_SESSION['account'],
        $row['name'],
        $row['factory']
    ));
    while ($result = $vol->fetch(PDO::FETCH_ASSOC)) {
        $today = date ("Y-m-01",mktime(date('m'), date('Y')));
        $Month = date("Y-m", strtotime("$today"));
        for ($i=0; $i < 31; $i++) { 
            if(!isset($data[2][$i])){
                $data[2][$i]=0;
            }
            if($result['vol']==$today){
                $data[2][$i]+=($money);
            }
            $today = date("Y-m-d", strtotime("$today +1 day"));
            $nowMonth = date("Y-m", strtotime("$today"));
            if(strtotime($nowMonth)>strtotime($Month)){
                break;
            }
        }
    }
}

echo json_encode($data);

?>