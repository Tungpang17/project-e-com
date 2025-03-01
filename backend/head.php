<style type="text/css">
  @media print {
    #hid {
      display: none;
      /* ซ่อน  */
    }
  }
</style>

<?php
@session_start();
if (!isset($_SESSION["shopee"]["user_id"])) {
  header("location:login/");
}

?>
<?php
include("conf/mariadb.php");
$sql = "SELECT * FROM `product` WHERE `Qty`<=10";
$que = mysqli_query($con, $sql);
$qty = mysqli_num_rows($que);

?>
<html lang="en">

<head>

  <!-- DataTables CSS -->
  <link href="css/addons/datatables2.min.css" rel="stylesheet">
  <!-- DataTables JS -->
  <script src="js/addons/datatables2.min.js" type="text/javascript"></script>

  <!-- DataTables Select CSS -->
  <link href="css/addons/datatables-select2.min.css" rel="stylesheet">
  <!-- DataTables Select JS -->
  <script src="js/addons/datatables-select2.min.js" type="text/javascript"></script>






  <link rel="stylesheet" type="text/css" href="datatables/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="datatables/css/dataTables.bootstrap4.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/bootstrap-5.0.0-alpha1-dist/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="jquery-1.9.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <title>ระบบบริหารจัดการคลังสินค้า</title>
</head>

