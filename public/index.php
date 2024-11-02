<?php
require_once("../app/config/config.php");
require_once APP_ROOT . ("/app/libs/dbConnection.libs.php");
require_once(APP_ROOT . "/app/controllers/home.controllers.php");
require_once(APP_ROOT . "/app/controllers/menu.controllers.php");
$controller = isset($_GET["controller"]) ? $_GET["controller"] : "home";
$action = isset($_GET["action"]) ? $_GET["action"] : "index";
$dbConnection = new DBConnection();
$db = $dbConnection->getConnection();
// $request = $_SERVER['REQUEST_URI'];
// echo($request);

if ($controller == 'home') {
    // Gọi HomeController
    $controller = new HomeController($db);
    $controller->index();
} if ($controller == 'menu') {
    // Gọi MenuController
    $controller = new MenuController($db);
    $controller->index();
}
?>

