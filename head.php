<?php include("backend/conf/mariadb.php");?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css" >
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>[ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่] </title>
  </head>
  <body>
  <?php
@session_start();
?>
  <header>

  <script>

$(function(){
     
     // เมื่อฟอร์มการเรียกใช้ evnet submit ข้อมูล        
     $("#form1").on("submit",function(e){
         e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
  
         // เตรียมข้อมูล form สำหรับส่ง
        var formData = $(this).serialize();
        register();
          
     });
      
      
 });
    function register(){
            
            document.getElementById("bt_login").innerHTML='Wait a minute! <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true" style="color:#fff"></i>';
            document.getElementById("bt_login").disabled=true;
            
        $.post("call_login.php", {
            user:$("#user").val(),
            pass:$("#pass").val()  
        }, function(data){

            try{
                var obj = JSON.parse(data);
                if(obj.status==0){
                    Swal.fire({
                    title: 'Username หรือ Password ไม่ถูกต้อง',
                    text: 'โปรดลองใหม่อีกครั้ง',
                    icon: 'warning',
                    confirmButtonText: 'เข้าใจแล้ว'
                    }).then((result) => {
                    if (result.value) {
                        $("#user").val()='';
                        $("#pass").val()='';
                    }
                    })
                }else if(obj.status==1){
                        location.href='index.php';
                }
            }catch(err){
                Swal.fire(
                    'เกิดข้อผิดพลาดไม่ทราบสาเหตุ',
                    'โปรดลองใหม่อีกครั้ง'+err+data,
                    'error'
                    )
            }
                document.getElementById("bt_login").disabled=false;
                document.getElementById("bt_login").innerHTML="Login";

                });
        }
    </script>


  <!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
  <div class="container">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
    <a class="navbar-brand" href="#">
      <strong>ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่ </strong>
    </a>
    <div class="collapse navbar-collapse" id="navbarNav1">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a href="index.php" class="nav-link">หน้าแรก <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a href="order.php" class="nav-link">การสั่งซื้อของฉัน</a>
        </li>
        <li class="nav-item">
          <a href="pomotion.php" class="nav-link">สินค้าขายดี5อันดับ</a>
        </li>
        <li class="nav-item">
          <a href="payments.php" class="nav-link">การแจ้งชำระเงิน</a>
        </li>
        <li class="nav-item">
          <a href="transport.php" class="nav-link">การจัดส่งสินค้า</a>
        </li>
        <!-- <li class="nav-item dropdown btn-group">
          <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More info</a>
          <div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
            <a class="dropdown-item">Contact</a>
            <a class="dropdown-item">Billing adress</a>
            <a class="dropdown-item">Discounts</a>
          </div>
        </li> -->
      </ul>
      <form class="form-inline waves-effect waves-light">
        <input class="form-control" type="search" placeholder="ค้นหาสินค้า" name="search" value="<?php echo $_GET["search"];?>">
      </form>&nbsp;
      <a href="taka.php"><button type="button" class="btn btn-warning"><i class="fas fa-shopping-basket">ตะกร้า</i> </button></a>
    </div>
  </div>
</nav>
<!--/.Navbar-->

</header>

<main>

<!--Main layout-->
<div class="container">
  <div class="row">

    <!--Sidebar-->
    <div class="col-lg-4 wow fadeIn" data-wow-delay="0.2s">

      <div class="widget-wrapper">
        <h4>หมวดหมู่สินค้า:</h4>
        <br>
        <div class="list-group">
        <a href="index.php" class="list-group-item active"></a>


        <?php
      $sql="SELECT * FROM `type` ";    
      $que=mysqli_query($con,$sql);
      while($re=mysqli_fetch_assoc($que)){
      ?>
          <a href="index.php?type_id=<?php echo $re["type_id"];?>" class="list-group-item "><?php echo $re["type_name"];?></a>
          <?php }?>
        </div>
      </div>



      <?php
      if(!isset($_SESSION["otop"]["ID"])){
      ?>
  <div class="widget-wrapper wow fadeIn" data-wow-delay="0.4s">
    <a href="login.php">
      <button class="btn btn-primary">ลงชื่อเข้าใช้</button>
    </a>
  </div>
  </div>
      

    <?php }else{?>
        <div class="widget-wrapper wow fadeIn" data-wow-delay="0.4s">
        <h4>ผู้เข้าใช้งาน : <?php echo $_SESSION["otop"]["m_fullname"];?></h4>
        <br>
    <form id="form1">
    <a href="edit-register.php"><button type="button" class="btn btn-secondary">แก้ไขข้อมูลส่วนตัว</button></a>
        <a href="logout.php"><button type="button" class="btn btn-secondary">ออกจากระบบ</button></a>
        </form>
      </div>

    </div>
        <?php }?>
    <!--/.Sidebar-->