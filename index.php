<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu E-Bike</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Navbar custom color */
        .navbar-custom {
            background-color: #497ecf; /* Gloss Glacier Blue */
        }
        /* Section background */
        .section-background {
            background-color: #497ecf; /* Blue background for all sections */
            color: #fff; /* White text for readability */
        }
        /* Carousel image styling */
        .carousel-item img {
            height: 100vh; /* Full viewport height */
            object-fit: cover;
        }
        /* Gallery image styling */
        .gallery-item img {
            height: 300px; /* Adjusted gallery image height */
            object-fit: cover;
        }
    </style>
</head>
<body>
<?php include('includes/header.php'); ?>

<!-- Carousel Section -->
<div class="py-5 section-background">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false">
        <ol class="carousel-indicators">
            <!-- Carousel indicators if any -->
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/ebike.jpg" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="assets/images/ebike.jpg" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="assets/images/ebike.jpg" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</div>


    <!-- Product Section -->
    <div class="container py-5 section-background">
        <h2 class="text-center text-white">Units</h2>
        <div class="row">
            <div class="col-md-3">
                <img src="assets/images/1.jpg" alt="Product 1" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
                <p class="text-center text-white">SG 5</p>
            </div>
            <div class="col-md-3">
                <img src="assets/images/2.jpg" alt="Product 2" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
                <p class="text-center text-white">DRAGON</p>
            </div>
            <div class="col-md-3">
                <img src="assets/images/bike3.jpg" alt="Product 3" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
                <p class="text-center text-white">CLASSY PRO 5 SEATERS</p>
            </div>
            <div class="col-md-3">
                <img src="assets/images/3.jpg" alt="Product 4" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
                <p class="text-center text-white">EAGLE SCOOTER</p>
            </div>
        </div>
    </div>

   <!-- Gallery Section -->
<div class="container py-5 section-background"> <!-- Added blue background -->
    <h2 class="text-center">Gallery</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/images/a.jpg" alt="Burger and Fries" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/images/b.jpg" alt="Couple enjoying burgers" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/images/c.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/images/d.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/images/e.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/images/f.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/images/g.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/images/h.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="gallery-item">
                <img src="assets/images/i.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div>
    <!-- Contact Us Section -->
    <div class="container py-5 section-background">
        <h2 class="text-center text-white">Contact Us</h2>
        <div class="row text-center text-white">
            <div class="col-md-4">
                <p><i class="fas fa-map-marker-alt"></i> Address</p>
                <p>Located at Campo, Bantigue, Bantayan Island, Cebu</p>
            </div>
            <div class="col-md-4">
                <p><i class="fas fa-phone"></i> Customer Service:</p>
                <p>0923-377-4667</p>
            </div>
            <div class="col-md-4">
                <p><i class="fas fa-envelope"></i> Complaint:</p>
                <p>0947-209-8888</p>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<!-- Footer Section -->
<footer class="footer bg-primary text-white py-4">
  <div class="container text-center">
    <div class="row">
      <div class="col-md-6">
        <span class="footer-link">Link: <a href="https://www.facebook.com/profile.php?id=100082397474734" class="text-white">FACEBOOK SER GLO</a></span>
      </div>
      <div class="col-md-6">
        <span>JI SU EBIKE</span>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12">
        <p>Add: Campo, Bantigue, Bantayan Island, Cebu. Tel: 0947-209-8888 Complaint:

0947-209-8888</p>
      </div>
    </div>
  </div>
</footer>

<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS for Footer -->
<style>
  .footer {
    background-color: #497ecf; /* Gloss Glacier Blue */
    font-size: 14px;
  }
  .footer a {
    text-decoration: none;
    font-weight: bold;
  }
  .footer-link a:hover {
    text-decoration: underline;
  }
</style>
