<?php
class StatisticModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }
  public function getMinDay()
  {
    $timeMinQuery = $this->pdo->prepare('SELECT DATE(MIN(timeIn)) AS minTimeIn FROM bill');
    $timeMinQuery->execute();
    $timeMin = $timeMinQuery->fetch(PDO::FETCH_ASSOC);
    return $timeMin['minTimeIn'];
    
  }
  public function getRevenue($beginDay, $endDay)
  {
    // Đảm bảo định dạng ngày là đúng
    $beginDay = date('Y-m-d', strtotime($beginDay));
    $endDay = date('Y-m-d', strtotime($endDay));

    $stmt = $this->pdo->prepare("SELECT * 
        FROM MonthlyDailyRevenue 
        WHERE OrderDate BETWEEN :beginDay AND :endDay");
    $stmt->bindParam(':beginDay', $beginDay);
    $stmt->bindParam(':endDay', $endDay);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getInventories(){
    $stmt = $this->pdo->prepare("select * from ingredients ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
// Hàm lấy doanh thu theo món ăn giữa hai tháng
public function getRevenueByFood($startDate, $endDate) {
  $stmt = $this->pdo->prepare("CALL fnRevenueByFood(:startDate, :endDate)");
  $stmt->bindParam(':startDate', $startDate);
  $stmt->bindParam(':endDate', $endDate);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// thống kê khách hàng mua hàng nhiều nhất
public function getTopCustomers($top, $beginDay, $endDay) {
        
  $beginDay = date('Y-m-d', strtotime($beginDay));
  $endDay = date('Y-m-d', strtotime($endDay));
  // Sử dụng biến $top trong câu lệnh SQL
  $stmt = $this->pdo->prepare("CALL fn_TopCustomers(:top, :beginDay, :endDay);");
  $stmt->bindParam(':top', $top);
  $stmt->bindParam(':beginDay', $beginDay);
  $stmt->bindParam(':endDay', $endDay);

  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
     
  }
}
