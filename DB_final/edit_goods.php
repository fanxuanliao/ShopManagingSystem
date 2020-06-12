<?php
session_start();
include("pdoInc.php");
include('php_template_class.php');
?>
 
<?php
    $sth = $dbh->prepare('SELECT * from commodity WHERE user=? AND category=?');
    $sth->execute(array($_SESSION['account'],'食品'));
 //   while($row = $sth->fetch(PDO::FETCH_ASSOC)){
// $vol = $dbh->prepare('SELECT COUNT(serial_num) AS vol FROM inventory WHERE user=? and name=? and factory=? and sold=0');
//             $vol->execute(array(
//                 $_SESSION['account'],
//                 $row['name'],
//                 $row['factory']
//             ));
// $result = $vol->fetch(PDO::FETCH_ASSOC);
  //  }
    
//抓商品資訊
    if(isset($_GET['name']) && isset($_GET['factory'])){
        $sth = $dbh->prepare('SELECT commodity_name, category, cost, sell_price, factory_name from commodity Left Join factory on factory.factory_tax_id = commodity.factory_tax_id WHERE commodity_name=? AND factory_name=? AND user_ID=?');
        $sth->execute(array($_GET['name'],$_GET['factory'],$_SESSION['account']));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        $tpl = new template('goods_edit.tpl');
        $tpl->set('php', basename($_SERVER['PHP_SELF']));
        $tpl->set('name', $row['commodity_name']);
        $tpl->set('category', $row['category']);
        $tpl->set('cost', $row['cost']);
        $tpl->set('price', $row['sell_price']);
        $tpl->set('factory', $row['factory_name']);
        echo $tpl->render();
    }

//表單送出
    if(isset($_POST['cost']) && isset($_POST['price']) && isset($_POST['name']) && isset($_POST['factory']) && isset($_POST['category'])){
        $sth = $dbh->prepare('UPDATE commodity Left Join factory ON factory.factory_tax_id = commodity.factory_tax_id SET cost=?,sell_price=?,category=? WHERE commodity_name=? AND factory_name=? AND user_ID=?');
        $sth->execute(array(
            $_POST['cost'],
            $_POST['price'],
            $_POST['category'],
            $_POST['name'],
            $_POST['factory'],
            $_SESSION['account'] // array to string conversion?
        ));
        echo '<script>alert("編輯成功")</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=goods.php>';
    }
?>
