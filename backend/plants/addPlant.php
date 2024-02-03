<?php
session_start();
require_once './plant.php';
require_once './watering.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId=$_SESSION['user_id'];
    $plantName = $_POST['plant-name'];
    $plantSpecies = $_POST['plant-species'];
    $wateringFrequency = $_POST['watering-frequency'];
    $lastWateredDate = $_POST['last-watered'];
    $uploadDir = '../../uploads/';
    $originalFileName = basename($_FILES['plant-picture']['name']);
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);


    $uniqueFileName = uniqid('uploaded_') . '.' . $fileExtension;

    $uploadFile = $uploadDir . $uniqueFileName;

    if (move_uploaded_file($_FILES['plant-picture']['tmp_name'], $uploadFile)) {
        echo 'File is valid, and was successfully uploaded.';
    } else {
        echo 'Upload failed.';
    }

    $imagePath = 'uploads/' . $uniqueFileName;

    $plant = new Plant($userId, $plantName, $plantSpecies, $imagePath);
    
    $plant->saveToDatabase(); 
    $plantId = $plant->getPlantId();
    $watering = new Watering($plant->getPlantId(), $lastWateredDate, $wateringFrequency);

    $watering->saveToDatabase(); 
    $watering->calculateNextWateringDate(); 
    $nextWateringDate = $watering->calculateNextWateringDate();

header('Location: ../../structure/plants.php');
}
?>
