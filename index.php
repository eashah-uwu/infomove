

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoMove</title>

    <!-- bootsrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
   
    <!--CSS link -->
    <link rel="stylesheet" href="/infomove/Css/Style.css">
    
    <!-- google fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

</head>
<body>

  <!--navbar background-color: #d2b48c;-->
  <header>
  <nav class="navbar navbar-expand-lg  bg-custom-brown  fixed-top" style="background-color: #F6D6D6; padding: 0.01em;">
  <div class="container-fluid">
  <a class="navbar-brand" href="index.php">
      <img src="Images/logo.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">

    </a>
    <a class="navbar-brand" href="index.php">InfoMove</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="BusRoute.php"> Bus Route</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="BusSchedule.php">Bus schedule</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="SignUp.php">Sign Up</a>
</li>
        <li class="nav-item">   
               <a class="nav-link" href="LogIn.php">Log In</a>
        </li>
</ul>
    </div>
  </div>
</nav>
</header>



 <main>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner">
  
    <div class="carousel-item">
      <img src="Images/pexels-mihis-alex-21014.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>InfoMove</h5>
        <p>The one stop for all your travelling needs</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="Images/pexels-nubia-navarro-(nubikini)-385998.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item active">
      <img src="Images\pexels-photo-3064079.jpeg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<section class="my-4">
  <div class="py-3">
    <h5 class="text-center" style="font-size: 2rem;">About Us</h5>
  </div>
  <div class="container text-center border border-dark bg-light p-4" >
    <h6 style="font-size: 1.5rem;">Welcome to InfoMove - Your Ultimate Route Solution!</h6>

    <p style="font-size: 1rem;">At InfoMove, we understand that getting from point A to point B should be seamless and stress-free. That's why we are here to revolutionize your travel experience. As a leading route-providing company, InfoMove is committed to offering you efficient and reliable transportation solutions tailored to your needs.</p>
  </div>
</section>
</main>

  <!--bootstrap js link-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
 crossorigin="anonymous"></script>

 <footer>
  <p class="text-center">&copy; 2023 InfoMove. All rights reserved.</p>
  <address class="text-center">
    Contact us at: info@infomove.com
  </address>
</footer>

</body>
</html>