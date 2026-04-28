<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Pet- my pets for adoption</title>
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
                        <!--begin::Row-->
                        <div class="row">

                            <form id="addpetform" autocomplete="off">
                                <fieldset>
                                    <h1 id="formnametext">Pet Registration</h1>
                                    <div>
                                        <label for="exampleSelect1" class="form-label mt-4">Pet Category</label>
                                        <input type="hidden" id="petid" name="petid">
                                        <select class="form-select" id="pettype" name="type">
                                            <option disabled selected value="">Select Pet Category</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="exampleSelect1" class="form-label mt-4">Pet Breed</label>
                                        <select class="form-select mt-2" id="breed" name="breed">
                                            <option disabled selected value="">Select Breed</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="exampleInputEmail1" class="form-label mt-4">Pet Name</label>
                                        <input type="email" class="form-control" id="name" name="name"
                                            aria-describedby="emailHelp" placeholder="Enter pet name">
                                    </div>
                                    <div>
                                        <label for="exampleInputEmail1" class="form-label mt-4">Pet Gender</label>
                                        <select class="form-select mt-2" id="gender" name="gender">
                                            <option disabled selected value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="petAge" class="form-label mt-4">Pet Age Category</label>
                                        <select class="form-select" id="petAge" name="pet_age">
                                            <option disabled selected value="">Select Age Category</option>
                                            <option value="Baby">Baby (0 - 6 months)</option>
                                            <option value="Young">Young (6 months - 2 years)</option>
                                            <option value="Adult">Adult (2 - 7 years)</option>
                                            <option value="Senior">Senior (7+ years)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="petSize" class="form-label mt-4">Pet Size</label>
                                        <select class="form-select" id="petSize" name="pet_size">
                                            <option disabled selected value="">Select Size</option>
                                            <option value="Small">Small</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Large">Large</option>
                                            <option value="Extra Large">Extra Large</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="petColor" class="form-label mt-4">Pet Color</label>
                                        <select class="form-select" id="petColor" name="pet_color">
                                            <option disabled selected value="">Select Color</option>
                                            <option value="Black">Black</option>
                                            <option value="White">White</option>
                                            <option value="Brown">Brown</option>
                                            <option value="Golden">Golden</option>
                                            <option value="Grey">Grey</option>
                                            <option value="Cream">Cream</option>
                                            <option value="Mixed">Mixed</option>
                                            <option value="Spotted">Spotted</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label mt-4">Location</label>
                                        <select class="form-select" id="petlocation" name="pet_location">
                                            <option disabled selected value="">Select District</option>

                                            <option value="Colombo">Colombo</option>
                                            <option value="Gampaha">Gampaha</option>
                                            <option value="Kalutara">Kalutara</option>

                                            <option value="Kandy">Kandy</option>
                                            <option value="Matale">Matale</option>
                                            <option value="Nuwara Eliya">Nuwara Eliya</option>

                                            <option value="Galle">Galle</option>
                                            <option value="Matara">Matara</option>
                                            <option value="Hambantota">Hambantota</option>

                                            <option value="Jaffna">Jaffna</option>
                                            <option value="Kilinochchi">Kilinochchi</option>
                                            <option value="Mannar">Mannar</option>
                                            <option value="Vavuniya">Vavuniya</option>
                                            <option value="Mullaitivu">Mullaitivu</option>

                                            <option value="Batticaloa">Batticaloa</option>
                                            <option value="Ampara">Ampara</option>
                                            <option value="Trincomalee">Trincomalee</option>

                                            <option value="Kurunegala">Kurunegala</option>
                                            <option value="Puttalam">Puttalam</option>

                                            <option value="Anuradhapura">Anuradhapura</option>
                                            <option value="Polonnaruwa">Polonnaruwa</option>

                                            <option value="Badulla">Badulla</option>
                                            <option value="Monaragala">Monaragala</option>

                                            <option value="Ratnapura">Ratnapura</option>
                                            <option value="Kegalle">Kegalle</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="petColor" class="form-label mt-4">Other Details</label>
                                        <textarea class="form-control" name="otherdetails" id="otherdetails"
                                            placeholder="Pet Health / Pet Charactericstics / Food Preferences"
                                            rows="3"></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="petColor" class="form-label mt-4">Pet Pictures</label>
                                            <input class="form-control" type="file" name="petimage" id="petimage">
                                        </div>

                                        <div class="col-6">
                                            <img src="assets/image/images.png" alt="" id="petimageprv"
                                                style="height:150px;">
                                        </div>
                                        <div>
                                        <label for="petSize" class="form-label mt-4">This pet is</label>
                                        <select class="form-select" id="petfor" name="petfor">
                                            <option disabled selected value="">Select</option>
                                            <option value="Medium">my own pet</option>
                                            <option value="Small">for adoption</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="py-2">
                                        <button id="addpetbtn" onclick="return false" class="btn btn-success">Add
                                            Pet</button>
                                        <button id="editpetbtn" onclick="return false" class="btn btn-warning">Edit
                                            Pet</button>
                                        <button id="newpetbtn" onclick="return false" class="btn btn-info">New
                                            Pet</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <!--end::Row-->

                    </div>
                    <div class="col-6">
                        <!--begin::Row-->
                        <div class="row">

                            <form id="addpetform" autocomplete="off">
                                <fieldset>
                                    <h1>My Pets For Adoption</h1>

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

                <!-- /.row (main row) -->
            </div>
        </div>
    </div>
