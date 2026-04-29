<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pet-resgister</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
    body {
        background: linear-gradient(135deg, #e3f2fd, #f1f8e9);
        height: 100vh;
    }

    .register-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        animation: fadeIn 0.6s ease-in-out;
    }

    .register-title {
        text-align: center;
        font-weight: bold;
        color: #198754;
    }

    .form-control, .form-select {
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
        transform: scale(1.03);
        background-color: #157347;
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
    <div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-5">

            <div class="register-card">

                <form id="regform" autocomplete="off">
                    <fieldset>

                        <h2 class="register-title mb-4">
                            <i class="bi bi-person-plus-fill"></i> Registration
                        </h2>

                        <div>
                            <label class="form-label mt-2">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter email">
                        </div>

                        <div>
                            <label class="form-label mt-3">User Name</label>
                            <input type="text" class="form-control is-invalid" id="username" name="username"
                                autocomplete="off" placeholder="Enter name">
                        </div>

                        <div>
                            <label class="form-label mt-3">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Enter phone number">
                        </div>

                        <div>
                            <label class="form-label mt-3">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" autocomplete="off">
                        </div>

                        <div>
                            <label class="form-label mt-3">Password Retype</label>
                            <input type="password" class="form-control" id="passwordretype"
                                placeholder="Retype Password" autocomplete="off">
                        </div>

                        <div>
                            <label class="form-label mt-3">User Type</label>
                            <select class="form-select" id="usertype" name="type">
                                <option disabled selected value="">Select</option>
                                <option value="Vet">Vet</option>
                                <option value="Adopter">Adopter</option>
                            </select>
                        </div>

                        <div class="py-3">
                            <button id="regbtn" onclick="return false" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Registration
                            </button>
                        </div>

                        <div class="text-center">
                            <small class="text-muted">Join Pet Connect Community</small>
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


        $('#regbtn').on("click", function(){
            let email = $('#email').val();
            let name = $('#username').val();
            let phone = $('#phone').val();
            let type = $('#usertype').val();

            let password = $('#password').val();
            let passwordre = $('#passwordretype').val();

            if(name == ""){
                $('#username').attr('class','form-control is-invalid');
            }else{
                $('#username').attr('class','form-control is-valid');

            } 

            if(email =="" ){ 
                Swal.fire({
                    title: "validation error",
                    text: "email is empty",
                    icon: "warning"
            });
            }
            else if (phone.length !=10){
                Swal.fire({
                    title: "validation error",
                    text: "wrong phone number",
                    icon: "warning"
            });
            }else if(password == "" ||passwordre == ""){
                Swal.fire({
                    title: "validation error",
                    text: "Password or password retype can't be empty",
                    icon: "warning"
            });
            }else if(password != passwordre){
                Swal.fire({
                    title: "validation error",
                    text: "Password and Retype Password is not matching",
                    icon: "warning"
            });
            }else if (type == null){ 
                alert("Please select user type");
            }else{
                $.ajax({
                    url:"lib/routes/auth/registration.php",
                    type:"post",
                    data:$('#regform').serialize(),
                    success: function(res){
                        
                        if(res.trim() ==='success'){
                            $('#regform')[0].reset();
                            Swal.fire({
                                title: "Registration Success",
                                text: "User registered Successfully",
                                showConfirmButton: false,
                                timerProgressBar:true,
                                timer:2000,
                                icon: "success" 
                            });

                        }else if(res === 'error'){
                            Swal.fire({
                                title: "Registration Error",
                                text: "Something went wrong",
                                icon: "Warning"
                            });
                              
                        }else{
                            Swal.fire({
                                title: "Registration Error",
                                text: "something went wrong",
                                icon: "warning"
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