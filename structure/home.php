<?php
session_start();

if (!isset($_SESSION['user_id'])) { 
   header("Location: ./login.php");
   exit();
}

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
            <a href="#" class="active"><i class="fa-solid fa-house"></i>Home</a>
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
        <div class="noti-banner">
          <i class="fa-solid fa-bell"></i>
          <p>Here are all the news about your plants</p>
          <p>One or more of your plants needs watering</p>
          <a href="./plants.html">Go to plants</a>
        </div>
        <div class="content-home">
          <a class="add-new-home" href="./addnew.php">
            <i class="fa-solid fa-plus"></i>
            <span>Add a new plant</span>
</a>
          <div class="all-plants-home">
            <div class="plants-home">
              <div class="home-images">
                <img src="../assets/images/begonia1.png" alt="" />
              </div>
              <div class="home-images">
                <img src="../assets/images/image-snake.png" alt="" />
              </div>
              <div class="home-images">
                <img src="../assets/images/peacelily.png" alt="" />
              </div>
            </div>

            <a href="./plants.php">View Your Plants</a>
          </div>
        </div>
        <div class="wrap-discover">
          <div class="discover-home">
            <img src="../assets/images/banner.png" alt="" />
            <div class="discover">
              <h2>
                <i class="fa-solid fa-compass"></i>Discover everything you need
                to know about plants
              </h2>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="../functionalities/clock.js"></script>
    <script src="../functionalities/responsive.js"></script>
  </body>
</html>
