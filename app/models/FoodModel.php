<?php
class FoodModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllFoods() {
        $stmt = $this->pdo->prepare("SELECT id, name, price, category FROM Food");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
