<?php include './head.php'; ?>
<?php
include './conf/mariadb.php';

// Fetch tailor record
$sql = "SELECT * FROM tailor_record WHERE id = " . $_GET['id'];
$result = $con->query($sql);
$row = $result->fetch_assoc();

// Fetch all tailors
$tailor_sql = 'SELECT * FROM tailor';
$tailor_result = $con->query($tailor_sql);
while ($tailor_row = $tailor_result->fetch_assoc()) {
  $tailors[] = $tailor_row;
}

// Fetch all products
$product_sql = 'SELECT * FROM product';
$product_result = $con->query($product_sql);
while ($product_row = $product_result->fetch_assoc()) {
  $products[] = $product_row;
}
?>

<div>
  <h1>แก้ไขรายการทอผ้า</h1>
</div>

<div>
  <form id="form">
    <div class="form-group">
      <label for="tailor-id">สมาชิก</label>
      <select id="tailor-id" class="custom-select" name="tailor_id">
        <?php foreach ($tailors as $tailor): ?>
          <option value="<?php echo $tailor['id']; ?>" <?php echo $tailor['id'] == $row['tailor_id'] ? 'selected' : ''; ?>>
            <?php echo $tailor['id'] . ' - ' . $tailor['name']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="product-id">สินค้า</label>
      <select id="product-id" class="custom-select" name="product_id">
        <?php foreach ($products as $product): ?>
          <option value="<?php echo $product['product_id']; ?>" <?php echo $product['product_id'] == $row['product_id'] ? 'selected' : ''; ?>>
            <?php echo $product['product_id'] . ' - ' . $product['Product_name']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="quantity">จำนวน</label>
      <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>"
        required>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
  </form>
</div>

<script>
  const form = document.getElementById('form');

  form.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(form);
    formData.append('id', <?php echo $_GET['id']; ?>);

    fetch('./../api/update-tailor-record.php', {
      method: 'POST',
      body: formData
    })
      .then(response => {
        if (response.ok) {
          alert('บันทึกข้อมูลสำเร็จ');
          window.location.href = './tailor-records.php';
        } else {
          alert('เกิดข้อผิดพลาด');
        }
      })
  })
</script>
<?php include './foot.php'; ?>