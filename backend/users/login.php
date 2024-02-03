<?php
session_start();
require_once '../server/config.php';
require_once './User.php';
require_once './UserRegistration.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new DatabaseConnection();


    $user = new User('', '', $email, $password, '');

    $userRegistration = new UserRegistration($database);

    $user = $userRegistration->checkLoginCredentials($user);

    if ($user instanceof User) {
        $_SESSION['user_id'] = $user->getUserId();
        $_SESSION['user_role'] = $user->getRole();

        if ($_SESSION['user_role'] == 'admin') {
            header("Location: ../../structure/dashboard.php");
        } else {
            header("Location: ../../structure/home.php");
        }
        exit();
    } else {

        $_SESSION['creds_error'] = 'Invalid login credentials';
        header("Location: ../../structure/login.php");
        exit();
    }
} else {

    header("Location: ../../structure/login.php");
    exit();
}
?>
