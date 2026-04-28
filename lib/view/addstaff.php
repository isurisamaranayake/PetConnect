<?php
//session start
session_start();

if(isset($_SESSION['user_id'])){
    $usertype = $_SESSION['user_Type'];

    if($usertype == 'adopter' || $usertype == 'vet'){
        header('location:../../login.php');    
    }

}else{
    header('location:../../login.php');
};

include_once('sidebar.php');

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <form id="regform" autocomplete="off">
                <fieldset>
                    <h1>staff registration</h1>
                    <div>
                        <label class="form-label mt-4">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="full_name"
                            placeholder="Enter full name" required>
                        <div class="invalid-feedback">Full name is required</div>
                    </div>

                    <div>
                        <label class="form-label mt-4">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                            required>
                        <div class="invalid-feedback">Valid email is required</div>
                    </div>

                    <div>
                        <label class="form-label mt-4">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number"
                            required>
                        <div class="invalid-feedback">Phone number is required</div>
                    </div>

                    <div>
                        <label class="form-label mt-4">User NIC</label>
                        <input type="text" class="form-control" id="userid" name="userid"
                            placeholder="Enter phone number" required>
                        <div class="invalid-feedback">User NIC is required</div>
                    </div>

                    <div>
                        <label class="form-label mt-4">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter password" autocomplete="off" required>
                        <div class="invalid-feedback">Password is required</div>
                    </div>

                    <div>
                        <label class="form-label mt-4">Confirm Password</label>
                        <input type="password" class="form-control" id="passwordretype" name="confirm_password"
                            placeholder="Retype password" autocomplete="off" required>
                        <div class="invalid-feedback">Please confirm password</div>
                    </div>

                    <div>
                        <label class="form-label mt-4">Role</label>
                        <select class="form-select" id="usertype" name="role" required>
                            <option disabled selected value="">Select Role</option>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                        </select>
                        <div class="invalid-feedback">Role is required</div>
                    </div>
                    <div class="py-2">
                        <button id="regbtn" onclick="return false" class="btn btn-success">Registration</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-6">
            <!--begin::Row-->
            <div class="row">

                <form id="addpetform" autocomplete="off">
                    <fieldset>
                        <h1>My Pets</h1>

                        <table class="table table-hover">
                            <thead>
                                <tr class="table-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Pet Type</th>
                                    <th scope="col">Breed</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Added Date/Location</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="mypetlist">

                            </tbody>
                        </table>
                    </fieldset>
                </form>
            </div>
            <!--end::Row-->

        </div>
    </div>
</div>
</body>


<script src="js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {



        $('#regbtn').on("click", function () {

            let full_name = $('#full_name').val();
            let email = $('#email').val();

            let phone = $('#phone').val();
            let userid = $('#userid').val();
            let role = $('#usertype').val();

            let password = $('#password').val();
            let passwordre = $('#passwordretype').val();

            // Full Name validation
            if (fullname == "") {
                $('#fullname').addClass('is-invalid');
                return;
            } else {
                $('#fullname').removeClass('is-invalid').addClass('is-valid');
            }

            // Email validation
            if (email == "") {
                Swal.fire({
                    title: "Validation Error",
                    text: "Email is required",
                    icon: "warning"
                });
                return;
            }

            // Phone validation
            if (phone.length != 10) {
                Swal.fire({
                    title: "Validation Error",
                    text: "Phone number must be 10 digits",
                    icon: "warning"
                });
                return;
            }

            // Password validation
            if (password == "" || passwordre == "") {
                Swal.fire({
                    title: "Validation Error",
                    text: "Password fields cannot be empty",
                    icon: "warning"
                });
                return;
            }

            if (password != passwordre) {
                Swal.fire({
                    title: "Validation Error",
                    text: "Passwords do not match",
                    icon: "warning"
                });
                return;
            }

            // Role validation
            if (role == null) {
                Swal.fire({
                    title: "Validation Error",
                    text: "Please select a role",
                    icon: "warning"
                });
                return;
            }


            $.ajax({
                url: "../routes/user/addstaff.php",
                type: "post",
                data: $('#regform').serialize(),
                success: function (res) {

                    if (res.trim() === 'success') {

                        $('#regform')[0].reset();

                        $('.form-control').removeClass('is-valid');

                        Swal.fire({
                            title: "Success",
                            text: "Staff/Admin added successfully",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });

                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Something went wrong",
                            icon: "error"
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: "Error",
                        text: "Server error occurred",
                        icon: "error"
                    });
                }
            });

        });

    });
</script>

<?php
      include_once('footer.php')
      ?>

</html>