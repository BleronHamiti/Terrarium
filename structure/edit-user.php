<?php

require_once '../backend/server/config.php';
require_once '../backend/users/UserManagement.php';

session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$database = new DatabaseConnection();
$userManagement = new UserManagement($database);

$user = null;
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    $user = $userManagement->getUserById($userId);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $userId = $_POST['user_id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $role = $_POST['role'];


    try {
        if ($userManagement->updateUser($userId, $name, $surname, $email, $role)) {
            header("Location: dashboard.php?success=User updated successfully");
            exit();
        } else {
            header("Location: edit-user.php?error=Unable to update user&user_id=" . $userId);
            exit();
        }
    } catch (PDOException $e) {
        header("Location: edit-user.php?error=" . $e->getMessage() . "&user_id=" . $userId);
        exit();
    }
}

if (!$user) {
    header("Location: dashboard.php?error=User not found");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>

    <link rel="stylesheet" href="../styles/edit-user.css" />
  
</head>
<body>

<form action="edit-user.php" method="post">
    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">
    
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['user_name']); ?>" required>
    
    <label for="surname">Surname:</label>
    <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($user['user_surname']); ?>" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['user_email']); ?>" required>
    
    <label for="role">Role:</label>
    <select id="role" name="role" required>
        <option value="user" <?php echo $user['user_role'] === 'user' ? 'selected' : ''; ?>>User</option>
        <option value="admin" <?php echo $user['user_role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
    </select>
    
    <button type="submit" name="submit">Update User</button>
</form>

</body>
</html>
