<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh sách các bàn</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bill.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">GROUP 1 COFFEE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="?controller=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=statistic&action=getStatistic">Loyal Customer</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="?controller=statistic&action=statisticDaily">Revenue</a>
                    </li>
                    <li>
                        <a href="?controller=statistic&action=statisticInventory" class="nav-link"> Inventory</a>
                    </li>
                    <li>
                        <a href="?controller=statistic&action=statisticRevenueByFood" class="nav-link">Revenue By Food</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
  <div class="container mt-5">
    <h1 class="text-center mb-4">Thêm Hóa Đơn Mới</h1>

    <form action="?controller=addBill&action=store" method="POST">
      <div class="form-group">
        <label for="tableSelect">Chọn Bàn</label>
        <select class="form-control" id="tableSelect" name="table_id" required>
          <option value="" disabled selected>Vui lòng chọn bàn...</option> <!-- Default instruction option -->
          <?php foreach ($tables as $table): ?>
            <option value="<?= htmlspecialchars($table['id']) ?>"
              <?= $table['id'] == $tableSelected ? 'selected' : '' ?>>
              <?= htmlspecialchars($table['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
        <small class="form-text text-muted">Hãy chọn một bàn để tiếp tục.</small> <!-- Optional helper text -->
      </div>


      <div class="form-group">
        <label for="customerSelect">Khách Hàng</label>
        <select class="form-control" id="customerSelect" name="customer_id" required>
          <option value="">Chọn khách hàng...</option>
          <?php foreach ($customers as $customer): ?>
            <option value="<?= htmlspecialchars($customer['id']) ?>">
              <?= htmlspecialchars($customer['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="accountSelect">Nhân Viên Phục Vụ</label>
        <select class="form-control" id="accountSelect" name="account_id" required>
          <option value="">Chọn nhân viên...</option>
          <?php foreach ($accounts as $account): ?>
            <option value="<?= htmlspecialchars($account['accountID']) ?>">
              <?= htmlspecialchars($account['displayName']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>


      <div class="container  mt-4">
        <div class="form-group">
          <label class="h5">Món Ăn</label>
          <div class="form-check">
            <div class="row">
              <?php foreach ($foods as $food): ?>
                <div class="card mb-2 col-5 mr-2">
                  <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="foods[]" value="<?= htmlspecialchars($food['id']) ?>" id="food_<?= $food['id'] ?>" data-price="<?= $food['price'] ?>">
                      <label class="form-check-label" for="food_<?= $food['id'] ?>">
                        <?= htmlspecialchars(string: $food['name']) ?> - <?= number_format($food['price'], 0, ',', '.') ?> VNĐ
                      </label>
                    </div>
                    <input type="number" name="food_quantity[<?= htmlspecialchars($food['id']) ?>]" min="0" value="0" class="form-control quantity-input" style="width: 70px;" placeholder="">
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>


        <div class="form-group">
          <label class="h5">Đồ Uống</label>
          <div class="form-check">
            <div class="row">
              <?php foreach ($drinks as $drink): ?>
                <div class="card mb-2 col-5 mr-2">
                  <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <input type="checkbox" name="drinks[]" class="form-check-input" id="drink_<?= $drink['id'] ?>" <?= htmlspecialchars($drink['name']) ?> value="<?= htmlspecialchars($drink['id']) ?>" data-price="<?= $drink['price'] ?>">
                      <label class="form-check-label" for="drink_<?= $drink['id'] ?>">
                        <?= htmlspecialchars($drink['name']) ?> - <?= number_format($drink['price'], 0, ',', '.') ?> VNĐ
                      </label>
                    </div>
                    <input type="number" name="drink_quantity[<?= htmlspecialchars($drink['id']) ?>]" min="0" value="0" class="form-control quantity-input" style="width: 70px;" placeholder="">
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>


      <h5>Tổng Tiền: <span id="totalPrice">0 VNĐ</span></h5>
      <!-- Thêm input hidden để lưu tổng tiền -->
      <input type="hidden" id="hiddenTotalPrice" name="total_price" value="0">


      <button type="submit" class="btn btn-primary btn-block">Thêm Hóa Đơn</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      // Hàm tính tổng tiền
      function calculateTotal() {
        let total = 0;

        // Tính tổng cho món ăn
        $('input[name^="food_quantity"]').each(function() {
          const foodId = $(this).attr('name').match(/\d+/)[0]; // Lấy ID món ăn
          const quantity = parseInt($(this).val()) || 0; // Lấy số lượng (mặc định 0 nếu không phải số)
          const price = parseFloat($(`input#food_${foodId}`).data('price')) || 0; // Lấy giá từ data-price

          // Nếu checkbox được chọn, tính tổng
          if ($(`input#food_${foodId}`).is(':checked')) {
            total += quantity * price;
          }
        });

        // Tính tổng cho đồ uống
        $('input[name^="drink_quantity"]').each(function() {
          const drinkId = $(this).attr('name').match(/\d+/)[0]; // Lấy ID đồ uống
          const quantity = parseInt($(this).val()) || 0; // Lấy số lượng (mặc định 0 nếu không phải số)
          const price = parseFloat($(`input[value="${drinkId}"]`).data('price')) || 0; // Lấy giá từ data-price

          // Nếu checkbox được chọn, tính tổng
          if ($(`input[value="${drinkId}"]`).is(':checked')) {
            total += quantity * price;
          }
        });
        // Cập nhật giá trị vào ô input hidden
        $('#hiddenTotalPrice').val(total);
        // Cập nhật tổng tiền vào phần hiển thị
        $('#totalPrice').text(total.toLocaleString() + ' VNĐ');
      }

      // Bắt sự kiện change cho các checkbox và input số lượng
      $('.form-check-input, .quantity-input').on('change keyup', function() {
        calculateTotal();
      });

      // Gọi hàm tính tổng ban đầu
      calculateTotal();
    });
  </script>


</body>

</html>