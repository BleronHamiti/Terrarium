<?php
session_start();

if (!isset($_SESSION['user_id'])) { 
   header("Location: ./login.php");
   exit();
}


require_once '../backend/server/config.php'; 
require_once '../backend/users/User.php';
require_once '../backend/users/UserRegistration.php';
require_once '../backend/plants/plantsCollection.php';
$userId = $_SESSION['user_id'];

$database = new DatabaseConnection();

$userRegistration = new UserRegistration($database);


$user = $userRegistration->getUserById($userId);
$plantsCollection = new PlantsCollection($userId);
$plantCount = $plantsCollection->getPlantCount();


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../styles/plant.css" />
    <link rel="stylesheet" href="../styles/card.css" />
    <meta
      http-equiv="Content-Security-Policy"
      content="frame-src 'self' https://www.youtube.com;"
    />

    <title>User</title>
  </head>
  <body>
    <header>
      <img src="../assets/images/logo.png" alt="TerrariumLogo" width="200px" />
      <div class="search">
        <input type="text" placeholder="Search..." />
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>
      <div class="user">
        <div class="time-container" id="current-time"></div>
        <a href="./user-settings.php"><i class="fa-solid fa-user"></i></a>
      </div>
      <img src="../assets/images/close.png" alt="" id="close">
        <img src="../assets/images/menu.png" alt="" id="menu">
    </header>
    <main>
      <div class="side-bar" id="side-bar">
        <ul>
          <li>
            <a href="./home.php" ><i class="fa-solid fa-house"></i>Home</a>
          </li>
          <li>
            <a href="./plants.php"
              ><i class="fa-solid fa-seedling"></i>My Plants</a
            >
          </li>
          <li>
            <a href="./addnew.php"><i class="fa-solid fa-plus"></i>Add new</a>
          </li>
          <li>
            <a href="./discover.php"
              ><i class="fa-solid fa-magnifying-glass"></i>Discover</a
            >
          </li>
        </ul>
      </div>
      <div class="main-content">
      
        <div><?php
              if (isset($_SESSION['error_update'])) {
              echo($_SESSION['error_update']);
              unset($_SESSION['error_update']);
            }?></div>
            <div><div class="profile-info">
          <div class="container">
            <div class="profile-pic">
              <img
                id="profileImage"
                src="../assets/images/profilepic.png"
                alt="Profile Picture"
              />
            </div>
            <div class="profile-plants">Plants owned: <?php echo $plantCount; ?></div>
            <button id="editButton">
              <i class="fa-solid fa-pen-to-square"></i>Edit
            </button>

            <div class="modalProfile" id="fileModal">
              <div class="modal-profile-content">
                <span class="close">&times;</span>
                <label for="modalFileInput" class="custom-file-input">
                  Choose File
                </label>
                <input
                  type="file"
                  id="modalFileInput"
                  class="file-input-hidden"
                  accept="image/*"
                />
                <div id="fileSelectedMessage"></div>
                <button id="modalSaveButton">Save</button>
              </div>
            </div>
          </div>

          <div class="profile-settings">
            <form id="ProfileForm" action="../backend/users/UserUpdate.php" method="POST">
              <div class="groups">
                <div class="form-group">
                  <input
                    type="text"
                    id="name"
                    name="name"
                    class="input-field"
                    required
                    value="<?php echo $user->getName()?>"
                  />
                  <span class="label">Name:</span>
                  <span class="error-message" id="nameError"></span>
                </div>
                <div class="form-group">
                  <input
                    type="text"
                    id="surname"
                    name="surname"
                    class="input-field"
                    required
                    value="<?php echo $user->getSurname()?>"
                  />
                  <span class="label">Surname:</span>
                  <span class="error-message" id="surnameError"></span>
                </div>
              </div>
              

              <div class="form-group">
                <input
                  type="email"
                  id="email"
                  name="email"
                  class="input-field"
                  required
                  value=" <?php echo $user->getEmail()?>"
                />
                <span class="label">Email:</span>
                <span class="error-message" id="emailError"></span>
              </div>
              <div class="form-group">
                <input
                  type="password"
                  id="password"
                  name="password"
                  class="input-field"
                 
                 
                />
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="error-message">
                        <?php 
                        echo $_SESSION['error_message']; 
                        unset($_SESSION['error_message']); 
                        ?>
                    </div>
                <?php endif; ?>

                <span class="label">New Password:</span>
                <span class="error-message" id="passwordError"></span>
              </div>
              <div class="form-group">
                <input
                  type="password"
                  id="confirm-password"
                  name="confirm-password"
                  class="input-field"
                 
                />
                <span class="label">Confirm Password:</span>
                <span class="error-message" id="confirm-passwordError"></span>
              </div>

              <button type="submit">Update</button>
              <a class="logout-phone" href="../backend/users/logout.php">Logout</a>
            </form>
            
          </div>
         
        </div> </div>
        
        <a class="logout" href="../backend/users/logout.php">Logout</a>
      </div>
    </main>
    <script src="../functionalities/clock.js"></script>
    <script src="../functionalities/profile.js"></script>
    <script src="../functionalities/responsive.js"></script>
  </body>
</html>
