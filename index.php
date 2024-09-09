<?php include('includes/header.php'); ?>

<!-- Carousel Section -->
<div class="py-5" style="background-size: cover; background-position: center; background-repeat: no-repeat; height: 100%;">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <!-- Carousel indicators go here -->
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/jisu-ebike.jpg" class="d-block w-100" alt="Slide 1" style="height: 100%; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="assets/images/jisu-ebike.jpg" class="d-block w-100" alt="Slide 2" style="height: 100%; object-fit: cover;">
            </div>
            <div class="carousel-item">
                <img src="assets/images/jisu-ebike.jpg" class="d-block w-100" alt="Slide 3" style="height: 100%; object-fit: cover;">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<!-- Other sections -->
    <div class="row justify-content-center">
        <div class="col-md-12 py-5 text-center">
            <?php alertMessage(); ?>
        </div>
    </div>
</div>

<!-- Product Section -->
<div class="container py-5" style="background-color: rgba(255, 255, 255, 0.85);">
    <h2 class="text-center" style="color: #004d4d;">Unit</h2>
    <div class="row">
        <div class="col-md-3">
            <img src="assets/images/1.jpg" alt="Product 1" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
            <p class="text-center" style="color: #006d77;">SG 5</p>
        </div>
        <div class="col-md-3">
            <img src="assets/images/2.jpg" alt="Product 2" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
            <p class="text-center" style="color: #006d77;">DRAGON</p>
        </div>
        <div class="col-md-3">
            <img src="assets/images/bike3.jpg" alt="Product 3" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
            <p class="text-center" style="color: #006d77;">CLASSY PRO 5 SEATERS</p>
        </div>
        <div class="col-md-3">
            <img src="assets/images/3.jpg" alt="Product 4" class="img-fluid w-100" style="object-fit: cover; height: 300px;">
            <p class="text-center" style="color: #006d77;">EAGLE SCOOTER</p>
        </div>
    </div>
</div>

<!-- Contact Us Section -->
<div class="container py-5" style="background-color: rgba(255, 255, 255, 0.85);">
    <h2 class="text-center" style="color: #004d4d;">Contact Us</h2>
    <div class="row text-center">
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

<!-- CSS for whole page background -->
<style>
    /* Apply the color from the image as the background */
    body, html {
        background-color: #6c90cf;
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    /* Ensure the container sections stand out with subtle padding */
    .container {
        background-color: rgba(255, 255, 255, 0.85); /* Slightly translucent white background for contrast */
        padding: 30px;
        border-radius: 8px;
    }

    /* Adjust carousel image sizes */
    .carousel-inner img {
        object-fit: cover;
        height: 500px; /* Ensures a large, uniform image height */
    }

    /* Adjust text colors to complement the new background */
    h2 {
        color: #004d4d; /* Darker shade for headers */
    }

    p {
        color: #006d77; /* Slightly darker blue for paragraphs */
    }
</style>
