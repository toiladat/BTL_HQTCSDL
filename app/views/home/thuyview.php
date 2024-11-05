<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê khách hàng và doanh thu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<style>
    /* Thiết lập màu sắc cơ bản */
:root {
    --primary-color: #6DCACA;
    --secondary-color: #ffffff;
    --text-color: #333333;
    --bg-light: #f9f9f9;
}

/* Thiết lập màu nền tổng thể và màu chữ */
body {
    font-family: Arial, sans-serif;
    background-color: var(--bg-light);
    color: var(--text-color);
    margin: 0;
}

/* Navbar */
.navbar {
    background-color: var(--primary-color);
    padding: 1rem;
}


.navbar-nav .nav-link {
    color: #ff7f50; /* Màu chữ của các link cam */
    font-size: 1.1rem; /* Kích thước chữ cho link */
    transition: color 0.3s; /* Hiệu ứng chuyển màu khi hover */
}

.navbar-nav .nav-link:hover {
    color: #ff4500; /* Màu chữ khi hover */
}

/* Tiêu đề */
h1.display-4 {
    color: var(--primary-color);
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

p.lead {
    color: var(--text-color);
    text-align: center;
}

.navbar-brand {
    font-family: 'Arial', sans-serif; /* Font chữ cho brand */
    font-size: 1.8rem; /* Kích thước chữ lớn hơn */
    font-weight: bold; /* Chữ đậm */
    color: #ff7f50; /* Màu chữ cam */
    text-transform: uppercase; /* Chữ in hoa */
    transition: color 0.3s; /* Hiệu ứng chuyển màu khi hover */
}

.navbar-brand:hover {
    color: #ff4500; /* Màu chữ khi hover */
}

.navbar {
    background-color: #6f42c1; /* Màu nền của navbar */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ cho navbar */
}

/* Form */
.form-input-day .form-group label {
    color: var(--text-color);
    font-weight: bold;
}

.form-control {
    border: 2px solid var(--primary-color);
    padding: 0.5rem;
}

button[type="submit"] {
    background-color: var(--primary-color);
    color: var(--secondary-color);
    font-weight: bold;
    border: none;
    padding: 0.5rem 1.5rem;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #5BB7B7; /* Màu sắc khi hover */
}

/* Bảng thống kê doanh thu */
.table {
    margin-top: 2rem;
    background-color: var(--secondary-color);
}

.table thead {
    background-color: var(--primary-color);
}

.table thead th {
    color: var(--secondary-color);
    font-weight: bold;
    background-color: #6DCACA;
}

.table tbody tr {
    transition: background-color 0.3s;
}

.table tbody tr:hover {
    background-color: #e3f7f7;
}

.table tbody td {
    color: var(--text-color);
    font-size: 1rem;
}

/* Biểu đồ */
.chart-revenue {
    background-color: var(--secondary-color);
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Footer */
footer {
    background-color: var(--primary-color);
    color: var(--secondary-color);
    padding: 1rem;
    text-align: center;
    margin-top: 2rem;
}

footer p a {
    color: var(--secondary-color);
    text-decoration: underline;
}

footer p a:hover {
    color: #333333; /* Màu tối hơn khi hover */
}

/* Hiệu ứng liên kết */
a {
    color: var(--primary-color);
    text-decoration: none;
}

a:hover {
    color: #5BB7B7;
    text-decoration: underline;
}

/* Hiệu ứng nút */
button:hover, .btn:hover {
    background-color: #5BB7B7;
    color: var(--secondary-color);
}

/* Responsive cho mobile */
@media (max-width: 768px) {
    h1.display-4 {
        font-size: 2rem;
    }

    .container {
        padding: 1rem;
    }

    .form-input-day, .chart-revenue {
        width: 100%;
    }
}

</style>

</style>
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
        <h1 class="display-4 text-center mb-4">Thống Kê Khách Hàng Hàng Đầu </h1>
        
        <form class="row mb-5" action="?controller=statistic&action=getStatistic" method="POST">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Ngày bắt đầu:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo $beginDay; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Ngày kết thúc:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo $beginDay; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="top_customers" class="form-label">Số khách hàng hàng đầu:</label>
                <input type="number" id="top_customers" name="top_customers" class="form-control" value="<?php echo $top; ?>" required>
            </div>
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary" >Thống kê</button>
            </div>
        </form>

        <!-- Bảng hiển thị khách hàng hàng đầu -->
        <div class="table-responsive mb-5">
            <table class="table table-striped table-bordered shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID Khách Hàng</th>
                        <th>Tên Khách Hàng</th>
                        <th>Tổng Số Hóa Đơn</th>
                        <th>Tổng Số Tiền</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    if (!empty($customers)) {
                        foreach ($customers as $customer) {
                   
                            echo "<tr>
                                <td>" . htmlspecialchars($customer['CustomerID']) ." </td>
                                <td>" . htmlspecialchars($customer['CustomerName']) . "</td>
                                <td>" . htmlspecialchars($customer['CountlBills']) . "</td>
                                <td>" . htmlspecialchars(number_format($customer['TotalBills'], 0, ',', '.')) . " VNĐ</td>                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-center'>Không có dữ liệu để hiển thị</td></tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>


    </div>

   
</body>

</html>
