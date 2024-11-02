<?php
require_once APP_ROOT.'/app/models/StatisticModel.php';
  class StatisticController {
    private $statisticModel;

  public function __construct($db)
  {
    $this->statisticModel = new StatisticModel($db);
  }

    public function index() {
      //tra ve giao dien
      $minDay=$this->statisticModel->getMinDay();
      $today = new DateTime();
      $today=$today->format("Y-m-d"); // Ví dụ: 2024-11-02
      $beginDay = !empty($_POST['start_date']) ? $_POST['start_date'] : $minDay;
      $endDay = !empty($_POST['end_date']) ? $_POST['end_date'] : $today;
      
      $Revenue = $this->statisticModel->getRevenue($beginDay,$endDay);

      include APP_ROOT.'/app/views/home/statistic.view.php';
    }
  }