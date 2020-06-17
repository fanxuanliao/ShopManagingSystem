<?php
session_start();
include("pdoInc.php");
?>
 
<?php
if(isset($_POST['contact_name']) && isset($_POST['phonenum']) && isset($_POST['address']) ){
    try {
        $dbh->beginTransaction();
        
        $data = [];
        foreach($_POST['product'] as $key => $p) {
            if (array_key_exists($p, $data)) {
                $data[$p] += $_POST['number'][$key];
            } else {
                $data[$p] = $_POST['number'][$key];
            }
        }

        $sth = $dbh->prepare('INSERT INTO customer_order (customer_name,customer_phone,customer_address,accept_date,user_ID) VALUES (?, ?, ?, ?, ?)');
        $sth->execute(array(
            $_POST['contact_name'],
            $_POST['phonenum'],
            $_POST['address'],
            date("Y-m-d"),
            $_SESSION['account']
        ));
        $order_id = $dbh->lastInsertId();
        $sth = $dbh->prepare('INSERT INTO order_include (user_ID, order_number, com_name, amount) VALUES (?, ?, ?, ?)');
        foreach($data as $key => $value) {
            $sth->execute(array($_SESSION['account'], $order_id, $key, $value));
        }
        
        $dbh->commit();
        echo '<script>alert("新增成功")</script>';
    }   catch (Exception $e){
        $dbh->rollback();
        throw $e;
    }
        echo '<meta http-equiv=REFRESH CONTENT=0;url=order_form.php>';
}

$sth = $dbh->prepare('Select * from factory inner join cooperate on cooperate.factory_ID = factory.factory_tax_id and cooperate.user_ID = '.  $_SESSION['account'] .';');
$sth->execute();
$factory = $sth->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['id'])) {
    $factory_id = $_POST['id'];
} else {
    $factory_id = $factory[0]['factory_tax_id'];
}

$sth = $dbh->prepare('Select * from commodity where user_ID='.$_SESSION['account']. ' and factory_tax_id = '. $factory_id .';');
$sth->execute();
$commodity = $sth->fetchAll();

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="商家管理系統">
    <meta name="author" content="DCT-WEB-GROUP-5">
    <title>新增訂單</title>
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
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- 內容 -->
            <div class="container-fluid">
                <h1 class="mt-4">新增訂單</h1>
                <form action="new_order_form.php" class="mx-auto" style="max-width: 500px;" method="post">
                    <div class="d-flex flex-column justify-content-center align-items-center mt-5" id="wrapper">
                        <div class="form-group mx-auto" style="max-width: 500px; width: 100%;">
                            <label for="formContactName">聯絡人</label>
                            <input type="text" class="form-control" id="formContactName" name="contact_name" placeholder="Contact Person" required>
                        </div>
                        <div class="form-group mx-auto" style="max-width: 500px; width: 100%;">
                            <label for="formPhoneNum">電話</label>
                            <input type="text" class="form-control" id="formPhoneNum" name="phonenum" placeholder="Phone Number" required>
                        </div>
                        <div class="form-group mx-auto" style="max-width: 500px; width: 100%;">
                            <label for="formAddress">地址</label>
                            <input type="text" class="form-control" id="formAddress" name="address" placeholder="Address" required>
                        </div>
                        <div class="form-group mx-auto" style="max-width: 500px; width: 100%;">
                            <label for="factory">廠商</label>
                            <select id="factory" class="form-control" style="width: 100%;">
                                <?php foreach($factory as $f) { ?>
                                    <option <?php if ($f['factory_tax_id'] === $factory_id) echo 'selected' ?> value="<?php echo $f['factory_tax_id'] ?>"><?php echo $f['factory_name'] ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group mx-auto" id="product-column" style="max-width: 500px; width: 100%;">
                            <div style="display: flex; margin-bottom: 15px; align-items: center;">
                                <span style="flex: 0 45%;">商品</span>
                                <span style="flex: 0 25%;">數量</span>
                                <div style="flex: 0 30%; text-align: right">
                                    <button type="button" id="add-btn" class="btn btn-info">新增商品</button>
                                </div>
                            </div>
                            <div class="product-info" style="display: flex; align-items: center; margin-bottom: 10px;">
                                <div style="flex: 0 45%; padding-right: 10px;">
                                    <select type="text" class="form-control product" id="product-1" name="product[]" placeholder="product">
                                        <?php foreach($commodity as $c) { ?>
                                            <option name="<?php echo $c['commodity_name']?>"><?php echo $c['commodity_name'] ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div style="flex: 0 45%; padding-right: 10px;">
                                    <input type="number" class="form-control" id="number" name="number[]" placeholder="number" min="0" required>
                                </div>
                                <div style="flex: 0 10%;">
                                    <span class="delete" style="display: none; float: right; color: red; border-radius: 50%; width: 25px; text-align: center; height: 25px; font-size: 20px; line-height: 20px;">x</span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group mx-auto" style="width: 500px;">
                            <label for="formgood">商品</label>
                            <input maxlength="8" type="text" class="form-control" id="formgood" name="good" placeholder="Tax Id" required>
                        </div> -->
                        <input type="submit" value="新增" class="btn btn-primary">
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
    $('#factory').change(function(e) {
        const form = document.createElement('form');
        form.method = 'post';
        form.action = 'new_order_form.php';

        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'id';
        hiddenField.value = e.target.value;

        form.appendChild(hiddenField);

        document.body.appendChild(form);
        form.submit();
    })
    function judge_single() {
        if ($('.product-info').length === 1) {
            $('.product-info').each(function() {
                let del = $(this).find('.delete')
                del.css('display', 'none');
            })
        } else {
            $('.product-info').each(function() {
                let del = $(this).find('.delete')
                del.css('display', 'block');
            })
        }
    }
    $('#add-btn').click(function(e) {
        $('#product-column').append(`
            <div class="product-info" style="display: flex; align-items: center; margin-bottom: 10px;">
                <div style="flex: 0 45%; padding-right: 10px;">
                    <select type="text" class="form-control product" id="product-1" name="product[]" placeholder="product">
                        <?php foreach($commodity as $c) { ?>
                            <option name="<?php echo $c['commodity_name']?>"><?php echo $c['commodity_name'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div style="flex: 0 45%; padding-right: 10px;">
                    <input type="number" class="form-control" id="number" name="number[]" placeholder="number" required>
                </div>
                <div style="flex: 0 10%;">
                    <span class="delete" style="cursor: pointer; float: right; color: red; border-radius: 50%; display: block; width: 25px; text-align: center; height: 25px; font-size: 20px; line-height: 20px;">x</span>
                </div>
            </div>
        `);
        judge_single();
    })

    $(document).on('click', '.delete', function() {
        $(this).parent().parent().remove();
        judge_single();
    })
    </script>
</body>

</html>