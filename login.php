<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <title>Pet-login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
    body {
        background: linear-gradient(135deg, #e0f7fa, #f1f8e9);
        height: 100vh;
    }

    .login-card {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        animation: fadeIn 0.6s ease-in-out;
    }

    .login-title {
        text-align: center;
        font-weight: bold;
        color: #28a745;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px;
    }

    .btn-success {
        border-radius: 10px;
        width: 100%;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-success:hover {
        background: #218838;
        transform: scale(1.03);
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }
</style>
</head>

<body>
    <?php
    include_once('common.php');
    ?>

    
   <div class="container d-flex align-items-center justify-content-center" style="height:100vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-4">

            <div class="login-card">

                <form autocomplete="off">
                    <fieldset>

                        <h2 class="login-title mb-4">
                            <i class="bi bi-person-circle"></i> Login
                        </h2>

                        <div>
                            <label class="form-label mt-2">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter email">
                        </div>

                        <div>
                            <label class="form-label mt-3">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" autocomplete="off">
                        </div>

                        <div class="py-3">
                            <button id="loginbtn" onclick="return false" class="btn btn-success">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </button>
                        </div>

                        <div class="text-center">
                            <small class="text-muted">Pet Connect System</small>
                        </div>

                    </fieldset>
                </form>

            </div>

        </div>
    </div>
</div>
</body>


<script> 
    $(document).ready(function(){
        $('#loginbtn').on("click", function(){
            let email = $("#email").val();
            let type = $("#passwordretype").val();

            let password = $('#password').val();
            let passwordre = $('#passwordre').val();

            
            if(email =="" ){ 
                Swal.fire({
                    title: "validation error",
                    text: "email is empty",
                    icon: "warning"
            });  
            
            }else if(password == ""){
                Swal.fire({
                    title: "validation error",
                    text: "Password can't be empty",
                    icon: "warning"
            });
            } else{
                $.ajax({
                    url:"lib/routes/auth/authentication.php",
                    type:"post",
                    data:{username:email, password:password},
                    success: function(res){
                    
                    let response = JSON.parse(res)
                        if(response.status === false){
                            Swal.fire({
                                title: "Authentication Fail!",
                                text: response.message,
                                icon: "error"
                            });  
                        }else if(response.status === true){
                    
                            Swal.fire({
                                title: "Successfully Authenticated!",
                                text: response.message,
                                showConfirmButton: false,
                                timerProgressBar:true,
                                timer:2000,  
                                icon: "success"
                            }).then(()=>{
                                window.location.href = response.path;

                            });
                        }else{
                            Swal.fire({
                                title: "Authentication Fail!",
                                text: "Something went wrong",
                                icon: "error"
                            }); 

                        }

                    },error: function(res){
                    }
                })
            } 
            
            })
        })  

</script>
</html>