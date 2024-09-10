<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JiSu E-Bike</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css"> <!-- AOS CSS -->
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
    <h2 class="text-center text-white" data-aos="fade-up">Units</h2>
    <div class="row">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/images/1.jpg" alt="Product 1" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
            <p class="text-center text-white">SG 5</p>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/images/2.jpg" alt="Product 2" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
            <p class="text-center text-white">DRAGON</p>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <img src="assets/images/bike3.jpg" alt="Product 3" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
            <p class="text-center text-white">CLASSY PRO 5 SEATERS</p>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <img src="assets/images/3.jpg" alt="Product 4" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
            <p class="text-center text-white">EAGLE SCOOTER</p>
        </div>
    </div>
</div>

<!-- Gallery Section -->
<div class="container py-5 section-background">
    <h2 class="text-center" data-aos="fade-up">Gallery</h2>
    <div class="row">
        <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="gallery-item">
                <img src="assets/images/a.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="gallery-item">
                <img src="assets/images/b.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="gallery-item">
                <img src="assets/images/c.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="400">
            <div class="gallery-item">
                <img src="assets/images/d.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="500">
            <div class="gallery-item">
                <img src="assets/images/e.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="600">
            <div class="gallery-item">
                <img src="assets/images/f.jpg" alt="" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div>

<!-- Contact Us Section -->
<div class="container py-5 section-background">
    <h2 class="text-center text-white" data-aos="fade-up">Contact Us</h2>
    <div class="row text-center text-white">
        <div class="col-md-4" data-aos="fade-left">
            <p><i class="fas fa-map-marker-alt"></i> Address</p>
            <p>Located at Campo, Bantigue, Bantayan Island, Cebu</p>
        </div>
        <div class="col-md-4" data-aos="fade-up">
            <p><i class="fas fa-phone"></i> Customer Service:</p>
            <p>0923-377-4667</p>
        </div>
        <div class="col-md-4" data-aos="fade-right">
            <p><i class="fas fa-envelope"></i> Complaint:</p>
            <p>0947-209-8888</p>
        </div>
    </div>
    <!-- Motorcycle animation -->
    <div class="text-center mt-4" data-aos="zoom-in">
        <img src="assets/images/motorcycle-animation.gif" alt="Person driving a motorcycle" class="img-fluid">
    </div>
</div>


<?php include('includes/footer.php'); ?>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script> <!-- AOS JS -->

<script>
    // Initialize AOS (Animate on Scroll)
    AOS.init({
        duration: 1000, // Animation duration
        once: true // Animation occurs only once when scrolling down
    });
</script>

</body>
</html>
