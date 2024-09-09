<nav class="navbar navbar-expand-lg shadow" style="background-color: #497ecf !important;">
  <div class="container">
    <div class="d-flex flex-column align-items-center">
      <span class="navbar-text mb-2 text-white">Welcome to Ji Su E-Bike</span>
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="assets/images/WS.jpg" alt="JiSu E-bike Logo" style="height: 40px; width: 90px; margin-right: 5px;">
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" href="about_us.php">About us</a>
        </li>
        <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle active text-white" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Units
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="dragon.php">2 Wheel</a></li>
              <li><a class="dropdown-item" href="scooter.php">3 Wheel</a></li>
              <li><a class="dropdown-item" href="classy.php">4 Wheel</a></li>
            </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" href="contact.php">Contact us</a>
        </li>
        <?php if(isset($_SESSION['loggedIn'])) : ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="#"><?= $_SESSION['loggedInUser']['name']; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle active text-white" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Login
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="login.php">Admin</a></li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Include Bootstrap CSS and JS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<!-- Custom CSS for hover dropdown -->
<style>
  .navbar-nav .dropdown:hover .dropdown-menu {
    display: block !important;
  }
  .navbar-nav .dropdown-menu {
    margin-top: 0 !important;
  }
  .navbar-toggler {
    background-color: #ffffff !important; /* White toggler icon for better contrast */
  }
  .dropdown-menu {
    background-color: #497ecf !important; /* Matching background for dropdown */
  }
  .dropdown-menu .dropdown-item {
    color: white !important;
  }
  .dropdown-menu .dropdown-item:hover {
    background-color: #ffffff !important; /* Change background color on hover */
    color: #497ecf !important; /* Blue text color on hover */
  }
</style>
