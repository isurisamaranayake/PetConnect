<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=S, initial-scale=1.0">
    <title>Pet</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">


<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Animate CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
body{
    font-family: 'Segoe UI', sans-serif;
}

/* HERO VIDEO */
.hero {
    position: relative;
    height: 100vh;
    overflow: hidden;
}

.hero video {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
}

.hero-content {
    position: relative;
    z-index: 2;
    color: white;
    top: 50%;
    transform: translateY(-50%);
}

/* FEATURES */
.feature-box {
    padding: 30px;
    border-radius: 15px;
    transition: 0.3s;
    background: #f8f9fa;
}
.feature-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

/* SECTION SPACING */
.section {
    padding: 80px 0;
}
</style>
</head>

<body>
    <?php
    include_once('common.php');
    ?>

    <!-- HERO VIDEO -->
<div class="hero">

    <video id="videoPlayer" autoplay muted loop>
        <source src="lib/Upload/ui/watermarked_preview.mp4" type="video/mp4">
    </video>

    <div class="hero-overlay"></div>

    <div class="container text-center hero-content">
        <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">
            Connect with Pets. Change Lives.
        </h1>
        <p class="lead animate__animated animate__fadeInUp">
            Adopt, care, and consult with experts – all in one place.
        </p>

        <a href="login.php" class="btn btn-success btn-lg mt-3">
            <i class="bi bi-heart-fill"></i> Explore Pets
        </a>
    </div>
</div>

<!-- FEATURES -->
<div class="section bg-light">
<div class="container text-center">
    <h2 class="fw-bold mb-5">What You Can Do</h2>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="feature-box animate__animated animate__fadeInUp">
                <i class="bi bi-person-circle fs-1 text-success"></i>
                <h5 class="mt-3">Create Account</h5>
                <p>Manage your pets and activities in one place.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="feature-box animate__animated animate__fadeInUp">
                <i class="bi bi-search-heart fs-1 text-success"></i>
                <h5 class="mt-3">Adopt Pets</h5>
                <p>Find loving pets ready for a new home.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="feature-box animate__animated animate__fadeInUp">
                <i class="bi bi-funnel fs-1 text-success"></i>
                <h5 class="mt-3">Smart Filters</h5>
                <p>Search pets by age, breed, size & location.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="feature-box animate__animated animate__fadeInUp">
                <i class="bi bi-chat-dots fs-1 text-success"></i>
                <h5 class="mt-3">Free Vet Help</h5>
                <p>Consult veterinarians anytime online.</p>
            </div>
        </div>

    </div>
</div>
</div>

<!-- ABOUT -->
<div class="section">
<div class="container">
    <div class="row align-items-center">

        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1583337130417-3346a1be7dee"
                 class="img-fluid rounded shadow">
        </div>

        <div class="col-md-6">
            <h2 class="fw-bold">About Pet Connect</h2>
            <p>
                Pet Connect is a platform designed to bring pet lovers together.
                Whether you're looking to adopt a pet, manage your own pets,
                or get expert advice from veterinarians, we make it simple and accessible.
            </p>
            <p>
                Our mission is to create a world where every pet finds a loving home.
                Join us and be part of this journey.
            </p>
        </div>

    </div>
</div>
</div>

<!-- CALL TO ACTION -->
<div class="section bg-success text-white text-center">
<div class="container">
    <h2>Ready to Find Your New Best Friend?</h2>
    <p>Start exploring pets and connect with loving companions today.</p>
    <a href="login.php" class="btn btn-light btn-lg">Get Started</a>
</div>
</div>
    <div class="container">
        <div class="row" style="height:20px; background-colour:blue;">
            <div class="col-5"></div>
            <div class="col-1" style="height:20px; background-colour:blue;"></div>
        </div>
    </div>
</body>

</html>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// VIDEO SWITCH
let videos = ["lib/Upload/ui/watermarked_preview.mp4", "lib/Upload/ui/watermarked_preview.mp4"];
let index = 0;

setInterval(() => {
    index = (index + 1) % videos.length;
    document.getElementById("videoPlayer").src = videos[index];
}, 8000);
</script>