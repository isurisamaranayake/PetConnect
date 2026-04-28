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
                    <h3 class="mb-0">Approve Pet</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Approve Pet</li>
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

            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <!-- Start col -->
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">#</th>
                                <th scope="col">Pet Type</th>
                                <th scope="col">Breed</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Pet Lister</th>
                                <th scope="col">Added Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="approvelistbody">

                        </tbody>
                    </table>
                <!-- /.Start col -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->

<script>
    $(document).ready(function () {

        $.get("../routes/pet/approvelist.php", function (res) {
            $('#approvelistbody').html(res);
        })
    });

    function approvepet(id) {
        
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, approve it!"
        }).then((result) => {
            if (result.isConfirmed)
                
                $.get("../routes/pet/approvepet.php",{petid:id},function(res){
                    if(res == "success"){
                        Swal.fire({
                            title: "approved!",
                            text: "Your request has been approved.",
                            icon: "success"
                        });

                        $('#approvelistbody').html("");

                        $.get("../routes/pet/approvelist.php", function (res) {
                            $('#approvelistbody').html(res);
                        })

                    }else{
                        Swal.fire({
                            title: "approve failed!",
                            text: "Something went wrong",
                            icon: "error"
                        });

                    }
                })
            });
        }

        function rejectpet(id) {

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, reject it!"
        }).then((result) => {
            if (result.isConfirmed)
                
                $.get("../routes/pet/rejectpet.php",{petid:id},function(res){
                    if(res == "success"){
                        Swal.fire({
                            title: "rejected!",
                            text: "Your request has been rejected.",
                            icon: "success"
                        });

                        $('#approvelistbody').html("");

                        $.get("../routes/pet/approvelist.php", function (res) {
                            $('#approvelistbody').html(res);
                        })

                    }else{
                        Swal.fire({
                            title: "reject failed!",
                            text: "Something went wrong",
                            icon: "error"
                        });

                    }
                })
            });
        
        }
</script>

<?php
      include_once('footer.php')
      ?>