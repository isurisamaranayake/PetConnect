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
                    <h3 class="mb-0">Event Managemnt</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Event Managemnt</li>
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
    <div class="container-fluid">
        <div class="row">

            <!-- LEFT SIDE FORM -->
            <div class="col-md-6">
                <form id="eventForm" enctype="multipart/form-data">
                    <input type="hidden" id="event_id" name="event_id">

                    <h4 id="formTitle">Add Event</h4>

                    <div>
                        <label>Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>

                    <div>
                        <label>Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div>
                        <label>Date</label>
                        <input type="date" class="form-control" id="event_date" name="event_date">
                    </div>

                    <div>
                        <label>Time</label>
                        <input type="time" class="form-control" id="event_time" name="event_time">
                    </div>

                    <div>
                        <label>Location</label>
                        <input type="text" class="form-control" id="location" name="location">
                    </div>

                    <div class="mt-2">
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <img id="preview" src="../../assets/image/images.png" style="height:120px;margin-top:10px;">

                    <div class="mt-3">
                        <button id="saveBtn" class="btn btn-success">Save</button>
                        <button id="resetBtn" type="button" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>

            
            <!-- RIGHT SIDE LIST -->
            <div class="col-md-6">
                <h4 id="formTitle">All Events</h4>
                <div id="eventList" class="row"></div>
            </div>

        </div>
    </div>
</div>
    <!--end::App Content-->
</main>
<!--end::App Main-->

<script>
$(document).ready(function () {

    loadEvents();

    // IMAGE PREVIEW
    $("#image").change(function () {
        let reader = new FileReader();
        reader.onload = e => $("#preview").attr("src", e.target.result);
        reader.readAsDataURL(this.files[0]);
    });

    // SAVE (ADD + EDIT)
    $("#saveBtn").click(function (e) {
        e.preventDefault();

        let isValid = true;

        // remove old errors
        $('.form-control').removeClass('is-invalid');

        function validate(id){
            if($(id).val() === ""){
                $(id).addClass('is-invalid');
                isValid = false;
            }
        }

        validate("#title");
        validate("#description");
        validate("#event_date");
        validate("#event_time");
        validate("#location");

        if(!isValid){
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: 'Please fill all required fields'
            });
            return;
        }

        let form = $("#eventForm")[0];
        let formData = new FormData(form);

        let id = $("#event_id").val();

        let url = (id === "")
            ? "../routes/events/addevent.php"
            : "../routes/events/updateevent.php";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (res) {

                if (res.trim() === "success") {

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: (id === "") ? 'Event Added Successfully' : 'Event Updated Successfully',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $("#eventForm")[0].reset();
                    $("#event_id").val("");
                    $("#formTitle").text("Add Event");
                    $("#preview").attr("src", "../../assets/image/images.png");

                    loadEvents();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong'
                    });
                }
            }
        });
    });

    // RESET
    $("#resetBtn").click(function () {
        $("#eventForm")[0].reset();
        $("#event_id").val("");
        $("#formTitle").text("Add Event");
        $("#preview").attr("src", "../../assets/image/images.png");

        Swal.fire({
            icon: 'info',
            title: 'Reset',
            text: 'Form cleared'
        });
    });

});


// LOAD EVENTS
function loadEvents() {
    $.get("../routes/events/loadEvents.php", function (res) {
        $("#eventList").html(res);
    });
}


// EDIT
$(document).on("click", ".editBtn", function () {

    $("#event_id").val($(this).data("id"));
    $("#title").val($(this).data("title"));
    $("#description").val($(this).data("description"));
    $("#event_date").val($(this).data("date"));
    $("#event_time").val($(this).data("time"));
    $("#location").val($(this).data("location"));

    $("#preview").attr("src", "lib/" + $(this).data("image"));

    $("#formTitle").text("Edit Event");

    Swal.fire({
        icon: 'info',
        title: 'Edit Mode',
        text: 'You can now update this event'
    });
});


// DELETE
function deleteEvent(id) {

    Swal.fire({
        title: 'Are you sure?',
        text: "This will delete the event!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.isConfirmed) {

            $.post("../routes/events/deleteevent.php", { id: id }, function (res) {

                if (res.trim() === "success") {

                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Event has been deleted',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    loadEvents();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Delete Failed',
                        text: 'Something went wrong'
                    });
                }
            });

        }
    });
}
</script>

<?php
      include_once('footer.php')
      ?>