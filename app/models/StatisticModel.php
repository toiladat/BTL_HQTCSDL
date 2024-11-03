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
}
