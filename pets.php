<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pet- pets for adoption</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .hover-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .hover-card img {
            transition: transform 0.3s ease;
            border-radius: 10px;
        }

        .hover-card:hover img {
            transform: scale(1.03);
        }
    </style>
</head>

<body>
    <?php
    include_once('common.php');
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card text-white bg-primary my-3">
                <div class="card-header">Filter</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-11">
                            <div class="row">
                                <div class="col-3">Pet Type</div>
                                <div class="col-3">Age Category</div>
                                <div class="col-3">Pet Size</div>
                                <div class="col-3">Pet Location</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-11">
                            <div class="row">
                        <div class="col-3">
                            <select class="form-select" id="pettype" name="type">
                                <option disabled selected value="">Select Pet Category</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select class="form-select" id="petAge" name="pet_age">
                                <option disabled selected value="">Select Age Category</option>
                                <option value="Baby">Baby (0 - 6 months)</option>
                                <option value="Young">Young (6 months - 2 years)</option>
                                <option value="Adult">Adult (2 - 7 years)</option>
                                <option value="Senior">Senior (7+ years)</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select class="form-select" id="petSize" name="pet_size">
                                <option disabled selected value="">Select Size</option>
                                <option value="Small">Small</option>
                                <option value="Medium">Medium</option>
                                <option value="Large">Large</option>
                                <option value="Extra Large">Extra Large</option>
                            </select>
                        </div>
                        <div class="col-3">
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
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" id="filterbutton" class="btn btn-success"><i class="bi bi-search-heart-fill"></i></button>
                </div>
                    </div>
                    
                </div>
            </div>
            <div id="petview" class="row mt-3">

            </div>
            <div class="row mt-3" id="petdetails">
                <div class="col-2">
                    <button type="button" onclick="petlist();" class="btn btn-secondary" fdprocessedid="xx121o">Pet
                        List</button>
                </div>

                <div class="row">
                    <div class="col-5">
                        <div class="row">
                            <h1 id="petname"></h1>
                        </div>
                        <div class="row">
                            <img id="petimageview" src="" alt="">
                        </div>
                    </div>
                    <div class="col-7 mt-5">
                        <input type="hidden" id="selectedpetid">
                        <div class="row" style="height:300px;">
                            <h4 id="otherdetailstext"></h4>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <div class="row">
                                    <img src="lib/Upload/ui/petbreed.png" alt="">
                                </div>
                                <div class="row">
                                    <h4 id=breedtext></h4>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <img src="lib/Upload/ui/petgender.png" alt="">
                                </div>
                                <div class="row">
                                    <h4 id=gendertext></h4>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <img src="lib/Upload/ui/petsize.png" alt="">
                                </div>
                                <div class="row">
                                    <h4 id=sizetext></h4>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <img src="lib/Upload/ui/petage.png" alt="">
                                </div>
                                <div class="row">
                                    <h4 id=agetext></h4>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <img src="lib/Upload/ui/petlocation.png" alt="">
                                </div>
                                <div class="row">
                                    <h4 id=locationtext></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="intbtn">
                            <button type="button" id="interestbtn" class="btn btn-warning">Interested</button>
                        </div>
                        <div class="row" id="intcdata">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Name</h3>
                                </div>
                                <div class="col-6">
                                    <h3 id="conname"></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h3>Phone Number</h3>
                                </div>
                                <div class="col-6">
                                    <h3 id="conphone"></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h3>Email Address</h3>
                                </div>
                                <div class="col-6">
                                    <h3 id="conemail"></h3>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<script>
    $(document).ready(function(){

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

        //Load categories into first dropdown
        $.each(pets, function (category, breeds) {
            categoryDropdown.append(
                '<option value="' + category + '">' + category + '</option>'
            );
        });

    
        $('#petdetails').hide();

            $.get("lib/routes/pet/loadallpetsforadoption.php", function (res) {
                $('#petview').html(res);

        })

        $('#filterbutton').on("click", function () {

                let category = $('#pettype').val() || "--";
                let pet_age = $('#petAge').val() || "--";
                let pet_size = $('#petSize').val() || "--";
                let petlocation = $('#petlocation').val() || "--";

                $.get("lib/routes/pet/loadfilterpetsforadoption.php",{category:category,pet_age:pet_age,pet_size:pet_size,petlocation:petlocation},function (res) {
                $('#petview').html(res);

            })
        })

        $('#interestbtn').on("click", function () {

                let petid = $('#selectedpetid').val();
            
                $.get("lib/routes/adoption/interested.php",{pet_id:petid},function (res) {

            })
            $('#intcdata').show();
                $('#intbtn').hide();
        })

    })

    function loadpet(isuri) {

            $('#intcdata').hide();
            $('#intbtn').show();


        $.get("lib/routes/pet/petdatabyid.php", {
            petid: isuri
        }, function (res) {

            var jdata = JSON.parse(res);


            $('#petname').text(jdata.name);
            $('#selectedpetid').val(jdata.pet_id);
            $('#otherdetailstext').text(jdata.otherdetails);
            $('#gendertext').text(jdata.gender);
            $('#sizetext').text(jdata.pet_size);
            $('#locationtext').text(jdata.pet_location);
            $('#agetext').text(jdata.pet_age);
            $('#breedtext').text(jdata.breed);
            $('#petimageview').attr('src', 'lib/' + jdata.image);

            $('#conname').text(jdata.userName);
            $('#conphone').text(jdata.phone);
            $('#conemail').text(jdata.email);

            if(jdata.i_status == null){
                $('#intcdata').hide();
                $('#intbtn').show();
                
            }else{
                $('#intcdata').show();
                $('#intbtn').hide();

            }

        })
        $('#petdetails').show();
        $('#petview').hide();
    }

    function petlist() {
        $('#petdetails').hide();
        $('#petview').show();
    }
</script>

</html>