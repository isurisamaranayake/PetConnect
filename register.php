<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pet-resgister</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php
    include_once('common.php');
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <form id="regform" autocomplete="off">
                    <fieldset>
                        <h1>registration</h1>
                        <div>
                            <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div>
                            <label for="exampleInputEmail1" class="form-label mt-4">User Name</label>
                            <input type="text" class="form-control is-invalid" id="username" name="username" autocomplete="off"
                                placeholder="Enter name">
                        </div>
                        <div>
                            <label for="exampleInputEmail1" class="form-label mt-4">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Enter phone number ">
                        </div>
                        <div>
                            <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" autocomplete="off">
                        </div>
                        <div>
                            <label for="exampleInputPassword1" class="form-label mt-4">Password Retype</label>
                            <input type="password" class="form-control" id="passwordretype"
                                placeholder="RetypePassword" autocomplete="off">
                        </div> 
                        <div>
                            <label for="exampleSelect1" class="form-label mt-4">User Type</label>
                            <select class="form-select" id="usertype" name="type">
                                <option disabled selected value="">Select</option>
                                <option value="Vet">Vet</option>
                                <option value="Adopter">Adopter</option>  
                            </select>
                        </div>
                        <div class="py-2">
                            <button id="regbtn" onclick="return false" class="btn btn-success">Registration</button>
                        </div>
                    </fieldset>
                </form>
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