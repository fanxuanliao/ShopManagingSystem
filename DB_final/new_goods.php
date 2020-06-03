<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_POST['category']) && isset($_POST['name']) && isset($_POST['cost']) && isset($_POST['price']) && isset($_POST['supplier'])){
        $sth = $dbh->prepare('SELECT factory_tax_id , factory_name FROM factory where factory_name =?');
        $sth->execute(array($_POST['supplier']));
        $chk = $sth->fetch(PDO::FETCH_ASSOC);
        echo "<script> alert(". $chk['factory_name'] .") </script>";
        if($chk['factory_name']!=NULL){
            $sth = $dbh->prepare('INSERT INTO commodity (commodity_name,category,cost,sell_price,factory_tax_id,user_ID) VALUES (?, ?, ?, ?, ?, ?)');
            $sth->execute(array(
                $_POST['name'],
                $_POST['category'],
                $_POST['cost'],
                $_POST['price'],
                $chk['factory_tax_id'],
                $_SESSION['account']
            ));
            echo '<script>alert("新增成功")</script>';
        }
        else
            echo '<script>alert("查無廠商，無法新增")</script>';
        
        echo '<meta http-equiv=REFRESH CONTENT=0;url=goods.php>';
}

?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="商家管理系統">
    <meta name="author" content="DCT-WEB-GROUP-5">
    <title>新增商品</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <!-- 嘗試更改預設字體  
  <link rel="stylesheet" href="/font_style.css">
  <style>
    body {
  margin: 0;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  line-height: 20px;
}
  </style>
-->
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right text-white" id="sidebar-wrapper">
            <div class="sidebar-heading">商家管理系統</div>
            <div class="list-group list-group-flush">
                <a href="goods.php" class="list-group-item list-group-item-action bg-dark text-white">商品</a>
                <a href="supplier.php" class="list-group-item list-group-item-action bg-dark text-white">供應商</a>
                <a href="order_form.php" class="list-group-item list-group-item-action bg-dark text-white">訂單</a>
                <a href="employee.php" class="list-group-item list-group-item-action bg-dark text-white">員工</a>
                <a href="analysis.php" class="list-group-item list-group-item-action bg-dark text-white">分析報告</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">收起/展開功能表</button>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="main.php">回到首頁<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                帳號資訊
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="edit_account.html">修改資料</a>
                                <a class="dropdown-item" href="logout.php">登出</a>
                                <!--
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            -->
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- 內容 -->
            <div class="container-fluid">
                <h1 class="mt-4">新增商品</h1>
                <form action="new_goods.php" method="post">
                    <div class="d-flex flex-column justify-content-center align-items-center mt-5" id="wrapper">
                        <div class="form-group mx-auto" style="width: 500px;">
                            <label for="inputCategory">類別</label>
                            <select id="inputCategory" class="form-control" name="category">
                                <option>食品</option>
                                <option>家電</option>
                                <option>生活雜物</option>
                            </select>
                            <!--改選單-->
                        </div>
                       <div class="form-group mx-auto" style="width: 500px;">
                            <label for="formSupplier">供應商</label>
                            <select id="formSupplier" class="form-control" name="supplier">
</html>
 <?php
                        $test = $dbh->prepare('SELECT factory_name FROM factory inner join cooperate on factory_tax_id = factory_ID where cooperate.User_ID = ' . $_SESSION['account']);
                        $test->execute();
                        while($row = $test->fetch(PDO::FETCH_ASSOC)){
                            echo "<option>$row[factory_name]</option>";
                        }
?>
    <html>
                            </select>
                       </div>
                        <div class="form-group mx-auto" style="width: 500px;">
                            <label for="formName">品名</label>
                            <input type="text" class="form-control" id="formName" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group mx-auto" style="width: 500px;">
                            <label for="formCost">成本</label>
                            <input type="text" class="form-control" id="formCost" name="cost" placeholder="Cost" required>
                        </div>
                        <div class="form-group mx-auto" style="width: 500px;">
                            <label for="formPrice">售價</label>
                            <input type="text" class="form-control" id="formPrice" name="price" placeholder="Price" required>
                        </div>
                        <input type="submit" value="新增" class="btn btn-primary"><br><br>
                    </div>
                </form>
            </div>
            <!-- 內容 -->
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>

</html>