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
                <a class="nav-link" aria-current="page" href="#">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">History</a>
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
              <a href="post_trip.php">
              <button type="button" class="btn btn-light btn-lg border-dark">
            <i class="fa-solid fa-plus"></i>
              Post Trip
            </button>
            </a>
            </div>
            <div class="col-3 text-center">
              <a href="../Razeen_Experiment/trip_browse.php">
            <button type="button" class="btn btn-light btn-lg border-dark">
            
            <i class="fa-solid fa-arrow-right-to-bracket"></i>
            Join Trip
            </button>
            </a>
            </div>
            <div class="col-3 text-center">
            <a href="add_vehicle.php">
            <button type="button" class="btn btn-light btn-lg border-dark">
            <i class="fa-solid fa-car"></i>
              Add Vehicle
            </button>
            </a>
            </div>
            <div class="col-3 text-center">
            <button class="btn btn-dark  btn-lg" type="button">
            <i class="fa-solid fa-clock-rotate-left"></i>
              Trip History
            </button>
            </div>
            </div>
           
        
      
    </section>



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
