<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['User_ID'])){
    header("Location: login.php");
    exit();
}

$user_id = intval($_SESSION['User_ID']);

$stmt = $conn->prepare("SELECT COUNT(*) AS unread_count FROM Notifications WHERE User_ID = ? AND Status = 'Unread'");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$notif_data = $result->fetch_assoc();
$unread = $notif_data['unread_count'];

$stmt->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Cholo</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7"
      crossorigin="anonymous"
    />
  

    <link rel="stylesheet" href="css/landing_style.css" />
  </head>
    <style>
      .profile_pic_tawfiq {
  clip-path: circle(40% at 53% 40%);
  height: 300px;
}
.profile_pic_razeen {
  clip-path: circle(37% at 53% 40%);
  height: 300px;
}
.profile_pic_imtiaz {
  clip-path: circle(37% at 50% 40%);
  height: 300px;
}
i {
  font-size: 2rem;

  padding: 0 10px;
}
.our_goal {
  font-family: "Montserrat";
  font-weight: 300;
  font-size: 1.5rem;
  line-height: 1.5;
  padding: 0 10%;
}
    </style>

  <body>
    <section id="title" class="vh-100">
      <!-- Nav Bar -->
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand" href="#">CHOLO</a>
          <button
            class="navbar-toggler bg-light"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon rounded"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
              <li class="nav-item">
                <a class="nav-link position-relative" href="notifications.php">
                  <i class="fa-solid fa-bell" style="color: white;"></i>
                  <?php if ($unread > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                      <?= $unread ?>
                    </span>
                  <?php endif; ?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#about_jump">About Us</a>
              </li>
              <li class="nav-item">
                
                <a class="nav-link" href="logout.php">Log Out</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Title -->

        <div class="row">
          <div class="col-lg-6">
            <h1 class="fw-bold mb-3">Your campus, your community, your ride.</h1>
            
            
            </div>
          <div class="col-lg-6 ">
            <img src="landing_page.svg" class="title-image img-fluid" alt="landing_svg"  style="width: 100%; height: auto;"/>    
          </div>
        </div>
        
          
            <div class="row mt-5">
              <div class="col-3 text-center">
              <a href="../frontend/post_trip.php" >
              <button type="button" class="btn btn-light btn-lg border-dark">
            <i class="fa-solid fa-plus fa-lg"></i>
              Post Trip
            </button>
            </a>
            </div>
            <div class="col-3 text-center">
              <a href="../Razeen_Experiment/trip_browse.php" >
            <button type="button" class="btn btn-light btn-lg border-dark">
            
            <i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i>
            Join Trip
            </button>
            </a>
            </div>
            <div class="col-3 text-center">
            <a href="../frontend/vehicle_list.php" >
            <button type="button" class="btn btn-light btn-lg border-dark">
            <i class="fa-solid fa-car fa-lg"></i>
              Private Vehicle
            </button>
            </a>
            </div>
            <div class="col-3 text-center">
            <a href="trip_history.php">
              <button class="btn btn-dark btn-lg" type="button">
                <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                Trip History
              </button>
            </a>
            </div>
            </div>
        </div>   
        
      
    </section>

   <!-- Features -->

     <section id="features" >
      <div class="container text-center">
        <h1 class="fw-bold mb-5 mt-5" id="about_jump">About US</h1>
        <div class="row">
          <div class="col-4">
          <img src="../frontend/images/razeen.jpg" class="profile_pic_razeen" alt="razeen's image">
            
            <h3 class="fw-bold">Razeen Hassan</h3>
            <p>Worked on Backend and Join Trip Feature</p>
            <a href="https://www.facebook.com/razeon101" target="_blank">
            <button type="button" class="btn btn-outline-info">
            <i class="fa-brands fa-facebook"></i>
            </button>
            </a>
          </div>

          <div class="col-4">
          <img src="../frontend/images/tawfiq.jpg" class="profile_pic_tawfiq" alt="tawfiq's image">
            <h3 class="fw-bold">Tawfiqur Rahman</h3>
            <p>Worked on Frontend and Post Trip, Add Vehicle Features</p>
            <a href="https://www.facebook.com/tawfiqur.rahman.581491" target="_blank">
            <button type="button" class="btn btn-outline-info">
            <i class="fa-brands fa-facebook"></i>
            </button> 
            </a>
          </div>

          <div class="col-4 p-0">
          <img src="../frontend/images/imtiaz.jpg" class="profile_pic_imtiaz p-0 m-0" alt="imatiaz's image">
            <h3 class="fw-bold">Imtiaz Hossain</h3>
            <p >Worked on Backend and User registration</p>
            <a href="https://www.facebook.com/imtiaz.hossain.96930013" target="_blank">
            <button type="button" class="btn btn-outline-info">
            <i class="fa-brands fa-facebook"></i>
            </button>
            </a>
          </div>
        </div>
        <div class="our_goal mt-5">
        <h2 class="fw-bold " >Our Goal</h2>
        <p>Our goal is to create a safe, easy, and efficient ride-sharing platform exclusively for BRAC University students.
        We aim to connect students traveling between home and university, reduce travel costs, and promote a stronger community through shared trips.</p>
        </div>
      </div>
    </section>


    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted mt-5">
      <div class="text-center p-4" style="background-color: #e3f2fd">
        © 2025 Copyright:
        <a class="text-reset fw-bold" href="#">CHOLO</a>
      </div>
    </footer>

    <!-- Footer -->

    <!-- <footer id="footer">
      <p>© Copyright Cholo</p>
    </footer> -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
