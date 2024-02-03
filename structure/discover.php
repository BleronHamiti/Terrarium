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
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="../styles/plant.css" />

    <meta
      http-equiv="Content-Security-Policy"
      content="frame-src 'self' https://www.youtube.com;"
    />

    <title>User</title>
    <style>
      
      .impact-card:hover {
        cursor: pointer;
      }
      .plant-needs {
        right: 60px;
      }
    </style>
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
            <a href="./addnew.php"><i class="fa-solid fa-plus"></i>Add new</a>
          </li>
          <li>
            <a href="test" class="active"
              ><i class="fa-solid fa-magnifying-glass"></i>Discover</a
            >
          </li>
        </ul>
      </div>
      <div class="modal" id="myModal">
        <div class="modal-content">
          <div class="modal-info">
            <span class="close">&times;</span>
            <h2 id="modal-title"></h2>
            <img id="modal-image" src="" alt="Plant" />
            <div id="modal-content"></div>
            <div>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident
              architecto, voluptas reiciendis tempora soluta alias nisi
              doloribus odit eum officia, animi voluptatem maxime ullam eaque ad
              hic itaque molestias ex nulla possimus fugiat quaerat error.
              Fugiat eius animi, rerum alias mollitia earum corrupti vel. Ut
              porro ad, provident totam neque dolorem repellendus omnis at
              molestiae impedit vel, aperiam non error ex dignissimos itaque
              saepe alias id adipisci! Omnis blanditiis odit unde quasi
              voluptatibus id, dolorum quas sint doloribus fugiat reprehenderit
              odio nobis dolor impedit possimus magni, ipsa consectetur magnam
              quia voluptatum perspiciatis? Voluptas ullam aliquid a est quia
              expedita maiores error, corporis harum quibusdam delectus dolor
              officiis quod illum rem eligendi dicta corrupti totam, laboriosam
              fuga beatae magni ducimus dignissimos consequuntur. Neque maiores
              ratione totam aperiam ipsam officia ipsa ducimus labore earum
              modi, eligendi laboriosam aut est. Quo in excepturi quidem facere.
              Error asperiores reprehenderit possimus nostrum amet nulla,
              quidem, sunt inventore vitae voluptates labore quos neque? Nisi
              veniam illum omnis voluptas soluta vitae quasi labore optio
              nostrum? Illum consequatur, repudiandae voluptatem perferendis ut
              consectetur, ipsa harum quo amet, reprehenderit doloribus qui
              consequuntur nostrum pariatur eum! Error cum id quia consectetur,
              laudantium, aut eos cumque voluptatem, accusamus odit molestias
              dolore consequuntur facilis voluptas at corporis dicta repellat ab
              ducimus ullam accusantium qui nisi nemo. Non eos velit accusantium
              nihil dolor hic voluptas dicta. Ipsam mollitia explicabo commodi
              possimus amet, pariatur, veniam ab assumenda doloremque maiores
              officiis provident obcaecati cum ipsa qui, perspiciatis voluptate
              dolorem eius culpa ducimus repellendus sequi. Eveniet nobis animi,
              nesciunt voluptas quia sunt asperiores repellendus dolores neque
              ea cum facere molestias id natus, vel aliquam facilis temporibus
              perspiciatis provident illum expedita! Dolores obcaecati dicta
              voluptate. Assumenda ut magnam eveniet eos? Similique ipsa dolore
              quam voluptatum eos dicta atque tempore expedita, quae voluptas
              rem reprehenderit, consequatur distinctio ipsum eaque. Vel,
              quisquam quibusdam nulla, fugit deserunt nisi iusto nobis dolorum,
              magnam totam voluptates neque quasi. Porro fugit sequi autem,
              dolore necessitatibus minus perferendis excepturi molestias animi
              architecto placeat laudantium expedita assumenda, atque ab, iste
              recusandae aut molestiae provident quidem nostrum doloremque
              numquam? Pariatur iste aut quo, similique quaerat ducimus alias
              nisi. Est laboriosam fuga voluptates corporis distinctio in. Totam
              similique ullam vitae nihil eius id minus? Eaque, dolores harum.
              Eveniet non natus quis repudiandae explicabo architecto, vel amet
              beatae quas aut fugiat reiciendis libero nisi molestias
              perspiciatis, harum ad veritatis totam error voluptate maxime
              autem? Consequuntur doloribus rerum provident deserunt commodi
              maxime quos sunt quaerat facere perferendis culpa nulla dolorem
              saepe a architecto non natus pariatur tempore ad, accusamus soluta
              animi molestiae aspernatur! Ut quidem impedit nulla ad inventore
              necessitatibus culpa exercitationem recusandae! Quis consectetur
              sunt unde molestiae doloribus voluptatibus voluptatem cum ad
              tempore! Doloremque eaque omnis officia qui sint quam architecto
              vero pariatur laborum illo! Et ut magnam necessitatibus eveniet
              quam perspiciatis, cumque ullam nemo temporibus hic, omnis dolorem
              labore illo reiciendis molestiae enim ratione? In aliquam
              voluptatem ab quam at autem ipsa doloremque! Doloremque quibusdam
              voluptatem quas dolore, quae, animi dolorum vel doloribus
              voluptatibus quis quaerat tenetur!
            </div>
          </div>
        </div>
      </div>

      <div class="main-content">
        <section class="impact">
          <h2>Everything you need to know about your plants</h2>
          <div class="impact-slider">
            <div class="impact-card">
              <div class="impact-card-title">
                <h3>Peace Lily</h3>
              </div>

              <div class="plant-care">
                <img src="../assets/images/peacelily.png" alt="Peace Lily" />
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
                    <span>Every 3 days</span>
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
            <div class="impact-card">
              <div class="impact-card-title">
                <h3>Snake</h3>
              </div>

              <div class="plant-care">
                <img src="../assets/images/image-snake.png" alt="Peace Lily" />
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
                    <span>Every 3 days</span>
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
            <div class="impact-card">
              <div class="impact-card-title">
                <h3>Cactus</h3>
              </div>

              <div class="plant-care">
                <img src="../assets/images/image-cactus.png" alt="Peace Lily" />
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
                    <span>Every 3 days</span>
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
            <div class="impact-card">
              <div class="impact-card-title">
                <h3>Peace Lily</h3>
              </div>

              <div class="plant-care">
                <img src="../assets/images/begonia1.png" alt="Peace Lily" />
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
                    <span>Every 3 days</span>
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
          <button>View More</button>
        </section>
      </div>
    </main>
    <script src="../functionalities/clock.js"></script>
    <script src="../functionalities/modal.js"></script>
    <script src="../functionalities/responsive.js"></script>
  </body>
</html>
