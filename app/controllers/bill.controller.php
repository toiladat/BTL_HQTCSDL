<?php
require_once APP_ROOT . '/app/models/BillModel.php';
class BillController
{
  private $billModal;

  public function __construct($db)
  {
    $this->billModal = new BillModel($db);
  }

  public function index()
  {
    $tables = $this->billModal->getAllTable();
    $tableId = isset($_GET["tableID"]) ? $_GET["tableID"] : "";
    $tableSelected = $tableId;
    $customers = $this->billModal->getAllCustomers();
    $accounts = $this->billModal->getAllAccounts();
    $foods = $this->billModal->getFoods(1);
    $drinks = $this->billModal->getFoods(0);

    include APP_ROOT . '/app/views/home/addBill.view.php';
  }
  public function store()
  {
    // Lấy dữ liệu từ form
    $tableId = $_POST['table_id'];
    $customerId = $_POST['customer_id'];
    $accountId = $_POST['account_id'];
    $foods = isset($_POST['foods']) ? $_POST['foods'] : [];
    $foodQuantities = isset($_POST['food_quantity']) ? $_POST['food_quantity'] : [];
    $drinks = isset($_POST['drinks']) ? $_POST['drinks'] : [];
    $drinkQuantities = isset($_POST['drink_quantity']) ? $_POST['drink_quantity'] : [];
    $totalPrice = $_POST['total_price'];

    // Tạo mảng sản phẩm
    $productArray = [];

    // Tạo định dạng cho mảng sản phẩm
    foreach ($foods as $foodId) {
      $quantity = isset($foodQuantities[$foodId]) ? $foodQuantities[$foodId] : 0;
      $productArray[] = ['id' => $foodId, 'count' => $quantity]; // Giả định mảng được yêu cầu
    }

    // Tạo định dạng cho mảng sản phẩm
    foreach ($drinks as $drinkId) {
      $quantity = isset($drinkQuantities[$drinkId]) ? $drinkQuantities[$drinkId] : 0;
      $productArray[] = ['id' => $drinkId, 'count' => $quantity]; // Giả định mảng được yêu cầu
    }


    // Thực hiện transaction
    try {
      // Bắt đầu transaction
      $this->billModal->beginTransaction();

      // Cập nhật bàn ăn 
      $this->billModal->updateTableStatus($tableId, "Đã có người");

      // Chèn hóa đơn để lấy ra ID
      $idBill = $this->billModal->insertBill($customerId, $accountId, $tableId, $totalPrice);
      // chèn bảng lịch sử mua hàng
      $this->billModal->insertHistoryBill($customerId,$idBill,$totalPrice);
      // Chèn thông tin hóa đơn
      $this->billModal->insertBillInfo($idBill, $productArray);

      // Cam kết transaction
      $this->billModal->commit();
    } catch (Exception $e) {
      // Rollback nếu có lỗi
      $this->billModal->rollBack();
      // Xử lý lỗi, có thể log lỗi hoặc thông báo cho người dùng
      echo "Có lỗi xảy ra: " . $e->getMessage();
    }
    header('Location: ?controller=home');
  }
  public function clearTable()
  {
    $tableId = isset($_GET["tableID"]) ? $_GET["tableID"] : "";
    $this->billModal->updateTableStatus($tableId, "Trống");
    header('Location: ?controller=home');
  }
}