<body>

  <style type="text/css">
    body {
      font-family: 'Kanit', sans-serif;
    }
  </style>

  <?php if ($_SESSION["shopee"]["type_id"] == "1") { ?>

    <nav id="hid" class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: fixed; top: 0;
  left: 0;
  z-index: 999;
  width: 100%;
">
      <div class="container-fluid">
        <img src="img/ru1.png" width="85" height="85">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <center></center>
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'edit_user.php')
                echo "active"; ?>" href="edit_user.php">จัดการข้อมูลพนักงาน</a>
            </li>
            <li class="nav-item">

              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'edit_member.php')
                echo "active"; ?>" href="edit_member.php">จัดการข้อมูลสมาชิก</a>
            </li>

            <li class="nav-item dropdown">

              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'edit_product.php')
                echo "active"; ?>" href="edit_product.php">จัดการข้อมูลสินค้า</a>

              <!-- <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
            จัดการข้อมูลสินค้า
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'edit_product.php')
              echo "active"; ?>" href="edit_product.php">จัดการข้อมูลสินค้า</a></li>
            <li><a class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'edit_stock.php')
              echo "active"; ?>" href="edit_stock.php">จัดการหมวดหมู่สินค้า</a></li>
           
          </ul> -->
            </li>


            <!-- <li class="nav-item"> -->

            <!-- <a class="nav-link <?php //if(basename($_SERVER['PHP_SELF'])=='edit_comy.php') echo "active"; ?>" href="edit_comy.php">จัดการข้อมูลสถานประกอบการ</a>
        </li> -->




            <li class="nav-item">
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'stock.php')
                echo "active"; ?>" href="stock.php">จัดการข้อมูลสินค้าคงคลัง</span>
              </a>
            </li>
            <!-- <li class="nav-item">
          
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'order.php')
            echo "active"; ?>" href="order.php">การสั่งซื้อ</a>
        </li> -->
            <li class="nav-item">
              <a class="nav-link " href="stock.php">จัดการข้อมูลการสั่งซื้อ
              </a>
            </li>
            <li class="nav-item">

              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'payment.php')
                echo "active"; ?>" href="payment.php" aria-current="page">แจ้งชำระเงิน</a>
            </li>
            <li class="nav-item">

              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'transport.php')
                echo "active"; ?>" href="transport.php" aria-current="page">การจัดส่ง</a>
            </li>
            <li class="nav-item">

              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'repost.php')
                echo "active"; ?>" href="repost.php">รายงาน</a>
            </li>
          </ul>
        </div>
        <div class="btn-group dropleft">
          <i class="fa fa-user-circle fa-2x" style="color: #fff;cursor:pointer" aria-hidden="true"
            data-toggle="dropdown"></i>
          <div class="dropdown-menu" style="margin-top: 40px" aria-labelledby="navbarDropdown">
            <a class="dropdown-item">รหัสสมาชิก : <?php echo $_SESSION["shopee"]["user_id"]; ?></a>
            <a class="dropdown-item"><?php echo $_SESSION["shopee"]["user_name"]; ?></a>
            <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
          </div>
        </div>
      </div>
    </nav>




  <?php } else { ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: fixed; top: 0;
  left: 0;
  z-index: 999;
  width: 100%;
">
      <div class="container-fluid">
        <img src="img/ru1.png" width="85" height="85">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">





            <li class="nav-item">
              <center><a href="edit_member.php"><img src="img/4.jpg" width="50" height="50"></a></center>
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'edit_member.php')
                echo "active"; ?>" href="edit_member.php">จัดการข้อมูลสมาชิก</a>
            </li>

            <li class="nav-item dropdown">
              <center><img src="img/8.png" width="50" height="50"></center>
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'edit_product.php')
                echo "active"; ?>" href="edit_product.php">จัดการข้อมูลสินค้า</a>

              <!-- <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
            จัดการข้อมูลสินค้า
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'edit_product.php')
              echo "active"; ?>" href="edit_product.php">จัดการข้อมูลสินค้า</a></li>
            <li><a class="dropdown-item <?php if (basename($_SERVER['PHP_SELF']) == 'edit_stock.php')
              echo "active"; ?>" href="edit_stock.php">จัดการหมวดหมู่สินค้า</a></li>
           
          </ul> -->
            </li>


            <!-- <li class="nav-item">
          <center><a href="edit_comy.php"><img src="img/7.png" width="50" height="50"></a></center>
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'edit_comy.php')
            echo "active"; ?>" href="edit_comy.php">จัดการข้อมูลสถานประกอบการ</a>
        </li> -->




            <li class="nav-item">
              <center><a href="tailors.php"><img src="img/11.png" width="50" height="50"></a></center>
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'tailors.php')
                echo "active"; ?>" href="tailors.php">สมาชิกกลุ่มทอผ้า</span>
              </a>
            </li>

            <li class="nav-item">
              <center><a href="tailor-records.php"><img src="img/11.png" width="50" height="50"></a></center>
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'tailors.php')
                echo "active"; ?>" href="tailor-records.php">การทอผ้า</span>
              </a>
            </li>
            <!-- <li class="nav-item">
          <center><a href="order.php"><img src="img/3.png" width="50" height="50"></a></center>
          <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'order.php')
            echo "active"; ?>" href="order.php">การสั่งซื้อ</a>
        </li> -->
            <li class="nav-item">
              <center><a href="payment.php"><img src="img/9.png" width="50" height="50"></a></center>
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'payment.php')
                echo "active"; ?>" href="payment.php" aria-current="page">แจ้งชำระเงิน</a>
            </li>
            <li class="nav-item">
              <center><a href="order.php"><img src="img/9.png" width="50" height="50"></a></center>
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'order.php')
                echo "active"; ?>" href="order.php" aria-current="page">การสั่งซื้อ</a>
            </li>
            <li class="nav-item">
              <center><a href="transport.php"><img src="img/2.jpg" width="50" height="50"></a></center>
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'transport.php')
                echo "active"; ?>" href="transport.php" aria-current="page">การจัดส่ง</a>
            </li>
            <li class="nav-item">
              <center><a href="repost.php"><img src="img/6.png" width="50" height="50"></a></center>
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'repost.php')
                echo "active"; ?>" href="repost.php">รายงาน</a>
            </li>













            <li class="nav-item">
              <center><a href="search_user.php"><img src="img/4.jpg" width="50" height="50"></a></center>
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'search_user.php')
                echo "active"; ?>" href="search_user.php">แก้ไขข้อมูลส่วนตัว</a>
            </li>
          </ul>
        </div>
        <div class="btn-group dropleft">
          <i class="fa fa-user-circle fa-2x" style="color: #fff;cursor:pointer" aria-hidden="true"
            data-toggle="dropdown"></i>
          <div class="dropdown-menu" style="margin-top: 40px" aria-labelledby="navbarDropdown">
            <a class="dropdown-item">รหัสสมาชิก : <?php echo $_SESSION["shopee"]["user_id"]; ?></a>
            <a class="dropdown-item"><?php echo $_SESSION["shopee"]["user_name"]; ?></a>
            <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
          </div>
        </div>
      </div>
    </nav>
  <?php } ?>
  <br>
  <br>