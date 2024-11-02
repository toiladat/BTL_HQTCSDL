<?php

class DBConnection
{
  private $host;
  private $user;
  private $pass;
  private $dbname;
  private $conn;

  public function __construct()
  {
    $this->host = DB_HOST;
    $this->user = DB_USER;
    $this->pass = DB_PASS;
    $this->dbname = DB_NAME;
    try {
      $sqlStr = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4";
      $this->conn = new PDO($sqlStr, $this->user, $this->pass);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Connection failed: " . $e->getMessage()); // Ghi log lỗi
      $this->conn = null;
    }
  }

  public function getConnection()
  {
    return $this->conn;
  }
}
