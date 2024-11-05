<?php
require_once APP_ROOT.'/app/models/StatisticModel.php';
  class StatisticController {
    private $statisticModel;

  public function __construct($db)
  {
    $this->statisticModel = new StatisticModel($db);
  }

    public function statisticDaily() {
      //tra ve giao dien
      $minDay= date('Y-m-01');
      $today = new DateTime();
      $today=$today->format("Y-m-d"); // Ví dụ: 2024-11-02
      $beginDay = !empty($_POST['start_date']) ? $_POST['start_date'] : $minDay;
      $endDay = !empty($_POST['end_date']) ? $_POST['end_date'] : $today;

      
      $Revenue = $this->statisticModel->getRevenue($beginDay,$endDay);

      include APP_ROOT.'/app/views/home/statistic.view.php';
    }
    public function statisticInventory(){
      $inventories=$this->statisticModel->getInventories();
      $currentDate = date('Y-m-d H:i:s'); // Ngày giờ hiện tại
      $currentDateTime = new DateTime($currentDate); // Chuyển đổi thành đối tượng DateTime
      include APP_ROOT.'/app/views/home/inventory.view.php';
    }
    public function statisticRevenueByFood() {
      $startDate = !empty($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-01',strtotime('first day of last month'));
      $endDate = !empty($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-t');
  
      $revenueByFood = $this->statisticModel->getRevenueByFood($startDate, $endDate);
  
      include APP_ROOT.'/app/views/home/revenuebyfood.view.php';
  }
  public function getStatistic() {


    $minDay=$this->statisticModel->getMinDay();

    $today = new DateTime();
    $today=$today->format("Y-m-d"); // Ví dụ: 2024-11-02
    
    // Lấy tham số từ GET request
    $top = isset($_GET['top']) ? (int)$_GET['top'] : 5; // Mặc định là 2 nếu không có giá trị
  
    $beginDay = isset($_GET['beginDay']) ? $_GET['beginDay'] : $minDay;
    $endDay = isset($_GET['endDay']) ? $_GET['endDay'] :  $today;
    
    // Gọi model để lấy danh sách khách hàng hàng đầu
    $customers = $this->statisticModel->getTopCustomers($top, $beginDay, $endDay);
    //var_dump($customers); // Kiểm tra dữ liệu trả về
    include APP_ROOT.'/app/views/home/thuyview.php';
  }
    public function statsticCustomer(){
      echo 'trang thong ke khach hang';
    }
  }