<?php
require_once APP_ROOT.'/app/models/TableModel.php';
  class HomeController {
    private $tableModel;

  public function __construct($db)
  {
    $this->tableModel = new TableModel($db);
  }

    public function index() {
      
      $tables = $this->tableModel->getAllTables();
      include APP_ROOT.'/app/views/home/index.view.php';

    }
  }