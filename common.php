<?php
$currentpage = basename($_SERVER["PHP_SELF"]);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<script src="js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .bell-animate i {
    display: inline-block;
    animation: bellShake 1s infinite;
    transform-origin: top center;
}

/* Shake animation */
@keyframes bellShake {
    0% { transform: rotate(0); }
    15% { transform: rotate(15deg); }
    30% { transform: rotate(-10deg); }
    45% { transform: rotate(8deg); }
    60% { transform: rotate(-5deg); }
    75% { transform: rotate(3deg); }
    100% { transform: rotate(0); }
}

</style>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <img src="assets/image/3047928.png" style="width:60px" alt="">
        <a class="navbar-brand" href="index.php">Pet Connect</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">

            <input type="hidden" id="loguserid" value="<?php  if(isset($_SESSION['user_id'])){
                      echo($_SESSION['user_id']);
                 } ?>">
                <li class="nav-item">
                    
                </li>
                <?php
                    if(isset($_SESSION['user_id'])){
                        $usertype = $_SESSION['user_Type'];

                        if($usertype != 'adopter'){  
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $currentpage =='login.php'? 'active' : ''?>"
                                    href="login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $currentpage =='register.php'? 'active' : ''?>"
                                    href="register.php">Registration</a>
                            </li>
                            <?php
                        }else{
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $currentpage =='pets.php'? 'active' : ''?>"
                                    href="pets.php">Adopt Pets</a>
                            </li>
                            
                           
                            <li class="nav-item">
                                <a class="nav-link <?php echo $currentpage =='mypets.php'? 'active' : ''?>"
                                    href="mypets.php">Add Pets for Adoption</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php echo $currentpage =='myownpets.php'? 'active' : ''?>"
                                    href="myownpets.php">My Pets</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php echo $currentpage =='products.php'? 'active' : ''?>"
                                    href="products.php">Pet Products</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php echo $currentpage =='events.php'? 'active' : ''?>"
                                    href="events.php">Pet Events</a>
                            </li>
                            <?php
                        }

                    }else{
                                ?>

                                <li class="nav-item">
                                <a class="nav-link <?php echo $currentpage =='products.php'? 'active' : ''?>"
                                    href="products.php">Pet Products</a>
                            </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentpage =='login.php'? 'active' : ''?>"
                                href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $currentpage =='register.php'? 'active' : ''?>"
                                href="register.php">Registration</a>
                        </li>
                        <?php        
                                
                            }
                            ?>

              
                
            </ul>
            <form class="d-flex">
                <?php
                    if(isset($_SESSION['user_id'])){
                        $usertype = $_SESSION['user_Type'];

                        if($usertype == 'adopter'){
                        echo(' <div id="notbtn"></div></i><a href="lib/view/logout.php" class="btn btn-danger btn-flat float-end">Sign out</a>');
                    }

                    }
                    
                    ?>
            </form>
        </div>
    </div>
</nav>
<div class="modal fade" id="notificationModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-end">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Notifications</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="notificationContent" style="max-height:300px; overflow-y:auto;">
        Loading...
      </div>
    </div>
  </div>
</div>

<script>
        let notificationHTML = "";

            $.ajax({
                url: "lib/routes/notification/check.php",
                type: "POST",
                success: function (res) {

                    notificationHTML = res; //store response

                    if(res.trim() != "No notifications today" && res.trim() != "No pets found"){
                        
                       $("#notbtn").html(`
                            <a href="#" id="bellBtn" class="me-3 bell-animate text-danger">
                                <i class="bi bi-bell-fill fs-4"></i>
                            </a>
                        `);

                    } else {
                        $("#notbtn").html("");
                    }
                }
            });

            $(document).on("click", "#bellBtn", function () {
                $(this).removeClass("bell-animate");
            });

            $(document).on("click", "#bellBtn", function (e) {
                e.preventDefault();

                $("#notificationContent").html(notificationHTML); // load content
                $("#notificationModal").modal("show"); // open modal
            });
</script>