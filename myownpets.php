<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Pet- My Own Pets</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    include_once('common.php');
    ?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-6">
                    </div>
                    <div class="col-6">

                    </div>

                </div>
                <!--begin::Row-->
                <div class="row">

                    <form id="addpetform" autocomplete="off">
                        <fieldset>
                            <h1>My Own Pets</h1>

                            <table class="table table-hover">
                                <thead>
                                    <tr class="table-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Pet Type</th>
                                        <th scope="col">Breed</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Added Date / Location</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Transfer Notes</th>
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
    </div>
    </div>
</body>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pet Tracker</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        Date
                    </div>
                    <div class="col-3">
                        Time
                    </div>
                    <div class="col-4">
                        Description
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-3">
                        <input class="form-control" type="date" name="date" id="date">
                        <input type="hidden" id="tpetid">
                    </div>
                    <div class="col-3">
                        <input class="form-control" type="time" name="time" id="time">
                    </div>
                    <div class="col-4">
                        <textarea class="form-control" name="description" id="description"
                            placeholder="Feeding Routines/ preferences, vaccination / vet appointments / Pet Routines"
                            rows="3"></textarea>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success" id="addtrackertbtn"><i
                                class="bi bi-plus"></i></button>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr class="table-dark">
                            <th scope="row">Date</th>
                            <td>Time</td>
                            <td>Description</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody id="pettrackers">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="savetrackerbtn">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Vet Consultation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        Description
                    </div>
                </div>
                <form id="askform">
                    <div class="row my-2">
                        <div class="col-12">
                            <input type="hidden" name="petid" id="tpetid2">
                            <textarea class="form-control" name="description" id="description2"
                                placeholder="Feeding Routines/ preferences, vaccination / vet appointments / Pet Routines"
                                rows="3"></textarea>
                        </div>

                        <div class="row my-2">
                            <div class="col-12">
                                <label>Priority</label>
                                <select class="form-control" name="priority" id="priority">
                                    <option value="">Select Priority</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            Upload Document
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-10">
                            <input type="file" class="form=control" name="document">
                        </div>
                        <div class="col-2   ">
                            <button type="button" class="btn btn-success" id="askbtn">Ask</button>
                        </div>
                    </div>

                </form>
              <h1 class="modal-title fs-5" id="exampleModalLabel">Consultation History</h1>
                <hr>
            
                <div class="row">
                    <div class="accordion" id="accordionExample">
                        
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function () {


        $.get("lib/routes/pet/myownpetlist.php", function (res) {
            $('#mypetlist').html(res);
        })

        let today = new Date().toISOString().split('T')[0];

        $("#date").attr("min", today);

        // Add button click
        $("#addtrackertbtn").click(function () {

            let dateInput = $("#date");
            let timeInput = $("#time");
            let descInput = $("#description");

            let date = dateInput.val().trim();
            let time = timeInput.val().trim();
            let description = descInput.val().trim();

            let isValid = true;

            //  Validation
            if (date === "") {
                dateInput.addClass("is-invalid");
                isValid = false;
            }

            if (time === "") {
                timeInput.addClass("is-invalid");
                isValid = false;
            }

            if (description === "") {
                descInput.addClass("is-invalid");
                isValid = false;
            }

            // Duplicate validation
            let isDuplicate = false;

            $("#pettrackers tr").each(function () {
                let rowDate = $(this).find("td:eq(0)").text().trim();
                let rowTime = $(this).find("td:eq(1)").text().trim();
                let rowDesc = $(this).find("td:eq(2)").text().trim();

                if (date === rowDate && time === rowTime && description === rowDesc) {
                    isDuplicate = true;
                    return false; // break loop
                }
            });

            if (isDuplicate) {
                alert("Duplicate record not allowed!");

                // mark all fields as invalid (optional)
                dateInput.addClass("is-invalid");
                timeInput.addClass("is-invalid");
                descInput.addClass("is-invalid");

                return;
            }

            if (!isValid) return;

            // Add row
            let newRow = `
                        <tr class="table-primary">
                            <td>${date}</td>
                            <td>${time}</td>
                            <td>${description}</td>
                            <td>
                                <button class="btn btn-danger btn-sm removeRow">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;

            $("#pettrackers").append(newRow);

            // 🔄 Clear inputs
            dateInput.val("");
            timeInput.val("");
            descInput.val("");
        });


        // Remove validation when typing
        $("#date, #time, #description").on("input change", function () {
            if ($(this).val().trim() !== "") {
                $(this).removeClass("is-invalid");
            }
        });


        // Remove row
        $(document).on("click", ".removeRow", function () {
            $(this).closest("tr").remove();
        });

        $("#savetrackerbtn").click(function () {

            let pet_id = $("#tpetid").val();
            let trackerData = [];

            //  Get all rows
            $("#pettrackers tr").each(function () {
                let date = $(this).find("td:eq(0)").text().trim();
                let time = $(this).find("td:eq(1)").text().trim();
                let description = $(this).find("td:eq(2)").text().trim();

                trackerData.push({
                    date: date,
                    time: time,
                    description: description
                });
            });

            // No data check
            if (trackerData.length === 0) {
                alert("No records to save!");
                return;
            }

            $.ajax({
                url: "lib/routes/tracking/saveTracker.php",
                type: "POST",
                data: {
                    pet_id: pet_id,
                    trackers: JSON.stringify(trackerData)
                },
                success: function (res) {
                    if (res.trim() === "success") {
                        Swal.fire({
                            title: "Saved!",
                            text: "Tracker records saved successfully",
                            icon: "success"
                        });

                        $.ajax({
                            url: "lib/routes/tracking/getTracker.php",
                            type: "POST",
                            data: {
                                pet_id: $('#tpetid').val()
                            },

                            success: function (res) {
                                $("#pettrackers").html(res);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Failed to save",
                            icon: "error"
                        });
                    }
                }
            });

        });

        $('#askbtn').on("click", function () {
           
            var valid = true;

            function validateField(id) {
                if ($(id).val() == "" || $(id).val() == null) {
                    $(id).addClass("is-invalid");
                    valid = false;
                } else {
                    $(id).removeClass("is-invalid");
                }
            }

            validateField('#description2');
            validateField('#priority');


            if (valid) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Ask Question!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        var form = $("#askform")[0];
                        var formData = new FormData(form);

                        $.ajax({
                            url: "lib/routes/consultation/ask.php",
                            type: "post",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (res) {
                                if (res == 'success') {
                                    $('#askform')[0].reset();

                                    Swal.fire({
                                        title: "Asked!",
                                        text: "Your Consultation Request was sent.",
                                        icon: "success"
                                    });

                                    $('#exampleModal1').modal("hide");

                                } else if (res == 'error') {
                                    Swal.fire({
                                        title: "Ask error",
                                        text: "something went wrong",
                                        icon: "warning"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Ask error",
                                        text: "something went wrong",
                                        icon: "warning"
                                    });
                                }

                            },
                            error: function (res) {

                            }
                        })

                    }
                });
            }


        })
    });

    function deletepet(id) {

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed)


                $.get("lib/routes/pet/deletepet.php", {
                    petid: id
                }, function (res) {

                    if (res == "success") {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your pet has been Deleted.",
                            icon: "success"
                        });
                        $('#mypetlist').html("");
                        $.get("lib/routes/pet/myownpetlist.php", function (res) {
                            $('#mypetlist').html(res);
                        })

                    } else {
                        Swal.fire({
                            title: "approve failed!",
                            text: "Something went wrong",
                            icon: "error"
                        });

                    }
                })

        })
    }

    function pettracker(id) {
        $('#exampleModal2').modal("show");
        $('#tpetid').val(id);

        //  load data
        $.ajax({
            url: "lib/routes/tracking/getTracker.php",
            type: "POST",
            data: {
                pet_id: id
            },

            success: function (res) {
                $("#pettrackers").html(res);
            }
        });
    }

    function petcon(id) {
        $('#exampleModal1').modal("show");
        $('#tpetid2').val(id);

        // load data
        $.ajax({
            url: "lib/routes/consultation/loadconhistory.php",
            type: "POST",
            data: {
                pet_id: id
            },

            success: function (res) {
                $("#accordionExample").html(res);
            }
        });
    }
</script>

</html>