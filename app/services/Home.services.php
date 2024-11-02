<?php
require_once APP_ROOT . "/app/models/Doc.models.php";
class DocService
{
  public function getAllDoc()
  {
    $doc = [];
    $dbConnection = new DBConnection();
    if ($dbConnection != null) {
      $conn = $dbConnection->getConnection();
      if ($conn) {
        $sql = "SELECT * from autos";
        $stmt = $conn->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $maxe = $row["maxe"];
          $ten = $row['ten'];
          $soseri = $row['soseri'];
          $namsanxuat = $row['namsanxuat'];
          $doc = new Doc($maxe, $ten, $soseri, $namsanxuat);
          $docs[] = $doc;
        }
        return $docs;
      }
    }
  }

  public function addDoc(Doc $Doc)
  {
    $dbConnection = new DBConnection();
    if ($dbConnection != null) {
      $conn = $dbConnection->getConnection();
      if ($conn) {
        $tenxe = $Doc->getTenTaiLieu();
        $soseri = $Doc->getTacGia();
        $namsanxuat = $Doc->getMoTa();
        $sql = "INSERT INTO autos (tenxe, soseri, namsanxuat)
            VALUES ('$tenxe','$soseri','$namsanxuat')";
        $conn->exec($sql);
      }
    }
  }

  public function getDocById($maxe)
  {
    $dbConnection = new DBConnection();
    if ($dbConnection != null) {
      $conn = $dbConnection->getConnection();
      if ($conn) {
        $sql = "SELECT * from autos where maxe='$maxe'";
        $stmt = $conn->query($sql);
        if ($stmt->rowCount() > 0) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $doc = new Doc($row["maxe"], $row["ten"], $row["soseri"], $row["namsanxuat"]);
          return $doc;
        }
      }
    }
  }
  public function editDoc(Doc $doc)
  {
    $dbConnection = new DBConnection();
    if ($dbConnection != null) {
      $conn = $dbConnection->getConnection();
      if ($conn) {
        $maxe = $doc->getMaTaiLieu();
        $tenxe = $doc->getTenTaiLieu();
        $soseri = $doc->getTacGia();
        $namsanxuat = $doc->getMoTa();
        //echo  $name = $patient->getFullname();;
        $sql = "UPDATE autos set tenxe='$tenxe', soseri='$soseri', namsanxuat='$namsanxuat'
               where maxe='$maxe'";
        $conn->exec($sql);
      }
    }
  }
  public function deleteDoc( $maxe){
    $dbConnection = new DBConnection();
    if ($dbConnection != null) {
      $conn = $dbConnection->getConnection();
      if ($conn) {
        
        $sql = "DELETE FROM autos where maxe='$maxe' ";
        $conn->exec($sql);
      }
    }
  }
}
