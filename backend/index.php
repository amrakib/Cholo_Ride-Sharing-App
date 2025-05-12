<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Share Ride</title>
  <link rel="stylesheet" href="css/login_Page.css" />
</head>
<body>

  <!-- Popup Message -->
  <div id="popupMessage" class="popup">
    <?php 
    if (isset($_SESSION['registration_success'])){ 
      echo $_SESSION['registration_success']; 
      unset($_SESSION['registration_success']);
    }
    ?>
  </div>

  <script>
    window.onload = function(){
      const popup = document.getElementById('popupMessage');
      if (popup.textContent.trim() !== '') {
        popup.classList.add('show');
        setTimeout(function(){
          popup.classList.remove('show');
        }, 5000);
      }
    };
  </script>

  <img src="login vector.svg" alt="login vector" height="200px" />
  <div id="signup-box">
    <h1>Log In</h1>
    <form action="login.php" method="post">
      <div class="input-group">
        <label for="email">Email:</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="abc@g.bracu.ac.bd"
          required
        />
      </div>
      <div class="input-group">
        <label for="name">Password:</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="********"
          required
        />
      </div>
      <input class="submit_button" type="submit" name="submit" value="Log In" />

      <div id="extra-links">
        <a href="">Forget Password?</a>
        <a href="registration.php" target="_blank">Create Account</a>
      </div>
    </form>
  </div>

</body>
</html>