<script type="text/javascript">
    var obj;
    var type_id = '';
</script>
<?php
include("head.php");
?>
<div class="container">
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-6">

            <div id="button1">

            </div>

            <br>


            <div class="row">
                <div class="col-6">
                    <form action="edit_product.php" method="get">
                        <input type="text" name="search" id="search" hidden>
                        <input id="search" type="text" class="form-control" name="search"
                            value="<?php echo $_GET['search']; ?>" style="width:230px" placeholder="โปรดใส่ชื่อสินค้า">
                        <button type="submit" class="btn btn-warning" style="width: 100px">ค้นหา</button>
                    </form>
                </div>
            </div>


            <br>
            <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">รหัสสินค้า</th>
                        <th scope="col">ชื่อสินค้า</th>
                        <th scope="col">รายละเอียดสินค้า</th>
                        <th scope="col">ราคา</th>
                        <th scope="col">จำนวน</th>
                        <th scope="col">ยอดคงเหลือ</th>
                    </tr>
                </thead>


                <tbody>
                    <?php
                    $search_term = $_GET['search'];

                    $query =
                        "SELECT `product`.*, `propic`.`pic_url`, `ordered_amount` FROM `product` 
                        LEFT JOIN `propic` ON `propic`.`product_id` = `product`.`product_id`
                        LEFT JOIN (
                            SELECT `product_id`, SUM(`order_detail`.`pro_amount`) AS `ordered_amount` 
                            FROM `order_detail` 
                            LEFT JOIN `orders` ON `order_detail`.`order_id` = `orders`.`order_id` 
                            LEFT JOIN `payments` ON `orders`.`order_id` = `payments`.`order_id`
                            WHERE `payments`.`pay_status` = 0 OR `payments`.`pay_status` IS NULL
                            GROUP BY `product_id`)
                        AS `order_detail` 
                        ON `order_detail`.`product_id` = `product`.`product_id`
                        WHERE `Product_name` LIKE '%$search_term%'
                        ORDER BY `product`.`product_id` ASC
                        ";

                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr id="product.<?php echo $row['product_id']; ?>" data-pro-id="<?php echo $row['product_id']; ?>"
                            data-pro-name="<?php echo $row['Product_name']; ?>"
                            data-pro-de="<?php echo $row['Product_detail']; ?>"
                            data-pro-price="<?php echo $row['Product_Price']; ?>" data-qty="<?php echo $row['Qty']; ?>"
                            data-type-id="<?php echo $row['type_id']; ?>" data-com-id="<?php echo $row['com_id']; ?>"
                            data-product-cos="<?php echo $row['product_cos']; ?>"
                            data-com-name="<?php echo $row['com_name']; ?>" data-pro="<?php echo $row['pro']; ?>"
                            data-pro-s="<?php echo $row['pro_s']; ?>" data-pro-e="<?php echo $row['pro_e']; ?>"
                            onclick="show_click(<?php echo $row['product_id']; ?>)" style="cursor:pointer">
                            >
                            <td>
                                <img src="img/product/<?php echo $row['pic_url']; ?>" style="width: 64px; height: 64px" />
                            </td>
                            <td><?php echo $row['product_id']; ?></td>
                            <td><?php echo $row['Product_name']; ?></td>
                            <td><?php echo $row['Product_detail']; ?></td>
                            <td><?php echo $row['Product_Price']; ?></td>
                            <td><?php echo $row['Qty'] + $row['ordered_amount']; ?></td>
                            <td><?php echo $row['Qty']; ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-6">

            <div>
                <div class="row no-gutters">
                    <center>
                        <div class="col-md-4">
                            <img src="img/1.png" class="card-img" alt="...">
                    </center>
                    <br>
                    <br>

                </div>
                <form id="form1">
                    <div class="col-md-12">
                        <div class="card-body">

                            <input class="form-control" type="text" placeholder="ใส่รหัสสินค้า" name="product_id"
                                id="pro_id" hidden="">

                            <label class="card-text" style="font-size: 20px">ชื่อสินค้า :</label>
                            <input class="form-control" type="text" placeholder="ใส่ชื่อสินค้า" name="Product_name"
                                id="pro_name">

                            <label class="card-text" style="font-size: 20px">รายระเอียดสินค้า :</label>
                            <textarea class="form-control" placeholder="รายระเอียดสินค้า" rows="3" name="Product_detail"
                                id="pro_de"></textarea>
                            <br>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" style="font-size: 20px">ต้นทุน :</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" placeholder="ใส่ราคา" name="product_cos"
                                        id="product_cos">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" style="font-size: 20px">ราคาขาย :</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" placeholder="ใส่ราคา" name="Product_Price"
                                        id="pro_price">
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" style="font-size: 20px">จำนวน :</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" placeholder="ใส่จำนวน" name="Qty" id="qty">
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" style="font-size: 20px">เลือกหมวดหมู่ :</label>
                                <div class="col-sm-5">
                                    <select class="form-select" aria-label="Default select example" name="type_id"
                                        id="type_id">
                                    </select>
                                </div>
                            </div>

                            <hr />
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" style="font-size: 20px">อัพโหลดรูปภาพ:</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="file" name="picture" id="picture">
                                </div>
                            </div>



                        </div>
                    </div>
            </div>
        </div>
        <center>

            <button type="button" class="btn btn-success" onclick="add()">เพิ่มสินค้า</button>
            <button type="button" class="btn btn-danger" onclick="de()">ลบสินค้า</button>
            <button type="button" class="btn btn-warning" onclick="up()">แก้ไขสินค้า</button>
            <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
        </center>
        </form>
    </div>


    <script>
        /*var input = document.getElementById("Product_name");
   input.addEventListener("keyup", function(event) {
     if (event.keyCode === 13) { 
       s();
     }
   
   
   
   
   });
   
   function s(){
   
        $.post("call_search2.php",{
         Product_name:$("#Product_name").val()
       },function(data){
   
   
         var obj=JSON.parse(data);
         console.log(obj.Product_name);
         $("#product_id").html(obj.product_id);
         $("#Product_name").html(obj.Product_name);
         $("#Product_Price").html(obj.Product_Price);
         $("#Qty").html(obj.Qty);
         
   
   
         });
   }*/

        function show_pic() {
            location.href = "pro-pic.php?id=" + $("#pro_id").val();
        }

        function add() {
            // เตรียมข้อมูล form สำหรับส่ง
            var formData = new FormData($("#form1")[0]);

            // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
            $.ajax({
                url: 'call_add_product.php',
                type: 'POST',
                data: formData,
                // contentType: 'multipart/form-data',
                /*async: false,*/
                cache: false,
                contentType: false,
                processData: false
            }).done(function (data) {
                try {
                    var obj = JSON.parse(data);
                    if (obj.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มรายการสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout("location.reload()", 1500);
                    }


                    console.log(data); // ทดสอบแสดงค่า  ดูผ่านหน้า console
                    /*              การใช้งาน console log เพื่อ debug javascript ใน chrome firefox และ ie 
                                    http://www.ninenik.com/content.php?arti_id=692 via @ninenik         */
                } catch (err) {
                    alert('พบข้อผิดพลาดในการเพิ่มข้อมูล โปรดรีเฟรชหน้าจอ' + data);
                    return 0;
                }



            });

        }



        function de() {
            if ($("#pro_id").val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'แจ้งเตือน',
                    text: 'โปรดใส่ข้อมูล',
                })
                return false;
            }

            // เตรียมข้อมูล form สำหรับส่ง
            var formData = new FormData($("#form1")[0]);

            // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
            $.ajax({
                url: 'call_de_product.php',
                type: 'POST',
                data: formData,
                // contentType: 'multipart/form-data',
                /*async: false,*/
                cache: false,
                contentType: false,
                processData: false
            }).done(function (data) {
                try {
                    var obj = JSON.parse(data);
                    if (obj.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบรายการสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout("location.reload()", 1500);
                    }


                    console.log(data); // ทดสอบแสดงค่า  ดูผ่านหน้า console
                    /*              การใช้งาน console log เพื่อ debug javascript ใน chrome firefox และ ie 
                                    http://www.ninenik.com/content.php?arti_id=692 via @ninenik         */
                } catch (err) {
                    alert('พบข้อผิดพลาดในการเพิ่มข้อมูล โปรดรีเฟรชหน้าจอ' + data);
                    return 0;
                }



            });

        }


        function up() {
            if ($("#pro_id").val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'แจ้งเตือน',
                    text: 'โปรดใส่ข้อมูล',
                })
                return false;
            }

            // เตรียมข้อมูล form สำหรับส่ง
            var formData = new FormData($("#form1")[0]);

            // ส่งค่าแบบ POST ไปยังไฟล์ show_data.php รูปแบบ ajax แบบเต็ม
            $.ajax({
                url: 'call_up_product.php',
                type: 'POST',
                data: formData,
                // contentType: 'multipart/form-data',
                /*async: false,*/
                cache: false,
                contentType: false,
                processData: false
            }).done(function (data) {
                try {
                    var obj = JSON.parse(data);
                    if (obj.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขรายการสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout("location.reload()", 1500);
                    }


                    console.log(data); // ทดสอบแสดงค่า  ดูผ่านหน้า console
                    /*              การใช้งาน console log เพื่อ debug javascript ใน chrome firefox และ ie 
                                    http://www.ninenik.com/content.php?arti_id=692 via @ninenik         */
                } catch (err) {
                    alert('พบข้อผิดพลาดในการเพิ่มข้อมูล โปรดรีเฟรชหน้าจอ' + data);
                    return 0;
                }



            });

        }

        function show_button1() {
            $.post("call_show.php", {
                table: 'type',
                condition: ''
            }, function (data) {
                obj = JSON.parse(data);


                $("#type_id").html('<option selected>เลือกหมวดหมู่สินค้า</option>');
                $("#button1").html(
                    '<button type="button" class="btn btn-warning" onclick="show_tbody1(\'\',\'\');type_id=\'\';">ทั้งหมด</button>  '
                );
                for (var i = 0; i < obj.length; i++) {

                    $("#button1").html($("#button1").html() +
                        '<button type="button" class="btn btn-warning" onclick="show_tbody1(\'' + obj[i]
                            .type_id + '\',\'\');type_id=\'' + obj[i].type_id + '\';">' + obj[i].type_name +
                        '</button>  ');
                    $("#type_id").html($("#type_id").html() + '<option value="' + obj[i].type_id + '">' + obj[i]
                        .type_name + '</option>');
                }
            });
        }

        function show_button2() {
            $.post("call_show2.php", {
                table: 'comunity',
                condition2: ''
            }, function (data) {
                obj = JSON.parse(data);


                $("#com_id").html('<option selected>เลือก</option>');
                for (var i = 0; i < obj.length; i++) {
                    $("#com_id").html($("#com_id").html() + '<option value="' + obj[i].com_id + '">' + obj[i]
                        .com_name + '</option>');
                }
            });
        }



        //  function show_tbody1(type_id, search) {
        //      $.post("call_show.php", {
        //          table: 'product',
        //          leftjoin: 'propic',
        //          leftjoin_column: 'product_id',
        //          table_leftjoin_column: 'product_id',
        //          conditon: type_id,
        //          search: search
        //      }, function(data) {
        //          obj = JSON.parse(data);
        //          console.log(data)
        //          console.log(obj);
        //          $("#tbody1").html('');
        //          for (var i = 0; i < obj.length; i++) {
        //              $("#tbody1").html($("#tbody1").html() + '<tr onclick="show_click(' + i +
        //                  ')" style="cursor:pointer"><th scope="row"><img src="img/product/' + (obj[i].pic_url) +
        //                  '" style="width: 64px; height: 64px"/></th><td>' + obj[i].product_id + '</td><td>' +
        //                  obj[i].Product_name + '</td><td>' + obj[i].Product_detail + '</td><td>' + obj[i]
        //                  .Product_Price + '</td><td>' + obj[i].Qty + `</td>
        //                     <td>

        //                     </td>
        //                  </tr>`);
        //          }
        //      });

        //  }

        function search() {

            var search = document.getElementById("search_product").value
            console.log('Search', search)
            //  show_tbody1(type_id, search);
        }


        function show_click(id) {
            const data = document.getElementById("product." + id).dataset;

            const proId = document.getElementById("pro_id")
            if (proId) proId.value = data.proId;
            const proName = document.getElementById("pro_name")
            if (proName) proName.value = data.proName;
            const proDe = document.getElementById("pro_de")
            if (proDe) proDe.value = data.proDe;
            const proPrice = document.getElementById("pro_price")
            if (proPrice) proPrice.value = data.proPrice;
            const qty = document.getElementById("qty")
            if (qty) qty.value = data.qty;
            const typeId = document.getElementById("type_id")
            if (typeId) typeId.value = data.typeId;
            const comId = document.getElementById("com_id")
            if (comId) comId.value = data.comId;
            const productCos = document.getElementById("product_cos")
            if (productCos) productCos.value = data.productCos;
            const comName = document.getElementById("com_name")
            if (comName) comName.value = data.comName;

            const pro = document.getElementById("pro")
            if (pro) pro.value = data.pro;
            const proS = document.getElementById("pro_s")
            if (proS) proS.value = data.proS;
            const proE = document.getElementById("pro_e")
            if (proE) proE.value = data.proE;
        }

        show_button1();
        // show_button2();
        //  show_tbody1();
    </script>
</div>
</div>
<br>
<?php
include("foot.php");
?>