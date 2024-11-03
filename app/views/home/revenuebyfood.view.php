<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê doanh thu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Thư viện biểu đồ Chart.js -->
    <link rel="stylesheet" href="css/style.css"> <!-- Đường dẫn tới file CSS -->

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
    <div class="container mt-5">
        <div class="text-center">
            <h1 class="display-4 mb-3">Thống Kê Doanh Thu Theo Món Ăn</h1>
            <p class="lead">Từ <span class="fw-bold"><?php echo htmlspecialchars(string:$startDate); ?></span> đến <span class="fw-bold"><?php echo htmlspecialchars(string:$endDate); ?></span></p>
        </div>

        <div class="row mt-5">
            <!-- Form nhập ngày -->
            <div class="col-md-4 mb-4">
                <div class="card p-4 shadow-sm">
                    <form action="?controller=statistic&action=statisticRevenueByFood" method="POST">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Ngày bắt đầu</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo $startDate; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Ngày kết thúc</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo $endDate; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Thống kê</button>
                    </form>
                </div>
            </div>

            <!-- Biểu đồ -->
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <h5 class="text-center">Doanh Thu Hiện Tại vs Tháng Trước</h5>
                    <canvas id="revenueChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Bảng dữ liệu -->
        <div class="table-responsive mt-5">
            <table class="table table-hover table-bordered shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th>Food ID</th>
                        <th>Tên Món</th>
                        <th>Doanh Thu Tháng Trước (VNĐ)</th>
                        <th>Doanh Thu Hiện Tại (VNĐ)</th>
                        <th>Tình Trạng</th>
                        <th>% Tăng Trưởng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($revenueByFood)) : ?>
                        <?php foreach ($revenueByFood as $revenue) : ?>
                            <tr>
                                <td><?= htmlspecialchars($revenue['FoodID']) ?></td>
                                <td><?= htmlspecialchars($revenue['FoodName']) ?></td>
                                <td><?= number_format($revenue['LastMonthRevenue'], 0, ',', '.') ?> VNĐ</td>
                                <td><?= number_format($revenue['CurrentMonthRevenue'], 0, ',', '.') ?> VNĐ</td>
                                <td><?= htmlspecialchars($revenue['GrowthStatus']) ?></td>
                                <td><?= number_format($revenue['GrowthPercentage'], 2, ',', '.') ?>%</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu thống kê.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p>&copy; <?= date("Y") ?> Quán Cafe. Tất cả quyền được bảo lưu.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const labels = <?= json_encode(array_column($revenueByFood, 'FoodName')) ?>;
        const lastMonthRevenue = <?= json_encode(array_column($revenueByFood, 'LastMonthRevenue')) ?>;
        const currentRevenue = <?= json_encode(array_column($revenueByFood, 'CurrentMonthRevenue')) ?>;

        const ctx = document.getElementById('revenueChart').getContext('2d');

        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Doanh Thu Tháng Trước (VNĐ)',
                        data: lastMonthRevenue,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Doanh Thu Hiện Tại (VNĐ)',
                        data: currentRevenue,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) { return value.toLocaleString() + " VNĐ"; }
                        }
                    }
                },
                plugins: {
                    legend: { display: true, position: 'top' }
                }
            }
        });
    </script>
</body>

</html>