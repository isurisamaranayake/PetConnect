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
                    <h3 class="mb-0">Add Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">add product</li>
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

                <form id="addproductform" autocomplete="off">
                    <fieldset>
                        <h1>Add Product</h1>

                        <div>
                            <label class="form-label mt-4">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" 
                                placeholder="Enter product name">
                        </div>

                        <div>
                            <label class="form-label mt-4">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Enter product description"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label class="form-label mt-4">Selling Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                    placeholder="Enter selling price">
                            </div>

                            <div class="col-6">
                                <label class="form-label mt-4">Cost Price</label>
                                <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price"
                                    placeholder="Enter cost price">
                            </div>
                        </div>

                        <div>
                            <label class="form-label mt-4">Stock Quantity</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity"
                                placeholder="Enter stock quantity">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="productimage" class="form-label mt-4">Product Pictures</label>
                                <input class="form-control" type="file" name="product_image" id="product_image">
                            </div>

                            <div class="col-6">
                                <img src="../../assets/image/images.png" alt="" id="productimageprv" style="height:150px;">
                            </div>
                        </div>
                        <div class="py-2">
                            <button id="addproductbtn" onclick="return false" class="btn btn-success">Add Product</button>
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

        $("#product_image").change(function () {

            var fileRead = new FileReader();

            fileRead.onload = function (e) {
                $("#productimageprv").attr("src", e.target.result);

            }

            fileRead.readAsDataURL(this.files[0]);

        })

        $('#addproductbtn').on("click", function () {

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

            validateField('#product_name');
            validateField('#description');
            validateField('#price');
            validateField('#cost_price');
            validateField('#stock_quantity');

            // Image validation
            if ($('#product_image')[0].files.length === 0) {
                $('#product_image').addClass('is-invalid');
                isValid = false;
            }
            
            if (isValid) {
                alert("Product added Successfully");

                var form = $("#addproductform")[0];
                var formData = new FormData(form);

                $.ajax({
                    url: "../routes/product/addproduct.php",
                    type: "post",
                    data: formData,
                    processdata: false,
                    contentType: false,

                    success: function (res) {

                        if (res.trim() === 'success') {
                            $('#addproductform')[0].reset();
                            Swal.fire({
                                title: "Successfully Saved",
                                text: "Product Added Successfully",
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