</body>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalcont1">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Interested List</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="table-dark">
                            <th scope="row">Name</th>
                            <td>Phone Number</td>
                            <td>Email Address</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody id="interestpersonlist">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
            </div>
        </div>
        <div class="modal-content" id="modalcont2" style="display:none">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Transfer Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="" id="transferform">

                <label for="petColor" class="form-label mt-4">Transfer Notes</label>

                <textarea class="form-control" name="transfernotes" id="transfernotes" placeholder="Pet Health / Pet Charactericstics / Food Preferences" rows="3"></textarea>

                <input type="hidden" name="interestid" id="interestid">
                <input type="hidden" name="ipetid" id="ipetid">
                <input type="hidden" name="icby" id="icby">


                <label for="petColor" class="form-label mt-4">Attach Document</label>
                <input class="form-control" type="file" name="documents" id="documents">

                <div class="text-end mt-3">
                    <button type="button" class="btn btn-success" id="transferconfirm"
                        onclick="return false">Confirm</button>
                </div>

</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="backlist();">Back</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        $('#editpetbtn, #newpetbtn').hide();

        $.get("lib/routes/pet/mypetlist.php", function (res) {
            $('#mypetlist').html(res);
        })

        var breedDropdown = $("#breed");

        $(document).on("click", ".editpetdata", function () {


            var pet_id = $(this).data("petid");

            $('#formnametext').text("Edit Pet");
            $('#editpetbtn, #newpetbtn').show();
            $('#addpetbtn').hide();

            $.get("lib/routes/pet/petdatabyid.php", {
                petid: pet_id
            }, function (res) {

                var jdata = JSON.parse(res);

                $('#pettype').val(jdata.type);;

                breedDropdown.empty();
                breedDropdown.append(
                    '<option disabled selected value="">Select Breed</option>');

                if (jdata.type) {

                    breedDropdown.prop("disabled", false);

                    $.each(pets[jdata.type], function (index, breed) {
                        breedDropdown.append(
                            '<option value="' + breed + '">' + breed +
                            '</option>'
                        );
                    });

                } else {
                    breedDropdown.prop("disabled", true);
                }

                $('#breed').val(jdata.breed);
                $('#name').val(jdata.name);
                $('#gender').val(jdata.gender);
                $('#petAge').val(jdata.pet_age);
                $('#petSize').val(jdata.pet_size);
                $('#petColor').val(jdata.pet_color);
                $('#petlocation').val(jdata.pet_location);
                $('#otherdetails').val(jdata.otherdetails);
                $("#petimageprv").attr("src", "lib/" + jdata.image);
                $('#petid').val(jdata.pet_id);




            })

        })

        $('#newpetbtn').on("click", function () {

            $('#formnametext').text("Add Pet");
            $('#editpetbtn, #newpetbtn').hide();
            $('#addpetbtn').show();
            $('#petid').val("");

        })

        $("#petimage").change(function () {

            var fileRead = new FileReader();

            fileRead.onload = function (e) {
                $("#petimageprv").attr("src", e.target.result);

            }

            fileRead.readAsDataURL(this.files[0]);

        })

        // All categories and breeds in one object
        var pets = {
            "Dog": [
                "Labrador",
                "German Shepherd",
                "Golden Retriever",
                "Bulldog",
                "Poodle",
                "Rottweiler",
                "Doberman",
                "Dachshund",
                "Street / stray dog",
                "Siberian Husky"
            ],
            "Cat": [
                "Persian",
                "Siamese",
                "Maine Coon",
                "British Shorthair",
                "Ragdoll",
                "Bengal",
                "Sphynx",
                "Street / stray cat",
                "Abyssinian",
                "Russian Blue"
            ],
            "Bird": [
                "Parrot",
                "Canary",
                "Budgie",
                "Cockatiel",
                "Lovebird",
                "Macaw",
                "Finch",
                "African Grey",
                "Cockatoo"
            ],
            "Fish": [
                "Goldfish",
                "Betta",
                "Guppy",
                "Angelfish",
                "Molly",
                "Platy",
                "Oscar",
                "Discus",
                "Neon Tetra"
            ],
            "Rabbit": [
                "Holland Lop",
                "Mini Rex",
                "Netherland Dwarf",
                "Lionhead",
                "Flemish Giant",
                "English Lop"
            ],
        };

        var categoryDropdown = $("#pettype");
        var breedDropdown = $("#breed");

        //Load categories into first dropdown
        $.each(pets, function (category, breeds) {
            categoryDropdown.append(
                '<option value="' + category + '">' + category + '</option>'
            );
        });

        //When category changes
        categoryDropdown.change(function () {

            var selectedCategory = $(this).val();

            breedDropdown.empty();
            breedDropdown.append('<option disabled selected value="">Select Breed</option>');

            if (selectedCategory) {

                breedDropdown.prop("disabled", false);

                $.each(pets[selectedCategory], function (index, breed) {
                    breedDropdown.append(
                        '<option value="' + breed + '">' + breed + '</option>'
                    );
                });

            } else {
                breedDropdown.prop("disabled", true);
            }

        });

        $('#addpetbtn').on("click", function () {

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

            validateField('#pettype');
            validateField('#breed');
            validateField('#name');
            validateField('#gender');
            validateField('#petAge');
            validateField('#petSize');
            validateField('#petColor');
            validateField('#petlocation');
            validateField('#otherdetails');
            validateField('#petimage');
            validateField('#petfor');

            // Image validation
            if ($('#petimage')[0].files.length === 0) {
                $('#petimage').addClass('is-invalid');
                isValid = false;
            }

            if (isValid) {

                var form = $("#addpetform")[0];
                var formData = new FormData(form);

                $.ajax({
                    url: "lib/routes/pet/addpet.php",
                    type: "post",
                    data: formData,
                    processdata: false,
                    contentType: false,

                    success: function (res) {

                        if (res.trim() === 'success') {
                            $('#addpetform')[0].reset();
                            Swal.fire({
                                title: "Successfully Saved",
                                text: "Pet Added Successfully",
                                icon: "success"
                            });

                            $('#mypetlist').html("");
                            $("#petimageprv").attr("src", "assets/image/images.png");

                            $.get("lib/routes/pet/mypetlist.php", function (res) {
                                $('#mypetlist').html(res);
                            })

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

        });

        $('#editpetbtn').on("click", function () {

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

            validateField('#pettype');
            validateField('#breed');
            validateField('#name');
            validateField('#gender');
            validateField('#petAge');
            validateField('#petSize');
            validateField('#petColor');
            validateField('#petlocation');
            validateField('#otherdetails');

            if (isValid) {

                var form = $("#addpetform")[0];
                var formData = new FormData(form);

                $.ajax({
                    url: "lib/routes/pet/editpet.php",
                    type: "post",
                    data: formData,
                    processdata: false,
                    contentType: false,

                    success: function (res) {

                        if (res.trim() === 'success') {
                            $('#addpetform')[0].reset();
                            Swal.fire({
                                title: "Edited Successfully",
                                text: "Pet Record Edited Successfully",
                                icon: "success"
                            });

                            $('#mypetlist').html("");

                            $.get("lib/routes/pet/mypetlist.php", function (res) {
                                $('#mypetlist').html(res);
                            })

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

        });

        $('#transferconfirm').on("click", function () {

            var valid = true;

            function validateField(id) {
                let value = $(id).val();
                if (!value) {
                    $(id).addClass('is-invalid');
                    isValid = false;
                }
            }

            validateField('#transfernotes');

            if (valid) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Transfer Pet!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        var form = $("#transferform")[0];
                        var formData = new FormData(form);

                        $.ajax({
                            url: "lib/routes/adoption/transferpet.php",
                            type: "post",
                            data: formData,
                            processdata: false,
                            contentType: false,

                            success: function (res) {

                                if (res.trim() === 'success') {
                                    $('#transferform')[0].reset();

                                    Swal.fire({
                                        title: "Transfered!",
                                        text: "Your pet has been transfered.",
                                        icon: "success"
                                    });

                                    $('#mypetlist').html("");

                                    $.get("lib/routes/pet/mypetlist.php", function (
                                        res) {
                                        $('#mypetlist').html(res);
                                    })

                                } else if (res === 'error') {
                                    Swal.fire({
                                        title: "Transfer Error",
                                        text: "Something went wrong",
                                        icon: "Warning"
                                    });

                                } else {
                                    Swal.fire({
                                        title: "Transfer Error",
                                        text: "something went wrong",
                                        icon: "warning"
                                    });

                                }
                            },
                            error: function (res) {}
                        })
                    }
                });
            }
        })




    });

    function viewintlist($petid) {
        $('#exampleModal').modal("show");

        $.get("lib/routes/adoption/interestlist.php", {
            petid: $petid
        }, function (res) {
            $('#interestpersonlist').html(res);
        })

    }

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
                        $.get("lib/routes/pet/mypetlist.php", function (res) {
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

    function backlist() {
        $('#modalcont1').show();
        $('#modalcont2').hide();
    }

    function transfer($xxx, $yyy, $zzz) {
        $('#modalcont1').hide();
        $('#modalcont2').show();

        $('#interestid').val($xxx);
        $('#ipetid').val($yyy);
        $('#icby').val($zzz);


    }
</script>

</html>