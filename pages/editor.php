<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <link rel="stylesheet" href="../css/editor.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/footer.css" />


    <title>Write Post</title>
</head>
<body>
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



    <div class="container mt-5 form">
        <h2 class="mb-4">Share Your Experience</h2>
        <form action="/assignment/php/submit_post.php" method="POST" enctype="multipart/form-data">
            <!-- Title Field -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <!-- Author Field -->
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>

            <!-- Content Field -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <!-- Image Upload Field -->
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Post</button>
        </form>
    </div>


    <footer class="footer bg-dark text-light py-4 position-relative ">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>