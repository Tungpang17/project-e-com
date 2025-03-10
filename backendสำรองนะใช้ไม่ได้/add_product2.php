 <?php
include("head.php");
?>
<div class="container">
<br>
<br>
<br>
<div class="row">
<div class="col-md-6">

<select class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
<br>

<div class="card mb-3" style="max-width: 10000px;">
  <div class="row">
  <div class="col-md-2">
  </div>
    <div class="col-md-8">
    <div class="card-body">
    <div class="row">
    <center><h3>ใบสั่งซื้อสินค้า</h3></center>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">วันที่ :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">12/12/12</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">เลขที่ใบสั่งซื้อ :</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">0000000000</label>
    <label class="col-sm-6 col-form-label" style="font-size: 20px">รายการสินค้า :</label>
    <table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">ราคา</th>
      <th scope="col">จำนวน</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>1</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
       <td>1</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry the Bird</td>
      <td>@twitter</td>
       <td>1</td>
    </tr>
  </tbody>
</table>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">จำนวนสินค้า :</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">1</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">รวมราคา :</label>
    <label class="col-sm-5 col-form-label" style="font-size: 20px">0.00 &nbsp&nbsp&nbsp&nbsp&nbsp บาท</label>
  
    </div>
      </div>
    </div>
  </div>
</div>


 

  </div>

<div class="col-md-6">
<button type="button" class="btn btn-outline-dark">stock 1</button>
<button type="button" class="btn btn-outline-dark">stock 2</button>
<button type="button" class="btn btn-outline-dark">stock 3</button>
<button type="button" class="btn btn-outline-dark">stock 4</button>
<br>
<br>
  <table id="example" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">รหัสสินค้า</th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">ราคา</th>
      <th scope="col">จำนวน</th>
    </tr>
  </thead>


  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td><input type="text" name="" style="width: 50px"></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td><input type="text" name="" style="width: 50px"></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry the Bird</td>
      <td>@twitter</td>
      <td>@twitter</td>
      <td><input type="text" name="" style="width: 50px"></td>
    </tr>
  </tbody>
</table>
<br>
<center>
<button type="button" class="btn btn-warning">บันทึก</button>
<button type="button" class="btn btn-warning">ยกเลิก</button>
</center>

  </div>
</div>
</div>
<?php
include("foot.php");
?>