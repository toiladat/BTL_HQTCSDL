<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thực Đơn</title>
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
                    <a class="nav-link" href="?controller=statistic">Statistic</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <header class="text-center mb-4">
        <h1 class="display-4">Thực Đơn của Chúng Tôi</h1>
        <p class="lead">Khám phá những món ngon tuyệt vời tại quán.</p>
    </header>

    <div class="row">
        <?php if (!empty($foods)): ?>
            <?php foreach ($foods as $food): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($food['name']) ?></h5>
                            <p class="card-text text-muted"><?= htmlspecialchars($food['category']) ?></p>
                            <p class="card-text"><strong>Giá: </strong><?= number_format($food['price'], 0, ',', '.') ?> VND</p>
                        </div>
                        <div class="card-footer bg-transparent text-center">
                            <button class="btn btn-success">Đặt Món</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    Thực đơn hiện tại chưa có món ăn.
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
