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

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Staff Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Staff Management</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
<div class="container-fluid">
    <div class="row">

        <!-- LEFT FORM -->
        <div class="col-md-4">
            <form id="regform">
                <input type="hidden" id="staff_id" name="staff_id">

                <h4 id="formTitle">Add Staff</h4>

                <div>

    <!-- FULL NAME -->
    <div>
        <label class="form-label mt-3">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="full_name" placeholder="Enter full name">
       
    </div>

    <!-- EMAIL -->
    <div>
        <label class="form-label mt-3">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        
    </div>

    <!-- PHONE -->
    <div>
        <label class="form-label mt-3">Phone Number</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
        
    </div>

    <!-- NIC -->
    <div>
        <label class="form-label mt-3">User NIC</label>
        <input type="text" class="form-control" id="userid" name="userid" placeholder="Enter NIC">
        
    </div>

    <!-- PASSWORD -->
    <div>
        <label class="form-label mt-3">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
        
    </div>

    <!-- CONFIRM PASSWORD -->
    <div>
        <label class="form-label mt-3">Confirm Password</label>
        <input type="password" class="form-control" id="passwordretype" placeholder="Retype password">
       
    </div>

    <!-- ROLE -->
    <div>
        <label class="form-label mt-3">Role</label>
        <select class="form-select" id="usertype" name="role">
            <option value="">Select Role</option>
            <option value="Admin">Admin</option>
            <option value="Vet">Vet</option>
        </select>
    </div>

</div>

                <button id="regbtn" class="btn btn-success mt-3">Save</button>
                <button type="button" id="resetBtn" class="btn btn-secondary mt-3">Reset</button>
            </form>
        </div>

        <!-- RIGHT TABLE -->
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th width="250">Actions</th>
                    </tr>
                </thead>
                <tbody id="staffTable"></tbody>
            </table>
        </div>

    </div>
</div>
</body>
</main>

<script src="js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {

    loadStaff();

    // SAVE (ADD + EDIT)
    $("#regbtn").click(function (e) {
        e.preventDefault();

        let id = $("#staff_id").val();

        let pass = $("#password").val();
        let repass = $("#passwordretype").val();

        if (id === "" && pass !== repass) {
            Swal.fire("Error", "Passwords do not match", "warning");
            return;
        }

        let url = (id === "")
            ? "../routes/user/addstaff.php"
            : "../routes/user/updatestaff.php";

        $.post(url, $("#regform").serialize(), function (res) {

            if (res.trim() === "success") {

                Swal.fire("Success", "Saved successfully", "success");

                $("#regform")[0].reset();
                $("#staff_id").val("");
                $("#formTitle").text("Add Staff");

                loadStaff();

            } else {
                Swal.fire("Error", res, "error");
            }
        });
    });

    $("#resetBtn").click(function () {
        $("#regform")[0].reset();
        $("#staff_id").val("");
        $("#formTitle").text("Add Staff");
    });

});

// LOAD STAFF
function loadStaff() {
    $.get("../routes/user/loadstaff.php", function (res) {
        $("#staffTable").html(res);
    });
}

// EDIT
$(document).on("click", ".editBtn", function () {

    $("#staff_id").val($(this).data("id"));
    $("#fullname").val($(this).data("name"));
    $("#email").val($(this).data("email"));
    $("#phone").val($(this).data("phone"));
    $("#userid").val($(this).data("nic"));
    $("#usertype").val($(this).data("role"));

    $("#formTitle").text("Edit Staff");

});

// ACTIVATE / DEACTIVATE
function toggleStatus(id, currentStatus, selfId){

    if(id == selfId){
        Swal.fire("Warning","You cannot change your own status","warning");
        return;
    }

    Swal.fire({
        title: "Are you sure?",
        text: "Change account status?",
        icon: "warning",
        showCancelButton: true
    }).then((res)=>{
        if(res.isConfirmed){

            $.post("../routes/user/togglestatus.php",{id:id},function(r){

                if(r.trim()=="success"){
                    Swal.fire("Done","Status updated","success");
                    loadStaff();
                }
            });

        }
    });
}

// RESET PASSWORD
function resetPassword(id, selfId){

    if(id == selfId){
        Swal.fire("Warning","You cannot reset your own password here","warning");
        return;
    }

    Swal.fire({
        title: "Reset Password?",
        text: "Password will be set to 123456",
        icon: "warning",
        showCancelButton: true
    }).then((res)=>{
        if(res.isConfirmed){

            $.post("../routes/user/resetpassword.php",{id:id},function(r){

                if(r.trim()=="success"){
                    Swal.fire("Success","Password reset to 123456","success");
                }
            });

        }
    });
}
</script>

<?php
      include_once('footer.php')
      ?>

</html>