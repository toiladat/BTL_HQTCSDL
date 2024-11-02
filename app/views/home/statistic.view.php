<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê doanh thu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Thư viện biểu đồ Chart.js -->
</head>

<body>
    <style>
        /* Base styles for the body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            /* Light gray background for contrast */
            color: #333;
            /* Dark text color for readability */
            margin: 0;
            padding: 0;
        }

        /* Form container styles */
        form {
            max-width: 600px;
            /* Limit the width of the form */
            margin: 50px auto;
            /* Center the form with top margin */
            padding: 20px;
            background-color: #fff;
            /* White background for the form */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* Light shadow for depth */
        }

        /* Styles for each form group */
        .form-group {
            margin-bottom: 20px;
            /* Space between form groups */
        }

        /* Label styles */
        label {
            display: block;
            /* Make the label a block element */
            margin-bottom: 5px;
            /* Space between label and input */
            font-weight: bold;
            /* Bold text for labels */
            color: #555;
            /* Slightly lighter color for labels */
        }

        /* Input styles */
        input[type="date"] {
            width: 100%;
            /* Full width input */
            padding: 10px;
            /* Padding for better touch target */
            border: 1px solid #ccc;
            /* Light border */
            border-radius: 4px;
            /* Rounded corners */
            font-size: 1rem;
            /* Base font size */
            transition: border-color 0.3s;
            /* Smooth transition for border color */
        }

        /* Input focus styles */
        input[type="date"]:focus {
            border-color: #007bff;
            /* Change border color on focus */
            outline: none;
            /* Remove the default outline */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Soft shadow on focus */
        }

        /* Button styles */
        .btn {
            background-color: #6DCACA;
            /* Primary button color */
            color: #fff;
            /* White text color */
            border: none;
            /* Remove default border */
            padding: 10px 20px;
            /* Padding for button */
            border-radius: 4px;
            /* Rounded corners */
            font-size: 1rem;
            /* Base font size */
            cursor: pointer;
            /* Pointer cursor on hover */
            transition: background-color 0.3s;
            /* Smooth transition for background color */
        }

        /* Button hover styles */
        .btn:hover {
            background-color: #0056b3;
            /* Darker shade on hover */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            form {
                padding: 15px;
                /* Reduce padding on smaller screens */
            }

            input[type="date"],
            .btn {
                font-size: 0.9rem;
                /* Slightly smaller font size on mobile */
            }
        }

        .form-input-day {
            width: 400px;
            height: 100%;
        }

        .chart-revenue {
            height: 100%;
        }

        h1,
        p,
        label {
            color: #6DCACA;
        }
    </style>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">GROUP 1 COFFEE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Statistic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="display-4 text-center mb-4">Thống Kê Doanh Thu Từ <br />
            <?php echo htmlspecialchars($beginDay); ?> đến <?php echo htmlspecialchars($beginDay); ?>
        </h1>
        <p class="lead text-center">Xem doanh thu hàng ngày trong tháng hiện tại.</p>

        <div class="d-flex">
            <form class="col-4 form-input-day" action="?controller=statistic" method="POST" action="">
                <div class="form-group">
                    <label for="start_date">Ngày bắt đầu:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo $beginDay; ?>" required>
                </div>

                <div class="form-group">
                    <label for="end_date">Ngày kết thúc:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo $beginDay; ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Thống kê</button>
            </form>

            <!-- Biểu đồ doanh thu -->
            <div class="mt-5 col-6 chart-revenue">
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
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh Thu Hàng Ngày (VNĐ)',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
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
    </script>

</body>

</html>