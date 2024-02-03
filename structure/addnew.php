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
            <a href="./home.php"><i class="fa-solid fa-house"></i>Home</a>
          </li>
          <li>
            <a href="./plants.php"
              ><i class="fa-solid fa-seedling"></i>My Plants</a
            >
          </li>
          <li>
            <a href="#" class="active"
              ><i class="fa-solid fa-plus"></i>Add new</a
            >
          </li>
          <li>
            <a href="./discover.php"
              ><i class="fa-solid fa-magnifying-glass"></i>Discover</a
            >
          </li>
        </ul>
      </div>
      <div class="main-content">
        <div class="add-plant-form">
          <h2>Add a New Plant</h2>
          <form
            id="plant-form"
            action="../backend/plants/addPlant.php"
            method="POST"
            enctype="multipart/form-data"
          >
            <div class="inputs">
              <div class="input-left">
                <div class="group-input">
                  <label for="plant-name">Plant Name:</label>
                  <input type="text" id="plant-name" name="plant-name" />
                  <br />
                </div>
                <div class="group-input">
                  <label for="plant-species">Plant Family:</label>
                  <input
                    type="text"
                    id="plant-species"
                    name="plant-species"
                  /><br />
                </div>

                <div class="group-input">
                  <label for="watering-frequency"
                    >Watering Frequency In Days</label
                  >
                  <input
                    type="number"
                    id="watering-frequency"
                    name="watering-frequency"
                  /><br />
                </div>
              </div>
              <div class="input-right">
                <div class="group-input">
                  <label for="last-watered">Last Watered:</label>
                  <input
                    type="date"
                    id="last-watered"
                    name="last-watered"
                  /><br />
                </div>
                <div class="group-input">
                  <label for="plant-picture">Upload Plant Picture:</label>
                  <input
                    type="file"
                    id="plant-picture"
                    name="plant-picture"
                  /><br />
                </div>
              </div>
            </div>
            <button type="submit">Add Plant</button>
          </form>
        </div>
      </div>
    </main>
    <script src="../functionalities/clock.js"></script>
    <script src="../functionalities/addnew.jsos"></script>
    <script src="../functionalities/responsive.js"></script>
  </body>
</html>
