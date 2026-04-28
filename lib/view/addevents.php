<?php
//session start
session_start();

if(isset($_SESSION['user_id'])){
    $usertype = $_SESSION['user_Type'];

    if($usertype == 'adopter' || $usertype == "vet"){
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
                    <h3 class="mb-0">Add Post</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">add post</li>
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
            <div class="row">
                <form id="addeventform" autocomplete="off">
                    <fieldset>
                        <h1>Add Community/Event Post</h1>


                        <div>
                            <label class="form-label mt-4">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                        </div>


                        <div>
                            <label class="form-label mt-4">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Enter description"></textarea>
                        </div>

                        <div id="eventFields">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label mt-4">Event Date</label>
                                    <input type="date" class="form-control" id="event_date" name="event_date">
                                </div>

                                <div class="col-6">
                                    <label class="form-label mt-4">Event Time</label>
                                    <input type="time" class="form-control" id="event_time" name="event_time">
                                </div>
                            </div>

                            <div>
                                <label class="form-label mt-4">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Enter event location">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mt-4">Upload Image</label>
                                <input class="form-control" type="file" name="image" id="image">
                            </div>

                            <div class="col-6">
                                <img src="../../assets/image/images.png" id="postimageprv" style="height:150px;">
                            </div>
                        </div>


                        <div class="py-2">
                            <button id="addeventtbtn" onclick="return false" class="btn btn-success">
                                Add Post
                            </button>
                        </div>
                    </fieldset>
                </form>
                </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <!-- Start col -->

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

        $("#image").change(function () {

            var fileRead = new FileReader();

            fileRead.onload = function (e) {
                $("#postimageprv").attr("src", e.target.result);

            }

            fileRead.readAsDataURL(this.files[0]);

        })

        $('#addeventtbtn').on("click", function () {

            let isValid = true;

            // Clear previous errors
            $('.form-control, .form-select').removeClass('is-invalid');

            function validateField(id) {
                let value = $(id).val();
                if (!value) {
                    $(id).addClass('is-invalid');
                    isValid = false;
                }
            }

            validateField('#title');
            validateField('#description');
            validateField('#event_date');
            validateField('#event_time');
            validateField('#location');

            // Image validation
            if ($('#image')[0].files.length === 0) {
                $('#image').addClass('is-invalid');
                isValid = false;
            }
            
            if (isValid) {
          

                var form = $("#addeventform")[0];
                var formData = new FormData(form);

                $.ajax({
                    url: "../routes/events/addevent.php",
                    type: "post",
                    data: formData,
                    processdata: false,
                    contentType: false,

                    success: function (res) {

                        if (res.trim() === 'success') {
                            $('#addeventform')[0].reset();
                            Swal.fire({
                                title: "Successfully Saved",
                                text: "Post Added Successfully",
                                icon: "success"
                            });

                        } else if (res === 'error') {
                            Swal.fire({
                                title: "Save Error",
                                text: "Something went wrong",
                                icon: "Warning"
                            });

                        } else {
                            Swal.fire({
                                title: "Save Error",
                                text: "something went wrong",
                                icon: "warning"
                            });

                        }
                    },
                    error: function (res) {}
                })

            }
            else{
                alert('successfull');
}

        });
    });
</script>

<?php
      include_once('footer.php')
      ?>