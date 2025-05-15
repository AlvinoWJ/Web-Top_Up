<?php
$games = [
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
    (object)[ 'title' => 'Delta Force', 'image' => 'image/Delta_Force.jpg' ],
];


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CincaStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">

  </head>
  <body>
    <?php include 'partials/navbar.php';?>
    
    <div class="container mt-5">
        <div id="carouselExample" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="10000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner rounded-4 overflow-hidden" style="height: 500px;">
                <div class="carousel-item active">
                    <img src="image/ml1.jpg" class="d-block w-100 h-100" style="object-fit: cover;" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="image/ml.jpg" class="d-block w-100 h-100" style="object-fit: cover;" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="image/ml1.jpg" class="d-block w-100 h-100" style="object-fit: cover;" alt="Slide 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <?php $showToggleButton = false; include 'partials/card-game.php';?>

    <?php include 'partials/footer.php';?>

    
  </body>
</html>