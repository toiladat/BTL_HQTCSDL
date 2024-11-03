<?php
class BillModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function beginTransaction()
  {
    $this->pdo->beginTransaction();
  }

  public function commit()
  {
    $this->pdo->commit();
  }

  public function rollback()
  {
    $this->pdo->rollback();
  }

  public function getAllTable()
  {
    $stmt = $this->pdo->prepare("SELECT * from tablefood where status='Trống' ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getAllAccounts()
  {
    $stmt = $this->pdo->prepare("select * from Account ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getAllCustomers()
  {
    $stmt = $this->pdo->prepare("select * from customer ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getFoods($target)
  {
    $category = $target == 1 ? 'Đồ ăn' : 'Đồ uống';
    $stmt = $this->pdo->prepare("SELECT * FROM food WHERE category = :category");
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function updateTableStatus($tableId, $status)
  {
    $tableId = (int)$tableId; // Chuyển đổi $tableId thành kiểu số nguyên

    $stmt = $this->pdo->prepare("UPDATE tablefood SET status = :status WHERE id = :id");

    // Sử dụng bindValue để gán giá trị trực tiếp
    $stmt->bindValue(':status', $status);
    $stmt->bindValue(':id', $tableId);

    $stmt->execute(); // Thực thi truy vấn
  }
  public function insertBill($customerId, $accountId, $tableId, $totalPrice, $discount = 0)
  {
    // Chuẩn bị câu lệnh SQL để chèn dữ liệu
    $stmt = $this->pdo->prepare("INSERT INTO Bill (customerID, accountID, idTable, totalPrice, discount, timeIn, status) 
                                   VALUES (:customerID, :accountID, :idTable, :totalPrice, :discount,  '2024-9-10', 'Đã thanh toán')");

    // Gán giá trị cho các tham số
    $stmt->bindParam(':customerID', $customerId, PDO::PARAM_INT);
    $stmt->bindParam(':accountID', $accountId, PDO::PARAM_INT);
    $stmt->bindParam(':idTable', $tableId, PDO::PARAM_INT);
    $stmt->bindParam(':totalPrice', $totalPrice, PDO::PARAM_STR);
    $stmt->bindParam(':discount', $discount, PDO::PARAM_INT);

    // Thực hiện câu lệnh
    $stmt->execute();

    // Trả về ID của bản ghi vừa chèn
    return $this->pdo->lastInsertId();
  }

  public function insertBillInfo($idBill, $foods)
  {
    $stmt = $this->pdo->prepare("INSERT INTO BillInfo (idBill, idFood, count) VALUES (:idBill, :idFood, :count)");

    foreach ($foods as $food) {
      $foodId = $food['id']; // ID của món ăn
      $count = $food['count']; // Số lượng món ăn

      // Gán giá trị cho các tham số
      $stmt->bindParam(':idBill', $idBill);
      $stmt->bindParam(':idFood', $foodId);
      $stmt->bindParam(':count', $count);
      $stmt->execute();
    }
  }
  public function insertHistoryBill($customerId, $idBill, $totalPrice)
  {
    // Prepare the SQL statement
    $stmt = $this->pdo->prepare("INSERT INTO purchasehistory (customerID, billID, purchaseDate, totalSpent)
                                  VALUES (:customerId, :billId, NOW(), :totalPrice)");

    // Bind values to parameters
    $stmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
    $stmt->bindParam(':billId', $idBill, PDO::PARAM_INT);
    $stmt->bindParam(':totalPrice', $totalPrice, PDO::PARAM_STR); // Use PARAM_STR if totalPrice is a string (e.g., currency)

    // Execute the statement
    $stmt->execute();
  }
}
