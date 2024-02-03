<?php
require_once __DIR__ . '/../server/config.php';
class Plant {
    private $plantId;
    private $userId;
    private $name;
    private $species;
    private $imagePath; 
    private $createdAt;

    public function __construct($userId, $name, $species, $imagePath) {
        $this->userId = $userId;
        $this->name = $name;
        $this->species = $species;
        $this->imagePath = $imagePath;
        $this->createdAt = date('Y-m-d H:i:s'); 
    }

    public function getPlantId() {
        return $this->plantId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getName() {
        return $this->name;
    }

    public function getspecies() {
        return $this->species;
    }

    public function getImagePath() {
        return $this->imagePath;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setspecies($species) {
        $this->species = $species;
    }

    public function setImagePath($imagePath) {
        $this->imagePath = $imagePath;
    }
    public function saveToDatabase() {
        $databaseConnection = new DatabaseConnection();
        
        
        $dbConnection = $databaseConnection->getConnection();
        
        $query = "INSERT INTO plants (user_id, name, species, picture_path, created_at) VALUES (?, ?, ?, ?, ?)";
        $statement = $dbConnection->prepare($query);
        
        $statement->bindParam(1, $this->userId);
        $statement->bindParam(2, $this->name);
        $statement->bindParam(3, $this->species);
        $statement->bindParam(4, $this->imagePath);
        $statement->bindParam(5, $this->createdAt);
  
        $result = $statement->execute();
       
        if ($result) {
            $this->plantId = $dbConnection->lastInsertId();
            return true;
        } else {
            return false;
        }
    }
    public static function getPlantById($plantId) {
        $databaseConnection = new DatabaseConnection();
        $dbConnection = $databaseConnection->getConnection();
        
        $query = "SELECT * FROM plants WHERE plant_id = ?";
        $statement = $dbConnection->prepare($query);
        $statement->bindParam(1, $plantId, PDO::PARAM_INT);
        $statement->execute();
        
        $plantData = $statement->fetch(PDO::FETCH_ASSOC);
        if ($plantData) {
            $plant = new self(
                $plantData['user_id'],
                $plantData['name'],
                $plantData['species'],
                $plantData['picture_path']
            );
            $plant->plantId = $plantId; 
            return $plant;
        } else {
            return null; 
        }
    }
    

}

?>