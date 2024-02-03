<?php
 session_start();

require_once '../server/config.php';
require_once './User.php';
require_once './UserRegistration.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $database = new DatabaseConnection();

    $newUser = new User($name, $surname, $email, $password);

  
    $userRegistration = new UserRegistration($database);

    $registrationResult = $userRegistration->registerUser($newUser);

    if ($registrationResult) {
        $_SESSION['user_id'] = $newUser->getUserId();
        header("Location: ../../structure/home.php");
        exit();
    } else {
        $_SESSION['email_exits'] = "A user with that email already exists!";
        header("Location: ../../structure/signup.php");
    }
} else {
   echo json_encode(['success' => false, 'errors' => ['registration' => 'Registration failed']]);
    
}
