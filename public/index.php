<?php
require_once("../app/config/config.php");
require_once APP_ROOT . "/app/libs/dbConnection.libs.php";
require_once APP_ROOT . "/app/controllers/home.controllers.php";
require_once APP_ROOT . "/app/controllers/menu.controllers.php";
require_once APP_ROOT . "/app/controllers/statistic.controller.php";// Mapping controller names to their respective classes
require_once APP_ROOT . "/app/controllers/bill.controller.php";
$controllers = [
    'home' => 'HomeController',
    'menu' => 'MenuController',
    'statistic' => 'StatisticController',
    'addBill'=>'BillController',
      // Dùng chung với MenuController (nếu thực tế cần khác, có thể tạo StatisticController)
];

// Xác định controller và action
$controllerName = isset($_GET["controller"]) ? $_GET["controller"] : "home";
$action = isset($_GET["action"]) ? $_GET["action"] : "index";


// Khởi tạo kết nối DB
$dbConnection = new DBConnection();
$db = $dbConnection->getConnection();

// Khởi tạo controller
$controllerClass = $controllers[$controllerName];
$controller = new $controllerClass($db);

// Kiểm tra và gọi action từ controller
if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    die("Action không tồn tại trong controller $controllerClass!");
}
