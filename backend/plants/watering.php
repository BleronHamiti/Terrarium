<?php
require_once __DIR__ .'/../server/config.php';
class Watering {
    private $wateringId;
    private $plantId;
    private $lastWateredDate;
    private $frequency;
    private $nextWateringDate;
    public function __construct($plantId, $lastWateredDate, $frequency) {
        $this->plantId = $plantId;
        $this->lastWateredDate = $lastWateredDate;
        $this->frequency = $frequency;
    }

    public function getWateringId() {
        return $this->wateringId;
    }

    public function getPlantId() {
        return $this->plantId;
    }

    public function getLastWateredDate() {
        return $this->lastWateredDate;
    }

    public function getFrequency() {
        return $this->frequency;
    }

    public function setWateringId($wateringId) {
        $this->wateringId = $wateringId;
    }

    public function setPlantId($plantId) {
        $this->plantId = $plantId;
    }

    public function setLastWateredDate($lastWateredDate) {
        $this->lastWateredDate = $lastWateredDate;
    }
    public function setNextWateringDate(DateTime $nextWateringDate) {
        $this->nextWateringDate = $nextWateringDate;
    }

    public function setFrequency($frequency) {
        $this->frequency = $frequency;
    }

    public function calculateNextWateringDate() {
        $lastWateredDate = new DateTime($this->lastWateredDate);
    
        $nextWateringDate = clone $lastWateredDate;
        $nextWateringDate->modify('+' . $this->frequency . ' days');
    
        $this->nextWateringDate = $nextWateringDate;
    
        $formattedNextWateringDate = $this->nextWateringDate->format('Y-m-d');
        $this->saveToDatabase();
    
        return $formattedNextWateringDate;
    }
    
    public function calculateAllWateringDates() {
        $lastWateredDate = new DateTime($this->lastWateredDate);
    
        $allWateringDates = [];
        $maxIterations = 365; 
    
        while ($maxIterations > 0 && $lastWateredDate->format('m') == date('m')) {
            $nextWateringDate = clone $lastWateredDate;
            $nextWateringDate->modify('+' . $this->frequency . ' days');
            $allWateringDates[] = $nextWateringDate->format('Y-m-d');
    
            $lastWateredDate = $nextWateringDate;
            $maxIterations--;
        }
    
        return $allWateringDates;
    }
    
    public function saveToDatabase() {
        $databaseConnection = new DatabaseConnection();
        $dbConnection = $databaseConnection->getConnection();
    
        
        if (!$this->nextWateringDate instanceof DateTime) {
            $this->calculateNextWateringDate();
        }
    
        $query = "INSERT INTO wateringneeds (plant_id, last_watered_date, watering_frequency, next_watering_date) VALUES (?, ?, ?, ?)
              ON DUPLICATE KEY UPDATE last_watered_date = VALUES(last_watered_date), watering_frequency = VALUES(watering_frequency), next_watering_date = VALUES(next_watering_date)";
        $statement = $dbConnection->prepare($query);
    
        $statement->bindParam(1, $this->plantId);
        $statement->bindParam(2, $this->lastWateredDate);
        $statement->bindParam(3, $this->frequency);
        $statement->bindValue(4, $this->nextWateringDate->format('Y-m-d'));
        $result = $statement->execute();
    
        return $result;
    }
    public function updateLastWateredDate($lastWateredDate) {
        $databaseConnection = new DatabaseConnection();
        $dbConnection = $databaseConnection->getConnection();
    
        $query = "UPDATE wateringneeds SET last_watered_date = ? WHERE plant_id = ?";
        $statement = $dbConnection->prepare($query);
        $statement->bindParam(1, $lastWateredDate);
        $statement->bindParam(2, $this->plantId);
        
        return $statement->execute();
    }
    
    public static function getWateringByPlantId($plantId) {
        $databaseConnection = new DatabaseConnection();
        $dbConnection = $databaseConnection->getConnection();
    
        $query = "SELECT watering_id, plant_id, last_watered_date, watering_frequency, next_watering_date FROM wateringneeds WHERE plant_id = ?";
        $statement = $dbConnection->prepare($query, [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false]);
        $statement->bindParam(1, $plantId);
        $statement->execute();
    
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            
            $watering = new Watering($result['plant_id'], $result['last_watered_date'], $result['watering_frequency']);
            $watering->setWateringId($result['watering_id']);
    
            
            if (isset($result['next_watering_date'])) {
                $watering->setNextWateringDate(new DateTime($result['next_watering_date']));
            }
    
            return $watering;
        }
    
        return null; 
    }
    
    
}
?>
