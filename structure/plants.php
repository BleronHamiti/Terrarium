<?php
session_start();

if (!isset($_SESSION['user_id'])) { 
   header("Location: ./login.php");
   exit();
}

?>
<?php
require_once '../backend/plants/plantsCollection.php';

$userId = $_SESSION['user_id'];

$plantsCollection = new PlantsCollection($userId);
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

    <title>Plants</title>
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
            <a href="./home.php"><i class="fa-solid fa-house"></i>Home</a>
          </li>
          <li>
            <a href="#" class="active"
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
    <h2 class="all-plants">Click to view your plant</h2>
    <div class="plants">
        <?php $plantsCollection->displayPlants(); ?>
    </div>
</div>
    </main>
    <script src="../functionalities/clock.js"></script>
    <script src="../functionalities/responsive.js"></script>
  </body>
</html>
