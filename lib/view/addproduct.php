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
                    <h3 class="mb-0">Product Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Management</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="container-fluid mt-4">
    <div class="row">

        <!-- LEFT SIDE FORM -->
        <div class="col-md-6">
            <form id="productForm" enctype="multipart/form-data">
                <input type="hidden" id="product_id" name="product_id">

                <h4 id="formTitle">Add Product</h4>

                <div class="mb-2">
                    <label>Product Name</label>
                    <input type="text" id="product_name" name="product_name" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Description</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>

                <div class="mb-2">
                    <label>Price</label>
                    <input type="number" id="price" name="price" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Cost Price</label>
                    <input type="number" id="cost_price" name="cost_price" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Stock Quantity</label>
                    <input type="number" id="stock_quantity" name="stock_quantity" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Image</label>
                    <input type="file" id="product_image" name="product_image" class="form-control">
                </div>

                <img id="preview" src="../../assets/image/images.png" style="height:120px">

                <div class="mt-3">
                    <button id="saveBtn" class="btn btn-success">Save</button>
                    <button type="button" id="resetBtn" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>

        <!-- RIGHT SIDE TABLE -->
        <div class="col-md-6">
             <h4 id="formTitle">All Products</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody id="productTable"></tbody>
            </table>
        </div>

    </div>
</div>
    <!--end::App Content-->
</main>
<!--end::App Main-->

<script>
   $(document).ready(function () {

    loadProducts();

    // IMAGE PREVIEW
    $("#product_image").change(function () {
        let reader = new FileReader();
        reader.onload = e => $("#preview").attr("src", e.target.result);
        reader.readAsDataURL(this.files[0]);
    });

    // SAVE
    $("#saveBtn").click(function (e) {
        e.preventDefault();

        let isValid = true;
        $('.form-control').removeClass('is-invalid');

        function validate(id){
            if($(id).val() === ""){
                $(id).addClass('is-invalid');
                isValid = false;
            }
        }

        validate("#product_name");
        validate("#price");
        validate("#stock_quantity");

        if(!isValid){
            Swal.fire("Error", "Fill required fields", "warning");
            return;
        }

        let form = $("#productForm")[0];
        let formData = new FormData(form);

        let id = $("#product_id").val();
        let url = (id === "") 
            ? "../routes/product/addproduct.php"
            : "../routes/product/updateproduct.php";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (res) {

                if (res.trim() === "success") {

                    Swal.fire("Success", "Saved Successfully", "success");

                    $("#productForm")[0].reset();
                    $("#product_id").val("");
                    $("#formTitle").text("Add Product");
                    $("#preview").attr("src","../../assets/image/images.png");

                    loadProducts();

                } else {
                    Swal.fire("Error", "Something went wrong", "error");
                }
            }
        });
    });

    // RESET
    $("#resetBtn").click(function () {
        $("#productForm")[0].reset();
        $("#product_id").val("");
        $("#formTitle").text("Add Product");
        $("#preview").attr("src","../../assets/image/images.png");
    });

});

// LOAD
function loadProducts(){
    $.get("../routes/product/loadproduct.php", function(res){
        $("#productTable").html(res);
    });
}

// EDIT
$(document).on("click", ".editBtn", function () {

    $("#product_id").val($(this).data("id"));
    $("#product_name").val($(this).data("name"));
    $("#description").val($(this).data("description"));
    $("#price").val($(this).data("price"));
    $("#cost_price").val($(this).data("cost"));
    $("#stock_quantity").val($(this).data("stock"));

    $("#preview").attr("src","../"+$(this).data("image"));

    $("#formTitle").text("Edit Product");

    // Swal.fire("Edit Mode", "You can now update this product", "info");
});

// DELETE
function deleteProduct(id){

    Swal.fire({
        title: "Delete?",
        text: "This product will be removed!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        confirmButtonText: "Yes delete"
    }).then((result)=>{
        if(result.isConfirmed){

            $.post("../routes/product/deleteproduct.php",{id:id},function(res){

                if(res.trim()=="success"){
                    Swal.fire("Deleted!", "Product removed", "success");
                    loadProducts();
                }else{
                    Swal.fire("Error", "Delete failed", "error");
                }

            });

        }
    });
}
</script>

<?php
      include_once('footer.php')
      ?>