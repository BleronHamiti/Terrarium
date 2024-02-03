<?php
session_start();

require_once '../server/config.php'; 
require_once './User.php';
require_once './UserRegistration.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];

    $database = new DatabaseConnection();
    $userRegistration = new UserRegistration($database);

    $currentUser = $userRegistration->getUserById($userId);

    $name = $_POST['name'] ?? $currentUser->getName(); 
    $surname = $_POST['surname'] ?? $currentUser->getSurname();
    $email = $_POST['email'] ?? $currentUser->getEmail();
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    if (!empty($password)) {
        
        if ($password === $confirmPassword) {
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        } else {
            
            $error = "Passwords do not match.";
           
        }
    }
    if (isset($error)) {
        $_SESSION['error_message'] = $error; 
        header("Location: ../../structure/user-settings.php");
    } 
    $updateResult = $userRegistration->updateUserInfo($userId, $name, $surname, $email, $hashedPassword);

    if ($updateResult) {
        header("Location: ../../structure/user-settings.php");
    } else {
        $_SESSION['error_update'] = "Error updating";
        header("Location: ../../structure/user-settings.php");
    }
  
}
?>
