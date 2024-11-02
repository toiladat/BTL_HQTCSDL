<?php
class TableModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Lấy tất cả các bàn
    public function getAllTables() {
        try {
            $stmt = $this->pdo->prepare("SELECT id, name, status FROM TableFood");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Xử lý lỗi
            echo "Error fetching tables: " . $e->getMessage();
            return [];
        }
    }

    // Tìm kiếm bàn theo trạng thái
    public function searchTablesByStatus($status) {
        try {
            $stmt = $this->pdo->prepare("SELECT id, name, status FROM TableFood WHERE status = :status");
            $stmt->execute(['status' => $status]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error searching for tables: " . $e->getMessage();
            return [];
        }
    }

    // Thêm một bàn mới
    public function addTable($name, $status) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO TableFood (name, status) VALUES (:name, :status)");
            $stmt->execute(['name' => $name, 'status' => $status]);
            return $this->pdo->lastInsertId(); // Trả về ID của bàn mới được thêm
        } catch (PDOException $e) {
            echo "Error adding table: " . $e->getMessage();
            return false;
        }
    }
}
?>
