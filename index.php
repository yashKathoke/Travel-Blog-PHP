<?php

session_start(); // Start the session to access user session variables

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Travel Buddy</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/logButton.css">
    <link rel="stylesheet" href="./css/footer.css">
  </head>
  <body>
  <div class="fixed-button-container">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/assignment/php/logout.php" class="btn btn-danger">Logout</a>
        <?php else: ?>
            <a href="/assignment/pages/login.php" class="btn btn-primary">Login</a>
        <?php endif; ?>
    </div>
    <div class="button-container">
        <a href="/assignment">
        <button class="button">

                <svg
                class="icon"
                stroke="currentColor"
                fill="currentColor"
                stroke-width="0"
                viewBox="0 0 1024 1024"
                height="1em"
                width="1em"
                xmlns="http://www.w3.org/2000/svg"
                >
                <path
                d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 0 0-44.4 0L77.5 505a63.9 63.9 0 0 0-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0 0 18.7-45.3c0-17-6.7-33.1-18.8-45.2zM568 868H456V664h112v204zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7 23.1 23.1L882 542.3h-96.1z"
                ></path>
            </svg>
            <span>Home</span>
        </button>
    </a>
    <a href="/assignment/pages/editor.php">
        <button class="button">

                <svg
                class="icon"
                stroke="currentColor"
                fill="currentColor"
                stroke-width="0"
                viewBox="0 0 1024 1024"
                height="1em"
                width="1em"
                xmlns="http://www.w3.org/2000/svg"
                >
                <path
                d="M880.4 204.8L819.2 143.6c-26.4-26.4-69.3-26.4-95.6 0L643.3 224.1 799.9 380.7 880.4 300.2c26.4-26.3 26.4-69.2 0-95.4zM592.9 274.5l-467.2 467c-7.4 7.4-12.8 16.8-15.6 27l-35.2 140.6c-4.4 17.6 11.1 33.1 28.7 28.7l140.5-35.3c10.2-2.6 19.6-8 27-15.6l467.2-467.2-145.4-145.2z"
                ></path>
            </svg>
            <span>Write Post</span>
        </button>
    </a>
    </div>
      

 
      
      
      

    <div
      id="carouselExampleSlidesOnly"
      class="carousel slide mb-0"
      data-bs-ride="carousel"
    >
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img
            src="https://images.unsplash.com/photo-1531761535209-180857e963b9?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            class="d-block w-100"
            alt="..."
          />
        </div>
        <div class="carousel-item">
          <img
            src="https://images.unsplash.com/photo-1545244407-25f1617c865b?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            class="d-block w-100"
            alt="..."
          />
        </div>

        <div class="carousel-item">
          <img
            src="https://images.unsplash.com/photo-1521071379542-3b741db9f90b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            class="d-block w-100"
            alt="..."
          />
        </div>
        <div class="carousel-item">
          <img
            class="d-block w-100"
            src="https://images.unsplash.com/photo-1671838916917-00a739b4b328?q=80&amp;w=1931&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            alt="Phi Phi Islands, Thailand beach image"
          />
        </div>
      </div>
      <div class="carousel-caption text-center">
        <h1 class="display-4 fw-bold">Plan Your Trip</h1>
        <p class="lead">
          By Reading through the experiences of Millions like you!!!
        </p>
        <a
          href="#blog-section"
          class="btn btn-primary btn-lg text-primary-emphasis caption-btn"
          >See Experiences</a
        >
      </div>
    </div>

    <div class="blog-section mt-0" id="blog-section">
      <h2 class="blog text-center p-5 m-1 mt-0">People's Experiences</h2>

      <div class="container mt-4">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="post-previews">
         

            
            </div>
          </div>
        </div>
      </div>
    </div>




    <footer class="footer bg-dark text-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-left">
                <p class="mb-0">&copy; 2024 Travel Buddy. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="#" class="text-light">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="#" class="text-light">Terms of Service</a></li>
                    <li class="list-inline-item"><a href="#" class="text-light">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="social-media text-center mt-3">
            <a href="#" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-light mx-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-light mx-2"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</footer>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src= "js/script.js"></script>
  </body>
</html>
