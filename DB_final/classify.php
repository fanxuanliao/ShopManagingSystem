<?php
session_start();
include("pdoInc.php");

$x=0;
$y=0;
$z=0;

if(isset($_POST['Foods'])){
    $x=1;    
}
if(isset($_POST['HAppliance'])){
    $y=1;
}
if(isset($_POST['Groceries'])){
    $z=1;
}
if($x==1||$y==1||$z==1){
    echo '<meta http-equiv=REFRESH CONTENT=0;url=goods.php?food='.$x.'&HA='.$y.'&grocery='.$z.'>';
}
else{
    echo '<script>alert("請選擇分類項目")</script>';
    echo '<meta http-equiv=REFRESH CONTENT=0;url=goods.php>';
}
?>