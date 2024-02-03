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
      <?php


require_once '../backend/plants/watering.php';



$plantId = isset($_GET['plant_id']) ? $_GET['plant_id'] : null;


$plantId = filter_var($plantId, FILTER_VALIDATE_INT);

if ($plantId === false || $plantId <= 0) {
    echo "Invalid plant ID.";
    exit;
}
require_once '../backend/plants/plant.php';
$plant = Plant::getPlantById($plantId);




if ($plantId === false || $plantId <= 0) {
    echo "Invalid plant ID.";
    exit;
}


$dateTimeObject = new DateTime('2022-01-13');
$dateString = $dateTimeObject->format('Y-m-d');

$watering = Watering::getWateringByPlantId($plantId);

if (!$watering) {
    
    echo "Plant not found.";
    exit;
}


$wateringDates = $watering->calculateAllWateringDates();


$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'updateLastWateredDate') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (isset($requestData['lastWateredDate'])) {
        $plantId = isset($_GET['plant_id']) ? $_GET['plant_id'] : null;
        $lastWateredDate = $requestData['lastWateredDate'];

        $watering = Watering::getWateringByPlantId($plantId);

        if ($watering) {
            $result = $watering->updateLastWateredDate($lastWateredDate);

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['error' => 'Failed to update last watered date']);
            }
        } else {
            echo json_encode(['error' => 'Plant not found']);
        }
    } else {
        echo json_encode(['error' => 'Invalid request']);
    }

    exit;
}

?>

        <div class="info">
          <div class="impact-card">
            <div class="plant-care">
              <img src="<?php if ($plant) {
                      echo "../".$plant->getImagePath();
                    } else {
                        echo "Plant not found.";
                    }?>" alt="Peace Lily" />
            </div>
            <div class="plant-group">
              <div class="plant-info">
                <div class="plant-needs__card">
                  <div class="card-requirments">
                    <h4>Plant Name:</h4>
                    <span><?php if ($plant) {
                      echo $plant->getName();
                    } else {
                        echo "Plant not found.";
                    }?></span>
                  </div>
                </div>
                <div class="plant-needs__card">
                  <div class="card-requirments">
                    <h4>Family name:</h4>
                    <span><?php if ($plant) {
                      echo $plant->getspecies();
                    } else {
                        echo "Plant not found.";
                    }?></span>
                  </div>
                </div>
                <div class="plant-needs__card">
                  <div class="card-requirments">
                    <h4>Toxic:</h4>
                    <span>Mild</span>
                  </div>
                </div>
              </div>
              <div class="plant-needs">
                <div class="plant-needs__card">
                  <div class="card-icons">
                    <i class="fa-regular fa-sun"></i>
                  </div>
                  <div class="card-requirments">
                    <h4>Light requirements</h4>
                    <span>Low-light, indirect</span>
                  </div>
                </div>
                <div class="plant-needs__card">
                  <div class="card-icons">
                    <i class="fa-solid fa-droplet"></i>
                  </div>
                  <div class="card-requirments">
                    <h4>Watering needs</h4>
                    <span><p id="wateringDaysCount"></p></span>
                  </div>
                </div>
                <div class="plant-needs__card">
                  <div class="card-icons">
                    <i class="fa-solid fa-temperature-quarter"></i>
                  </div>
                  <div class="card-requirments">
                    <h4>Humidity Levels</h4>
                    <span>70%</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="info-noti">
            <h2>Care Progress</h2>
            <div class="notifications">
              <div class="chart-container">
                <canvas id="pieChart" width="200" height="200"></canvas>
              </div>
              <div class="days-watered">
                <span id="watering-message"></span>
                <span>Last day you watered: 2 days ago</span>
              </div>
            </div>
          </div>
        </div>
        <div class="care-section">
          <div class="schedule">
            <div class="header">
              <button id="prevBtn">
                <i class="fa-solid fa-chevron-left"></i>
              </button>
              <h2 id="monthYear"></h2>
              <button id="nextBtn">
                <i class="fa-solid fa-chevron-right"></i>
              </button>
            </div>
            
            <div class="calendar-container" data-plant-id="<?php echo $plantId; ?>">
              <table id="calendar">
                <thead>
                  <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
              
           
          <div class="music">
            <h2>Plants can hear us, here's some music</h2>
            <iframe
              src="https://www.youtube.com/embed/MjL-g1sTQ0k"
              frameborder="0"
              allowfullscreen
            ></iframe>
          </div>
        </div>
      </div>
    </main>
   

    <script src="../functionalities/clock.js"></script>
    <script>
  var wateringDates = <?php echo json_encode($wateringDates);?>;
</script>
    <script src="../functionalities/calendar.js"></script>
    <script src="../functionalities/responsive.js"></script>
  </body>
</html>
