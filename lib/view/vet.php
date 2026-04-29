<?php
//session start
session_start();

if(isset($_SESSION['user_id'])){
    $usertype = $_SESSION['user_Type'];

    if($usertype != 'vet'){
        header('location:../../login.php');    

    }

}else{
    header('location:../../login.php');
}

include_once('sidebar.php')

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
.dashboard-card {
    border-radius: 15px;
    padding: 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
    transition: 0.3s;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.dashboard-card i {
    font-size: 40px;
    opacity: 0.3;
    position: absolute;
    right: 15px;
    bottom: 15px;
}

.dashboard-title {
    font-size: 16px;
}

.dashboard-value {
    font-size: 28px;
    font-weight: bold;
}

.welcome-box {
    height: 60vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.welcome-content {
    text-align: center;
    position: relative;
}

.welcome-bg-text {
    font-size: 80px;
    font-weight: bold;
    color: #000;
    opacity: 0.05;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    white-space: nowrap;
}

.welcome-icon {
    font-size: 70px;
    color: #198754;
    margin-bottom: 10px;
}

.welcome-title {
    font-size: 32px;
    font-weight: bold;
}

.welcome-sub {
    color: #6c757d;
}
</style>

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
         <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-3">

            <!-- USERS -->
            <div class="col-md-3">
                <div class="dashboard-card" style="background: linear-gradient(45deg,#0d6efd,#5dade2);">
                    <div class="dashboard-title">Total Users</div>
                    <div class="dashboard-value" id="userCount">0</div>
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>

            <!-- PETS -->
            <div class="col-md-3">
                <div class="dashboard-card" style="background: linear-gradient(45deg,#198754,#58d68d);">
                    <div class="dashboard-title">Total Pets</div>
                    <div class="dashboard-value" id="petCount">0</div>
                    <i class="bi bi-heart-fill"></i>
                </div>
            </div>

            <!-- ADOPTIONS -->
            <div class="col-md-3">
                <div class="dashboard-card" style="background: linear-gradient(45deg,#fd7e14,#f5b041);">
                    <div class="dashboard-title">Adoptions</div>
                    <div class="dashboard-value" id="adoptionCount">0</div>
                    <i class="bi bi-arrow-left-right"></i>
                </div>
            </div>

            <!-- ORDERS -->
            <div class="col-md-3">
                <div class="dashboard-card" style="background: linear-gradient(45deg,#6f42c1,#af7ac5);">
                    <div class="dashboard-title">Consultant helps</div>
                    <div class="dashboard-value" id="orderCount">0</div>
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
            </div>

        </div>
            <!--end::Row-->
            <!--begin::Row-->
           <div class="col-12">
              <div class="welcome-box">

                  <div class="welcome-content">

                      <!-- Background faded text -->
                      <div class="welcome-bg-text">
                          PET CONNECT
                      </div>

                      <!-- Main icon -->
                      <div class="welcome-icon">
                          <img src="../../assets/image/3047928.png" style="width:20%;" alt="">
                      </div>

                      <!-- Title -->
                      <div class="welcome-title">
                          Welcome to Pet Connect
                      </div>

                      <!-- Subtitle -->
                      <div class="welcome-sub">
                          Vet Panel Dashboard
                      </div>

                  </div>

              </div>
          </div>
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
        <!--end::App Content-->
      </main>
      <!--end::App Main-->

       <script>
        $(document).ready(function(){
    loadCounts();
});

function loadCounts(){

    $.get("../routes/report/getCounts2.php", function(res){

        let data = JSON.parse(res);

        $("#userCount").text(data.users);
        $("#petCount").text(data.pets);
        $("#adoptionCount").text(data.adoptions);
        $("#orderCount").text(data.orders);

    });

}
      </script>

      <?php
      include_once('footer.php')
      ?>
     
