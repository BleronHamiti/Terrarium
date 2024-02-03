<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ./home.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/signup.css" />
    <title>Signup Form</title>
  </head>

  <body>
    <span class="home"
      ><a href="./index.php">Go Home</a>
      <a href="./index.php"> <img src="../assets/images/home.png" alt="" /></a
    ></span>
    <div class="container">
      <img src="../assets/images/mushroom.png" class="img-top" alt="" />
      <img src="../assets/images/mushroom1.png" class="img-middle" alt="" />
      <img src="../assets/images/mushroom2.png" class="img-right" alt="" />
      <div class="form-section">
        <h2>Signup Form</h2>
        <form
          id="signupForm"
          action="../backend/users/registration.php"
          method="POST"
        >
          <div class="groups">
            <div class="form-group">
              <input
                type="text"
                id="name"
                name="name"
                class="input-field"
                required
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
            />
            <span class="label">Email:</span>
            <div class="error-message" id="registrationError"></div>
            <span class="error-message" id="emailError">
              <?php
              if (isset($_SESSION['email_exits'])) {
              echo($_SESSION['email_exits']);
              unset($_SESSION['email_exits']);
            }?></span>
          </div>
          <div class="form-group">
            <input
              type="password"
              id="password"
              name="password"
              class="input-field"
              required
            />
            <span class="label">Password:</span>
            <span class="error-message" id="passwordError"></span>
          </div>
          <div class="form-group">
            <input
              type="password"
              id="confirm-password"
              name="confirm-password"
              class="input-field"
              required
            />
            <span class="label">Confirm Password:</span>
            <span class="error-message" id="confirm-passwordError"></span>
          </div>
          <div class="links">
            <span class="account"
              >Already have an account? <a href="./login.php">Login</a>
            </span>
          </div>
          <button type="submit">Submit</button>
        </form>
      </div>
    </div>

    <script src="../functionalities/signup.js"></script>
    <script src="../functionalities/responsive.js"></script>
  </body>
</html>
