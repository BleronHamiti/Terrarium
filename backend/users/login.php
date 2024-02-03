<?php
session_start();
require_once '../server/config.php';
require_once './User.php';
require_once './UserRegistration.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new DatabaseConnection();

    $user = new User('', '', $email, $password);

    $userRegistration = new UserRegistration($database);

    $loginResult = $userRegistration->checkLoginCredentials($user);

    if ($loginResult) {
        
        $_SESSION['user_id'] = $user->getUserId();
        header("Location: ../../structure/home.php");
        exit();
    } else {
        $_SESSION['creds_error'] = 'Invalid login credentials';
        header("Location: ../../structure/login.php");
        echo json_encode(['success' => false, 'message' => 'Invalid login credentials']);
    }
} else {
    
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
