<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product - Pet Products</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
            <div id="productview" class="row mt-3">

            </div>
            <div class="row mt-3" id="productdetails" >
            <div class="col-2">
                <button type="button" onclick="productlist();" class="btn btn-secondary" fdprocessedid="xx121o">Product List</button>
            </div> 
            <div class="row">
                    <div class="col-5">
                        <div class="row">
                            <h1 id="productname"></h1>
                        </div>
                        <div class="row">
                            <img id="productimageview" src="" alt="">
                        </div> 
                    </div>     
                    <div class="col-7 mt-5">
                        <div class="row" style = "height:300px;">
                        <h4 id="description"></h4>
                        </div>
                        <div class="row">
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
                        </div>
                    </div>  
               </div> 
            </div>
        </div>
    </div>
</body>


<script>
    $(document).ready(function () {})

    $('#productdetails').hide();
    $.get("lib/routes/product/loadallproducts.php", function (res) {
        $('#productview').html(res);

    })

    function loadproduct(isuri){
        $.get("lib/routes/product/productdatabyid.php",{productid: isuri}, function (res) {

            var jdata = JSON.parse(res);
            

            $('#productname').text(jdata.product_name); 
            $('#description').text(jdata.description);
            $('#price').text(jdata.price);
            $('#productimageview').attr('src','lib/'+jdata.image); 

        })
        $('#productdetails').show();
       $('#productview').hide(); 
    }
    function productlist(){
       $('#productdetails').hide();
       $('#productview').show(); 
    }
</script>

</html>