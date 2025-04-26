<?php
include 'connection.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <!-- <link rel="stylesheet" href="styles.css" /> -->

    <link rel="stylesheet" href="login Page css.css" />
    <title>Share Ride</title>
  </head>
  <body>
    <img src="login vector.svg" alt="login vector" / height="200px" >
    <div id="signup-box">
      <!-- <img src="login vector.svg" alt="login vector" / > -->
      <h1>Log In</h1>
      <!-- <p>Some tagline could be added here</p> -->
      <form action="login.php" method="post">
        <div class="input-group">
          <label for="email">Email:</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="johndoe@example.com"
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

        <!-- <button type="submit" name="submit">Log In</button> -->
        <div id="extra-links">
          <a href="">Forget Password?</a>
          <a href="Create Account Page.html" target="_blank">Create Account</a>
        </div>
      </form>
    </div>
  </body>
</html>
