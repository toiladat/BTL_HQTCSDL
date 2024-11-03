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
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="display-4 text-center mb-4">Thống Kê Doanh Thu Từ <br />
            <?php echo htmlspecialchars($beginDay); ?> đến <?php echo htmlspecialchars($endDay); ?>
        </h1>
        <p class="lead text-center">Xem doanh thu hàng ngày trong tháng hiện tại.</p>

        <div class="d-flex">
            <form class="col-4 form-input-day" action="?controller=statistic&action=statisticDaily" method="POST" action="">
                <div class="form-group">
                    <label for="start_date">Ngày bắt đầu:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo $beginDay; ?>" required>
                </div>

                <div class="form-group">
                    <label for="end_date">Ngày kết thúc:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo $endDay; ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Thống kê</button>
            </form>

            <!-- Biểu đồ doanh thu -->
            <div class="mt-5 col-6 chart-revenue">
                <button id="toggleChart" class="btn btn-primary ">Chuyển Đổi Biểu Đồ</button>

                <canvas id="revenueChart" width="400" height="200"></canvas>
            </div>
        </div>
        <!-- Bảng thống kê doanh thu -->
        <div class="container mt-5">
            <div class="table-responsive">
                <table class="table table-striped table-bordered shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Ngày</th>
                            <th>Doanh Thu (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Giả sử $Revenue chứa dữ liệu doanh thu
                        $revenues = [['OrderDate' => '2024-10-01', 'TotalRevenue' => 1000000]];

                        // Kiểm tra xem mảng doanh thu có rỗng không
                        if (!empty($Revenue)) {
                            foreach ($Revenue as $revenue) {
                                // Gán 0 nếu TotalRevenue là null
                                $totalRevenue = $revenue['TotalRevenue'] !== null ? $revenue['TotalRevenue'] : 0;
                                echo "<tr>
                            <td>" . htmlspecialchars($revenue['OrderDate']) . "</td>
                            <td>" . number_format($totalRevenue, 0, ',', '.') . " VNĐ</td>
                          </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2' class='text-center'>Không có dữ liệu thống kê.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <footer class="text-center py-4 mt-5">
        <div class="container">
            <p>&copy; <?= date("Y") ?> Quán Cafe. Tất cả quyền được bảo lưu.</p>
            <p>Theo dõi chúng tôi trên:
                <a href="#" class="text-decoration-none">Facebook</a>,
                <a href="#" class="text-decoration-none">Instagram</a>,
                <a href="#" class="text-decoration-none">Twitter</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dữ liệu doanh thu để hiển thị trên biểu đồ
        const labels = <?= json_encode(array_column($Revenue, 'OrderDate')) ?>;
        const data = <?= json_encode(array_column($Revenue, 'TotalRevenue')) ?>;

        // Tạo biểu đồ đường
        const ctx = document.getElementById('revenueChart').getContext('2d');
        let chartType = 'line'; // Khởi tạo loại biểu đồ là 'line'

        // Tạo biểu đồ
        let revenueChart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh Thu Hàng Ngày (VNĐ)',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: chartType === 'line' ? 'rgba(75, 192, 192, 0.2)' : 'rgba(75, 192, 192, 0.5)',
                    borderWidth: 2,
                    fill: chartType === 'line',
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });

        // Sự kiện click cho nút chuyển đổi
        document.getElementById('toggleChart').addEventListener('click', function() {
            // Thay đổi loại biểu đồ
            chartType = chartType === 'line' ? 'bar' : 'line'; // Đổi giữa 'line' và 'bar'

            // Cập nhật biểu đồ
            revenueChart.destroy(); // Hủy biểu đồ cũ
            revenueChart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Doanh Thu Hàng Ngày (VNĐ)',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: chartType === 'line' ? 'rgba(75, 192, 192, 0.2)' : 'rgba(75, 192, 192, 0.5)',
                        borderWidth: 2,
                        fill: chartType === 'line',
                        tension: 0.3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>