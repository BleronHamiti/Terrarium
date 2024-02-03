<?php
session_start();

// Redirect if not logged in as admin
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: home.php");
    exit();
}

require_once '../backend/server/config.php';
require_once '../backend/users/UserManagement.php';

$database = new DatabaseConnection();
$userManagement = new UserManagement($database);

// If there's a delete request, handle it
if (isset($_POST['delete']) && isset($_POST['user_id'])) {
    $userManagement->deleteUser($_POST['user_id']);
    // Redirect to dashboard to prevent form resubmission
    header("Location: dashboard.php");
    exit();
}

$users = $userManagement->getAllUsers();
?>

<!-- HTML and PHP to display users in a table -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Include your stylesheets here -->
    <link rel="stylesheet" href="../styles/dashboard.css" />
</head>
<body>
    <a href="login.php"> Go to Home</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user) { ?>
    <tr>
        <td><?php echo htmlspecialchars($user['user_id']); ?></td>
        <td><?php echo htmlspecialchars($user['user_name']); ?></td>
        <td><?php echo htmlspecialchars($user['user_surname']); ?></td>
        <td><?php echo htmlspecialchars($user['user_email']); ?></td>
        <td><?php echo htmlspecialchars($user['user_role']); ?></td>
        <td>
        <form action="edit-user.php" method="get">
    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
    <input type="submit" value="Edit" class="action-btn delete-btn">
</form>

            <form method="post" style="display: inline;">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                <input type="submit" name="delete" value="Delete" class="action-btn delete-btn">
            </form>
        </td>
    </tr>
<?php } ?>
    </table>
</body>
</html>
