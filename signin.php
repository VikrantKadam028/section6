<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $conpass = $_POST['conpass'];
    $phone = $_POST['phone'];

    $con = mysqli_connect("localhost", "root", "", "signindb");
    if ($con->connect_error) {
        echo "$con->connect_error";
        die("Connection Failed : " . $con->connect_error);
    } else {
        $add = mysqli_query($con, "INSERT INTO signin (username, email, password, confirm_password, phone) VALUES ('$username', '$email', '$pass', '$conpass', '$phone')") or die(mysqli_error($con));
        if ($add) {
            echo "<script>";
            echo "window.alert('Data Added Successfully......!');";
            echo "</script>";
            header("Location: signup.php");
        } else {
            echo "<script>";
            echo "window.alert('Data Not Added......!');";
            echo "</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gemini AI | Registration</title>
  <script src="https://kit.fontawesome.com/5274d0405c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    /* Your existing CSS styles */
    @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");
    * {
      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
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
      transition: all 0.4s ease;
      border-radius: 8px;
    }
    .navbar ul li a {
      text-decoration: none;
      color: white;
      display: inline;
      font-size: 18px;
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
    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
    }
    .form-section {
      width: 100%;
      max-width: 500px;
      background-color: transparent;
      backdrop-filter: blur(15px);
      border: 2px solid rgba(255, 255, 255, 0.5);
      border-radius: 20px;
      backdrop-filter: blur(15px);
      padding: 20px;
      margin-bottom: 90px;
      
    }
    .form-section h1 {
      font-size: 1.8rem;
      color: white;
      margin-left: 8px;
      
      margin-bottom: 20px;
    }
    .inputbox {
      position: relative;
      margin-bottom: 20px;
      width: 100%;
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
    input:focus ~ label,
    input:valid ~ label {
      top: -2px;
      background-color: white;
      padding: 0px 10px;
      color: black;
      border-radius: 15px;
      font-size: 12px;
    }
    .inputbox input {
      width: calc(100% - 30px);
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
      margin-bottom: 20px;
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
      margin-top: 10px;
    }
    .register p a {
      text-decoration: none;
      color: white;
      font-weight: 600;
    }
    .register p a:hover {
      text-decoration: underline;
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
      .navbar p{
        font-size:24px;
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
      .form-section {
        /* max-width: 100%; */
        width: 370px;
        margin-bottom: 150px;

      }
      .form-section h1{
        font-size: 1.5rem;
      }
     
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
          <li><a href="#">Features</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
    <section class="form-container">
      <div class="form-section">
        <h1>Create your account in GeminiAI</h1>
        <form method="POST" action="signin.php">
          <div class="inputbox">
            <input type="text" name="username" id="username" required />
            <label for="username">Username</label>
            <i class="far fa-user"></i>
          </div>
          <div class="inputbox">
            <input type="email" name="email" id="email" required />
            <label for="email">Email</label>
            <i class="far fa-envelope"></i>
          </div>
          <div class="inputbox">
            <input type="password" name="pass" id="pass" required />
            <label for="pass">Password</label>
            <i class="fas fa-lock"></i>
          </div>
          <div class="inputbox">
            <input type="password" name="conpass" id="conpass" required />
            <label for="conpass">Confirm Password</label>
            <i class="fas fa-lock"></i>
          </div>
          <div class="inputbox">
            <input type="text" name="phone" id="phone" required />
            <label for="phone">Phone</label>
            <i class="fas fa-phone"></i>
          </div>
          <button type="submit" name="submit">Submit</button>
        </form>
        <div class="register">
          <p>Already have an account? <a href="signup.php">Login here</a></p>
        </div>
      </div>
    </section>
  </div>
</body>
</html>
