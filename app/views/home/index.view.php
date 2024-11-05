<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các bàn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <header class="text-center mb-4">
            <h1 class="display-4">Danh Sách Các Bàn</h1>
            <p class="lead">Chọn bàn yêu thích của bạn.</p>
        </header>

        <div class="row">
            <?php if (!empty($tables)): ?>
                <?php foreach ($tables as $table): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= htmlspecialchars($table['name']) ?></h5>
                                <p class="card-text"><strong>Trạng thái:</strong> <?= htmlspecialchars($table['status']) ?></p>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <!-- <a href="?controller=addBill&tableID= <?= htmlspecialchars($table['id']) ?> " class="btn btn-primary">Chọn Bàn</a> -->
                                <?php if ($table['status'] == "Đã có người"): ?>
                                    <a href="#" class="btn btn-secondary disabled" aria-disabled="true">Đã Có Người</a>
                                    <a href="?controller=addBill&action=clearTable&tableID=<?= htmlspecialchars($table['id']) ?>" class="btn btn-primary">Dọn Bàn</a>
                                <?php else: ?>
                                    <a href="?controller=addBill&tableID=<?= htmlspecialchars($table['id']) ?>" class="btn btn-primary">Chọn Bàn</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert">
                        Không có bàn nào để hiển thị.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer class="text-center py-4">
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
</body>

</html>