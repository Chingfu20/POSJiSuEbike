
<?php 
include 'config/conn.php';
$sql = "SELECT name, image, description FROM products WHERE status = 0 ORDER BY created_at ";
$result = $conn->query($sql);

// Prepare an array for the products
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image" href="assets/images/logo.jpg">
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

    /* Carousel image styling */
    .carousel-item img {
        height: 100vh; /* Full viewport height */
        object-fit: cover;
    }
    /* Gallery and product image styling */
    .gallery-item img,
    .section-background img {
        height: 300px; /* Adjusted image height */
        object-fit: cover;
        border-radius: 8px; /* Slight rounding of corners for aesthetics */
        padding: 10px; /* Add padding around images */
        margin: 10px;
        margin-left:10px; /* Add margin to ensure space between images */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Add subtle shadow */
    }
    /* General section spacing */
    .section-background {
        padding: 5% 10px; /* Padding for consistent section spacing */
    }

    .footer-link a:hover {
    text-decoration: underline;
  }
     .footer-link{
        text-decoration:none;
     }

     .footer-link a{
      font-weight:bold;
      color:black;
     }

     .product-image-wrapper {
    position: relative;
    overflow: hidden;
    width: 100%;
    max-height: 250px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.product-image-wrapper img {
    transition: transform 0.3s ease-in-out;
}

.product-image-wrapper:hover img {
    transform: scale(1.1); /* Zoom effect on hover */
}
    </style>
</head>
<body style="background-color:#497ecf;">
<?php include('includes/header.php'); ?>

<!-- Carousel Section -->
<div>
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
<div class="section-background">
    <h2 class="text-center text-white" data-aos="fade-up">Units</h2>
    <div class="row">
        <?php foreach ($products as $index => $product): ?>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex flex-column align-items-center mb-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                <div class="product-image-wrapper">
                    <img 
                        src="<?= htmlspecialchars($product['image']) ?>" 
                        alt="<?= htmlspecialchars($product['name']) ?>" 
                        class="img-fluid w-100 rounded shadow-sm" 
                        style="object-fit: cover; max-height: 250px;">
                </div>
                <p class="text-center text-white mt-2"><?= htmlspecialchars($product['name']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Gallery Section -->
<div class="section-background ">
    <h2 class="text-center text-white" data-aos="fade-up">Gallery</h2>
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
<div class="section-background">
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
</div>



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
<p> © Hershey Sedurifa, Johnril Rosello, Mitche Pedroza, Jessa Mae Bayawa</p>
      </div>
    </div>
  </div>
</footer>

<?php include('includes/footer.php'); ?>
<?php include('assets/script.php'); ?>
<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
