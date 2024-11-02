<?php
require_once APP_ROOT.'/app/models/FoodModel.php';
  class MenuController {
    private $foodModel;

  public function __construct($db)
  {
    $this->foodModel = new FoodModel($db);
  }

    public function index() {
      
      $foods = $this->foodModel->getAllFoods();
      include APP_ROOT.'/app/views/home/menu.view.php';

    }
  }