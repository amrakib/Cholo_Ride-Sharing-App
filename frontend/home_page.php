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

    <link rel="stylesheet" href="css/home_page_style.css" />
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
                <a class="nav-link" aria-current="page" href="index.php">Log In</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="registration.php">Sign Up</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about_jump">About Us</a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Title -->
<div  class="container " id="About">
        <div class="row">
          <div class="col-lg-6">
            <h1 class="fw-bold mb-3">Your campus, your community, your ride.</h1>
            
            <button class="btn btn-dark mt-5 fs-3 " type="button">
            <i class="fa-solid fa-circle-user"></i>
              Log In
            </button>
            <button class="btn btn-outline-light mt-5 fs-3" type="button">
            <i class="fa-solid fa-user-plus"></i>Sign Up
            </button>
            </div>
          <div class="col-lg-6 img-fluid ">
            
          <img src="landing_page.svg" alt="landing_svg" class="img-fluid " style="width: 100%; height: auto;"/>
          
            
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
          <img src="images/razeen.jpg" class="profile_pic_razeen" alt="razeen's image">
            
            <h3 class="fw-bold">Razeen Hassan</h3>
            <p>Worked on Backend and Join Trip Feature</p>
            <a href="https://www.facebook.com/razeon101" target="_blank">
            <button type="button" class="btn btn-outline-info">
            <i class="fa-brands fa-facebook"></i>
            </button>
            </a>
          </div>

          <div class="col-4">
          <img src="images/tawfiq.jpg" class="profile_pic_tawfiq" alt="tawfiq's image">
            <h3 class="fw-bold">Tawfiqur Rahman</h3>
            <p>Worked on Frontend and Post Trip Feature</p>
            <a href="https://www.facebook.com/tawfiqur.rahman.581491" target="_blank">
            <button type="button" class="btn btn-outline-info">
            <i class="fa-brands fa-facebook"></i>
            </button> 
            </a>
          </div>

          <div class="col-4 p-0">
          <img src="images/imtiaz.jpg" class="profile_pic_imtiaz p-0 m-0" alt="imatiaz's image">
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
        © 2023 Copyright:
        <a class="text-reset fw-bold" href="#">CHOLO</a>
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
