<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh sách các bàn</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css"> <!-- Đường dẫn tới file CSS -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }

    h2 {
      text-align: center;
      color: #6DCACA;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      font-size: 14px;
      /* Kích thước chữ nhỏ gọn hơn */
    }

    th,
    td {
      padding: 10px;
      /* Khoảng cách ô nhỏ hơn */
      text-align: left;
      border: 1px solid #ddd;
    }

    th {
      background-color: #6DCACA;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }


    .no-data {
      text-align: center;
      color: #999;
      font-style: italic;
      padding: 20px;
      /* Thêm khoảng cách cho ô không có dữ liệu */
    }

    @media (max-width: 600px) {
      table {
        font-size: 12px;
        /* Kích thước chữ nhỏ hơn trên màn hình nhỏ */
      }

      th,
      td {
        padding: 8px;
        /* Giảm khoảng cách ô trên màn hình nhỏ */
      }
    }

    .warming-restock {
      font-weight: bold;
      color: #6DCACA;
    }
  </style>
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
                    <a class="nav-link" href="?controller=statistic&action=statisticDaily">Revenue</a>
                    </li>
                    <li>
                        <a href="?controller=statistic&action=statisticInventory" class="nav-link">Inventory</a>
                    </li>
                    <li>
                        <a href="?controller=statistic&action=statisticRevenueByFood" class="nav-link">Revenue By Food</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
  <h2>Thống Kê Hàng Tồn Trong Kho</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên Nguyên Liệu</th>
        <th>Số Lượng</th>
        <th>Đơn Vị</th>
        <th>Nhà Cung Cấp</th>
        <th>Ngày Hết Hạn</th>
        <th>Địa Điểm Lưu Trữ</th>
        <th>Ngày Thêm</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($inventories) > 0): ?>
        <?php foreach ($inventories as $inventory): ?>
          <?php
          // Tính toán ngày hết hạn
          $expirationDate = new DateTime($inventory['expirationDate']);
          $interval = $currentDateTime->diff($expirationDate);
          ?>
          <tr class="<?php echo ($interval->days <= 50 && $interval->invert == 0) ? 'warming-restock' : ''; ?>">
            <td><?php echo htmlspecialchars($inventory['id']); ?></td>
            <td><?php echo htmlspecialchars($inventory['name']); ?></td>
            <td><?php echo htmlspecialchars($inventory['quantity']); ?></td>
            <td><?php echo htmlspecialchars($inventory['unit']); ?></td>
            <td><?php echo htmlspecialchars($inventory['supplier']); ?></td>
            <td><?php echo htmlspecialchars($inventory['expirationDate']); ?></td>
            <td><?php echo htmlspecialchars($inventory['storageLocation']); ?></td>
            <td><?php echo htmlspecialchars($inventory['addedDate']); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="8" class="no-data">Không có dữ liệu tồn kho.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

</body>

</html>