<?php
require_once __DIR__ . '/../server/config.php';

class PlantsCollection {
    private $userId;  

    public function __construct($userId) {
        $this->userId = $userId;
    }

    public function getAllPlants() {
        $databaseConnection = new DatabaseConnection();
        $dbConnection = $databaseConnection->getConnection();

        $query = "SELECT * FROM plants WHERE user_id = ? ORDER BY created_at DESC";
        $statement = $dbConnection->prepare($query);
        $statement->bindParam(1, $this->userId);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPlantCount() {
        $databaseConnection = new DatabaseConnection();
        $dbConnection = $databaseConnection->getConnection();

        $query = "SELECT COUNT(*) FROM plants WHERE user_id = ?";
        $statement = $dbConnection->prepare($query);
        $statement->bindParam(1, $this->userId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchColumn();
    }
    public function displayPlants() {
        $plants = $this->getAllPlants();

        foreach ($plants as $plant) {
            echo '<a href="./plant.php?plant_id=' . $plant['plant_id'] . '">';
            echo '<div class="plants-card">';
            echo '<h2>' . htmlspecialchars($plant['name']) . '</h2>';
            echo '<img src="../' . htmlspecialchars($plant['picture_path']) . '" alt="" />';
            echo '</div></a>';
        }
    }
}
?>
