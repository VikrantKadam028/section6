<?php
session_start();
include "config.php";

function validate($data)
{
  $data = trim($data);
  $data = stripslashes($data); // Note: It should be 'stripslashes' not 'stripcslashes'
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = validate($_POST['email']);
  $pass = validate($_POST['password']);

  if (empty($email)) {
    header("Location: signup.php?error=Email is required");

    exit();
  } else if (empty($pass)) {
    header("Location: signup.php?error=Password is required");
    exit();
  }

  $sql = "SELECT * FROM signin WHERE email='$email' AND password='$pass'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['email'] === $email && $row['password'] === $pass) {
      echo "<script>";
      echo "window.alert('Logged in....!');";
      echo "</script>";
      $_SESSION['username'] = $row['username'];
      $_SESSION['email'] = $row['email'];

      header("Location: home.php");



      exit();
    } else {
      header("Location: signup.php?error=Incorrect email or password.");
    }
  } else {
    header("Location: signup.php?error=Incorrect email or password.");
    exit();
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gemini AI | Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

    * {
      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
      font-family: poppins;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background-image: url(background2.jpeg);
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
    }

    section {
      position: relative;
      margin-bottom: 45px;
      width: 400px;
      background-color: transparent;
      border: 2px solid rgba(255, 255, 255, 0.5);
      border-radius: 20px;
      backdrop-filter: blur(15px);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1.5rem 2.5rem;
    }

    h1 {
      font-size: 1.8rem;
      color: white;
      margin-left: 8px;
    }

    .inputbox {
      position: relative;
      margin: 30px 0;
      width: 300px;
      border-radius: 25px;
      border: 1px solid white;
    }

    .inputbox label {
      position: absolute;
      top: 50%;
      left: 25px;
      transform: translateY(-50%);
      color: white;
      font-size: 1rem;
      pointer-events: none;
      transition: all 0.5s ease-in-out;
    }

    input:focus~label,
    input:valid~label {
      top: -2px;
      background-color: white;
      padding: 0px 10px;
      color: black;
      border-radius: 15px;
      font-size: 12px;
    }

    .inputbox input {
      width: 100%;
      height: 50px;
      background-color: transparent;
      border: none;
      outline: none;
      font-size: 1rem;
      padding: 0 35px 0 5px;
      padding-left: 25px;
      color: white;
    }

    .inputbox i {
      position: absolute;
      right: 25px;
      color: white;
      font-size: 1.2rem;
      top: 15px;
    }

    .forget {
      margin: 35px 0;
      font-size: 0.85rem;
      color: white;
      display: flex;
      justify-content: space-between;
    }

    .forget label {
      display: flex;
      align-items: center;
    }

    .forget label input {
      margin-right: 3px;
    }

    .forget a {
      color: white;
      text-decoration: none;
      font-size: 12px;
      font-weight: 600;
    }

    button {
      width: 100%;
      height: 40px;
      border-radius: 40px;
      background-color: rgb(255, 255, 255, 1);
      border: none;
      outline: none;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 600;
      transition: all 0.4s ease;
    }

    button:hover {
      background-color: #12024b;
      color: white;
    }

    .register {
      font-size: 0.9rem;
      color: white;
      text-align: center;
      margin: 25px 0 10px;
    }

    .register p a {
      text-decoration: none;
      color: white;
      font-weight: 600;
    }

    .register p a:hover {
      text-decoration: underline;
    }

    .mainpage {
      width: 100vw;
      height: 100vh;
      position: relative;
      overflow: hidden;
    }

    .navbar {
      width: 97%;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      margin-top: 10px;
    }

    .navbar p {
      color: white;
      font-family: poppins;
      font-size: 26px;
      margin-top: 2px;
    }

    .logo {
      width: 130px;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo img {
      width: auto;
      height: 42px;
      margin-right: 3px;
    }

    .menu-toggle {
      display: none;
      cursor: pointer;
      font-size: 24px;
      color: white;
    }

    .nav-links {
      display: flex;
    }

    .navbar ul {
      display: flex;
      list-style: none;
    }

    .navbar ul li {
      display: inline;
      font-size: 18px;
      color: white;
      font-family: poppins;
      transition: all 0.4s ease;
      border-radius: 8px;
    }

    .navbar ul li a {
      text-decoration: none;
      color: white;
      display: inline;
      font-size: 18px;
      font-family: poppins;
      margin-right: 30px;
      padding: 12px 18px;
      transition: all 0.4s ease;
      border-radius: 8px;
    }

    .navbar ul li a:hover {
      background-color: white;
      backdrop-filter: blur(8px);
      color: black;
      cursor: pointer;
    }

    .navbar button {
      background-image: linear-gradient(to right,
          #6441a5 0%,
          #2a0845 51%,
          #6441a5 100%);
      transition: 0.5s;
      background-size: 200% auto;
      color: white;
      margin: 10px;
      padding: 10px 30px;
      text-align: center;
      font-size: 16px;
      font-family: poppins;
      border-radius: 10px;
      display: block;
      border: none;
      cursor: pointer;
    }

    .navbar button:hover {
      background-position: right center;
      /* change the direction of the change here */
      color: #fff;
      text-decoration: none;
    }

    .form1 {
      width: 100%;
      height: 90%;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    @media (max-width: 600px) {
      body {
        background-size: cover;
      }

      .menu-toggle {
        display: block;
      }

      .nav-links {
        display: none;

        flex-direction: column;
        width: 90%;
        background: rgba(0, 0, 0, 0.8);
        position: absolute;
        top: 60px;
        left: 22px;
        padding: 20px;
        border-radius: 15px;
        margin: 8px auto;
        z-index: 2;
      }

      .nav-links.active {
        display: block;
      }

      .navbar ul {
        display: flex;
        flex-direction: column;
        width: 100%;
      }

      .navbar ul li {
        display: block;
        width: 100%;
        margin: 10px 0;
      }

      .navbar ul li a {
        margin-right: 0;
        padding: 10px;
      }

      section {
        width: 340px;
        margin-bottom: 68px;
      }

      .navbar p {
        font-size: 24px;
      }

      .forget {
        margin: 0;
      }

      .error {
        margin-top: 15px;
      }

    }

    .error {
      width: 100%;
      height: 35px;
      color: #9D1C24;
      background-color: #F8D7DA;
      text-align: center;
      font-size: 14px;
      border-radius: 10px;

      align-items: center;
      justify-content: center;

      display: none;

    }

    .error.show {
      display: flex;

    }
  </style>
</head>

<body>
  <div class="mainpage">
    <div class="navbar">
      <div class="logo">
        <img src="geminilogo.png" />
        <p>Gemini</p>
      </div>
      <div class="menu-toggle"><i class="fas fa-bars"></i></div>
      <div class="nav-links">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Discover</a></li>
        </ul>
      </div>
      <!-- <button onclick="redirect_login()">Login</button> -->
    </div>
    <div class="form1">
      <section>
        <form action="signup.php" method="post">
          <h1>Get started with Gemini AI</h1>

          <div class="inputbox">
            <i class="fa-regular fa-envelope"></i>
            <input type="text" name="email" required />
            <label for="">Email</label>
          </div>
          <div class="inputbox">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" required />
            <label for="">Password</label>
          </div>

          <div class="forget">
            <label>
              <input type="checkbox" style="zoom: 1.4" />Remember Me
            </label>
            <a href="#">Forget Password?</a>
          </div>
          <?php
          if (isset($_GET['error'])) { ?>
            <p id="error" class="error"><?php echo $_GET['error']; ?></p>;
          <?php } ?>
          <button>Log in</button>
          <div class="register">
            <p>
              Don't have an account? <a href="signin.php">Register here</a>
            </p>
          </div>
        </form>
      </section>
    </div>
  </div>
  <script>
    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-links");
    menuToggle.addEventListener("click", () => {
      navLinks.classList.toggle("active");
    });
    const errorElement = document.getElementById("error");
    if (errorElement) {
      // Add the show class to make it visible
      errorElement.classList.add("show");
      // Remove the show class after 5 seconds
      setTimeout(() => {
        errorElement.classList.remove("show");
      }, 5000); // 5000 milliseconds = 5 seconds
    }
  </script>
</body>

</html>