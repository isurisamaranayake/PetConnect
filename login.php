<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <title>Pet-login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php
    include_once('common.php');
    ?>

    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <form id="" autocomplete="off">
                    <fieldset>
                        <h1>login</h1>
                        <div>
                            <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div>
                            <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" autocomplete="off">
                        </div>
                        <div class="py-2">
                            <button id="loginbtn" onclick="return false" class="btn btn-success">Login</button>
                        </div>
                    </fieldset>
                </form>
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