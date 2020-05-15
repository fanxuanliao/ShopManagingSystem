<?php
session_start();
if(!isset($_SESSION['account'])){
    echo '<meta http-equiv=REFRESH CONTENT=0;url="login.html">';
}
?>

<!DOCTYPE html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="庫存管理系統">
  <meta name="author" content="DCT-WEB-GROUP-5">

  <style type="text/css">
      label{text-align: center; font-size: 20pt;}
  </style>

  <title>庫存管理系統首頁</title>

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
      <div class="sidebar-heading">庫存管理系統</div>
      <div class="list-group list-group-flush">
        <a href="goods.php" class="list-group-item list-group-item-action bg-dark text-white">商品</a>
        <a href="supplier.php" class="list-group-item list-group-item-action bg-dark text-white">廠商</a>
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
<!--內容-->
<!-- 內容 -->
<div class="container-fluid">
    <h1 class="mt-4">分析報告</h1>
            若無法自行顯示資料請按表格標籤<br><br>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5" id="wrapper">
        <div class="form-group mx-auto" style="width: 900px;">

            <label>當日銷售分類</label>
            <br>
            <br>
            <canvas id="chart1" width="100" height="40"></canvas>
            <script src="chart1.js"></script>
            <br><br>
        </div>

        <div class="form-group mx-auto" style="width: 1000px;">
            <label>本月營業額比較</label>
            <br><br>
            <canvas id="chart2" width="500 px" height="200 px"></canvas>
            <script src="chart2.js"></script>
        </div>

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
