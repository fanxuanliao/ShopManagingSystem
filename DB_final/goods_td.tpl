<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="商家管理系統">
    <meta name="author" content="DCT-WEB-GROUP-5">
    <title>商品管理</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
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
                <a href="./charts/index.html" class="list-group-item list-group-item-action bg-dark text-white">分析報告</a>
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
                <h1 class="mt-4">商品管理</h1><br><br>
                <a href="new_goods.php" class="ml-5"><button type="button" class="btn btn-info btn-sm">新增商品</button></a>
                <div class="classbtn d-inline">
                    <!--
                    <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" id="classdropdownMenu" data-toggle="dropdown">
                        分類
                    </button>
                  -->
                    <div class="text d-inline">分類選項：</div>
                    <form action="classify.php" method="post" class="d-inline">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="Foods" {:checked1}>
                            <label class="form-check-label" for="inlineCheckbox1">食品</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="HAppliance" {:checked2}>
                            <label class="form-check-label" for="inlineCheckbox2">家電</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="Groceries" {:checked3}>
                            <label class="form-check-label" for="inlineCheckbox3">生活雜物</label>
                        </div>
                        <input type="submit" value="確定" class="btn btn-primary btn-sm">
                    </form>
                </div>
                <hr>
            </div>
            <div class="ml-5 mr-5">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>類別</th>
                            <th>品名</th>
                            <th>成本</th>
                            <th>售價</th>
                            <th>廠商</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {:messages}
                    </tbody>
                </table>
            </div>
            <!--
            <nav aria-label="Search results pages">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="<?php echo'supplier.html'?>">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
            -->
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